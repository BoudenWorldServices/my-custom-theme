<?php
/**
 * Goliath Content Editor — Videos Page admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

function my_theme_admin_videos_page_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-videos-page') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_vp_hero_badge'           => 'text',
        'my_theme_vp_hero_h1'              => 'text',
        'my_theme_vp_hero_desc'            => 'textarea',

        'my_theme_vp_install_heading'      => 'text',
        'my_theme_vp_install_subtitle'     => 'text',
        'my_theme_vp_safety_heading'       => 'text',
        'my_theme_vp_safety_subtitle'      => 'text',

        'my_theme_vp_copy_left_h2'         => 'text',
        'my_theme_vp_copy_left_p1'         => 'textarea',
        'my_theme_vp_copy_left_p2'         => 'textarea',
        'my_theme_vp_copy_right_h2'        => 'text',
        'my_theme_vp_copy_right_p1'        => 'textarea',
        'my_theme_vp_copy_right_p2'        => 'textarea',

        'my_theme_vp_black_cta_text'       => 'text',
        'my_theme_vp_black_cta_btn1'       => 'text',
        'my_theme_vp_black_cta_btn2'       => 'text',

        'my_theme_vp_orange_h2'            => 'text',
        'my_theme_vp_orange_desc'          => 'textarea',
        'my_theme_vp_orange_btn'           => 'text',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_videos_page_fields', 10, 2);

function my_theme_admin_render_videos_page(): void
{
    my_theme_admin_page_open('Videos Page', 'goliath-videos-page');

    my_theme_admin_section_open('Hero Section', 'Badge, heading, and introduction.');
    my_theme_admin_text_field('my_theme_vp_hero_badge', 'Badge Text', 'Featured Video');
    my_theme_admin_text_field('my_theme_vp_hero_h1', 'Heading (H1)', 'Rack Safety & Installation Videos');
    my_theme_admin_textarea_field('my_theme_vp_hero_desc', 'Description', 'Watch Goliath™ in action and learn everything you need to know about warehouse racking safety, compliance, and cost-effective repair solutions.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Section Headings', 'Headings and subtitles for video sections.');
    my_theme_admin_text_field('my_theme_vp_install_heading', 'Installation Heading', 'Installation & Product Demos');
    my_theme_admin_text_field('my_theme_vp_install_subtitle', 'Installation Subtitle', 'Watch how Goliath™ is installed and see the product in action');
    my_theme_admin_text_field('my_theme_vp_safety_heading', 'Safety Heading', 'Safety & Compliance');
    my_theme_admin_text_field('my_theme_vp_safety_subtitle', 'Safety Subtitle', 'Understanding warehouse racking safety regulations and best practices');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Supporting Copy', 'Two-column content below video grids.');
    my_theme_admin_text_field('my_theme_vp_copy_left_h2', 'Left Column Heading', 'Goliath™ Rack Repair & Safety Videos');
    my_theme_admin_textarea_field('my_theme_vp_copy_left_p1', 'Left Paragraph 1', 'Pallet racking damage is a constant issue in busy warehouses, but the real problem is how it is managed over time. Goliath™ is designed to break the cycle of repeated damage, costly replacements, and downtime.', 3);
    my_theme_admin_textarea_field('my_theme_vp_copy_left_p2', 'Left Paragraph 2', 'Our video series shows how Goliath™ repairs and reinforces uprights differently from traditional methods, delivering a permanent solution that improves safety, reduces downtime, and lowers long-term maintenance costs.', 3);
    my_theme_admin_text_field('my_theme_vp_copy_right_h2', 'Right Column Heading', 'Learn How Goliath™ Breaks the Repair Cycle');
    my_theme_admin_textarea_field('my_theme_vp_copy_right_p1', 'Right Paragraph 1', 'Traditional pallet racking repair replaces damaged uprights after impact, restoring the rack but not preventing future damage.', 3);
    my_theme_admin_textarea_field('my_theme_vp_copy_right_p2', 'Right Paragraph 2', 'The Goliath™ video series shows how our high-strength steel repair system reinforces the impact zone, turning repeated repairs into a permanent structural upgrade.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Black CTA Bar', 'Dark call-to-action strip between sections.');
    my_theme_admin_text_field('my_theme_vp_black_cta_text', 'CTA Text', 'Ready to see Goliath™ in your warehouse?');
    my_theme_admin_text_field('my_theme_vp_black_cta_btn1', 'Button 1 Text', 'Book a free on-site demonstration');
    my_theme_admin_text_field('my_theme_vp_black_cta_btn2', 'Button 2 Text', 'Schedule live demo');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Orange CTA', 'Bottom call-to-action section.');
    my_theme_admin_text_field('my_theme_vp_orange_h2', 'Heading (H2)', 'Ready to see Goliath™ in your warehouse?');
    my_theme_admin_textarea_field('my_theme_vp_orange_desc', 'Description', 'Book a free on-site demonstration and see first-hand how Goliath™ can improve your racking maintenance.', 2);
    my_theme_admin_text_field('my_theme_vp_orange_btn', 'Button Text', 'Schedule live demo');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
