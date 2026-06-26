<?php

/**
 * Branded HTML email templates for the Goliath contact form.
 *
 * All styles are inlined — email clients strip <style> blocks.
 * Table-based layout ensures broad client compatibility including Outlook.
 *
 * @package MyCustomTheme
 */

/**
 * Shared email wrapper: opens the outer table, renders the header, and returns
 * a string that must be closed with {@see my_theme_email_footer()}.
 *
 * @param string $heading The heading text shown in the dark banner below the logo.
 * @return string
 */
function my_theme_email_header(string $heading): string
{
    $logo_url = 'https://goliathrepair.co.uk/wp-content/themes/my-custom-theme/assets/images/logo-full.png';

    return '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<title>' . esc_html($heading) . '</title>
<style>
  :root { color-scheme: light; }
</style>
</head>
<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,Helvetica,sans-serif;color-scheme:light;"
      data-ogsc>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;">
  <tr>
    <td align="center" style="padding:24px 16px;">
      <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background-color:#ffffff;border-radius:4px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">

        <!-- Orange accent bar -->
        <tr>
          <td style="background-color:#ff5c00;height:6px;font-size:0;line-height:0;">&nbsp;</td>
        </tr>

        <!-- Logo area -->
        <tr>
          <td align="center" style="padding:32px 40px 28px 40px;background-color:#ffffff;">
            <img src="' . esc_url($logo_url) . '"
                 alt="Goliath Pallet Racking Repair Ltd"
                 width="200"
                 style="display:block;max-width:200px;height:auto;border:0;">
          </td>
        </tr>

        <!-- Dark heading banner -->
        <tr>
          <td style="padding:0 40px 0 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="background-color:#020202;padding:18px 24px;margin-top:20px;border-radius:4px;">
                  <p style="margin:0;font-size:18px;font-weight:700;color:#ffffff;letter-spacing:0.3px;">'
        . esc_html($heading) .
        '</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>';
}

/**
 * Shared email footer: closes the outer wrapper table.
 *
 * @return string
 */
function my_theme_email_footer(): string
{
    $year = gmdate('Y');

    return '
        <!-- Footer -->
        <tr>
          <td style="background-color:#020202;padding:28px 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>
                  <p style="margin:0 0 4px 0;font-size:14px;font-weight:700;color:#ffffff;">Goliath Pallet Racking Repair Ltd</p>
                  <p style="margin:0 0 4px 0;font-size:13px;color:#cccccc;">
                    <a href="tel:01218056747" style="color:#ff5c00;text-decoration:none;">0121 805 6747</a>
                    &nbsp;&middot;&nbsp;
                    <a href="mailto:sales@goliathrepair.co.uk" style="color:#ff5c00;text-decoration:none;">sales@goliathrepair.co.uk</a>
                  </p>
                  <p style="margin:0 0 16px 0;font-size:12px;color:#999999;">Calibre Industrial Park, Unit 2, Laches Close, Four Ashes, Staffordshire, WV10 7DZ</p>
                  <p style="margin:0;font-size:11px;color:#666666;">&copy; ' . esc_html($year) . ' Goliath Pallet Racking Repair Ltd. All rights reserved.</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
</body>
</html>';
}

/**
 * Builds the branded HTML notification email sent to the business when a
 * contact form is submitted.
 *
 * @param array{
 *   name: string,
 *   company: string,
 *   email: string,
 *   phone: string,
 *   uprights: string,
 *   message: string
 * } $data Sanitised form field values.
 * @return string Full HTML email string.
 */
function my_theme_notification_email_html(array $data): string
{
    $name     = esc_html($data['name'] ?? '');
    $company  = esc_html($data['company'] ?? '');
    $email    = esc_html($data['email'] ?? '');
    $phone    = $data['phone'] !== '' ? esc_html($data['phone']) : 'Not provided';
    $uprights = $data['uprights'] !== '' ? esc_html($data['uprights']) : 'Not provided';
    $message  = $data['message'] !== '' ? nl2br(esc_html($data['message'])) : 'Not provided';

    $fields = [
        'Name'                      => $name,
        'Company'                   => $company,
        'Email'                     => '<a href="mailto:' . esc_attr($data['email'] ?? '') . '" style="color:#ff5c00;text-decoration:none;">' . $email . '</a>',
        'Phone'                     => $phone,
        'Number of Damaged Uprights' => $uprights,
        'Additional Information'    => $message,
    ];

    $rows = '';
    $shade = false;
    foreach ($fields as $label => $value) {
        $bg = $shade ? '#f9f9f9' : '#ffffff';
        $rows .= '
              <tr>
                <td style="padding:12px 16px;font-size:13px;font-weight:700;color:#020202;background-color:' . $bg . ';width:40%;border-bottom:1px solid #eeeeee;vertical-align:top;">'
            . esc_html($label) .
            '</td>
                <td style="padding:12px 16px;font-size:13px;color:#333333;background-color:' . $bg . ';border-bottom:1px solid #eeeeee;vertical-align:top;">'
            . $value .
            '</td>
              </tr>';
        $shade = !$shade;
    }

    $reply_email = esc_attr($data['email'] ?? '');
    $reply_name  = esc_attr($data['name'] ?? '');

    $heading = (string) get_option('my_theme_email_notif_heading', 'New Assessment Request');

    return my_theme_email_header($heading) . '

        <!-- Body -->
        <tr>
          <td style="padding:28px 40px 8px 40px;">
            <p style="margin:0 0 20px 0;font-size:14px;color:#555555;">
              A new assessment request has been submitted via the website. The details are below.
            </p>
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #eeeeee;border-radius:4px;overflow:hidden;">'
        . $rows . '
            </table>
          </td>
        </tr>

        <!-- Reply CTA -->
        <tr>
          <td align="center" style="padding:24px 40px 36px 40px;">
            <a href="mailto:' . $reply_email . '?subject=Re%3A%20Your%20Goliath%20Assessment%20Request&body=Dear%20' . rawurlencode($reply_name) . '%2C%0A%0A"
               style="display:inline-block;background-color:#ff5c00;color:#ffffff;font-size:14px;font-weight:700;text-decoration:none;padding:14px 32px;border-radius:4px;letter-spacing:0.3px;">
              Reply to ' . esc_html($data['name'] ?? '') . ' &rarr;
            </a>
          </td>
        </tr>'

        . my_theme_email_footer();
}

