<?php

/**
 * Form protection: rate limiting, time trap, content filtering, and Cloudflare Turnstile.
 *
 * @package MyCustomTheme
 */

defined('ABSPATH') || exit;

/**
 * Turnstile site key (visible widget). Override in wp-config.php if needed.
 */
if (! defined('MY_THEME_TURNSTILE_SITE_KEY')) {
    define('MY_THEME_TURNSTILE_SITE_KEY', '');
}

/**
 * Turnstile secret key (server verification). Override in wp-config.php if needed.
 */
if (! defined('MY_THEME_TURNSTILE_SECRET_KEY')) {
    define('MY_THEME_TURNSTILE_SECRET_KEY', '');
}

/**
 * Maximum form submissions per IP within the time window.
 */
if (! defined('MY_THEME_RATE_LIMIT_MAX')) {
    define('MY_THEME_RATE_LIMIT_MAX', 2);
}

/**
 * Rate limit time window in seconds (default: 15 minutes).
 */
if (! defined('MY_THEME_RATE_LIMIT_WINDOW')) {
    define('MY_THEME_RATE_LIMIT_WINDOW', 900);
}

/**
 * Minimum seconds between successive submissions from the same IP (burst protection).
 */
if (! defined('MY_THEME_RATE_BURST_WINDOW')) {
    define('MY_THEME_RATE_BURST_WINDOW', 120);
}

/**
 * Max submissions per email address within MY_THEME_RATE_EMAIL_WINDOW.
 */
if (! defined('MY_THEME_RATE_EMAIL_MAX')) {
    define('MY_THEME_RATE_EMAIL_MAX', 1);
}

/**
 * Per-email rate limit window in seconds (default: 1 hour).
 */
if (! defined('MY_THEME_RATE_EMAIL_WINDOW')) {
    define('MY_THEME_RATE_EMAIL_WINDOW', 3600);
}

/**
 * Block identical submissions (same fingerprint) for this many seconds.
 */
if (! defined('MY_THEME_DUPLICATE_WINDOW')) {
    define('MY_THEME_DUPLICATE_WINDOW', 86400);
}

/**
 * Minimum seconds between page load and form submission (bot trap).
 */
if (! defined('MY_THEME_MIN_SUBMIT_TIME')) {
    define('MY_THEME_MIN_SUBMIT_TIME', 3);
}

/**
 * Reject submissions if the form timestamp is older than this (seconds).
 */
if (! defined('MY_THEME_FORM_MAX_AGE')) {
    define('MY_THEME_FORM_MAX_AGE', 14400);
}

/**
 * Check whether Turnstile is configured (both keys present).
 */
function my_theme_turnstile_enabled(): bool
{
    return MY_THEME_TURNSTILE_SITE_KEY !== '' && MY_THEME_TURNSTILE_SECRET_KEY !== '';
}

/**
 * Get the visitor's IP address, accounting for common proxies.
 */
function my_theme_get_client_ip(): string
{
    if (! empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $ip = trim((string) $_SERVER['HTTP_CF_CONNECTING_IP']);
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
        }
    }

    $remote = ! empty($_SERVER['REMOTE_ADDR']) ? trim((string) $_SERVER['REMOTE_ADDR']) : '';
    if (filter_var($remote, FILTER_VALIDATE_IP)) {
        return $remote;
    }

    return '0.0.0.0';
}

/**
 * Build a stable fingerprint for duplicate submission detection.
 */
function my_theme_submission_fingerprint(
    string $name,
    string $company,
    string $email,
    string $message,
    string $phone = ''
): string {
    $normalized = strtolower(trim($name)) . '|'
        . strtolower(trim($company)) . '|'
        . strtolower(trim($email)) . '|'
        . strtolower(trim($phone)) . '|'
        . strtolower(preg_replace('/\s+/', ' ', trim($message)));

    return hash('sha256', $normalized);
}

/**
 * Increment a rate-limit counter atomically (wp_options + transaction).
 * Returns true when the request is allowed, false when the limit is exceeded.
 */
