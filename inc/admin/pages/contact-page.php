<?php
/**
 * Goliath Content Editor — Contact Page admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

function my_theme_admin_contact_page_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-contact-page') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_cp_hero_h1'              => 'text',
        'my_theme_cp_hero_desc'            => 'textarea',

        'my_theme_cp_phone_subtitle'       => 'text',
        'my_theme_cp_email_subtitle'       => 'text',

        'my_theme_cp_form_h2'              => 'text',
        'my_theme_cp_sidebar_large1'       => 'text',
        'my_theme_cp_sidebar_large2'       => 'text',
        'my_theme_cp_sidebar_body'         => 'textarea',
        'my_theme_cp_sidebar_why_heading'  => 'text',
        'my_theme_cp_sidebar_bullet1'      => 'text',
        'my_theme_cp_sidebar_bullet2'      => 'text',
        'my_theme_cp_sidebar_bullet3'      => 'text',
        'my_theme_cp_sidebar_bullet4'      => 'text',

        'my_theme_cp_bottom_desc'          => 'textarea',
        'my_theme_cp_benefit1_title'       => 'text',
        'my_theme_cp_benefit1_subtitle'    => 'text',
        'my_theme_cp_benefit2_title'       => 'text',
        'my_theme_cp_benefit2_subtitle'    => 'text',
        'my_theme_cp_benefit3_title'       => 'text',
        'my_theme_cp_benefit3_subtitle'    => 'text',
        'my_theme_cp_benefit4_title'       => 'text',
        'my_theme_cp_benefit4_subtitle'    => 'text',
        'my_theme_cp_bottom_image'         => 'image',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_contact_page_fields', 10, 2);

function my_theme_admin_render_contact_page(): void
{
    my_theme_admin_page_open('Contact Page', 'goliath-contact-page');

    my_theme_admin_section_open('Hero Section', 'Page heading and introduction.');
    my_theme_admin_text_field('my_theme_cp_hero_h1', 'Heading (H1)', 'Get in Touch');
    my_theme_admin_textarea_field('my_theme_cp_hero_desc', 'Description', 'Request a free warehouse racking assessment from our SEMA-qualified team. We respond within one working day and provide transparent, no-obligation pricing.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Quick Contact Cards', 'Subtitles shown beneath phone and email cards.');
    my_theme_admin_text_field('my_theme_cp_phone_subtitle', 'Phone Subtitle', 'Mon-Fri, 8am-6pm GMT');
    my_theme_admin_text_field('my_theme_cp_email_subtitle', 'Email Subtitle', 'We respond within 1 working day');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Form Section', 'Heading and sidebar content next to the contact form.');
    my_theme_admin_text_field('my_theme_cp_form_h2', 'Form Heading (H2)', 'Request a Free Warehouse Assessment');
    my_theme_admin_text_field('my_theme_cp_sidebar_large1', 'Sidebar Large Text Line 1', 'Get Your Free');
    my_theme_admin_text_field('my_theme_cp_sidebar_large2', 'Sidebar Large Text Line 2', 'Consultation');
    my_theme_admin_textarea_field('my_theme_cp_sidebar_body', 'Sidebar Body', 'Lifetime warranty, 30-minute installation, minimal downtime. Find out how Goliath can reduce your racking repair costs.', 3);
    my_theme_admin_text_field('my_theme_cp_sidebar_why_heading', '"Why Request" Heading', 'Why Request an Assessment?');
    my_theme_admin_text_field('my_theme_cp_sidebar_bullet1', 'Bullet 1', 'Free, no-obligation evaluation');
    my_theme_admin_text_field('my_theme_cp_sidebar_bullet2', 'Bullet 2', 'Response within 1 working day');
    my_theme_admin_text_field('my_theme_cp_sidebar_bullet3', 'Bullet 3', 'Transparent, honest pricing');
    my_theme_admin_text_field('my_theme_cp_sidebar_bullet4', 'Bullet 4', 'Expert safety advice');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Bottom Info Section', 'Description, benefits, and image below the form.');
    my_theme_admin_textarea_field('my_theme_cp_bottom_desc', 'Description', 'Our expert team will visit your facility, assess your racking condition, identify damage and risk areas, and provide a detailed quote with no obligation. Most assessments are completed within 48 hours of booking.', 3);
    my_theme_admin_text_field('my_theme_cp_benefit1_title', 'Benefit 1 — Title', 'Free Site Survey');
    my_theme_admin_text_field('my_theme_cp_benefit1_subtitle', 'Benefit 1 — Subtitle', 'Complete damage assessment and risk mapping');
    my_theme_admin_text_field('my_theme_cp_benefit2_title', 'Benefit 2 — Title', 'Detailed Quote');
    my_theme_admin_text_field('my_theme_cp_benefit2_subtitle', 'Benefit 2 — Subtitle', 'Transparent pricing with no hidden costs');
    my_theme_admin_text_field('my_theme_cp_benefit3_title', 'Benefit 3 — Title', 'Expert Recommendations');
    my_theme_admin_text_field('my_theme_cp_benefit3_subtitle', 'Benefit 3 — Subtitle', 'Tailored solutions for your specific needs');
    my_theme_admin_text_field('my_theme_cp_benefit4_title', 'Benefit 4 — Title', 'Fast Response');
    my_theme_admin_text_field('my_theme_cp_benefit4_subtitle', 'Benefit 4 — Subtitle', 'Emergency installations within 48 hours');
    my_theme_admin_image_field('my_theme_cp_bottom_image', 'Experts Photo', get_theme_file_uri('assets/images/contact/experts.webp'));
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