/**
 * Builds the branded HTML auto-reply confirmation email sent to the customer
 * after they submit the contact form.
 *
 * @param string $name The customer's first/full name (sanitised).
 * @return string Full HTML email string.
 */
/**
 * Returns the subject line for the customer auto-reply email.
 * Reads from wp_options so it can be edited in Goliath Content → Email Templates.
 */
function my_theme_autoreply_email_subject(): string
{
    return (string) get_option(
        'my_theme_email_reply_subject',
        'We\'ve received your assessment request — Goliath Pallet Racking Repair'
    );
}

function my_theme_autoreply_email_html(string $name): string
{
    $name = esc_html($name);

    $intro   = (string) get_option(
        'my_theme_email_reply_intro',
        'Thank you for reaching out to us. We\'ve received your assessment request and one of our team will be in touch with you within 1 working day.'
    );
    $bullet1 = (string) get_option('my_theme_email_reply_bullet1', 'Free, no-obligation evaluation of your racking system');
    $bullet2 = (string) get_option('my_theme_email_reply_bullet2', 'Response within 1 working day');
    $bullet3 = (string) get_option('my_theme_email_reply_bullet3', 'Transparent, honest pricing with no hidden fees');
    $quote   = (string) get_option(
        'my_theme_email_reply_quote',
        'We offer more than repairs. We deliver confidence, safety, and the certainty that your warehouse is protected for life.'
    );
    $cta     = (string) get_option('my_theme_email_reply_cta', 'Visit Our Website');

    $bullets = array_filter([$bullet1, $bullet2, $bullet3]);

    $bullet_html = '';
    foreach ($bullets as $bullet) {
        $bullet_html .= '
                <tr>
                  <td style="padding:6px 0;" valign="top">
                    <table role="presentation" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="font-size:16px;color:#ff5c00;padding-right:10px;line-height:1;" valign="top">&#9679;</td>
                        <td style="font-size:14px;color:#333333;line-height:1.6;" valign="top">' . esc_html($bullet) . '</td>
                      </tr>
                    </table>
                  </td>
                </tr>';
    }

    return my_theme_email_header('Thank you, ' . $name . '!') . '

        <!-- Body -->
        <tr>
          <td style="padding:28px 40px 8px 40px;">
            <p style="margin:0 0 16px 0;font-size:15px;color:#333333;line-height:1.7;">'
        . esc_html($intro) . '
            </p>
            <p style="margin:0 0 20px 0;font-size:14px;color:#555555;line-height:1.7;">
              Here is what you can expect next:
            </p>
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">'
        . $bullet_html . '
            </table>
          </td>
        </tr>

        <!-- Divider -->
        <tr>
          <td style="padding:8px 40px;">
            <hr style="border:none;border-top:1px solid #eeeeee;margin:0;">
          </td>
        </tr>

        <!-- Reassurance note -->
        <tr>
          <td style="padding:16px 40px 8px 40px;">
            <p style="margin:0;font-size:13px;color:#777777;line-height:1.7;font-style:italic;">
              &ldquo;' . esc_html($quote) . '&rdquo;
            </p>
          </td>
        </tr>

        <!-- Visit website CTA -->
        <tr>
          <td align="center" style="padding:24px 40px 36px 40px;">
            <a href="https://goliathrepair.co.uk"
               style="display:inline-block;background-color:#ff5c00;color:#ffffff;font-size:14px;font-weight:700;text-decoration:none;padding:14px 32px;border-radius:4px;letter-spacing:0.3px;">
              ' . esc_html($cta) . ' &rarr;
            </a>
          </td>
        </tr>'

        . my_theme_email_footer();
}
