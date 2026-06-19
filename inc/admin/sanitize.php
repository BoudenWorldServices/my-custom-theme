<?php
/**
 * Goliath Content Editor — sanitisation and validation.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Sanitise a single field value based on its declared type.
 *
 * @param mixed  $raw  Raw input (already wp_unslash'd).
 * @param string $type One of: text, textarea, html, url, email, number, float, image, repeater_faq, repeater_video, repeater_team, repeater_case_study, repeater_generic
 * @return mixed
 */
function my_theme_admin_sanitise_field($raw, string $type)
{
    switch ($type) {
        case 'text':
            return sanitize_text_field((string) ($raw ?? ''));

        case 'textarea':
            return sanitize_textarea_field((string) ($raw ?? ''));

        case 'html':
            return wp_kses_post((string) ($raw ?? ''));

        case 'url':
            return esc_url_raw((string) ($raw ?? ''));

        case 'email':
            $email = sanitize_email((string) ($raw ?? ''));
            return is_email($email) ? $email : '';

        case 'number':
            return (string) intval($raw ?? 0);

        case 'float':
            return (string) floatval($raw ?? 0);

        case 'image':
            $val = (string) ($raw ?? '');
            if (is_numeric($val) && (int) $val > 0) {
                return (string) absint($val);
            }
            return esc_url_raw($val);

        case 'repeater_faq':
            return my_theme_admin_sanitise_faq_repeater($raw);

        case 'repeater_video':
            return my_theme_admin_sanitise_video_repeater($raw);

        case 'repeater_case_study':
            return my_theme_admin_sanitise_case_study_repeater($raw);

        case 'repeater_team':
            $team = my_theme_admin_sanitise_generic_repeater($raw, [
                'name'           => 'text',
                'role'           => 'text',
                'qualifications' => 'text',
                'bio'            => 'textarea',
                'photo'          => 'image',
            ]);
            return array_values(array_filter($team, fn($row) => ($row['name'] ?? '') !== ''));

        case 'repeater_link':
            $links = my_theme_admin_sanitise_generic_repeater($raw, [
                'label' => 'text',
                'url'   => 'text',
                'logo'  => 'image',
            ]);
            return array_values(array_filter($links, fn($row) => ($row['label'] ?? '') !== ''));

        case 'repeater_generic':
            return my_theme_admin_sanitise_generic_repeater($raw, [
                'title'       => 'text',
                'description' => 'textarea',
            ]);

        default:
            return sanitize_text_field((string) ($raw ?? ''));
    }
}

/**
 * Sanitise FAQ repeater items.
 *
 * @param mixed $raw
 * @return array<int, array{question: string, paragraphs: string[]}>
 */
function my_theme_admin_sanitise_faq_repeater($raw): array
{
    if (! is_array($raw)) {
        return [];
    }

    $clean = [];
    foreach ($raw as $item) {
        if (! is_array($item)) {
            continue;
        }
        $question = sanitize_text_field((string) ($item['question'] ?? ''));
        if ($question === '') {
            continue;
        }

        $paragraphs_raw = $item['paragraphs'] ?? '';
        if (is_string($paragraphs_raw)) {
            $paragraphs = array_filter(
                array_map('trim', explode("\n\n", $paragraphs_raw)),
                fn($p) => $p !== ''
            );
            $paragraphs = array_map('sanitize_textarea_field', array_values($paragraphs));
        } elseif (is_array($paragraphs_raw)) {
            $paragraphs = array_map('sanitize_textarea_field', $paragraphs_raw);
        } else {
            $paragraphs = [];
        }

        $clean[] = [
            'question'   => $question,
            'paragraphs' => $paragraphs,
        ];
    }

    return $clean;
}

/**
 * Sanitise video library repeater items.
 *
 * @param mixed $raw
 * @return array<string, array{file: string, title: string, excerpt: string, body: string, section: string, in_carousel: bool}>
 */
function my_theme_admin_sanitise_video_repeater($raw): array
{
    if (! is_array($raw)) {
        return [];
    }

    $clean = [];
    foreach ($raw as $item) {
        if (! is_array($item)) {
            continue;
        }
        $slug = sanitize_title((string) ($item['slug'] ?? ''));
        $title = sanitize_text_field((string) ($item['title'] ?? ''));
        if ($slug === '' || $title === '') {
            continue;
        }

        $file_val = (string) ($item['file'] ?? '');
        if (str_starts_with($file_val, 'http://') || str_starts_with($file_val, 'https://') || str_starts_with($file_val, '/')) {
            $file_val = esc_url_raw($file_val);
        } else {
            $file_val = sanitize_file_name($file_val);
        }

        $thumb_val = (string) ($item['thumbnail'] ?? '');
        if (is_numeric($thumb_val) && (int) $thumb_val > 0) {
            $thumb_val = (string) absint($thumb_val);
        } elseif ($thumb_val !== '') {
            $thumb_val = esc_url_raw($thumb_val);
        }

        $clean[$slug] = [
            'file'        => $file_val,
            'title'       => $title,
            'excerpt'     => sanitize_textarea_field((string) ($item['excerpt'] ?? '')),
            'body'        => sanitize_textarea_field((string) ($item['body'] ?? '')),
            'section'     => sanitize_text_field((string) ($item['section'] ?? 'installation')),
            'in_carousel' => ! empty($item['in_carousel']),
            'thumbnail'   => $thumb_val,
        ];
    }

    return $clean;
}

