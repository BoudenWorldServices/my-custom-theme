<?php
/**
 * Theme-hosted MP4 catalogue for the videos hub and detail routes.
 *
 * Reads from wp_options (Goliath Content Editor) with hardcoded defaults.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * All public videos under assets/videos/.
 *
 * @return array<string, array{file: string, title: string, excerpt: string, body: string, section: string, in_carousel: bool}>
 */
function my_theme_get_video_library(): array
{
    $saved = get_option('my_theme_video_library');
    if (is_array($saved) && ! empty($saved)) {
        return $saved;
    }

    return [
        'carousel-video1' => [
            'file'        => 'carousel-video1.mp4',
            'title'       => 'Goliath™ upright repair installation in action',
            'excerpt'     => 'A practical demonstration of the Goliath™ racking repair system being installed on a damaged warehouse upright, showing step-by-step fitting, secure anchoring, and how it restores strength whilst minimising operational disruption.',
            'body'        => 'This clip shows how quickly the Goliath™ repair can be installed with minimal disruption. Use it to brief your team on what to expect on the day.',
            'section'     => 'installation',
            'in_carousel' => true,
        ],
        'carousel-video2' => [
            'file'        => 'carousel-video2.mp4',
            'title'       => 'On-site installation overview',
            'excerpt'     => 'A second angle on Goliath™ being deployed in the warehouse, with emphasis on access around the bay and the finished repair ready for loading.',
            'body'        => 'Further on-site footage emphasising speed of installation, access around the bay, and the finished repair ready for loading.',
            'section'     => 'installation',
            'in_carousel' => true,
        ],
        'explanation-video' => [
            'file'        => 'explanation-video.mp4',
            'title'       => 'Goliath™ racking repair system for warehouse uprights',
            'excerpt'     => 'An animated product video showing damaged warehouse racking uprights and how the Goliath™ repair solution strengthens them with 6mm structural steel, improves safety, and reduces downtime.',
            'body'        => 'This walkthrough explains how the Goliath™ racking repair kit restores upright strength, how it works with your existing frames, and why it is designed as a permanent alternative to repeated upright replacement.',
            'section'     => 'installation',
            'in_carousel' => false,
        ],
        'goliath-demo' => [
            'file'        => 'goliath-demo.mp4',
            'title'       => 'Goliath™ product demo',
            'excerpt'     => 'See what is in the kit, how it addresses typical damage patterns, and how the repaired upright is ready for service after installation.',
            'body'        => 'See what is in the kit, how it addresses typical damage patterns, and how the repaired upright is ready for service after installation.',
            'section'     => 'installation',
            'in_carousel' => false,
        ],
        'corporate-crash-test' => [
            'file'        => 'corporate-crash-test.mp4',
            'title'       => 'Goliath™ crash test: with vs without protection',
            'excerpt'     => 'A side-by-side crash test comparing warehouse racking uprights with and without the Goliath™ repair system, demonstrating how it absorbs impact from forklift collisions and significantly reduces structural damage.',
            'body'        => 'Supporting material for compliance and engineering discussions: how Goliath™ behaves under severe loading and why it is tested to recognised standards.',
            'section'     => 'installation',
            'in_carousel' => false,
        ],
    ];
}

/**
 * Check whether a file value is a full URL (media library or external).
 */
function my_theme_is_video_url(string $file_value): bool
{
    return str_starts_with($file_value, 'http://') || str_starts_with($file_value, 'https://') || str_starts_with($file_value, '/');
}

function my_theme_get_video_file_uri(string $filename): string
{
    if (my_theme_is_video_url($filename)) {
        return $filename;
    }
    return get_theme_file_uri('assets/videos/' . ltrim($filename, '/'));
}

function my_theme_get_video_file_path(string $filename): string
{
    if (my_theme_is_video_url($filename)) {
        return '';
    }
    return get_theme_file_path('assets/videos/' . ltrim($filename, '/'));
}

function my_theme_video_file_is_readable(string $filename): bool
{
    if (my_theme_is_video_url($filename)) {
        return true;
    }
    $path = my_theme_get_video_file_path($filename);

    return $path !== '' && is_readable($path);
}