function my_theme_rate_limit_allow(string $bucket, int $max, int $window_seconds): bool
{
    global $wpdb;

    if ($max < 1 || $window_seconds < 1) {
        return false;
    }

    $option_name = 'my_theme_rl_' . md5($bucket);
    $now         = time();

    $started = $wpdb->query('START TRANSACTION');
    if ($started === false) {
        return my_theme_rate_limit_allow_transient($bucket, $max, $window_seconds);
    }

    $value = $wpdb->get_var($wpdb->prepare(
        "SELECT option_value FROM {$wpdb->options} WHERE option_name = %s FOR UPDATE",
        $option_name
    ));

    $data = null;
    if ($value !== null) {
        $decoded = json_decode((string) $value, true);
        if (is_array($decoded)) {
            $data = $decoded;
        }
    }

    if ($data === null || $now >= (int) ($data['reset_at'] ?? 0)) {
        $data = [
            'count'    => 1,
            'reset_at' => $now + $window_seconds,
        ];

        if ($value === null) {
            $inserted = $wpdb->insert(
                $wpdb->options,
                [
                    'option_name'  => $option_name,
                    'option_value' => wp_json_encode($data),
                    'autoload'     => 'no',
                ],
                ['%s', '%s', '%s']
            );
            if ($inserted === false) {
                $wpdb->query('ROLLBACK');
                return my_theme_rate_limit_allow_transient($bucket, $max, $window_seconds);
            }
        } else {
            $wpdb->update(
                $wpdb->options,
                ['option_value' => wp_json_encode($data)],
                ['option_name' => $option_name],
                ['%s'],
                ['%s']
            );
        }

        $wpdb->query('COMMIT');
        return true;
    }

    $count = (int) ($data['count'] ?? 0);
    if ($count >= $max) {
        $wpdb->query('ROLLBACK');
        return false;
    }

    $data['count'] = $count + 1;
    $wpdb->update(
        $wpdb->options,
        ['option_value' => wp_json_encode($data)],
        ['option_name' => $option_name],
        ['%s'],
        ['%s']
    );
    $wpdb->query('COMMIT');

    return true;
}

/**
 * Transient-based fallback when DB transactions are unavailable.
 */
function my_theme_rate_limit_allow_transient(string $bucket, int $max, int $window_seconds): bool
{
    $key  = 'form_rl_' . md5($bucket);
    $data = get_transient($key);

    if ($data === false || ! is_array($data) || ! isset($data['count'], $data['first'])) {
        set_transient($key, ['count' => 1, 'first' => time()], $window_seconds);
        return true;
    }

    if ($data['count'] >= $max) {
        return false;
    }

    $data['count']++;
    $elapsed   = time() - (int) $data['first'];
    $remaining = max(1, $window_seconds - $elapsed);
    set_transient($key, $data, $remaining);

    return true;
}

/**
 * Apply IP burst, IP window, email, and duplicate submission limits.
 */
function my_theme_check_submission_rate_limits(string $email): string
{
    $ip = my_theme_get_client_ip();

    if (! my_theme_rate_limit_allow('burst:ip:' . $ip, 1, MY_THEME_RATE_BURST_WINDOW)) {
        return 'rate_limit';
    }

    if (! my_theme_rate_limit_allow('ip:' . $ip, MY_THEME_RATE_LIMIT_MAX, MY_THEME_RATE_LIMIT_WINDOW)) {
        return 'rate_limit';
    }

    $email_key = 'email:' . hash('sha256', strtolower(trim($email)));
    if (! my_theme_rate_limit_allow($email_key, MY_THEME_RATE_EMAIL_MAX, MY_THEME_RATE_EMAIL_WINDOW)) {
        return 'rate_limit';
    }

    return '';
}

/**
 * Validate the time trap field. Returns true if the submission time is plausible.
 */
function my_theme_check_time_trap(): bool
{
    if (! isset($_POST['_form_loaded'])) {
        return false;
    }

    $loaded = (int) $_POST['_form_loaded'];
    $now = time();

    if ($loaded <= 0 || $loaded > $now) {
        return false;
    }

    $elapsed = $now - $loaded;

    if ($elapsed < MY_THEME_MIN_SUBMIT_TIME) {
        return false;
    }

    return $elapsed <= MY_THEME_FORM_MAX_AGE;
}

/**
 * Check form content for spam signals. Returns error key or empty string if clean.
 */
function my_theme_check_content_spam(string $name, string $company, string $email, string $message): string
{
    $url_pattern = '#https?://|www\.|\.com/|\.net/|\.org/|bit\.ly|tinyurl#i';
    if (preg_match($url_pattern, $name) || preg_match($url_pattern, $company)) {
        return 'spam_content';
    }

    if (preg_match($url_pattern, $message) && substr_count($message, 'http') > 2) {
        return 'spam_content';
    }

    $spam_phrases = [
        'buy now', 'click here', 'free money', 'casino', 'viagra',
        'cryptocurrency', 'earn money fast', 'work from home',
        'nigerian prince', 'wire transfer', 'bitcoin investment',
        'SEO services', 'link building', 'web traffic',
    ];

    $combined = strtolower($name . ' ' . $company . ' ' . $message);
    foreach ($spam_phrases as $phrase) {
        if (str_contains($combined, $phrase)) {
            return 'spam_content';
        }
    }

    $disposable_domains = [
        'mailinator.com', 'guerrillamail.com', 'tempmail.com', 'throwaway.email',
        'yopmail.com', 'sharklasers.com', 'trashmail.com', 'fakeinbox.com',
        'maildrop.cc', '10minutemail.com', 'temp-mail.org',
    ];

    $email_domain = strtolower(substr($email, strpos($email, '@') + 1));
    if (in_array($email_domain, $disposable_domains, true)) {
        return 'spam_email';
    }

    if (preg_match('/(.)\1{4,}/', $name) || preg_match('/^[^aeiou]{8,}$/i', $name)) {
        return 'spam_content';
    }

    return '';
}

