<?php
/**
 * Goliath Content Editor — reusable field renderers.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/* ------------------------------------------------------------------ */
/*  Page wrapper                                                      */
/* ------------------------------------------------------------------ */

/**
 * Open the settings page wrapper, form, and nonce.
 */
function my_theme_admin_page_open(string $title, string $page_slug): void
{
    echo '<div class="wrap goliath-admin-wrap">';
    echo '<h1 class="goliath-admin-title">' . esc_html($title) . '</h1>';

    settings_errors('goliath_content');

    echo '<form method="post" action="" class="goliath-admin-form">';
    wp_nonce_field('goliath_admin_save', 'goliath_admin_nonce');
    echo '<input type="hidden" name="goliath_page" value="' . esc_attr($page_slug) . '">';
}

/**
 * Submit button and close the form + wrapper.
 */
function my_theme_admin_page_close(): void
{
    submit_button('Save Changes', 'primary goliath-save-btn', 'submit', true);
    echo '</form></div>';
}

/* ------------------------------------------------------------------ */
/*  Section wrapper                                                   */
/* ------------------------------------------------------------------ */

function my_theme_admin_section_open(string $heading, string $description = ''): void
{
    echo '<div class="goliath-section">';
    echo '<h2 class="goliath-section-heading">' . esc_html($heading) . '</h2>';
    if ($description !== '') {
        echo '<p class="goliath-section-desc">' . esc_html($description) . '</p>';
    }
    echo '<table class="form-table goliath-fields" role="presentation"><tbody>';
}

function my_theme_admin_section_close(): void
{
    echo '</tbody></table></div>';
}

/* ------------------------------------------------------------------ */
/*  Field renderers                                                   */
/* ------------------------------------------------------------------ */

/**
 * @param string $option_key  The wp_option key.
 * @param string $label
 * @param string $default     Hardcoded fallback.
 * @param string $placeholder
 */
function my_theme_admin_text_field(string $option_key, string $label, string $default = '', string $placeholder = ''): void
{
    $value = get_option($option_key, $default);
    echo '<tr>';
    echo '<th scope="row"><label for="goliath_' . esc_attr($option_key) . '">' . esc_html($label) . '</label></th>';
    echo '<td>';
    echo '<input type="text" id="goliath_' . esc_attr($option_key) . '" name="goliath_fields[' . esc_attr($option_key) . ']" value="' . esc_attr((string) $value) . '" class="large-text" placeholder="' . esc_attr($placeholder) . '">';
    echo '</td></tr>';
}

/**
 * Textarea field.
 */
function my_theme_admin_textarea_field(string $option_key, string $label, string $default = '', int $rows = 4): void
{
    $value = get_option($option_key, $default);
    echo '<tr>';
    echo '<th scope="row"><label for="goliath_' . esc_attr($option_key) . '">' . esc_html($label) . '</label></th>';
    echo '<td>';
    echo '<textarea id="goliath_' . esc_attr($option_key) . '" name="goliath_fields[' . esc_attr($option_key) . ']" rows="' . (int) $rows . '" class="large-text">' . esc_textarea((string) $value) . '</textarea>';
    echo '</td></tr>';
}

/**
 * Rich text (wp_editor) field.
 */
function my_theme_admin_wysiwyg_field(string $option_key, string $label, string $default = ''): void
{
    $value = get_option($option_key, $default);
    echo '<tr>';
    echo '<th scope="row"><label>' . esc_html($label) . '</label></th>';
    echo '<td>';
    wp_editor((string) $value, 'goliath_' . sanitize_key($option_key), [
        'textarea_name' => 'goliath_fields[' . $option_key . ']',
        'textarea_rows' => 8,
        'media_buttons' => true,
        'teeny'         => false,
        'quicktags'     => true,
    ]);
    echo '</td></tr>';
}

/**
 * Image picker using WP Media Library.
 */
