<?php
/**
 * Goliath Content Editor — FAQ admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Register field definitions for the FAQ page.
 */
function my_theme_admin_faq_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-faq') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_faq_items' => 'repeater_faq',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_faq_fields', 10, 2);

/**
 * Render the FAQ admin page.
 */
function my_theme_admin_render_faq(): void
{
    my_theme_admin_page_open('FAQ Items', 'goliath-faq');

    my_theme_admin_section_open('Questions & Answers', 'These appear on the FAQ page and in the FAQPage schema markup. Separate paragraphs with a blank line.');

    $items = my_theme_get_faq_items();
    $items = my_theme_admin_repeater_open('my_theme_faq_items', 'FAQ Items', ['Question', 'Answer'], $items);

    foreach ($items as $i => $item) {
        $paragraphs_text = implode("\n\n", $item['paragraphs'] ?? []);
        my_theme_admin_repeater_row('my_theme_faq_items', $i, [
            'question' => [
                'label' => 'Question',
                'type'  => 'text',
                'value' => $item['question'] ?? '',
            ],
            'paragraphs' => [
                'label' => 'Answer (separate paragraphs with a blank line)',
                'type'  => 'textarea',
                'value' => $paragraphs_text,
            ],
        ]);
    }

    my_theme_admin_repeater_close('my_theme_faq_items', [
        'question'   => ['label' => 'Question', 'type' => 'text'],
        'paragraphs' => ['label' => 'Answer (separate paragraphs with a blank line)', 'type' => 'textarea'],
    ]);

    my_theme_admin_section_close();
    my_theme_admin_page_close();
}
