<?php
/**
 * Goliath Content Editor — admin panel bootstrap.
 *
 * Registers the top-level menu, all sub-pages, and enqueues admin assets.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

require_once __DIR__ . '/render-helpers.php';
require_once __DIR__ . '/sanitize.php';

/* ------------------------------------------------------------------ */
/*  Admin menu                                                        */
/* ------------------------------------------------------------------ */

/**
 * Register the Goliath Content top-level menu and sub-pages.
 */
function my_theme_admin_menu(): void
{
    $capability = 'manage_options';
    $icon       = 'dashicons-edit-page';

    add_menu_page(
        'Goliath Content',
        'Goliath Content',
        $capability,
        'goliath-content',
        'my_theme_admin_render_homepage',
        $icon,
        26
    );

    $pages = [
        ['goliath-content',           'Homepage',        'my_theme_admin_render_homepage'],
        ['goliath-contact-details',   'Contact Details',  'my_theme_admin_render_contact_details'],
        ['goliath-faq',               'FAQ',             'my_theme_admin_render_faq'],
        ['goliath-videos',            'Videos',          'my_theme_admin_render_videos'],
        ['goliath-global',            'Global Settings',  'my_theme_admin_render_global'],
        ['goliath-header-footer',     'Header & Footer', 'my_theme_admin_render_header_footer'],
        ['goliath-services',          'Services',        'my_theme_admin_render_services'],
        ['goliath-why-goliath',       'Why Goliath',     'my_theme_admin_render_why_goliath'],
        ['goliath-how-it-works',      'How It Works',    'my_theme_admin_render_how_it_works'],
        ['goliath-compliance',        'Compliance',      'my_theme_admin_render_compliance'],
        ['goliath-case-studies',      'Case Studies',    'my_theme_admin_render_case_studies'],
        ['goliath-contact-page',      'Contact Page',    'my_theme_admin_render_contact_page'],
        ['goliath-faq-page',          'FAQ Page',        'my_theme_admin_render_faq_page'],
        ['goliath-videos-page',       'Videos Page',     'my_theme_admin_render_videos_page'],
        ['goliath-about-page',        'About / Team',    'my_theme_admin_render_about_page'],
        ['goliath-migrate-to-blocks', 'Migrate to Blocks', 'my_theme_migrate_render_page'],
    ];

    foreach ($pages as $page) {
        add_submenu_page(
            'goliath-content',
            $page[1] . ' — Goliath Content',
            $page[1],
            $capability,
            $page[0],
            $page[2]
        );
    }
}
add_action('admin_menu', 'my_theme_admin_menu');

/* ------------------------------------------------------------------ */
/*  Admin assets                                                      */
/* ------------------------------------------------------------------ */

/**
 * Enqueue admin JS and CSS only on Goliath Content pages.
 */
function my_theme_admin_enqueue_assets(string $hook_suffix): void
{
    $screen = get_current_screen();
    if (! $screen || strpos($screen->id, 'goliath') === false) {
        return;
    }

    wp_enqueue_media();

    $css_file = get_theme_file_path('inc/admin-assets/admin.css');
    wp_enqueue_style(
        'goliath-admin-css',
        get_theme_file_uri('inc/admin-assets/admin.css'),
        [],
        file_exists($css_file) ? (string) filemtime($css_file) : THEME_VERSION
    );

    $js_file = get_theme_file_path('inc/admin-assets/admin.js');
    wp_enqueue_script(
        'goliath-admin-js',
        get_theme_file_uri('inc/admin-assets/admin.js'),
        ['jquery', 'wp-media-utils'],
        file_exists($js_file) ? (string) filemtime($js_file) : THEME_VERSION,
        true
    );
}
add_action('admin_enqueue_scripts', 'my_theme_admin_enqueue_assets');

/* ------------------------------------------------------------------ */
/*  Save handler                                                      */
/* ------------------------------------------------------------------ */

/**
 * Generic save handler for all Goliath Content admin pages.
 *
 * Each page POSTs an array of fields under `goliath_fields`.
 * Field definitions (key => sanitise callback) are registered per page.
 */
function my_theme_admin_handle_save(): void
{
    if (! isset($_POST['goliath_admin_nonce'])) {
        return;
    }

    $nonce = sanitize_text_field(wp_unslash((string) $_POST['goliath_admin_nonce']));
    if (! wp_verify_nonce($nonce, 'goliath_admin_save')) {
        add_settings_error('goliath_content', 'nonce_fail', 'Security check failed. Please try again.', 'error');
        return;
    }

    if (! current_user_can('manage_options')) {
        add_settings_error('goliath_content', 'capability', 'You do not have permission to edit this content.', 'error');
        return;
    }

    $page = isset($_POST['goliath_page']) ? sanitize_text_field(wp_unslash((string) $_POST['goliath_page'])) : '';
    if ($page === '') {
        return;
    }

    $fields = isset($_POST['goliath_fields']) && is_array($_POST['goliath_fields'])
        ? wp_unslash($_POST['goliath_fields'])
        : [];

    /**
     * Filter: lets each admin page declare its field definitions.
     *
     * @param array<string, string> $defs  option_key => sanitise_type
     * @param string                $page  The page slug being saved.
     */
    $definitions = apply_filters('my_theme_admin_field_definitions', [], $page);

    foreach ($definitions as $option_key => $type) {
        $raw = $fields[$option_key] ?? null;
        $sanitised = my_theme_admin_sanitise_field($raw, $type);
        update_option($option_key, $sanitised);
    }

    add_settings_error('goliath_content', 'saved', 'Content saved successfully.', 'success');
}
add_action('admin_init', 'my_theme_admin_handle_save');

/* ------------------------------------------------------------------ */
/*  Load sub-page renderers                                           */
/* ------------------------------------------------------------------ */

$admin_pages_dir = __DIR__ . '/pages/';
foreach (glob($admin_pages_dir . '*.php') as $page_file) {
    require_once $page_file;
}