function my_theme_admin_image_field(string $option_key, string $label, string $default = ''): void
{
    $value = get_option($option_key, $default);
    $preview_url = '';

    if (is_numeric($value) && (int) $value > 0) {
        $preview_url = wp_get_attachment_image_url((int) $value, 'medium') ?: '';
    } elseif (is_string($value) && $value !== '') {
        $preview_url = $value;
    }

    echo '<tr>';
    echo '<th scope="row"><label>' . esc_html($label) . '</label></th>';
    echo '<td>';
    echo '<div class="goliath-image-field" data-field="' . esc_attr($option_key) . '">';
    echo '<input type="hidden" name="goliath_fields[' . esc_attr($option_key) . ']" value="' . esc_attr((string) $value) . '" class="goliath-image-value">';
    echo '<div class="goliath-image-preview"' . ($preview_url === '' ? ' style="display:none"' : '') . '>';
    echo '<img src="' . esc_url($preview_url) . '" alt="" style="max-width:300px;max-height:180px;">';
    echo '</div>';
    echo '<div class="goliath-image-actions">';
    echo '<button type="button" class="button goliath-image-upload">Choose Image</button> ';
    echo '<button type="button" class="button goliath-image-remove"' . ($preview_url === '' ? ' style="display:none"' : '') . '>Remove</button>';
    echo '</div>';
    echo '</div>';
    echo '</td></tr>';
}

/**
 * Video picker using WP Media Library.
 */
function my_theme_admin_video_field(string $option_key, string $label, string $default = ''): void
{
    $value = get_option($option_key, $default);
    $preview_url = '';
    $filename = '';

    if (is_numeric($value) && (int) $value > 0) {
        $preview_url = wp_get_attachment_url((int) $value) ?: '';
        $filename = basename($preview_url);
    } elseif (is_string($value) && $value !== '') {
        $preview_url = $value;
        $filename = basename($value);
    }

    echo '<tr>';
    echo '<th scope="row"><label>' . esc_html($label) . '</label></th>';
    echo '<td>';
    echo '<div class="goliath-video-field" data-field="' . esc_attr($option_key) . '">';
    echo '<input type="hidden" name="goliath_fields[' . esc_attr($option_key) . ']" value="' . esc_attr((string) $value) . '" class="goliath-video-value">';
    echo '<div class="goliath-video-preview"' . ($preview_url === '' ? ' style="display:none"' : '') . '>';
    echo '<span class="goliath-video-filename dashicons-before dashicons-video-alt3"> ' . esc_html($filename) . '</span>';
    echo '</div>';
    echo '<div class="goliath-video-actions">';
    echo '<button type="button" class="button goliath-video-upload">Choose Video</button> ';
    echo '<button type="button" class="button goliath-video-remove"' . ($preview_url === '' ? ' style="display:none"' : '') . '>Remove</button>';
    echo '</div>';
    echo '</div>';
    echo '</td></tr>';
}

/**
 * URL input.
 */
function my_theme_admin_url_field(string $option_key, string $label, string $default = ''): void
{
    $value = get_option($option_key, $default);
    echo '<tr>';
    echo '<th scope="row"><label for="goliath_' . esc_attr($option_key) . '">' . esc_html($label) . '</label></th>';
    echo '<td>';
    echo '<input type="url" id="goliath_' . esc_attr($option_key) . '" name="goliath_fields[' . esc_attr($option_key) . ']" value="' . esc_attr((string) $value) . '" class="large-text" placeholder="https://">';
    echo '</td></tr>';
}

/**
 * Number input.
 */
function my_theme_admin_number_field(string $option_key, string $label, string $default = '', string $step = '1'): void
{
    $value = get_option($option_key, $default);
    echo '<tr>';
    echo '<th scope="row"><label for="goliath_' . esc_attr($option_key) . '">' . esc_html($label) . '</label></th>';
    echo '<td>';
    echo '<input type="number" id="goliath_' . esc_attr($option_key) . '" name="goliath_fields[' . esc_attr($option_key) . ']" value="' . esc_attr((string) $value) . '" step="' . esc_attr($step) . '" class="small-text">';
    echo '</td></tr>';
}

/* ------------------------------------------------------------------ */
/*  Repeater helpers                                                  */
/* ------------------------------------------------------------------ */

/**
 * Start a repeater section.
 *
 * @param string   $option_key  The wp_option key that stores the array.
 * @param string   $label       Section label.
 * @param string[] $columns     Column headers for the repeater table.
 * @param array    $default     Default items array.
 */
function my_theme_admin_repeater_open(string $option_key, string $label, array $columns, array $default = []): array
{
    $items = get_option($option_key);
    if (! is_array($items) || empty($items)) {
        $items = $default;
    }

    echo '<tr>';
    echo '<th scope="row" colspan="2"><h3 class="goliath-repeater-label">' . esc_html($label) . '</h3></th>';
    echo '</tr>';
    echo '<tr><td colspan="2">';
    echo '<div class="goliath-repeater" data-option="' . esc_attr($option_key) . '">';
    echo '<div class="goliath-repeater-items">';

    return $items;
}

