<?php
/**
 * Media URL helpers — rewrite stale dev URLs to the current site.
 *
 * Block content and wp_options migrated from localhost often store full
 * http://localhost:8000/... URLs. On live those only work when a visitor's
 * machine happens to be running the local Docker stack. This module rewrites
 * them at render time so images always resolve on the production domain.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Build a URL from a /wp-content/... path on the current site.
 */
function my_theme_uri_from_content_path(string $path): string
{
    if (preg_match('#^/wp-content/themes/[^/]+/(.+)$#', $path, $matches)) {
        return get_theme_file_uri($matches[1]);
    }

    return home_url($path);
}

/**
 * Rewrite localhost / 127.0.0.1 URLs to the current site.
 *
 * Theme asset paths are resolved via get_theme_file_uri() so they survive
 * domain changes without a database search-replace.
 */
function my_theme_normalize_media_url(string $url): string
{
    $url = trim($url);

    if ($url === '') {
        return '';
    }

    if (preg_match('#^https?://(?:localhost|127\.0\.0\.1)(?::\d+)?(/.*)$#i', $url, $matches)) {
        return my_theme_uri_from_content_path($matches[1]);
    }

    $site_host = (string) wp_parse_url(home_url(), PHP_URL_HOST);
    $url_host  = (string) wp_parse_url($url, PHP_URL_HOST);

    if (
        $site_host !== ''
        && $url_host !== ''
        && $url_host !== $site_host
        && preg_match('#^https?://[^/]+(/wp-content/(?:themes/[^/]+|uploads)/.+)$#i', $url, $matches)
    ) {
        return my_theme_uri_from_content_path($matches[1]);
    }

    return $url;
}

/**
 * Resolve a block attribute or option value to a normalised image URL.
 *
 * @param mixed  $value   Attachment ID, URL string, or empty.
 * @param string $default Fallback when value is empty or invalid.
 * @param string $size    WP image size for attachment IDs.
 */
function my_theme_resolve_image_value($value, string $default = '', string $size = 'full'): string
{
    if ($value === '' || $value === false || $value === null) {
        return $default;
    }

    if (is_numeric($value) && (int) $value > 0) {
        $url = wp_get_attachment_image_url((int) $value, $size);

        return $url ? my_theme_normalize_media_url($url) : $default;
    }

    $normalised = my_theme_normalize_media_url((string) $value);

    return $normalised !== '' ? $normalised : $default;
}

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

    return my_theme_resolve_image_value($value, $default, $size);
}

/**
 * Replace localhost URLs inside rendered HTML (img src, srcset, etc.).
 */
function my_theme_fix_localhost_in_html(string $html): string
{
    if ($html === '' || (stripos($html, 'localhost') === false && stripos($html, '127.0.0.1') === false)) {
        return $html;
    }

    return (string) preg_replace_callback(
        '#https?://(?:localhost|127\.0\.0\.1)(?::\d+)?(/[^"\'\s<>\)]*)#i',
        static function (array $matches): string {
            return my_theme_uri_from_content_path($matches[1]);
        },
        $html
    );
}

/**
 * Fix localhost URLs in rendered block HTML.
 *
 * @param string $content Rendered block markup.
 * @param array  $block   Block data (unused).
 */
function my_theme_filter_render_block_urls(string $content, array $block): string
{
    unset($block);

    return my_theme_fix_localhost_in_html($content);
}
add_filter('render_block', 'my_theme_filter_render_block_urls', 20, 2);

/**
 * Fix localhost URLs in classic editor / mixed post content.
 */
function my_theme_filter_the_content_urls(string $content): string
{
    return my_theme_fix_localhost_in_html($content);
}
add_filter('the_content', 'my_theme_filter_the_content_urls', 20);
