<?php
/**
 * Goliath Content Editor — Header & Footer admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

function my_theme_admin_header_footer_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-header-footer') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_header_logo'               => 'image',
        'my_theme_header_cta_call_text'      => 'text',
        'my_theme_header_cta_assessment_text' => 'text',
        'my_theme_header_cta_assessment_url'  => 'text',
        'my_theme_header_nav_links'          => 'repeater_link',
        'my_theme_footer_tagline'             => 'textarea',
        'my_theme_footer_logo'               => 'image',
        'my_theme_footer_copyright_entity'    => 'text',
        'my_theme_footer_quick_links'         => 'repeater_link',
        'my_theme_footer_service_links'       => 'repeater_link',
        'my_theme_footer_bottom_links'        => 'repeater_link',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_header_footer_fields', 10, 2);

function my_theme_admin_render_header_footer(): void
{
    my_theme_admin_page_open('Header & Footer', 'goliath-header-footer');

    my_theme_admin_section_open('Header — Logo', 'Upload a custom logo for the header. Leave empty to use the default Goliath logo.');
    my_theme_admin_image_field('my_theme_header_logo', 'Header Logo');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Header — Navigation Links', 'Top-level links in the navigation bar. Service sub-pages are handled automatically under the Services dropdown. Use relative URLs like /about/ or full URLs for external links.');

    $nav_links = get_option('my_theme_header_nav_links');
    if (! is_array($nav_links) || $nav_links === []) {
        $nav_links = my_theme_header_default_nav_links();
    }

    $nav_links = my_theme_admin_repeater_open('my_theme_header_nav_links', 'Navigation Links', [], $nav_links);
    foreach ($nav_links as $i => $item) {
        my_theme_admin_repeater_row('my_theme_header_nav_links', $i, [
            'label' => ['label' => 'Link Text', 'type' => 'text', 'value' => $item['label'] ?? ''],
            'url'   => ['label' => 'URL',       'type' => 'text', 'value' => $item['url'] ?? ''],
        ]);
    }
    my_theme_admin_repeater_close('my_theme_header_nav_links', [
        'label' => ['label' => 'Link Text', 'type' => 'text'],
        'url'   => ['label' => 'URL',       'type' => 'text'],
    ]);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Header — CTAs', 'The two buttons on the right side of the header.');
    my_theme_admin_text_field('my_theme_header_cta_call_text', 'Call Button Text', 'Call Us');
    my_theme_admin_text_field('my_theme_header_cta_assessment_text', 'Assessment Button Text', 'Get Free Assessment');
    my_theme_admin_text_field('my_theme_header_cta_assessment_url', 'Assessment Button URL', '/contact/');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Footer — Logo & Tagline', 'The logo and tagline appear in the top-left of the footer. Leave the logo empty to use the default.');
    my_theme_admin_image_field('my_theme_footer_logo', 'Footer Logo');
    my_theme_admin_textarea_field('my_theme_footer_tagline', 'Footer Tagline', 'Safe, instant repair for damaged uprights. We deliver confidence, safety, and the certainty that your warehouse is protected for life.');
    my_theme_admin_text_field('my_theme_footer_copyright_entity', 'Copyright Entity Name', 'Goliath Pallet Racking Repair Ltd');
    my_theme_admin_section_close();

    // Quick Links repeater
    my_theme_admin_section_open('Footer — Quick Links', 'Links shown in the "Quick Links" column. Add, remove, or reorder as needed.');

    $quick_links = get_option('my_theme_footer_quick_links');
    if (! is_array($quick_links) || $quick_links === []) {
        $quick_links = my_theme_footer_default_quick_links();
    }

    $quick_links = my_theme_admin_repeater_open('my_theme_footer_quick_links', 'Quick Links', [], $quick_links);
    foreach ($quick_links as $i => $item) {
        my_theme_admin_repeater_row('my_theme_footer_quick_links', $i, [
            'label' => ['label' => 'Link Text', 'type' => 'text', 'value' => $item['label'] ?? ''],
            'url'   => ['label' => 'URL',       'type' => 'text', 'value' => $item['url'] ?? ''],
        ]);
    }
    my_theme_admin_repeater_close('my_theme_footer_quick_links', [
        'label' => ['label' => 'Link Text', 'type' => 'text'],
        'url'   => ['label' => 'URL',       'type' => 'text'],
    ]);
    my_theme_admin_section_close();

    // Services Links repeater
    my_theme_admin_section_open('Footer — Service Links', 'Links shown in the "Services" column.');

    $service_links = get_option('my_theme_footer_service_links');
    if (! is_array($service_links) || $service_links === []) {
        $service_links = my_theme_footer_default_service_links();
    }

    $service_links = my_theme_admin_repeater_open('my_theme_footer_service_links', 'Service Links', [], $service_links);
    foreach ($service_links as $i => $item) {
        my_theme_admin_repeater_row('my_theme_footer_service_links', $i, [
            'label' => ['label' => 'Link Text', 'type' => 'text', 'value' => $item['label'] ?? ''],
            'url'   => ['label' => 'URL',       'type' => 'text', 'value' => $item['url'] ?? ''],
        ]);
    }
    my_theme_admin_repeater_close('my_theme_footer_service_links', [
        'label' => ['label' => 'Link Text', 'type' => 'text'],
        'url'   => ['label' => 'URL',       'type' => 'text'],
    ]);
    my_theme_admin_section_close();

    // Bottom bar links repeater
    my_theme_admin_section_open('Footer — Bottom Bar Links', 'Links in the copyright bar at the very bottom. Each link can optionally have a logo (e.g. for a partner or startup badge). External links open in a new tab automatically.');

    $bottom_links = get_option('my_theme_footer_bottom_links');
    if (! is_array($bottom_links) || $bottom_links === []) {
        $bottom_links = my_theme_footer_default_bottom_links();
    }

    $bottom_links = my_theme_admin_repeater_open('my_theme_footer_bottom_links', 'Bottom Bar Links', [], $bottom_links);
    foreach ($bottom_links as $i => $item) {
        my_theme_admin_repeater_row('my_theme_footer_bottom_links', $i, [
            'label' => ['label' => 'Link Text',       'type' => 'text',  'value' => $item['label'] ?? ''],
            'url'   => ['label' => 'URL',              'type' => 'text',  'value' => $item['url'] ?? ''],
            'logo'  => ['label' => 'Logo (optional)',  'type' => 'image', 'value' => $item['logo'] ?? ''],
        ]);
    }
    my_theme_admin_repeater_close('my_theme_footer_bottom_links', [
        'label' => ['label' => 'Link Text',       'type' => 'text'],
        'url'   => ['label' => 'URL',              'type' => 'text'],
        'logo'  => ['label' => 'Logo (optional)',  'type' => 'image'],
    ]);
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}

/**
 * Default Quick Links for a fresh install.
 *
 * @return list<array{label: string, url: string}>
 */