/**
 * Verify Cloudflare Turnstile token. Returns true if valid or if Turnstile is not configured.
 */
function my_theme_verify_turnstile(): bool
{
    if (! my_theme_turnstile_enabled()) {
        return true;
    }

    $token = isset($_POST['cf-turnstile-response'])
        ? sanitize_text_field(wp_unslash((string) $_POST['cf-turnstile-response']))
        : '';

    if ($token === '') {
        return false;
    }

    $response = wp_remote_post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
        'body' => [
            'secret'   => MY_THEME_TURNSTILE_SECRET_KEY,
            'response' => $token,
            'remoteip' => my_theme_get_client_ip(),
        ],
        'timeout' => 10,
    ]);

    if (is_wp_error($response)) {
        return false;
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);

    return ! empty($body['success']);
}

/**
 * Run all protection checks. Returns error key string or empty string if all pass.
 */
function my_theme_run_form_protection(
    string $name,
    string $company,
    string $email,
    string $message,
    string $phone = ''
): string {
    $rate_error = my_theme_check_submission_rate_limits($email);
    if ($rate_error !== '') {
        return $rate_error;
    }

    if (! my_theme_check_time_trap()) {
        return 'spam_bot';
    }

    if (! my_theme_verify_turnstile()) {
        return 'captcha';
    }

    $content_check = my_theme_check_content_spam($name, $company, $email, $message);
    if ($content_check !== '') {
        return $content_check;
    }

    $fingerprint = my_theme_submission_fingerprint($name, $company, $email, $message, $phone);
    if (! my_theme_rate_limit_allow('dup:' . $fingerprint, 1, MY_THEME_DUPLICATE_WINDOW)) {
        return 'duplicate';
    }

    return '';
}

/**
 * Enqueue Turnstile script on pages with forms.
 */
function my_theme_enqueue_turnstile(): void
{
    if (! my_theme_turnstile_enabled()) {
        return;
    }

    if (! is_front_page() && ! my_theme_is_contact_page()) {
        return;
    }

    wp_enqueue_script(
        'cf-turnstile',
        'https://challenges.cloudflare.com/turnstile/v0/api.js',
        [],
        null,
        ['strategy' => 'defer']
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_turnstile');

/**
 * Prevent double-clicks from firing multiple POST requests in quick succession.
 */
function my_theme_contact_form_submit_guard(): void
{
    if (is_admin()) {
        return;
    }
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form input[name="action"][value="my_theme_contact_form"]').forEach(function (input) {
            var form = input.form;
            if (!form || form.dataset.myThemeSubmitGuard === '1') {
                return;
            }
            form.dataset.myThemeSubmitGuard = '1';
            form.addEventListener('submit', function () {
                var btn = form.querySelector('button[type="submit"], input[type="submit"]');
                if (btn && !btn.disabled) {
                    btn.disabled = true;
                    btn.setAttribute('aria-busy', 'true');
                }
            });
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'my_theme_contact_form_submit_guard', 20);

/**
 * Check if current page is the contact page.
 */
function my_theme_is_contact_page(): bool
{
    $path = isset($_SERVER['REQUEST_URI']) ? trim(parse_url((string) $_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') : '';
    return $path === 'contact' || $path === 'contact/';
}

/**
 * Render the Turnstile widget markup (place inside form).
 */
function my_theme_render_turnstile_widget(): void
{
    if (! my_theme_turnstile_enabled()) {
        return;
    }
    ?>
    <div class="cf-turnstile mb-6" data-sitekey="<?php echo esc_attr(MY_THEME_TURNSTILE_SITE_KEY); ?>" data-theme="light"></div>
    <?php
}

/**
 * Render the time-trap hidden field (place inside form).
 */
function my_theme_render_time_trap(): void
{
    ?>
    <input type="hidden" name="_form_loaded" value="<?php echo esc_attr((string) time()); ?>">
    <?php
}

/**
 * Map protection error codes to user-friendly messages.
 */
function my_theme_get_protection_error_message(string $error_code): string
{
    $messages = [
        'rate_limit'   => 'You have submitted too many requests. Please wait a few minutes and try again.',
        'spam_bot'     => 'Your submission was flagged as suspicious. Please reload the page and try again.',
        'captcha'      => 'Please complete the security check and try again.',
        'spam_content' => 'Your submission was flagged as spam. Please remove any links and try again.',
        'spam_email'   => 'Please use a valid business email address.',
        'security'     => 'Security verification failed. Please reload the page and try again.',
        'validation'   => 'Please fill in all required fields with valid information.',
        'phone_invalid' => 'Please enter a valid phone number.',
        'send'         => 'We could not send your message. Please try again or contact us directly.',
    ];

    return $messages[$error_code] ?? 'Sorry, we could not submit your request. Please try again.';
}
