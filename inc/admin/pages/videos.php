<?php
/**
 * Goliath Content Editor — Video Library admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Register field definitions for the videos page.
 */
function my_theme_admin_videos_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-videos') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_video_library'    => 'repeater_video',
        'my_theme_videos_hub_order' => 'text',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_videos_fields', 10, 2);

/**
 * Resolve a video value to a displayable URL.
 * Supports media library URLs, theme-relative filenames, and full URLs.
 */
function my_theme_admin_resolve_video_url(string $val): string
{
    if ($val === '') {
        return '';
    }
    if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://') || str_starts_with($val, '/')) {
        return $val;
    }
    return get_theme_file_uri('assets/videos/' . $val);
}

/**
 * Render the video library admin page.
 */
function my_theme_admin_render_videos(): void
{
    my_theme_admin_page_open('Video Library', 'goliath-videos');

    my_theme_admin_section_open('Videos', 'Legacy video catalogue used as a fallback when no Video posts exist. The /videos/ page carousel reads published Video posts automatically — use Videos → Add New in the sidebar to manage them.');

    $library = my_theme_get_video_library();
    $items = [];
    foreach ($library as $slug => $row) {
        $file_val = $row['file'] ?? '';
        $file_url = my_theme_admin_resolve_video_url($file_val);
        $thumb_val = $row['thumbnail'] ?? '';
        $items[] = array_merge($row, [
            'slug'      => $slug,
            'file'      => $file_url,
            'thumbnail' => $thumb_val,
        ]);
    }

    $items = my_theme_admin_repeater_open('my_theme_video_library', 'Video Library', [], $items);

    foreach ($items as $i => $item) {
        my_theme_admin_repeater_row('my_theme_video_library', $i, [
            'slug' => [
                'label' => 'Slug (URL identifier)',
                'type'  => 'text',
                'value' => $item['slug'] ?? '',
            ],
            'file' => [
                'label' => 'Video file (MP4)',
                'type'  => 'video',
                'value' => $item['file'] ?? '',
            ],
            'thumbnail' => [
                'label' => 'Thumbnail image',
                'type'  => 'image',
                'value' => $item['thumbnail'] ?? '',
            ],
            'title' => [
                'label' => 'Title',
                'type'  => 'text',
                'value' => $item['title'] ?? '',
            ],
            'excerpt' => [
                'label' => 'Excerpt (shown on cards)',
                'type'  => 'textarea',
                'value' => $item['excerpt'] ?? '',
            ],
            'body' => [
                'label' => 'Full description (detail page)',
                'type'  => 'textarea',
                'value' => $item['body'] ?? '',
            ],
            'section' => [
                'label' => 'Section (installation / safety)',
                'type'  => 'text',
                'value' => $item['section'] ?? 'installation',
            ],
            'in_carousel' => [
                'label' => 'Show in homepage carousel? (1 = yes, 0 = no)',
                'type'  => 'text',
                'value' => ! empty($item['in_carousel']) ? '1' : '0',
            ],
        ]);
    }

    my_theme_admin_repeater_close('my_theme_video_library', [
        'slug'         => ['label' => 'Slug (URL identifier)', 'type' => 'text'],
        'file'         => ['label' => 'Video file (MP4)', 'type' => 'video'],
        'thumbnail'    => ['label' => 'Thumbnail image', 'type' => 'image'],
        'title'        => ['label' => 'Title', 'type' => 'text'],
        'excerpt'      => ['label' => 'Excerpt (shown on cards)', 'type' => 'textarea'],
        'body'         => ['label' => 'Full description (detail page)', 'type' => 'textarea'],
        'section'      => ['label' => 'Section (installation / safety)', 'type' => 'text'],
        'in_carousel'  => ['label' => 'Show in homepage carousel? (1/0)', 'type' => 'text'],
    ]);

    my_theme_admin_section_close();

    my_theme_admin_section_open('Videos Hub Display Order', 'Legacy setting for related videos on old video detail templates. The Videos page carousel uses published Video posts instead.');
    my_theme_admin_text_field('my_theme_videos_hub_order', 'Hub Slug Order', 'explanation-video,carousel-video1,corporate-crash-test');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
