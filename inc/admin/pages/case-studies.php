<?php
/**
 * Goliath Content Editor — Case Studies admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Register field definitions for the case studies page.
 */
function my_theme_admin_case_studies_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-case-studies') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_cs_hero_h1'          => 'text',
        'my_theme_cs_hero_desc'        => 'textarea',
        'my_theme_case_study_library'  => 'repeater_case_study',
        'my_theme_cs_cta_h2'           => 'text',
        'my_theme_cs_cta_desc'         => 'textarea',
        'my_theme_cs_cta_btn'          => 'text',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_case_studies_fields', 10, 2);

/**
 * Resolve a stored image value to a preview URL for the admin.
 */
function my_theme_admin_cs_resolve_image_preview(string $val): string
{
    if ($val === '') {
        return '';
    }
    if (is_numeric($val) && (int) $val > 0) {
        return wp_get_attachment_image_url((int) $val, 'thumbnail') ?: '';
    }
    return $val;
}

/**
 * Resolve a stored video value to a display name for the admin.
 */
function my_theme_admin_cs_resolve_video_name(string $val): string
{
    if ($val === '') {
        return '';
    }
    return basename($val);
}

/**
 * Render the case studies admin page.
 */
function my_theme_admin_render_case_studies(): void
{
    my_theme_admin_page_open('Case Studies', 'goliath-case-studies');

    /* ------------------------------------------------------------------ */
    /*  Hero section                                                       */
    /* ------------------------------------------------------------------ */
    my_theme_admin_section_open('Hero Section', 'Page heading and introduction paragraph.');
    my_theme_admin_text_field('my_theme_cs_hero_h1', 'Heading (H1)', 'Case Studies');
    my_theme_admin_textarea_field(
        'my_theme_cs_hero_desc',
        'Description',
        'Seeing is believing. Our case studies showcase real-world results from warehouses across the UK that have made the switch to Goliath™.',
        6
    );
    my_theme_admin_section_close();

    /* ------------------------------------------------------------------ */
    /*  Case study library repeater                                        */
    /* ------------------------------------------------------------------ */
    my_theme_admin_section_open(
        'Case Studies',
        'Add, edit, or remove case studies. Each entry creates a listing card on /case-studies/ and a detail page at /case-studies/{slug}/. The slug must be unique and URL-safe (lowercase letters, numbers, hyphens only).'
    );

    $library = function_exists('my_theme_get_case_study_library') ? my_theme_get_case_study_library() : [];

    $items = [];
    foreach ($library as $slug => $row) {
        $items[] = array_merge($row, ['slug' => $slug]);
    }

    $items = my_theme_admin_repeater_open('my_theme_case_study_library', 'Case Study Library', [], $items);

    foreach ($items as $i => $item) {
        my_theme_admin_repeater_row('my_theme_case_study_library', $i, [
            /* ---- Listing card fields ---- */
            'slug' => [
                'label' => 'Slug (URL identifier — e.g. bm-racking-damage)',
                'type'  => 'text',
                'value' => $item['slug'] ?? '',
            ],
            'client' => [
                'label' => 'Client name',
                'type'  => 'text',
                'value' => $item['client'] ?? '',
            ],
            'title' => [
                'label' => 'Case study title',
                'type'  => 'text',
                'value' => $item['title'] ?? '',
            ],
            'image' => [
                'label' => 'Listing card image',
                'type'  => 'image',
                'value' => $item['image'] ?? '',
            ],
            'challenge' => [
                'label' => 'Challenge (shown on listing card)',
                'type'  => 'textarea',
                'value' => $item['challenge'] ?? '',
            ],
            'solution' => [
                'label' => 'Solution (shown on listing card)',
                'type'  => 'textarea',
                'value' => $item['solution'] ?? '',
            ],
            'metric1_value' => [
                'label' => 'Metric 1 — Value (e.g. 30%)',
                'type'  => 'text',
                'value' => $item['metric1_value'] ?? '',
            ],
            'metric1_label' => [
                'label' => 'Metric 1 — Label (e.g. Repair Budget Reduction)',
                'type'  => 'text',
                'value' => $item['metric1_label'] ?? '',
            ],
            'metric2_value' => [
                'label' => 'Metric 2 — Value',
                'type'  => 'text',
                'value' => $item['metric2_value'] ?? '',
            ],
            'metric2_label' => [
                'label' => 'Metric 2 — Label',
                'type'  => 'text',
                'value' => $item['metric2_label'] ?? '',
            ],
            'metric3_value' => [
                'label' => 'Metric 3 — Value',
                'type'  => 'text',
                'value' => $item['metric3_value'] ?? '',
            ],
            'metric3_label' => [
                'label' => 'Metric 3 — Label',
                'type'  => 'text',
                'value' => $item['metric3_label'] ?? '',
            ],

            /* ---- Detail page — hero ---- */
            'hero_intro' => [
                'label' => 'Hero intro paragraph (shown under the title in the hero)',
                'type'  => 'textarea',
                'value' => $item['hero_intro'] ?? '',
            ],

            /* ---- Detail page — The Problem ---- */
            'problem_text' => [
                'label' => 'The Problem — body text (separate paragraphs with a blank line)',
                'type'  => 'textarea',
                'value' => $item['problem_text'] ?? '',
            ],
            'problem_callout' => [
                'label' => 'The Problem — orange callout sentence',
                'type'  => 'text',
                'value' => $item['problem_callout'] ?? '',
            ],

            /* ---- Detail page — What They Tried ---- */
            'tried_text' => [
                'label' => 'What They Tried — body text (separate paragraphs with a blank line)',
                'type'  => 'textarea',
                'value' => $item['tried_text'] ?? '',
            ],
            'tried_callout' => [
                'label' => 'What They Tried — orange callout sentence',
                'type'  => 'text',
                'value' => $item['tried_callout'] ?? '',
            ],

            /* ---- Detail page — Solution ---- */
            'video' => [
                'label' => 'Solution — video (optional, MP4)',
                'type'  => 'video',
                'value' => $item['video'] ?? '',
            ],
            'solution_text' => [
                'label' => 'Solution — body text (separate paragraphs with a blank line)',
                'type'  => 'textarea',
                'value' => $item['solution_text'] ?? '',
            ],
            'solution_callout' => [
                'label' => 'Solution — callout text (orange strip)',
                'type'  => 'textarea',
                'value' => $item['solution_callout'] ?? '',
            ],

            /* ---- Detail page — Results ---- */
            'results_image' => [
                'label' => 'Results — main warehouse photo',
                'type'  => 'image',
                'value' => $item['results_image'] ?? '',
            ],
            'results_intro' => [
                'label' => 'Results — intro paragraph',
                'type'  => 'textarea',
                'value' => $item['results_intro'] ?? '',
            ],
            'result1_title' => [
                'label' => 'Result card 1 — title',
                'type'  => 'text',
                'value' => $item['result1_title'] ?? '',
            ],
            'result1_text' => [
                'label' => 'Result card 1 — description',
                'type'  => 'text',
                'value' => $item['result1_text'] ?? '',
            ],
            'result2_title' => [
                'label' => 'Result card 2 — title',
                'type'  => 'text',
                'value' => $item['result2_title'] ?? '',
            ],
            'result2_text' => [
                'label' => 'Result card 2 — description',
                'type'  => 'text',
                'value' => $item['result2_text'] ?? '',
            ],
            'result3_title' => [
                'label' => 'Result card 3 — title',
                'type'  => 'text',
                'value' => $item['result3_title'] ?? '',
            ],
            'result3_text' => [
                'label' => 'Result card 3 — description',
                'type'  => 'text',
                'value' => $item['result3_text'] ?? '',
            ],
            'result4_title' => [
                'label' => 'Result card 4 — title (optional)',
                'type'  => 'text',
                'value' => $item['result4_title'] ?? '',
            ],
            'result4_text' => [
                'label' => 'Result card 4 — description (optional)',
                'type'  => 'text',
                'value' => $item['result4_text'] ?? '',
            ],

            /* ---- Detail page — warranty banner ---- */
            'warranty_text' => [
                'label' => 'Warranty banner text (dark strip — separate paragraphs with a blank line)',
                'type'  => 'textarea',
                'value' => $item['warranty_text'] ?? '',
            ],

            /* ---- Detail page — testimonial (optional) ---- */
            'testimonial_quote' => [
                'label' => 'Testimonial quote (optional — leave blank to hide section)',
                'type'  => 'textarea',
                'value' => $item['testimonial_quote'] ?? '',
            ],
            'testimonial_attr' => [
                'label' => 'Testimonial attribution (e.g. Kenny Hudson, National Facilities Manager, B&M)',
                'type'  => 'text',
                'value' => $item['testimonial_attr'] ?? '',
            ],

            /* ---- SEO overrides (optional) ---- */
            'seo_title' => [
                'label' => 'SEO title override (optional — leave blank to use the case study title)',
                'type'  => 'text',
                'value' => $item['seo_title'] ?? '',
            ],
            'seo_desc' => [
                'label' => 'SEO meta description override (optional)',
                'type'  => 'textarea',
                'value' => $item['seo_desc'] ?? '',
            ],
        ]);
    }

    my_theme_admin_repeater_close('my_theme_case_study_library', [
        'slug'              => ['label' => 'Slug (URL identifier)', 'type' => 'text'],
        'client'            => ['label' => 'Client name', 'type' => 'text'],
        'title'             => ['label' => 'Case study title', 'type' => 'text'],
        'image'             => ['label' => 'Listing card image', 'type' => 'image'],
        'challenge'         => ['label' => 'Challenge (listing card)', 'type' => 'textarea'],
        'solution'          => ['label' => 'Solution (listing card)', 'type' => 'textarea'],
        'metric1_value'     => ['label' => 'Metric 1 — Value', 'type' => 'text'],
        'metric1_label'     => ['label' => 'Metric 1 — Label', 'type' => 'text'],
        'metric2_value'     => ['label' => 'Metric 2 — Value', 'type' => 'text'],
        'metric2_label'     => ['label' => 'Metric 2 — Label', 'type' => 'text'],
        'metric3_value'     => ['label' => 'Metric 3 — Value', 'type' => 'text'],
        'metric3_label'     => ['label' => 'Metric 3 — Label', 'type' => 'text'],
        'hero_intro'        => ['label' => 'Hero intro paragraph', 'type' => 'textarea'],
        'problem_text'      => ['label' => 'The Problem — body text', 'type' => 'textarea'],
        'problem_callout'   => ['label' => 'The Problem — callout sentence', 'type' => 'text'],
        'tried_text'        => ['label' => 'What They Tried — body text', 'type' => 'textarea'],
        'tried_callout'     => ['label' => 'What They Tried — callout sentence', 'type' => 'text'],
        'video'             => ['label' => 'Solution — video (optional)', 'type' => 'video'],
        'solution_text'     => ['label' => 'Solution — body text', 'type' => 'textarea'],
        'solution_callout'  => ['label' => 'Solution — callout text', 'type' => 'textarea'],
        'results_image'     => ['label' => 'Results — main photo', 'type' => 'image'],
        'results_intro'     => ['label' => 'Results — intro paragraph', 'type' => 'textarea'],
        'result1_title'     => ['label' => 'Result card 1 — title', 'type' => 'text'],
        'result1_text'      => ['label' => 'Result card 1 — description', 'type' => 'text'],
        'result2_title'     => ['label' => 'Result card 2 — title', 'type' => 'text'],
        'result2_text'      => ['label' => 'Result card 2 — description', 'type' => 'text'],
        'result3_title'     => ['label' => 'Result card 3 — title', 'type' => 'text'],
        'result3_text'      => ['label' => 'Result card 3 — description', 'type' => 'text'],
        'result4_title'     => ['label' => 'Result card 4 — title (optional)', 'type' => 'text'],
        'result4_text'      => ['label' => 'Result card 4 — description (optional)', 'type' => 'text'],
        'warranty_text'     => ['label' => 'Warranty banner text', 'type' => 'textarea'],
        'testimonial_quote' => ['label' => 'Testimonial quote (optional)', 'type' => 'textarea'],
        'testimonial_attr'  => ['label' => 'Testimonial attribution', 'type' => 'text'],
        'seo_title'         => ['label' => 'SEO title override (optional)', 'type' => 'text'],
        'seo_desc'          => ['label' => 'SEO meta description (optional)', 'type' => 'textarea'],
    ]);

    my_theme_admin_section_close();

    /* ------------------------------------------------------------------ */
    /*  CTA section                                                        */
    /* ------------------------------------------------------------------ */
    my_theme_admin_section_open('CTA Section', 'Bottom call-to-action bar on the case studies listing page.');
    my_theme_admin_text_field('my_theme_cs_cta_h2', 'CTA Heading (H2)', 'Ready to Write Your Success Story?');
    my_theme_admin_textarea_field(
        'my_theme_cs_cta_desc',
        'CTA Description',
        'Join hundreds of UK warehouses saving costs and improving safety with Goliath.',
        2
    );
    my_theme_admin_text_field('my_theme_cs_cta_btn', 'CTA Button Text', 'Book Free Assessment');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
