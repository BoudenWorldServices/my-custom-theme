<?php
/**
 * Goliath custom Gutenberg block registration.
 *
 * Each block is a dynamic (server-rendered) block.
 * The compiled JS lives in blocks-build/{name}/index.js.
 * The render callback is blocks/{name}/render.php.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/* ------------------------------------------------------------------ */
/*  Custom block category                                              */
/* ------------------------------------------------------------------ */

/**
 * Add a "Goliath Blocks" category to the block inserter.
 *
 * @param array[] $categories
 * @return array[]
 */
function my_theme_register_block_category(array $categories): array
{
    return array_merge(
        [
            [
                'slug'  => 'goliath',
                'title' => 'Goliath Blocks',
                'icon'  => null,
            ],
        ],
        $categories
    );
}
add_filter('block_categories_all', 'my_theme_register_block_category', 10, 1);

/* ------------------------------------------------------------------ */
/*  Block registration                                                 */
/* ------------------------------------------------------------------ */

/**
 * Register all Goliath custom blocks.
 *
 * block.json drives attributes, category, and title.
 * The `render` key in block.json points to render.php.
 * The compiled editor script is declared via `editorScript` → blocks-build/{name}/index.js.
 */
function my_theme_register_blocks(): void
{
    $blocks_build_dir = get_theme_file_path('blocks-build');
    $blocks_src_dir   = get_theme_file_path('blocks');

    if (! is_dir($blocks_build_dir)) {
        return;
    }

    $block_dirs = [
        // ── Shared / generic blocks ──────────────────────────────────
        'hero-section',
        'cta-section',
        'stats-strip',
        'text-columns',
        'content-card',
        'video-embed',
        'testimonial',
        'process-steps',
        'faq-accordion',
        'tick-list',
        'image-text-split',
        'orange-banner',
        'dark-bar-cta',
        'media-gallery',
        'team-member',
        'contact-info-cards',
        'resource-cards',
        'callout-box',
        'legal-document',
        'legal-content',

        // ── Contact page ─────────────────────────────────────────────
        'contact-form',
        'contact-cards',
        'contact-bottom-info',

        // ── FAQ page ─────────────────────────────────────────────────
        'faq-resources',
        'faq-bottom-cta',

        // ── Why Goliath page ─────────────────────────────────────────
        'wg-vs-standard',
        'wg-future-costs',
        'wg-repair-replace',
        'wg-compatible-systems',
        'wg-end-repair-cycle',
        'wg-sustainability',
        'wg-dual-cta',

        // ── About page ───────────────────────────────────────────────
        'about-our-story',
        'about-mission',
        'about-leadership',
        'about-team',
        'about-credentials',

        // ── How It Works page ────────────────────────────────────────
        'hiw-stats-bar',
        'hiw-installation',
        'hiw-fix-warranty',
        'hiw-uk-standards',
        'hiw-crash-video',
        'hiw-image-gallery',
        'hiw-fast-repair',
        'hiw-our-process',
        'hiw-strength',
        'hiw-realworld',

        // ── Videos page ──────────────────────────────────────────────
        'videos-grid',
        'videos-copy',
        'videos-dark-bar',
        'videos-orange-cta',

        // ── Compliance page ──────────────────────────────────────────
        'comp-regulation',
        'comp-standards',
        'comp-warranty-overlay',
        'comp-concerns',
        'comp-only-system',
        'comp-proven',
        'comp-compatibility',
        'comp-documentation',
        'comp-audit',

        // ── Services hub page ────────────────────────────────────────
        'svc-heavy-duty',
        'svc-comparison',
        'svc-projects',
        'svc-regulation',
        'svc-gallery',
        'svc-final-cta',

        // ── Homepage ─────────────────────────────────────────────────
        'hp-hero',
        'hp-process',
        'hp-preview',
        'hp-solution',
        'hp-advantages',
        'hp-timer-video',
        'hp-case-study',
        'hp-dent-risk',
        'hp-contact-form',

        // ── Service sub-page reusable blocks ─────────────────────────
        'service-orange-banner',
        'service-tick-list',
        'service-image-split',
        'svc-hero',
        'svc-text-block',
        'svc-split-panel',
        'svc-cards-grid',
        'svc-image-pair',
        'svc-two-articles',
        'svc-case-banner',
        'svc-bordered-cards',
        'svc-fullwidth-image',
        'svc-dark-section',

        // ── Case Study CPT ───────────────────────────────────────────
        'cs-hero',
        'cs-problem',
        'cs-solution',
        'cs-results',
        'cs-testimonial-cta',
    ];

    foreach ($block_dirs as $block_name) {
        $block_json = $blocks_src_dir . '/' . $block_name . '/block.json';

        if (! file_exists($block_json)) {
            continue;
        }

        $asset_file = $blocks_build_dir . '/' . $block_name . '/index.asset.php';
        $script_src = get_theme_file_uri('blocks-build/' . $block_name . '/index.js');

        if (! file_exists($asset_file)) {
            continue;
        }

        $asset = require $asset_file;

        // Register the compiled editor script.
        $handle = 'goliath-block-' . $block_name;
        wp_register_script(
            $handle,
            $script_src,
            $asset['dependencies'] ?? [],
            $asset['version'] ?? THEME_VERSION,
            ['in_footer' => true]
        );

        // Register the block with the compiled script + PHP render callback.
        register_block_type(
            $block_json,
            [
                'editor_script_handles' => [$handle],
            ]
        );
    }
}
add_action('init', 'my_theme_register_blocks');

/* ------------------------------------------------------------------ */
/*  Editor stylesheet — loads Tailwind in the block editor             */
/* ------------------------------------------------------------------ */

/**
 * Enqueue the compiled Tailwind CSS inside the block editor so block
 * previews match the front-end appearance.
 */
function my_theme_enqueue_block_editor_assets(): void
{
    $css_file = get_theme_file_path('dist/output.css');
    wp_enqueue_style(
        'my-theme-tailwind-editor',
        get_theme_file_uri('dist/output.css'),
        [],
        file_exists($css_file) ? (string) filemtime($css_file) : THEME_VERSION
    );
}
add_action('enqueue_block_editor_assets', 'my_theme_enqueue_block_editor_assets');