function my_theme_get_video_thumbnail_filename(string $video_filename): string
{
    $base = pathinfo($video_filename, PATHINFO_FILENAME);

    return $base . '.jpg';
}

/**
 * Get thumbnail URI for a video, checking the library for a custom thumbnail first.
 */
function my_theme_get_video_thumbnail_uri(string $video_filename): string
{
    $library = my_theme_get_video_library();
    foreach ($library as $row) {
        if (($row['file'] ?? '') === $video_filename && ! empty($row['thumbnail'])) {
            $thumb = $row['thumbnail'];
            if (is_numeric($thumb) && (int) $thumb > 0) {
                $url = wp_get_attachment_image_url((int) $thumb, 'medium');
                if ($url) {
                    return $url;
                }
            } elseif (is_string($thumb) && $thumb !== '') {
                return $thumb;
            }
        }
    }
    return get_theme_file_uri('assets/images/video-thumbnails/' . my_theme_get_video_thumbnail_filename($video_filename));
}

function my_theme_get_video_thumbnail_path(string $video_filename): string
{
    return get_theme_file_path('assets/images/video-thumbnails/' . my_theme_get_video_thumbnail_filename($video_filename));
}

function my_theme_video_thumbnail_is_readable(string $video_filename): bool
{
    $library = my_theme_get_video_library();
    foreach ($library as $row) {
        if (($row['file'] ?? '') === $video_filename && ! empty($row['thumbnail'])) {
            return true;
        }
    }
    $path = my_theme_get_video_thumbnail_path($video_filename);

    return $path !== '' && is_readable($path);
}

/**
 * @return list<array{slug: string, file: string, title: string, excerpt: string, body: string, section: string, in_carousel: bool}>
 */
function my_theme_get_video_carousel_items(): array
{
    $out = [];
    foreach (my_theme_get_video_library() as $slug => $row) {
        if (! empty($row['in_carousel'])) {
            $item         = $row;
            $item['slug'] = $slug;
            $out[]        = $item;
        }
    }

    return $out;
}

/**
 * @return array<string, array{file: string, title: string, excerpt: string, body: string, section: string, in_carousel: bool}>
 */
function my_theme_get_videos_by_section(string $section): array
{
    $out = [];
    foreach (my_theme_get_video_library() as $slug => $row) {
        if (($row['section'] ?? 'installation') === $section) {
            $out[ $slug ] = $row;
        }
    }

    return $out;
}

/**
 * @return list<string>
 */
function my_theme_get_videos_hub_slug_order(): array
{
    $saved = get_option('my_theme_videos_hub_order', '');
    if (is_string($saved) && $saved !== '') {
        return array_filter(array_map('trim', explode(',', $saved)));
    }

    return [
        'explanation-video',
        'carousel-video1',
        'corporate-crash-test',
    ];
}

/**
 * @return array<string, array{file: string, title: string, excerpt: string, body: string, section: string, in_carousel: bool}>
 */
function my_theme_get_videos_hub_videos(): array
{
    $library = my_theme_get_video_library();
    $ordered = [];
    foreach (my_theme_get_videos_hub_slug_order() as $slug) {
        if (! isset($library[ $slug ])) {
            continue;
        }
        $row = $library[ $slug ];
        if (! my_theme_video_file_is_readable($row['file'])) {
            continue;
        }
        $ordered[ $slug ] = $row;
    }

    return $ordered;
}

/**
 * @return list<array{slug: string, file: string, title: string, excerpt: string, body: string, section: string, in_carousel: bool}>
 */
function my_theme_get_videos_hub_related(string $current_slug): array
{
    $out = [];
    foreach (my_theme_get_videos_hub_videos() as $slug => $row) {
        if ($slug === $current_slug) {
            continue;
        }
        $item         = $row;
        $item['slug'] = $slug;
        $out[]        = $item;
    }

    return $out;
}

/**
 * @return list<array{slug: string, file: string, title: string, excerpt: string, body: string, section: string, in_carousel: bool}>
 */
function my_theme_get_related_videos(string $current_slug, int $limit = 3): array
{
    $related = my_theme_get_videos_hub_related($current_slug);
    if ($limit > 0 && count($related) > $limit) {
        return array_slice($related, 0, $limit);
    }

    return $related;
}