/**
 * Sanitise case study library repeater items.
 *
 * Keyed by slug (same pattern as the video repeater).
 *
 * @param mixed $raw
 * @return array<string, array<string, string>>
 */
function my_theme_admin_sanitise_case_study_repeater($raw): array
{
    if (! is_array($raw)) {
        return [];
    }

    $clean = [];
    foreach ($raw as $item) {
        if (! is_array($item)) {
            continue;
        }

        $slug = sanitize_title((string) ($item['slug'] ?? ''));
        $title = sanitize_text_field((string) ($item['title'] ?? ''));
        if ($slug === '' || $title === '') {
            continue;
        }

        $image_val = (string) ($item['image'] ?? '');
        if (is_numeric($image_val) && (int) $image_val > 0) {
            $image_val = (string) absint($image_val);
        } elseif ($image_val !== '') {
            $image_val = esc_url_raw($image_val);
        }

        $results_image_val = (string) ($item['results_image'] ?? '');
        if (is_numeric($results_image_val) && (int) $results_image_val > 0) {
            $results_image_val = (string) absint($results_image_val);
        } elseif ($results_image_val !== '') {
            $results_image_val = esc_url_raw($results_image_val);
        }

        $video_val = (string) ($item['video'] ?? '');
        if (
            str_starts_with($video_val, 'http://') ||
            str_starts_with($video_val, 'https://') ||
            str_starts_with($video_val, '/')
        ) {
            $video_val = esc_url_raw($video_val);
        } else {
            $video_val = sanitize_file_name($video_val);
        }

        $clean[$slug] = [
            'client'            => sanitize_text_field((string) ($item['client'] ?? '')),
            'title'             => $title,
            'image'             => $image_val,
            'challenge'         => sanitize_textarea_field((string) ($item['challenge'] ?? '')),
            'solution'          => sanitize_textarea_field((string) ($item['solution'] ?? '')),
            'metric1_value'     => sanitize_text_field((string) ($item['metric1_value'] ?? '')),
            'metric1_label'     => sanitize_text_field((string) ($item['metric1_label'] ?? '')),
            'metric2_value'     => sanitize_text_field((string) ($item['metric2_value'] ?? '')),
            'metric2_label'     => sanitize_text_field((string) ($item['metric2_label'] ?? '')),
            'metric3_value'     => sanitize_text_field((string) ($item['metric3_value'] ?? '')),
            'metric3_label'     => sanitize_text_field((string) ($item['metric3_label'] ?? '')),
            'hero_intro'        => sanitize_textarea_field((string) ($item['hero_intro'] ?? '')),
            'problem_text'      => sanitize_textarea_field((string) ($item['problem_text'] ?? '')),
            'problem_callout'   => sanitize_text_field((string) ($item['problem_callout'] ?? '')),
            'tried_text'        => sanitize_textarea_field((string) ($item['tried_text'] ?? '')),
            'tried_callout'     => sanitize_text_field((string) ($item['tried_callout'] ?? '')),
            'video'             => $video_val,
            'solution_text'     => sanitize_textarea_field((string) ($item['solution_text'] ?? '')),
            'solution_callout'  => sanitize_textarea_field((string) ($item['solution_callout'] ?? '')),
            'results_image'     => $results_image_val,
            'results_intro'     => sanitize_textarea_field((string) ($item['results_intro'] ?? '')),
            'result1_title'     => sanitize_text_field((string) ($item['result1_title'] ?? '')),
            'result1_text'      => sanitize_text_field((string) ($item['result1_text'] ?? '')),
            'result2_title'     => sanitize_text_field((string) ($item['result2_title'] ?? '')),
            'result2_text'      => sanitize_text_field((string) ($item['result2_text'] ?? '')),
            'result3_title'     => sanitize_text_field((string) ($item['result3_title'] ?? '')),
            'result3_text'      => sanitize_text_field((string) ($item['result3_text'] ?? '')),
            'result4_title'     => sanitize_text_field((string) ($item['result4_title'] ?? '')),
            'result4_text'      => sanitize_text_field((string) ($item['result4_text'] ?? '')),
            'warranty_text'     => sanitize_textarea_field((string) ($item['warranty_text'] ?? '')),
            'testimonial_quote' => sanitize_textarea_field((string) ($item['testimonial_quote'] ?? '')),
            'testimonial_attr'  => sanitize_text_field((string) ($item['testimonial_attr'] ?? '')),
            'seo_title'         => sanitize_text_field((string) ($item['seo_title'] ?? '')),
            'seo_desc'          => sanitize_textarea_field((string) ($item['seo_desc'] ?? '')),
        ];
    }

    return $clean;
}

/**
 * Sanitise a generic repeater where field types are provided.
 *
 * @param mixed                   $raw
 * @param array<string, string>   $field_types  field_name => sanitise_type
 * @return list<array<string, string>>
 */
function my_theme_admin_sanitise_generic_repeater($raw, array $field_types): array
{
    if (! is_array($raw)) {
        return [];
    }

    $clean = [];
    foreach ($raw as $item) {
        if (! is_array($item)) {
            continue;
        }
        $row = [];
        foreach ($field_types as $key => $type) {
            $row[$key] = my_theme_admin_sanitise_field($item[$key] ?? '', $type);
        }
        $clean[] = $row;
    }

    return $clean;
}
