<?php

/**
 * My Custom Theme - functions and definitions.
 *
 * @package MyCustomTheme
 */

define('THEME_VERSION', '1.0.0');

require_once __DIR__ . '/inc/video-library.php';
require_once __DIR__ . '/inc/case-study-library.php';
require_once __DIR__ . '/inc/breadcrumbs.php';
require_once __DIR__ . '/inc/contact-details.php';
require_once __DIR__ . '/inc/faq-data.php';
require_once __DIR__ . '/inc/schema.php';
require_once __DIR__ . '/inc/form-protection.php';
require_once __DIR__ . '/inc/email-templates.php';
require_once __DIR__ . '/inc/admin/bootstrap.php';
require_once __DIR__ . '/inc/blocks.php';
require_once __DIR__ . '/inc/block-patterns.php';

/**
 * Theme setup: register support for WordPress features.
 */
function my_theme_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'my-custom-theme'),
        'footer'  => __('Footer Menu', 'my-custom-theme'),
    ]);
}
add_action('after_setup_theme', 'my_theme_setup');

/* ------------------------------------------------------------------ */
/*  Case Study Custom Post Type                                         */
/* ------------------------------------------------------------------ */

/**
 * Register the 'case-study' Custom Post Type.
 *
 * Posts are served at /case-studies/{slug}/ by WordPress native routing.
 * The listing at /case-studies/ is handled by the existing WordPress Page
 * (slug: case-studies) and page-case-studies.php template.
 */
