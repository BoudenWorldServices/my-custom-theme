<?php
/**
 * Goliath Content Editor — FAQ Page admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

function my_theme_admin_faq_page_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-faq-page') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_faqp_hero_h1'           => 'text',
        'my_theme_faqp_hero_desc'         => 'textarea',

        'my_theme_faqp_resources_h2'      => 'text',
        'my_theme_faqp_res1_title'        => 'text',
        'my_theme_faqp_res1_desc'         => 'text',
        'my_theme_faqp_res2_title'        => 'text',
        'my_theme_faqp_res2_desc'         => 'text',
        'my_theme_faqp_res3_title'        => 'text',
        'my_theme_faqp_res3_desc'         => 'text',

        'my_theme_faqp_cta_h3'            => 'text',
        'my_theme_faqp_cta_body'          => 'textarea',
        'my_theme_faqp_cta_btn'           => 'text',
        'my_theme_faqp_cta_image'         => 'image',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_faq_page_fields', 10, 2);

function my_theme_admin_render_faq_page(): void
{
    my_theme_admin_page_open('FAQ Page', 'goliath-faq-page');

    my_theme_admin_section_open('Hero Section', 'Page heading and introduction.');
    my_theme_admin_text_field('my_theme_faqp_hero_h1', 'Heading (H1)', 'Frequently Asked Questions');
    my_theme_admin_textarea_field('my_theme_faqp_hero_desc', 'Description', 'Everything you need to know about Goliath Pallet Racking Repair Ltd, from installation and costs to safety compliance and warranty coverage.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Resources Section', 'Heading and resource card titles/descriptions.');
    my_theme_admin_text_field('my_theme_faqp_resources_h2', 'Section Heading (H2)', 'Explore More Resources');
    my_theme_admin_text_field('my_theme_faqp_res1_title', 'Card 1 — Title', 'How It Works');
    my_theme_admin_text_field('my_theme_faqp_res1_desc', 'Card 1 — Description', 'Learn about our 30-minute installation process');
    my_theme_admin_text_field('my_theme_faqp_res2_title', 'Card 2 — Title', 'Compliance');
    my_theme_admin_text_field('my_theme_faqp_res2_desc', 'Card 2 — Description', 'Understand how Goliath™ meets UK safety standards');
    my_theme_admin_text_field('my_theme_faqp_res3_title', 'Card 3 — Title', 'Case Studies');
    my_theme_admin_text_field('my_theme_faqp_res3_desc', 'Card 3 — Description', 'See real-world results from B&M and others');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Bottom CTA', 'Call-to-action section with image.');
    my_theme_admin_text_field('my_theme_faqp_cta_h3', 'CTA Heading (H3)', 'Still Have Questions?');
    my_theme_admin_textarea_field('my_theme_faqp_cta_body', 'CTA Body', 'Our team of experts is ready to answer any questions you have about Goliath™ and how it can benefit your warehouse operations.', 3);
    my_theme_admin_text_field('my_theme_faqp_cta_btn', 'CTA Button Text', 'Contact us');
    my_theme_admin_image_field('my_theme_faqp_cta_image', 'CTA Image', get_theme_file_uri('assets/images/FAQ/installonce.webp'));
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