function my_theme_footer_default_quick_links(): array
{
    return [
        ['label' => 'Why Goliath™?', 'url' => '/why-goliath/'],
        ['label' => 'How it works?', 'url' => '/how-it-works/'],
        ['label' => 'Videos',        'url' => '/videos/'],
        ['label' => 'Compliance',    'url' => '/compliance/'],
        ['label' => 'FAQs',          'url' => '/faq/'],
        ['label' => 'Case Studies',  'url' => '/case-studies/'],
        ['label' => 'About',         'url' => '/about/'],
    ];
}

/**
 * Default Service Links for a fresh install.
 *
 * @return list<array{label: string, url: string}>
 */
function my_theme_footer_default_service_links(): array
{
    return [
        ['label' => 'Racking Upright Repair', 'url' => '/services/racking-upright-repair/'],
        ['label' => 'Damage Prevention',      'url' => '/services/damage-prevention/'],
        ['label' => 'Annual Inspections',     'url' => '/services/annual-inspections/'],
        ['label' => 'Installations & CDM',    'url' => '/services/installations-cdm/'],
        ['label' => 'Reconfiguration',        'url' => '/services/reconfiguration/'],
    ];
}

/**
 * Default Bottom Bar Links for a fresh install.
 *
 * @return list<array{label: string, url: string, logo: string}>
 */
function my_theme_footer_default_bottom_links(): array
{
    return [
        ['label' => 'Privacy Policy',       'url' => '/privacy-policy/',      'logo' => ''],
        ['label' => 'Terms and Conditions',  'url' => '/terms-of-service/',   'logo' => ''],
    ];
}

/**
 * Default Header Navigation Links for a fresh install.
 *
 * @return list<array{label: string, url: string}>
 */
function my_theme_header_default_nav_links(): array
{
    return [
        ['label' => 'Why Goliath™?', 'url' => '/why-goliath/'],
        ['label' => 'How it works?', 'url' => '/how-it-works/'],
        ['label' => 'Services',      'url' => '/services/'],
        ['label' => 'Compliance',    'url' => '/compliance/'],
        ['label' => 'Case Studies',  'url' => '/case-studies/'],
    ];
}
