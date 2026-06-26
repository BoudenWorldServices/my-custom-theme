<?php

/**
 * Goliath Content Editor — Email Templates admin page.
 *
 * Exposes the editable parts of the branded contact form emails
 * via the existing Goliath Content admin panel.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/* ------------------------------------------------------------------ */
/*  Field definitions                                                  */
/* ------------------------------------------------------------------ */

/**
 * Register email template option keys and their sanitise types.
 *
 * @param array<string, string> $defs
 * @param string                $page
 * @return array<string, string>
 */
function my_theme_admin_email_templates_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-email-templates') {
        return $defs;
    }

    return array_merge($defs, [
        // Notification email (sent to the business)
        'my_theme_email_notif_heading'  => 'text',

        // Customer confirmation auto-reply
        'my_theme_email_reply_subject'  => 'text',
        'my_theme_email_reply_intro'    => 'textarea',
        'my_theme_email_reply_bullet1'  => 'text',
        'my_theme_email_reply_bullet2'  => 'text',
        'my_theme_email_reply_bullet3'  => 'text',
        'my_theme_email_reply_quote'    => 'textarea',
        'my_theme_email_reply_cta'      => 'text',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_email_templates_fields', 10, 2);

/* ------------------------------------------------------------------ */
/*  Render callback                                                    */
/* ------------------------------------------------------------------ */

/**
 * Render the Email Templates admin page.
 */
function my_theme_admin_render_email_templates(): void
{
    my_theme_admin_page_open('Email Templates', 'goliath-email-templates');

    my_theme_admin_section_open(
        'Assessment request notification',
        'This email is sent to the business inbox (sales@goliathrepair.co.uk) each time a visitor submits the contact form.'
    );
    my_theme_admin_text_field(
        'my_theme_email_notif_heading',
        'Email heading',
        'New Assessment Request',
        'e.g. New Assessment Request'
    );
    my_theme_admin_section_close();

    my_theme_admin_section_open(
        'Customer confirmation email',
        'This email is automatically sent to the visitor immediately after they submit the form.'
    );
    my_theme_admin_text_field(
        'my_theme_email_reply_subject',
        'Subject line',
        'We\'ve received your assessment request — Goliath Pallet Racking Repair',
        'Subject line shown in the inbox'
    );
    my_theme_admin_textarea_field(
        'my_theme_email_reply_intro',
        'Intro paragraph',
        'Thank you for reaching out to us. We\'ve received your assessment request and one of our team will be in touch with you within 1 working day.',
        3
    );
    my_theme_admin_text_field(
        'my_theme_email_reply_bullet1',
        'Bullet point 1',
        'Free, no-obligation evaluation of your racking system'
    );
    my_theme_admin_text_field(
        'my_theme_email_reply_bullet2',
        'Bullet point 2',
        'Response within 1 working day'
    );
    my_theme_admin_text_field(
        'my_theme_email_reply_bullet3',
        'Bullet point 3',
        'Transparent, honest pricing with no hidden fees'
    );
    my_theme_admin_textarea_field(
        'my_theme_email_reply_quote',
        'Brand quote',
        'We offer more than repairs. We deliver confidence, safety, and the certainty that your warehouse is protected for life.',
        2
    );
    my_theme_admin_text_field(
        'my_theme_email_reply_cta',
        'Button text',
        'Visit Our Website'
    );
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