function my_theme_register_case_study_cpt(): void
{
    register_post_type('case-study', [
        'labels' => [
            'name'               => 'Case Studies',
            'singular_name'      => 'Case Study',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Case Study',
            'edit_item'          => 'Edit Case Study',
            'new_item'           => 'New Case Study',
            'view_item'          => 'View Case Study',
            'search_items'       => 'Search Case Studies',
            'not_found'          => 'No case studies found',
            'not_found_in_trash' => 'No case studies found in trash',
        ],
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => ['slug' => 'case-studies', 'with_front' => false],
        'show_in_rest'  => true,
        'supports'      => ['title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 'excerpt'],
        'menu_icon'     => 'dashicons-portfolio',
        'menu_position' => 5,
        'template'      => [
            ['goliath/cs-hero', [
                'client' => '',
                'intro'  => '',
            ]],
            ['goliath/cs-problem', [
                'title'          => '',
                'problemText'    => '',
                'problemCallout' => '',
                'triedText'      => '',
                'triedCallout'   => '',
            ]],
            ['goliath/cs-metrics-row', [
                'metric1Value' => '',
                'metric1Label' => '',
                'metric2Value' => '',
                'metric2Label' => '',
                'metric3Value' => '',
                'metric3Label' => '',
            ]],
            ['goliath/cs-content-section', [
                'heading'       => 'The Solution: Goliath™',
                'body'          => '',
                'callout'       => '',
                'imagePosition' => 'none',
            ]],
            ['goliath/cs-image-row', [
                'layout' => 'single',
            ]],
            ['goliath/cs-solution', [
                'sectionTitle'    => 'The Solution: Goliath™',
                'video'           => '',
                'solutionText'    => '',
                'solutionCallout' => '',
            ]],
            ['goliath/cs-results', [
                'sectionTitle' => 'The Results',
                'resultsImage' => '',
                'resultsIntro' => '',
                'result1Title' => '',
                'result1Text'  => '',
                'result2Title' => '',
                'result2Text'  => '',
                'result3Title' => '',
                'result3Text'  => '',
                'result4Title' => '',
                'result4Text'  => '',
                'warrantyText' => '',
            ]],
            ['goliath/cs-inline-quote', [
                'quote'       => '',
                'attribution' => '',
            ]],
            ['goliath/cs-testimonial-cta', [
                'client'      => '',
                'quote'       => '',
                'attribution' => '',
                'ctaText'     => 'Get Similar Results',
                'ctaUrl'      => '/contact/',
            ]],
        ],
        'template_lock' => false,
    ]);
}
add_action('init', 'my_theme_register_case_study_cpt');

function my_theme_register_case_study_meta(): void
{
    $meta_fields = [
        '_cs_client', '_cs_challenge', '_cs_solution', '_cs_image',
        '_cs_metric_1_value', '_cs_metric_1_label',
        '_cs_metric_2_value', '_cs_metric_2_label',
        '_cs_metric_3_value', '_cs_metric_3_label',
        '_cs_seo_title', '_cs_seo_desc',
    ];

    foreach ($meta_fields as $key) {
        register_post_meta('case-study', $key, [
            'show_in_rest'  => true,
            'single'        => true,
            'type'          => 'string',
            'auth_callback' => fn() => current_user_can('edit_posts'),
        ]);
    }
}
add_action('init', 'my_theme_register_case_study_meta');

/* ------------------------------------------------------------------ */
/*  Video CPT                                                          */
/* ------------------------------------------------------------------ */

function my_theme_register_video_cpt(): void
{
    register_post_type('video', [
        'labels' => [
            'name'               => 'Videos',
            'singular_name'      => 'Video',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Video',
            'edit_item'          => 'Edit Video',
            'new_item'           => 'New Video',
            'view_item'          => 'View Video',
            'search_items'       => 'Search Videos',
            'not_found'          => 'No videos found',
            'not_found_in_trash' => 'No videos found in trash',
        ],
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => ['slug' => 'videos', 'with_front' => false],
        'show_in_rest'  => true,
        'supports'      => ['title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'page-attributes'],
        'menu_icon'     => 'dashicons-video-alt3',
        'menu_position' => 6,
        'template'      => [
            ['goliath/vid-hero', [
                'label'       => 'Featured Video',
                'titleOrange' => '',
                'titleWhite'  => '',
                'description' => 'Watch Goliath in action and learn everything you need to know about warehouse racking safety, compliance, and cost-effective repair solutions.',
            ]],
            ['goliath/vid-player', [
                'videoUrl'    => '',
                'posterUrl'   => '',
                'heading'     => '',
                'description' => '',
            ]],
            ['goliath/vid-related', []],
            ['goliath/vid-content', [
                'headingBlack'  => "What the Goliath\xe2\x84\xa2",
                'headingOrange' => 'Video Series Covers',
                'introText'     => "The Goliath\xe2\x84\xa2 videos provide clear, practical insight into:",
                'bulletPoints'  => [
                    'Why repeated upright replacement leads to ongoing costs and disruption',
                    "How Goliath\xe2\x84\xa2 differs from standard pallet racking repair",
                    'The installation process in live warehouse environments',
                    'How damaged uprights are cut, reinforced, and fixed on site',
                    "How Goliath\xe2\x84\xa2 supports safety, compliance, and long-term cost control",
                ],
                'closingText' => 'Each video is designed to be easy to understand and relevant to real-world warehouse operations.',
            ]],
            ['goliath/vid-cta', [
                'heading'     => 'Ready to See Goliath in Your Warehouse?',
                'description' => "Book a free on-site demonstration and see first-hand how Goliath\xe2\x84\xa2 can improve your racking maintenance.",
                'buttonText'  => 'Schedule Live Demo',
                'buttonUrl'   => '/contact/',
            ]],
        ],
        'template_lock' => false,
    ]);
}
add_action('init', 'my_theme_register_video_cpt');

/**
 * Video post meta for carousel section grouping.
 */
function my_theme_register_video_meta(): void
{
    register_post_meta('video', '_video_section', [
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'default'       => 'installation',
        'auth_callback' => static fn (): bool => current_user_can('edit_posts'),
    ]);
}
add_action('init', 'my_theme_register_video_meta');

/**
 * Sidebar control: which carousel section this video appears in on /videos/.
 */
function my_theme_video_section_meta_box(): void
{
    add_meta_box(
        'my_theme_video_section',
        'Videos Page Carousel',
        'my_theme_render_video_section_meta_box',
        'video',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'my_theme_video_section_meta_box');

/**
 * @param WP_Post $post Current video post.
 */
function my_theme_render_video_section_meta_box(WP_Post $post): void
{
    wp_nonce_field('my_theme_video_section_save', 'my_theme_video_section_nonce');
    $current = my_theme_get_video_post_section($post->ID);
    ?>
    <p>
        <label for="my_theme_video_section_field"><strong>Carousel section</strong></label>
    </p>
    <select name="my_theme_video_section_field" id="my_theme_video_section_field" class="widefat">
        <option value="installation" <?php selected($current, 'installation'); ?>>Installation &amp; Product Demos</option>
        <option value="safety" <?php selected($current, 'safety'); ?>>Safety &amp; Compliance</option>
    </select>
    <p class="description">Published videos appear automatically in the matching carousel on the Videos page.</p>
    <?php
}

/**
 * @param int $post_id Saved post ID.
 */
function my_theme_save_video_section_meta(int $post_id): void
{
    if (! isset($_POST['my_theme_video_section_nonce'])) {
        return;
    }

    $nonce = sanitize_text_field(wp_unslash((string) $_POST['my_theme_video_section_nonce']));
    if (! wp_verify_nonce($nonce, 'my_theme_video_section_save')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    if (get_post_type($post_id) !== 'video') {
        return;
    }

    $section = sanitize_key((string) wp_unslash($_POST['my_theme_video_section_field'] ?? 'installation'));
    if (! in_array($section, ['installation', 'safety'], true)) {
        $section = 'installation';
    }

    update_post_meta($post_id, '_video_section', $section);
}
add_action('save_post_video', 'my_theme_save_video_section_meta');

/**
 * Flush rewrite rules once after the CPT is registered.
 *
 * Runs on admin_init to avoid a performance hit on every front-end request.
 * Self-removes via an option so it only fires once.
 */
function my_theme_flush_rewrite_once(): void
{
    if (get_option('my_theme_cpt_rewrite_flushed') !== 'yes') {
        flush_rewrite_rules(false);
        update_option('my_theme_cpt_rewrite_flushed', 'yes', false);
    }
}
add_action('admin_init', 'my_theme_flush_rewrite_once');

/**
 * Enqueue styles and scripts.
 */
function my_theme_enqueue_assets(): void
{
    wp_enqueue_style(
        'my-theme-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&family=Montserrat:wght@400;500;600;700&family=Roboto:wght@400;500;600;700&family=Yantramanav:wght@700&display=swap',
        [],
        null
    );

    $css_file = get_theme_file_path('dist/output.css');
    wp_enqueue_style(
        'my-theme-tailwind',
        get_theme_file_uri('dist/output.css'),
        ['my-theme-google-fonts'],
        file_exists($css_file) ? (string) filemtime($css_file) : THEME_VERSION
    );

    $js_file = get_theme_file_path('assets/js/header-navigation.js');
    wp_enqueue_script(
        'my-theme-header-navigation',
        get_theme_file_uri('assets/js/header-navigation.js'),
        [],
        file_exists($js_file) ? (string) filemtime($js_file) : THEME_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_assets');

/**
 * Add defer to selected scripts.
 */
function my_theme_add_defer_to_scripts(string $tag, string $handle, string $src): string
{
    $deferred_handles = [
        'my-theme-header-navigation',
    ];

    if (! in_array($handle, $deferred_handles, true)) {
        return $tag;
    }

    return sprintf(
        '<script src="%1$s" id="%2$s-js" defer></script>',
        esc_url($src),
        esc_attr($handle)
    );
}
add_filter('script_loader_tag', 'my_theme_add_defer_to_scripts', 10, 3);

/**
 * Add font preconnect hints.
 *
 * @param string[] $urls
 * @return string[]
 */
function my_theme_resource_hints(array $urls, string $relation_type): array
{
    if ($relation_type !== 'preconnect') {
        return $urls;
    }

    $urls[] = 'https://fonts.googleapis.com';
    $urls[] = [
        'href'        => 'https://fonts.gstatic.com',
        'crossorigin' => 'anonymous',
    ];

    return $urls;
}
add_filter('wp_resource_hints', 'my_theme_resource_hints', 10, 2);

/**
 * Preload primary webfont stylesheet.
 */
function my_theme_preload_fonts(): void
{
    $fonts_url = 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&family=Montserrat:wght@400;500;600;700&family=Roboto:wght@400;500;600;700&family=Yantramanav:wght@700&display=swap';
    echo '<link rel="preload" href="' . esc_url($fonts_url) . '" as="style">' . "\n";
}
add_action('wp_head', 'my_theme_preload_fonts', 1);


/**
 * Get a stable URL for a page slug with a fallback.
 *
 * @param string $slug
 * @param string $fallback_url
 * @return string
 */
function my_theme_get_page_url_or_fallback(string $slug, string $fallback_url): string
{
    $page = get_page_by_path($slug);
    if ($page instanceof WP_Post) {
        return get_permalink($page->ID) ?: $fallback_url;
    }

    return $fallback_url;
}

/**
 * Shared navigation items for header/footer.
 *
 * @return array<string, string>
 */
function my_theme_get_primary_nav_items(): array
{
    return [
        'Why Goliath™?' => home_url('/why-goliath/'),
        'How it works?' => home_url('/how-it-works/'),
        'Services' => [
            'url' => home_url('/services/'),
            'children' => [
                'Racking Upright Repair' => home_url('/services/racking-upright-repair/'),
                'Damage Prevention' => home_url('/services/damage-prevention/'),
                'Annual Inspections' => home_url('/services/annual-inspections/'),
                'Racking Installations & CDM' => home_url('/services/installations-cdm/'),
                'Racking Reconfiguration Services' => home_url('/services/reconfiguration/'),
            ],
        ],
        'Compliance' => home_url('/compliance/'),
        'Case Studies' => home_url('/case-studies/'),
    ];
}

/**
 * Handle contact/assessment form submissions with full protection stack:
 * nonce, honeypot, rate limiting, time trap, Turnstile CAPTCHA, and content filtering.
 */
function my_theme_handle_contact_form_submission(): void
{
    $redirect_url = wp_get_referer();
    if (! is_string($redirect_url) || $redirect_url === '') {
        $redirect_url = home_url('/contact/');
    }
    $redirect_url = remove_query_arg(['form_status', 'form_error'], $redirect_url);

    $nonce = isset($_POST['my_theme_contact_nonce'])
        ? sanitize_text_field(wp_unslash((string) $_POST['my_theme_contact_nonce']))
        : '';

    if (! wp_verify_nonce($nonce, 'my_theme_contact_form_submit')) {
        wp_safe_redirect(add_query_arg([
            'form_status' => 'error',
            'form_error'  => 'security',
        ], $redirect_url));
        exit;
    }

    // Honeypot: if this hidden field is filled, silently treat as spam.
    $honeypot = isset($_POST['website']) ? trim((string) wp_unslash($_POST['website'])) : '';
    if ($honeypot !== '') {
        wp_safe_redirect(add_query_arg(['form_status' => 'success'], $redirect_url));
        exit;
    }

    // Second honeypot (CSS-hidden field).
    $honeypot2 = isset($_POST['fax_number']) ? trim((string) wp_unslash($_POST['fax_number'])) : '';
    if ($honeypot2 !== '') {
        wp_safe_redirect(add_query_arg(['form_status' => 'success'], $redirect_url));
        exit;
    }

    $name    = isset($_POST['name']) ? sanitize_text_field(wp_unslash((string) $_POST['name'])) : '';
    $company = isset($_POST['company']) ? sanitize_text_field(wp_unslash((string) $_POST['company'])) : '';
    $email   = isset($_POST['email']) ? sanitize_email(wp_unslash((string) $_POST['email'])) : '';
    $phone   = isset($_POST['phone']) ? sanitize_text_field(wp_unslash((string) $_POST['phone'])) : '';
    $uprights = isset($_POST['uprights']) ? sanitize_text_field(wp_unslash((string) $_POST['uprights'])) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash((string) $_POST['message'])) : '';

    if ($name === '' || $company === '' || $email === '' || ! is_email($email)) {
        wp_safe_redirect(add_query_arg([
            'form_status' => 'error',
            'form_error'  => 'validation',
        ], $redirect_url));
        exit;
    }

    if ($phone !== '') {
        $digits = preg_replace('/[^\d]/', '', $phone);
        $digit_count = strlen($digits);
        if (
            $digit_count < 7 ||
            $digit_count > 15 ||
            ! preg_match('/^[\+]?[\d\s\-\(\)\.]{7,20}$/', $phone)
        ) {
            wp_safe_redirect(add_query_arg([
                'form_status' => 'error',
                'form_error'  => 'phone_invalid',
            ], $redirect_url));
            exit;
        }
    }

    // Run protection stack: rate limit, time trap, Turnstile, content filtering.
    $protection_error = my_theme_run_form_protection($name, $company, $email, $message);
    if ($protection_error !== '') {
        $fake_success = in_array($protection_error, ['spam_content', 'spam_bot'], true);
        wp_safe_redirect(add_query_arg([
            'form_status' => $fake_success ? 'success' : 'error',
            'form_error'  => $fake_success ? null : $protection_error,
        ], $redirect_url));
        exit;
    }

    $to      = function_exists('my_theme_contact_email') ? my_theme_contact_email() : get_option('admin_email');
    $subject = sprintf('New assessment request from %s', $name);

    $email_body = my_theme_notification_email_html([
        'name'     => $name,
        'company'  => $company,
        'email'    => $email,
        'phone'    => $phone,
        'uprights' => $uprights,
        'message'  => $message,
    ]);

    $headers = ['Content-Type: text/html; charset=UTF-8'];
    if (is_email($email)) {
        $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    }

    $sent = wp_mail($to, $subject, $email_body, $headers);

    if ($sent && is_email($email)) {
        wp_mail(
            $email,
            my_theme_autoreply_email_subject(),
            my_theme_autoreply_email_html($name),
            ['Content-Type: text/html; charset=UTF-8']
        );
    }

    wp_safe_redirect(add_query_arg([
        'form_status' => $sent ? 'success' : 'error',
        'form_error'  => $sent ? null : 'send',
    ], $redirect_url));
    exit;
}
add_action('admin_post_nopriv_my_theme_contact_form', 'my_theme_handle_contact_form_submission');
add_action('admin_post_my_theme_contact_form', 'my_theme_handle_contact_form_submission');

/**
 * Current request path without querystring.
 */
function my_theme_get_current_request_path(): string
{
    $request_uri = isset($_SERVER['REQUEST_URI']) ? (string) wp_unslash($_SERVER['REQUEST_URI']) : '';
    $path        = (string) parse_url($request_uri, PHP_URL_PATH);

    return trim($path, '/');
}

/**
 * Path segment used for static marketing routes (matches {@see my_theme_route_static_pages()}).
 */
function my_theme_get_static_route_path(): string
{
    global $wp;

    $path = '';
    if (isset($wp) && isset($wp->request)) {
        $path = trim((string) $wp->request, '/');
    }
    if ($path === '') {
        $request_uri = isset($_SERVER['REQUEST_URI']) ? (string) wp_unslash($_SERVER['REQUEST_URI']) : '';
        $path = trim((string) parse_url($request_uri, PHP_URL_PATH), '/');
    }
    if (strpos($path, 'index.php/') === 0) {
        $path = trim(substr($path, strlen('index.php/')), '/');
    }

    return $path;
}

/**
 * Document title for virtually routed pages (main query is still 404, so core would show "Page not found").
 */
function my_theme_resolve_static_document_title(): string
{
    $path  = my_theme_get_static_route_path();
    $brand = function_exists('my_theme_organization_name') ? my_theme_organization_name() : 'Goliath Pallet Racking Repair Ltd';

    $map = [
        'why-goliath'                     => 'Why Goliath™? | ' . $brand,
        'how-it-works'                    => 'How it works | ' . $brand,
        'services'                        => 'Service portfolio | ' . $brand,
        'services/racking-upright-repair' => 'Racking upright repair | ' . $brand,
        'services/damage-prevention'     => 'Damage prevention | ' . $brand,
        'services/annual-inspections'     => 'Annual inspections | ' . $brand,
        'services/installations-cdm'      => 'Racking installations & CDM | ' . $brand,
        'services/reconfiguration'        => 'Racking reconfiguration | ' . $brand,
        'compliance'                      => 'Compliance & safety standards | ' . $brand,
        'privacy-policy'                  => 'Privacy policy | ' . $brand,
        'terms-of-service'                => 'Terms of service | ' . $brand,
        'contact'                         => 'Contact | ' . $brand,
        'faqs'                            => 'FAQs | ' . $brand,
        'faq'                             => 'FAQs | ' . $brand,
        'videos'                          => 'Videos | ' . $brand,
        'video'                           => 'Videos | ' . $brand,
        'case-studies'                    => 'Case studies | ' . $brand,
        'about'                           => 'About Goliath™ | ' . $brand,
    ];

    if (isset($map[ $path ])) {
        return $map[ $path ];
    }

    if (preg_match('#^(?:videos|video)/([^/]+)$#', $path, $match)) {
        $slug    = sanitize_title($match[1]);
        $library = my_theme_get_video_library();
        if (isset($library[ $slug ])) {
            return $library[ $slug ]['title'] . ' | ' . $brand;
        }
    }

    if (preg_match('#^case-studies/([^/]+)$#', $path, $match)) {
        $slug    = sanitize_title($match[1]);
        $cs_lib  = my_theme_get_case_study_library();
        if (isset($cs_lib[ $slug ])) {
            $cs = $cs_lib[ $slug ];
            $seo_title = $cs['seo_title'] ?? '';
            return ($seo_title !== '' ? $seo_title : $cs['title']) . ' | ' . $brand;
        }
    }

    return '';
}

/**
 * @param string $title Value passed through the filter (often empty).
 */
function my_theme_filter_pre_get_document_title(string $title): string
{
    if (is_admin()) {
        return $title;
    }

    if (is_front_page()) {
        $brand = function_exists('my_theme_organization_name') ? my_theme_organization_name() : 'Goliath Pallet Racking Repair Ltd';
        return 'Permanent Racking Upright Repair | ' . $brand . ' | UK & EU';
    }

    if (is_404()) {
        $brand = function_exists('my_theme_organization_name') ? my_theme_organization_name() : 'Goliath Pallet Racking Repair Ltd';
        return 'Page not found | ' . $brand;
    }

    // Case study CPT single posts: use post title + brand.
    if (is_singular('case-study')) {
        $brand = function_exists('my_theme_organization_name') ? my_theme_organization_name() : 'Goliath Pallet Racking Repair Ltd';
        $seo_title = get_post_meta(get_the_ID(), '_cs_seo_title', true);
        $post_title = $seo_title ?: get_the_title();
        return $post_title . ' | ' . $brand;
    }

    $resolved = my_theme_resolve_static_document_title();

    return $resolved !== '' ? $resolved : $title;
}
add_filter('pre_get_document_title', 'my_theme_filter_pre_get_document_title', 1000);

/**
 * Current URL for canonical and meta output.
 */
function my_theme_get_current_url(): string
{
    $request_uri = isset($_SERVER['REQUEST_URI']) ? (string) wp_unslash($_SERVER['REQUEST_URI']) : '/';
    $path = (string) parse_url($request_uri, PHP_URL_PATH);

    return user_trailingslashit(home_url($path));
}

/**
 * Basic SEO context for fallback tags.
 *
 * @return array{title: string, description: string, image: string}
 */
function my_theme_get_seo_context(): array
{
    $default_title = wp_get_document_title();
    $brand         = function_exists('my_theme_organization_name') ? my_theme_organization_name() : 'Goliath Pallet Racking Repair Ltd';
    $default_image = get_theme_file_uri('assets/images/Homepage/carousel-image1.webp');
    $path          = my_theme_get_current_request_path();
    $library       = my_theme_get_video_library();

    if (preg_match('#^(?:videos|video)/([^/]+)$#', $path, $match)) {
        $slug = sanitize_title($match[1]);
        if (isset($library[ $slug ])) {
            return [
                'title'       => $library[ $slug ]['title'] . ' | ' . $brand,
                'description' => $library[ $slug ]['excerpt'],
                'image'       => my_theme_video_thumbnail_is_readable($library[ $slug ]['file'])
                    ? my_theme_get_video_thumbnail_uri($library[ $slug ]['file'])
                    : $default_image,
            ];
        }
    }

    // Case study CPT single posts.
    if (is_singular('case-study')) {
        $post = get_queried_object();
        if ($post instanceof WP_Post) {
            $seo_title = get_post_meta($post->ID, '_cs_seo_title', true) ?: $post->post_title;
            $seo_desc  = get_post_meta($post->ID, '_cs_seo_desc', true)
                ?: ($post->post_excerpt ?: sprintf(
                    'Read the %s case study — see how Goliath reduced repair costs, eliminated upright damage, and improved warehouse safety.',
                    get_post_meta($post->ID, '_cs_client', true) ?: $post->post_title
                ));
            $thumb = get_the_post_thumbnail_url($post->ID, 'full');
            if (!$thumb) {
                $card_img = get_post_meta($post->ID, '_cs_image', true);
                $thumb = $card_img ?: $default_image;
            }
            return [
                'title'       => $seo_title . ' | ' . $brand,
                'description' => $seo_desc,
                'image'       => $thumb,
            ];
        }
    }

    // Legacy library fallback (for slugs not yet migrated to CPT).
    if (preg_match('#^case-studies/([^/]+)$#', $path, $match)) {
        $slug   = sanitize_title($match[1]);
        $cs_lib = my_theme_get_case_study_library();
        if (isset($cs_lib[ $slug ])) {
            $cs    = $cs_lib[ $slug ];
            $cs_title = ($cs['seo_title'] ?? '') !== '' ? $cs['seo_title'] : $cs['title'];
            $cs_desc  = ($cs['seo_desc'] ?? '') !== ''
                ? $cs['seo_desc']
                : sprintf(
                    'Read the %s case study — see how Goliath reduced repair costs, eliminated upright damage, and improved warehouse safety.',
                    $cs['client'] ?? 'client'
                );
            $cs_image = my_theme_resolve_case_study_image($cs['image'] ?? '', $default_image);
            return [
                'title'       => $cs_title . ' | ' . $brand,
                'description' => $cs_desc,
                'image'       => $cs_image,
            ];
        }
    }

    $descriptions = [
        ''                                => 'Permanent pallet racking upright repair with lifetime warranty. Save 70% vs replacement with 30-minute installation across the UK and EU.',
        'why-goliath'                     => 'Discover why Goliath is the UK\'s only permanent racking upright repair system with a lifetime warranty, 30-minute install, and 70% cost saving.',
        'how-it-works'                    => 'See how Goliath permanently repairs damaged racking uprights in 30 minutes with no hot works, no disruption, and a lifetime structural warranty.',
        'services'                        => 'Explore Goliath services including permanent upright repair, damage prevention, annual inspections, and compliance-led warehouse support.',
        'services/racking-upright-repair' => 'Permanent pallet racking upright repair in 30 minutes. Engineered steel system with lifetime warranty — no welding, no disruption, no replacement needed.',
        'services/damage-prevention'      => 'Prevent repeat racking upright damage with Goliath\'s engineered protection system. Reduce ongoing repair costs by over 30% in the first year.',
        'services/annual-inspections'     => 'SEMA-qualified annual racking inspections to keep your warehouse compliant with HSE requirements. Expert assessments with clear repair recommendations.',
        'services/installations-cdm'      => 'Professional racking installation and CDM-compliant project management. New racking systems installed safely with full compliance documentation.',
        'services/reconfiguration'        => 'Warehouse racking reconfiguration services. Restructure your storage layout with minimal disruption and full compliance with UK safety standards.',
        'compliance'                      => 'Understand how Goliath aligns with SEMA, HSE, and EN 15635 warehouse racking safety standards. Full compliance documentation provided.',
        'contact'                         => 'Request a free warehouse racking assessment from Goliath. SEMA-qualified inspectors, one working day response, transparent pricing with no obligation.',
        'faqs'                            => 'Answers to common questions about Goliath racking repair — installation time, warranty coverage, costs, compliance, and how the system works.',
        'faq'                             => 'Answers to common questions about Goliath racking repair — installation time, warranty coverage, costs, compliance, and how the system works.',
        'videos'                          => 'Watch Goliath racking repair in action. Installation demos, crash tests, and product walkthroughs showing the 30-minute permanent repair process.',
        'video'                           => 'Watch Goliath racking repair in action. Installation demos, crash tests, and product walkthroughs showing the 30-minute permanent repair process.',
        'case-studies'                    => 'Real results from UK warehouses using Goliath. See how clients reduced repair costs, eliminated downtime, and improved safety compliance.',
        'privacy-policy'                  => 'Privacy policy for Goliath Pallet Racking Repair Ltd. How we collect, use, and protect your personal information.',
        'terms-of-service'                => 'Terms and conditions for Goliath Pallet Racking Repair Ltd services, quotations, and website usage.',
        'about'                           => 'Learn about Goliath Pallet Racking Repair Ltd — our mission, leadership team, and commitment to permanent, safety-led racking repair across the UK and EU.',
    ];

    $images = [
        'services'   => get_theme_file_uri('assets/images/Services/foreveryproject.webp'),
        'compliance' => get_theme_file_uri('assets/images/Compliance/compatible.webp'),
    ];

    $description = $descriptions[$path] ?? ($brand . ' delivers permanent warehouse racking upright repair solutions across the UK and EU.');
    $image       = $images[$path] ?? $default_image;

    return [
        'title'       => $default_title,
        'description' => $description,
        'image'       => $image,
    ];
}

/**
 * Whether Rank Math is active.
 */
function my_theme_is_rank_math_active(): bool
{
    return defined('RANK_MATH_VERSION') || class_exists('RankMath');
}

/**
 * Canonical, robots, OG, and Twitter fallback tags.
 */
function my_theme_output_head_seo_tags(): void
{
    $canonical_url = my_theme_get_current_url();
    $seo_context   = my_theme_get_seo_context();

    if (is_404()) {
        echo '<meta name="robots" content="noindex,nofollow">' . "\n";
        return;
    }

    if (! my_theme_is_rank_math_active()) {
        echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n";
    }
    echo '<link rel="alternate" href="' . esc_url($canonical_url) . '" hreflang="en-GB">' . "\n";
    echo '<link rel="alternate" href="' . esc_url($canonical_url) . '" hreflang="x-default">' . "\n";
    if (! my_theme_is_rank_math_active()) {
        echo '<meta name="robots" content="index,follow">' . "\n";
    }

    // Always output fallback meta/OG tags from the theme. Most pages on this site are
    // virtual routes that Rank Math cannot introspect. If Rank Math is later configured,
    // it fires at wp_head priority 1 (before this hook at priority 5), so its tags
    // appear first in the <head> and search engines will use those over these fallbacks.

    $brand = function_exists('my_theme_organization_name') ? my_theme_organization_name() : 'Goliath Pallet Racking Repair Ltd';

    echo '<meta name="description" content="' . esc_attr($seo_context['description']) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($brand) . '">' . "\n";
    echo '<meta property="og:locale" content="en_GB">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($seo_context['title']) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($seo_context['description']) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($canonical_url) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($seo_context['image']) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($seo_context['title']) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($seo_context['description']) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($seo_context['image']) . '">' . "\n";
}
add_action('wp_head', 'my_theme_output_head_seo_tags', 5);

/**
 * Route static marketing slugs to their template files.
 * This keeps navbar/footer links working without requiring manual WP page creation.
 */
function my_theme_route_static_pages(): void
{
    if (is_admin() || wp_doing_ajax()) {
        return;
    }

    $request_uri_raw = isset($_SERVER['REQUEST_URI']) ? (string) wp_unslash($_SERVER['REQUEST_URI']) : '';
    if (preg_match('#/(?:index\.php/)?(?:videos|video)/([^/?\#]+)/?#', $request_uri_raw, $m)) {
        $video_slug = sanitize_title($m[1]);
        // If a Video CPT post exists for this slug, let WP handle it via single-video.php.
        $cpt_post = get_page_by_path($video_slug, OBJECT, 'video');
        if ($cpt_post) {
            return;
        }
        $library = my_theme_get_video_library();
        if (isset($library[ $video_slug ])) {
            $GLOBALS['my_theme_video_detail_slug'] = $video_slug;
            $template_path = get_theme_file_path('page-video-detail.php');
            if (file_exists($template_path)) {
                status_header(200);
                include $template_path;
                exit;
            }
        }
    }

    $path = my_theme_get_static_route_path();

    if ($path === 'videos/title-goliath-video' || $path === 'video/title-goliath-video') {
        wp_safe_redirect(home_url('/videos/explanation-video/'), 301);
        exit;
    }

    // Robust dynamic video detail routing (handles index.php-prefixed paths too).
    if (preg_match('#^(?:index\.php/)?(?:videos|video)/([^/]+)$#', $path, $m)) {
        $video_slug = sanitize_title($m[1]);
        // If a Video CPT post exists, let WP handle it.
        $cpt_post = get_page_by_path($video_slug, OBJECT, 'video');
        if ($cpt_post) {
            return;
        }
        $library = my_theme_get_video_library();
        if (isset($library[ $video_slug ])) {
            $GLOBALS['my_theme_video_detail_slug'] = $video_slug;
            $template_path = get_theme_file_path('page-video-detail.php');
            if (file_exists($template_path)) {
                status_header(200);
                include $template_path;
                exit;
            }
        }
    }

    // Dynamic case study detail routing.
    if (preg_match('#^case-studies/([^/]+)$#', $path, $cs_match)) {
        $cs_slug    = sanitize_title($cs_match[1]);
        $cs_library = my_theme_get_case_study_library();
        if (isset($cs_library[ $cs_slug ])) {
            $GLOBALS['my_theme_case_study_slug'] = $cs_slug;
            $cs_template = get_theme_file_path('page-case-study-detail.php');
            if (file_exists($cs_template)) {
                status_header(200);
                include $cs_template;
                exit;
            }
        }
    }

    $routes = [
        'why-goliath'  => 'page-why-goliath.php',
        'how-it-works' => 'page-how-it-works.php',
        'services'     => 'page-services.php',
        'services/racking-upright-repair' => 'page-service-racking-upright-repair.php',
        'services/damage-prevention' => 'page-service-damage-prevention.php',
        'services/annual-inspections' => 'page-service-annual-inspections.php',
        'services/installations-cdm' => 'page-service-installations-cdm.php',
        'services/reconfiguration' => 'page-service-reconfiguration.php',
        'compliance'   => 'page-compliance.php',
        'privacy-policy' => 'page-privacy-policy.php',
        'terms-of-service' => 'page-terms-of-service.php',
        'contact'      => 'page-contact.php',
        'faqs'         => 'page-faq.php',
        'faq'          => 'page-faq.php',
        'videos'       => 'page-videos.php',
        'video'        => 'page-videos.php',
        'case-studies' => 'page-case-studies.php',
    ];

    foreach (array_keys(my_theme_get_video_library()) as $video_slug) {
        // Skip if a Video CPT post exists for this slug (handled by WP template hierarchy).
        if (get_page_by_path($video_slug, OBJECT, 'video')) {
            continue;
        }
        $routes[ 'videos/' . $video_slug ] = 'page-video-detail.php';
        $routes[ 'video/' . $video_slug ]  = 'page-video-detail.php';
    }

    if (!array_key_exists($path, $routes)) {
        return;
    }

    $template_file = $routes[ $path ];
    if ($template_file === 'page-video-detail.php') {
        if (strpos($path, 'videos/') === 0) {
            $GLOBALS['my_theme_video_detail_slug'] = substr($path, strlen('videos/'));
        } elseif (strpos($path, 'video/') === 0) {
            $GLOBALS['my_theme_video_detail_slug'] = substr($path, strlen('video/'));
        }
    }

    $template_path = get_theme_file_path($template_file);
    if (!file_exists($template_path)) {
        return;
    }

    status_header(200);
    include $template_path;
    exit;
}
add_action('template_redirect', 'my_theme_route_static_pages', 1);

/**
 * Register custom video sitemap rewrite.
 */
function my_theme_register_video_sitemap_rewrite(): void
{
    add_rewrite_rule('^video-sitemap\.xml$', 'index.php?my_theme_video_sitemap=1', 'top');
}
add_action('init', 'my_theme_register_video_sitemap_rewrite');

/**
 * Add custom sitemap query var.
 *
 * @param string[] $vars
 * @return string[]
 */
function my_theme_register_video_sitemap_query_var(array $vars): array
{
    $vars[] = 'my_theme_video_sitemap';
    return $vars;
}
add_filter('query_vars', 'my_theme_register_video_sitemap_query_var');

/**
 * Render custom XML sitemap for dynamic video detail pages.
 */
function my_theme_render_video_sitemap(): void
{
    $is_sitemap_query = (int) get_query_var('my_theme_video_sitemap') === 1;
    $path             = my_theme_get_current_request_path();
    if (! $is_sitemap_query && $path !== 'video-sitemap.xml') {
        return;
    }

    status_header(200);
    header('Content-Type: application/xml; charset=' . get_bloginfo('charset'));

    $now     = gmdate('c');
    $library = my_theme_get_video_library();

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($library as $slug => $row) {
        echo "  <url>\n";
        echo '    <loc>' . esc_url(home_url('/videos/' . $slug . '/')) . "</loc>\n";
        echo '    <lastmod>' . esc_html($now) . "</lastmod>\n";
        echo "  </url>\n";
    }
    echo "</urlset>\n";
    exit;
}
add_action('template_redirect', 'my_theme_render_video_sitemap', 0);

/**
 * Register custom pages sitemap rewrite.
 */
function my_theme_register_pages_sitemap_rewrite(): void
{
    add_rewrite_rule('^pages-sitemap\.xml$', 'index.php?my_theme_pages_sitemap=1', 'top');
}
add_action('init', 'my_theme_register_pages_sitemap_rewrite');

/**
 * Add pages sitemap query var.
 *
 * @param string[] $vars
 * @return string[]
 */
function my_theme_register_pages_sitemap_query_var(array $vars): array
{
    $vars[] = 'my_theme_pages_sitemap';
    return $vars;
}
add_filter('query_vars', 'my_theme_register_pages_sitemap_query_var');

/**
 * All canonical marketing page paths for sitemap output.
 *
 * @return string[]
 */
function my_theme_get_sitemap_page_paths(): array
{
    $paths = [
        '',
        'why-goliath',
        'how-it-works',
        'services',
        'services/racking-upright-repair',
        'services/damage-prevention',
        'services/annual-inspections',
        'services/installations-cdm',
        'services/reconfiguration',
        'compliance',
        'contact',
        'case-studies',
        'faq',
        'videos',
        'about',
        'privacy-policy',
        'terms-of-service',
    ];

    // Legacy case study library (options-based).
    foreach (array_keys(my_theme_get_case_study_library()) as $cs_slug) {
        $paths[] = 'case-studies/' . $cs_slug;
    }

    // CPT case study posts.
    $cpt_posts = get_posts([
        'post_type'      => 'case-study',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
    ]);
    foreach ($cpt_posts as $post_id) {
        $slug = get_post_field('post_name', $post_id);
        if ($slug !== '') {
            $paths[] = 'case-studies/' . $slug;
        }
    }

    return array_values(array_unique($paths));
}

/**
 * Render custom XML sitemap for all marketing pages.
 */
function my_theme_render_pages_sitemap(): void
{
    $is_sitemap_query = (int) get_query_var('my_theme_pages_sitemap') === 1;
    $path             = my_theme_get_current_request_path();
    if (! $is_sitemap_query && $path !== 'pages-sitemap.xml') {
        return;
    }

    status_header(200);
    header('Content-Type: application/xml; charset=' . get_bloginfo('charset'));

    $now   = gmdate('c');
    $pages = my_theme_get_sitemap_page_paths();

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($pages as $page_path) {
        $loc = $page_path === ''
            ? home_url('/')
            : user_trailingslashit(home_url('/' . $page_path));

        $priority = '0.7';
        if ($page_path === '') {
            $priority = '1.0';
        } elseif (! str_contains($page_path, '/')) {
            $priority = '0.8';
        }

        echo "  <url>\n";
        echo '    <loc>' . esc_url($loc) . "</loc>\n";
        echo '    <lastmod>' . esc_html($now) . "</lastmod>\n";
        echo '    <priority>' . $priority . "</priority>\n";
        echo "  </url>\n";
    }
    echo "</urlset>\n";
    exit;
}
add_action('template_redirect', 'my_theme_render_pages_sitemap', 0);

/**
 * Primary XML sitemap index URL for this site (domain follows Settings > General).
 *
 * Rank Math uses sitemap_index.xml; WordPress core uses wp-sitemap.xml.
 */
function my_theme_get_primary_sitemap_url(): string
{
    if (my_theme_is_rank_math_active()) {
        return home_url('/sitemap_index.xml');
    }

    if (function_exists('wp_sitemaps_get_server')) {
        $server = wp_sitemaps_get_server();
        if ($server && method_exists($server, 'get_index_url')) {
            return $server->get_index_url();
        }
    }

    return home_url('/wp-sitemap.xml');
}

/**
 * Override virtual robots.txt output with SEO-ready directives.
 */
function my_theme_filter_robots_txt(string $output, bool $public): string
{
    unset($public);

    $primary_sitemap = my_theme_get_primary_sitemap_url();
    $pages_sitemap   = home_url('/pages-sitemap.xml');
    $video_sitemap   = home_url('/video-sitemap.xml');

    /**
     * Allow hosts to append extra Sitemap lines (multisite, CDN index, etc.).
     *
     * @param string[] $urls Absolute sitemap URLs.
     */
    $extra_sitemaps = apply_filters('my_theme_robots_extra_sitemap_urls', []);

    $lines = [
        'User-agent: *',
        'Allow: /',
        'Disallow: /wp-admin/',
        'Allow: /wp-admin/admin-ajax.php',
        '',
        'Sitemap: ' . $primary_sitemap,
        'Sitemap: ' . $pages_sitemap,
        'Sitemap: ' . $video_sitemap,
    ];

    foreach ($extra_sitemaps as $url) {
        $url = esc_url_raw((string) $url);
        if ($url !== '') {
            $lines[] = 'Sitemap: ' . $url;
        }
    }

    return implode("\n", $lines) . "\n";
}
add_filter('robots_txt', 'my_theme_filter_robots_txt', 10, 2);

/* ------------------------------------------------------------------ */
/*  Image option resolver for templates                               */
/* ------------------------------------------------------------------ */

/**
 * Resolve an image option value to a URL.
 *
 * Supports WP attachment IDs and direct URLs; falls back to the
 * provided default (typically a get_theme_file_uri() path).
 *
 * @param string $option_key WP option name.
 * @param string $default    Default URL if option is empty.
 * @param string $size       WP image size for attachment IDs.
 */
function my_theme_get_image_url(string $option_key, string $default = '', string $size = 'full'): string
{
    $value = get_option($option_key, '');

    if ($value === '' || $value === false) {
        return $default;
    }

    if (is_numeric($value) && (int) $value > 0) {
        $url = wp_get_attachment_image_url((int) $value, $size);
        return $url ? $url : $default;
    }

    return (string) $value;
}

/* ------------------------------------------------------------------ */
/*  Auto-provision required pages on fresh deployments                 */
/* ------------------------------------------------------------------ */

/**
 * Create all required pages if they don't already exist.
 *
 * Runs on theme activation and on the first admin visit after a
 * database reset (version-gated via wp_options). Existing pages
 * with matching slugs are never overwritten.
 */
function my_theme_provision_pages(): void
{
    $version = '1.2';
    if (get_option('my_theme_pages_version') === $version) {
        return;
    }

    $pages = [
        ['title' => 'Home',                              'slug' => 'home',                    'template' => '',                                'parent' => ''],
        ['title' => 'Why Goliath',                       'slug' => 'why-goliath',             'template' => 'page-why-goliath.php',            'parent' => ''],
        ['title' => 'How It Works',                      'slug' => 'how-it-works',            'template' => 'page-how-it-works.php',           'parent' => ''],
        ['title' => 'Services',                          'slug' => 'services',                'template' => 'page-services.php',               'parent' => ''],
        ['title' => 'Compliance',                        'slug' => 'compliance',              'template' => 'page-compliance.php',             'parent' => ''],
        ['title' => 'Case Studies',                      'slug' => 'case-studies',            'template' => 'page-case-studies.php',           'parent' => ''],
        ['title' => 'Videos',                            'slug' => 'videos',                  'template' => 'page-videos.php',                 'parent' => ''],
        ['title' => 'FAQs',                              'slug' => 'faq',                     'template' => 'page-faq.php',                    'parent' => ''],
        ['title' => 'Contact',                           'slug' => 'contact',                 'template' => 'page-contact.php',                'parent' => ''],
        ['title' => 'About',                             'slug' => 'about',                   'template' => 'page-about.php',                  'parent' => ''],
        ['title' => 'Privacy Policy',                    'slug' => 'privacy-policy',          'template' => 'page-privacy-policy.php',         'parent' => ''],
        ['title' => 'Terms of Service',                  'slug' => 'terms-of-service',        'template' => 'page-terms-of-service.php',       'parent' => ''],
        ['title' => 'B&M Racking Damage',               'slug' => 'case-study-1',            'template' => 'page-case-study-1.php',           'parent' => ''],

        ['title' => 'Racking Upright Repair',            'slug' => 'racking-upright-repair',  'template' => '',                                'parent' => 'services'],
        ['title' => 'Damage Prevention',                 'slug' => 'damage-prevention',       'template' => '',                                'parent' => 'services'],
        ['title' => 'Annual Inspections',                'slug' => 'annual-inspections',      'template' => '',                                'parent' => 'services'],
        ['title' => 'Racking Installations & CDM',       'slug' => 'installations-cdm',       'template' => '',                                'parent' => 'services'],
        ['title' => 'Racking Reconfiguration Services',  'slug' => 'reconfiguration',         'template' => '',                                'parent' => 'services'],
    ];

    $created_ids = [];

    foreach ($pages as $page) {
        $path = $page['parent'] !== '' ? $page['parent'] . '/' . $page['slug'] : $page['slug'];
        $existing = get_page_by_path($path, OBJECT, 'page');

        if ($existing) {
            $created_ids[$page['slug']] = $existing->ID;

            $needs_update = false;
            $update_data  = ['ID' => $existing->ID];

            if ($existing->post_status !== 'publish') {
                $update_data['post_status'] = 'publish';
                $needs_update = true;
            }

            if ($page['template'] !== '') {
                $current_tpl = get_post_meta($existing->ID, '_wp_page_template', true);
                if ($current_tpl !== $page['template']) {
                    update_post_meta($existing->ID, '_wp_page_template', $page['template']);
                }
            }

            if ($needs_update) {
                wp_update_post($update_data);
            }

            continue;
        }

        $parent_id = 0;
        if ($page['parent'] !== '' && isset($created_ids[$page['parent']])) {
            $parent_id = $created_ids[$page['parent']];
        }

        $id = wp_insert_post([
            'post_title'  => $page['title'],
            'post_name'   => $page['slug'],
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_parent' => $parent_id,
        ], true);

        if (! is_wp_error($id)) {
            $created_ids[$page['slug']] = $id;
            if ($page['template'] !== '') {
                update_post_meta($id, '_wp_page_template', $page['template']);
            }
        }
    }

    if (isset($created_ids['home'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $created_ids['home']);
    }

    update_option('my_theme_pages_version', $version, false);
}
add_action('after_switch_theme', 'my_theme_provision_pages');
add_action('admin_init', 'my_theme_provision_pages');

/* ------------------------------------------------------------------ */
/*  Auto-provision GXO case study CPT posts                            */
/* ------------------------------------------------------------------ */

/**
 * Create CPT posts for GXO case studies if they do not already exist.
 *
 * Version-gated so it only runs once per environment. Bump the version
 * string when new case studies need seeding.
 *
 * Safe to re-run: existing posts are never overwritten.
 */
function my_theme_provision_case_studies(): void
{
    $version = '1.2';
    if (get_option('my_theme_case_studies_version') === $version) {
        return;
    }

    if (! function_exists('my_theme_get_case_study_defaults')) {
        return;
    }

    if (! function_exists('my_theme_migrate_case_study_markup')) {
        return;
    }

    $slugs_to_provision = [
        'gxo-lowestoft-xhd-redirack',
        'gxo-thrapston-primark-pss',
    ];

    // Use hardcoded defaults directly so GXO entries are always available,
    // even if wp_options has a saved library that predates them.
    $library   = my_theme_get_case_study_defaults();
    $menu_order = 10;

    foreach ($slugs_to_provision as $slug) {
        if (! isset($library[$slug])) {
            continue;
        }

        $cs = $library[$slug];

        $existing = get_page_by_path($slug, OBJECT, 'case-study');
        if ($existing) {
            $menu_order++;
            continue;
        }

        $markup  = my_theme_migrate_case_study_markup($slug, $cs);

        $post_id = wp_insert_post([
            'post_type'    => 'case-study',
            'post_title'   => $cs['title'] ?? $slug,
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_content' => $markup,
            'post_excerpt' => $cs['seo_desc'] ?? '',
            'menu_order'   => $menu_order,
        ], true);

        if (is_wp_error($post_id)) {
            $menu_order++;
            continue;
        }

        // Derive listing card summaries from the first paragraphs of narrative fields.
        $problem_paras  = array_filter(array_map('trim', explode("\n\n", $cs['problem_text'] ?? '')));
        $solution_paras = array_filter(array_map('trim', explode("\n\n", $cs['solution_text'] ?? '')));
        $challenge_summary = reset($problem_paras)  ?: ($cs['challenge'] ?? '');
        $solution_summary  = reset($solution_paras) ?: ($cs['solution'] ?? '');

        $default_card_image = get_theme_file_uri('assets/images/caseStudy/B&M.webp');
        $card_image = function_exists('my_theme_resolve_case_study_image')
            ? my_theme_resolve_case_study_image($cs['image'] ?? '', $default_card_image)
            : ($cs['image'] ?? $default_card_image);

        $meta_map = [
            '_cs_client'         => $cs['client'] ?? '',
            '_cs_challenge'      => $challenge_summary,
            '_cs_solution'       => $solution_summary,
            '_cs_image'          => $card_image,
            '_cs_metric_1_value' => $cs['metric1_value'] ?? '',
            '_cs_metric_1_label' => $cs['metric1_label'] ?? '',
            '_cs_metric_2_value' => $cs['metric2_value'] ?? '',
            '_cs_metric_2_label' => $cs['metric2_label'] ?? '',
            '_cs_metric_3_value' => $cs['metric3_value'] ?? '',
            '_cs_metric_3_label' => $cs['metric3_label'] ?? '',
            '_cs_metric_4_value' => $cs['metric4_value'] ?? '',
            '_cs_metric_4_label' => $cs['metric4_label'] ?? '',
            '_cs_seo_title'      => $cs['seo_title'] ?? '',
            '_cs_seo_desc'       => $cs['seo_desc'] ?? '',
        ];

        foreach ($meta_map as $meta_key => $meta_value) {
            if ($meta_value !== '') {
                update_post_meta($post_id, $meta_key, $meta_value);
            }
        }

        $menu_order++;
    }

    update_option('my_theme_case_studies_version', $version, false);
}
add_action('after_switch_theme', 'my_theme_provision_case_studies');
add_action('admin_init', 'my_theme_provision_case_studies');