/**
 * Render a single repeater row with named sub-fields.
 *
 * @param string $option_key  Parent option key.
 * @param int    $index       Row index.
 * @param array  $fields      field_name => ['label' => string, 'type' => 'text'|'textarea'|'image', 'value' => string]
 */
function my_theme_admin_repeater_row(string $option_key, int $index, array $fields): void
{
    echo '<div class="goliath-repeater-row" data-index="' . $index . '">';
    echo '<div class="goliath-repeater-row-header">';
    echo '<span class="goliath-repeater-row-number">#' . ($index + 1) . '</span>';
    echo '<button type="button" class="button-link goliath-repeater-remove" title="Remove item">Remove</button>';
    echo '</div>';

    foreach ($fields as $field_name => $field) {
        $name_attr = 'goliath_fields[' . esc_attr($option_key) . '][' . $index . '][' . esc_attr($field_name) . ']';
        $id_attr = 'goliath_' . esc_attr($option_key) . '_' . $index . '_' . esc_attr($field_name);
        $val = $field['value'] ?? '';

        echo '<div class="goliath-repeater-field">';
        echo '<label for="' . $id_attr . '">' . esc_html($field['label']) . '</label>';

        switch ($field['type'] ?? 'text') {
            case 'textarea':
                echo '<textarea id="' . $id_attr . '" name="' . $name_attr . '" rows="3" class="large-text">' . esc_textarea($val) . '</textarea>';
                break;
            case 'image':
                $preview = '';
                if (is_numeric($val) && (int) $val > 0) {
                    $preview = wp_get_attachment_image_url((int) $val, 'thumbnail') ?: '';
                } elseif ($val !== '') {
                    $preview = $val;
                }
                echo '<div class="goliath-image-field" data-field="' . esc_attr($option_key . '_' . $index . '_' . $field_name) . '">';
                echo '<input type="hidden" name="' . $name_attr . '" value="' . esc_attr($val) . '" class="goliath-image-value">';
                echo '<div class="goliath-image-preview"' . ($preview === '' ? ' style="display:none"' : '') . '>';
                echo '<img src="' . esc_url($preview) . '" alt="" style="max-width:120px;max-height:80px;">';
                echo '</div>';
                echo '<button type="button" class="button goliath-image-upload">Choose Image</button> ';
                echo '<button type="button" class="button goliath-image-remove"' . ($preview === '' ? ' style="display:none"' : '') . '>Remove</button>';
                echo '</div>';
                break;
            case 'video':
                $vid_url = '';
                $vid_name = '';
                if ($val !== '') {
                    $vid_url = $val;
                    $vid_name = basename($val);
                }
                echo '<div class="goliath-video-field" data-field="' . esc_attr($option_key . '_' . $index . '_' . $field_name) . '">';
                echo '<input type="hidden" name="' . $name_attr . '" value="' . esc_attr($val) . '" class="goliath-video-value">';
                echo '<div class="goliath-video-preview"' . ($vid_url === '' ? ' style="display:none"' : '') . '>';
                echo '<span class="goliath-video-filename dashicons-before dashicons-video-alt3"> ' . esc_html($vid_name) . '</span>';
                echo '</div>';
                echo '<div class="goliath-video-actions">';
                echo '<button type="button" class="button goliath-video-upload">Choose Video</button> ';
                echo '<button type="button" class="button goliath-video-remove"' . ($vid_url === '' ? ' style="display:none"' : '') . '>Remove</button>';
                echo '</div>';
                echo '</div>';
                break;
            default:
                echo '<input type="text" id="' . $id_attr . '" name="' . $name_attr . '" value="' . esc_attr($val) . '" class="large-text">';
                break;
        }
        echo '</div>';
    }

    echo '</div>';
}

/**
 * Close a repeater and add the "Add Item" button.
 */
function my_theme_admin_repeater_close(string $option_key, array $template_fields): void
{
    echo '</div>';

    $template_json = wp_json_encode($template_fields);
    echo '<button type="button" class="button goliath-repeater-add" data-option="' . esc_attr($option_key) . '" data-template="' . esc_attr($template_json) . '">+ Add Item</button>';
    echo '</div>';
    echo '</td></tr>';
}
