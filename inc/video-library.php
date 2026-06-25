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
 * Published Video CPT posts keyed by slug, when any exist.
 *
 * @return array<string, array{file: string, title: string, excerpt: string, body: string, section: string, in_carousel: bool, post_id?: int, thumbnail_url?: string}>
 */
function my_theme_get_videos_from_posts(): array
{
    static $cache = null;
    if (is_array($cache)) {
        return $cache;
    }

    $cache = [];
    $posts = get_posts([
        'post_type'              => 'video',
        'post_status'            => 'publish',
        'posts_per_page'         => -1,
        'orderby'                => [
            'menu_order' => 'ASC',
            'date'       => 'ASC',
        ],
        'order'                  => 'ASC',
        'suppress_filters'       => false,
        'update_post_meta_cache' => true,
        'update_post_term_cache' => false,
    ]);

    foreach ($posts as $post) {
        if (! $post instanceof WP_Post) {
            continue;
        }
        $row = my_theme_video_post_to_row($post);
        if ($row === null) {
            continue;
        }
        $cache[ $post->post_name ] = $row;
    }

    return $cache;
}

/**
 * Read goliath/vid-player block attributes from a Video post.
 *
 * @return array<string, mixed>
 */
function my_theme_get_video_post_player_attrs(int $post_id): array
{
    $post = get_post($post_id);
    if (! $post instanceof WP_Post || ! has_blocks($post->post_content)) {
        return [];
    }

    foreach (parse_blocks($post->post_content) as $block) {
        if (($block['blockName'] ?? '') === 'goliath/vid-player') {
            return is_array($block['attrs'] ?? null) ? $block['attrs'] : [];
        }
    }

    return [];
}

/**
 * Resolve carousel section for a Video post.
 */
function my_theme_get_video_post_section(int $post_id): string
{
    $meta = get_post_meta($post_id, '_video_section', true);
    if (is_string($meta) && $meta !== '') {
        return sanitize_key($meta);
    }

    $slug    = (string) get_post_field('post_name', $post_id);
    $library = my_theme_get_video_library();

    return sanitize_key((string) ($library[ $slug ]['section'] ?? 'installation'));
}

/**
 * Resolve MP4 URL for a Video post (block, legacy library, or theme asset).
 */
function my_theme_get_video_post_file(int $post_id): string
{
    $attrs = my_theme_get_video_post_player_attrs($post_id);
    $url   = trim((string) ($attrs['videoUrl'] ?? ''));
    if ($url !== '') {
        return esc_url_raw($url);
    }

    $slug    = (string) get_post_field('post_name', $post_id);
    $library = my_theme_get_video_library();

    return (string) ($library[ $slug ]['file'] ?? '');
}

/**
 * Resolve card thumbnail URL for a Video post.
 */
function my_theme_get_video_post_thumbnail_url(int $post_id): string
{
    $thumb = get_the_post_thumbnail_url($post_id, 'medium_large');
    if (is_string($thumb) && $thumb !== '') {
        return $thumb;
    }

    $attrs = my_theme_get_video_post_player_attrs($post_id);
    $poster = trim((string) ($attrs['posterUrl'] ?? ''));
    if ($poster !== '') {
        return esc_url_raw($poster);
    }

    $file = my_theme_get_video_post_file($post_id);
    if ($file !== '' && my_theme_video_thumbnail_is_readable($file)) {
        return my_theme_get_video_thumbnail_uri($file);
    }

    return '';
}

/**
 * Map a Video CPT post to the carousel row shape.
 *
 * @return array{file: string, title: string, excerpt: string, body: string, section: string, in_carousel: bool, post_id: int, thumbnail_url: string}|null
 */
function my_theme_video_post_to_row(WP_Post $post): ?array
{
    $file = my_theme_get_video_post_file($post->ID);
    $thumb = my_theme_get_video_post_thumbnail_url($post->ID);

    if ($file === '' && $thumb === '') {
        return null;
    }

    $excerpt = trim($post->post_excerpt);
    if ($excerpt === '') {
        $attrs   = my_theme_get_video_post_player_attrs($post->ID);
        $excerpt = trim((string) ($attrs['description'] ?? ''));
    }
    if ($excerpt === '') {
        $library = my_theme_get_video_library();
        $excerpt = (string) ($library[ $post->post_name ]['excerpt'] ?? '');
    }

    $library = my_theme_get_video_library();
    $legacy  = $library[ $post->post_name ] ?? [];

    return [
        'file'          => $file,
        'title'         => $post->post_title,
        'excerpt'       => $excerpt,
        'body'          => (string) ($legacy['body'] ?? ''),
        'section'       => my_theme_get_video_post_section($post->ID),
        'in_carousel'   => ! empty($legacy['in_carousel']),
        'post_id'       => $post->ID,
        'thumbnail_url' => $thumb,
    ];
}

/**
 * Whether a carousel row has a thumbnail image to show.
 *
 * @param array{file?: string, thumbnail_url?: string} $row
 */
function my_theme_video_row_has_thumbnail(array $row): bool
{
    $thumb = trim((string) ($row['thumbnail_url'] ?? ''));
    if ($thumb !== '') {
        return true;
    }

    $file = trim((string) ($row['file'] ?? ''));

    return $file !== '' && my_theme_video_thumbnail_is_readable($file);
}

/**
 * Thumbnail URL for a carousel card row.
 *
 * @param array{file?: string, thumbnail_url?: string} $row
 */
function my_theme_video_row_thumbnail_uri(array $row): string
{
    $thumb = trim((string) ($row['thumbnail_url'] ?? ''));
    if ($thumb !== '') {
        return $thumb;
    }

    return my_theme_get_video_thumbnail_uri((string) ($row['file'] ?? ''));
}

/**
 * Whether a carousel row has enough media to display.
 *
 * @param array{file?: string, thumbnail_url?: string} $row
 */
function my_theme_video_row_is_displayable(array $row): bool
{
    $file = trim((string) ($row['file'] ?? ''));
    if ($file !== '' && my_theme_video_file_is_readable($file)) {
        return true;
    }

    return my_theme_video_row_has_thumbnail($row);
}

/**
 * Render one video carousel card.
 *
 * @param array{file: string, title: string, excerpt: string, thumbnail_url?: string} $row
 */
function my_theme_render_video_carousel_card(string $slug, array $row): void
{
    if (! empty($row['post_id'])) {
        $permalink = get_permalink((int) $row['post_id']);
    } else {
        $permalink = home_url('/videos/' . $slug . '/');
    }
    if (! is_string($permalink) || $permalink === '') {
        $permalink = home_url('/videos/' . $slug . '/');
    }
    ?>
    <a href="<?php echo esc_url($permalink); ?>" class="videos-carousel__slide group w-full flex-shrink-0 border-t border-[#faf5ff] px-[13px] py-[10px] md:w-1/2 lg:w-1/3">
        <div class="relative flex h-[206px] w-full overflow-hidden bg-black">
            <?php if (my_theme_video_row_has_thumbnail($row)) : ?>
                <img
                    src="<?php echo esc_url(my_theme_video_row_thumbnail_uri($row)); ?>"
                    alt="<?php echo esc_attr($row['title']); ?>"
                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                    loading="lazy"
                    decoding="async"
                    width="640"
                    height="360"
                >
            <?php elseif (($row['file'] ?? '') !== '') : ?>
                <video
                    class="h-full w-full object-cover opacity-90 transition-opacity group-hover:opacity-100"
                    src="<?php echo esc_url(my_theme_get_video_file_uri($row['file'])); ?>"
                    muted
                    playsinline
                    preload="metadata"
                    aria-hidden="true"
                ></video>
            <?php endif; ?>
        </div>
        <div class="mt-[10px]">
            <p class="font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]"><?php echo esc_html($row['title']); ?></p>
            <p class="mt-1 font-montserrat text-[12px] font-medium leading-[23px] text-[#364153]"><?php echo esc_html($row['excerpt']); ?></p>
        </div>
    </a>
    <?php
}

/**
 * Videos for a carousel section (installation / safety).
 *
 * Uses published Video CPT posts when available; falls back to the legacy option library.
 *
 * @return array<string, array{file: string, title: string, excerpt: string, body: string, section: string, in_carousel: bool, post_id?: int, thumbnail_url?: string}>
 */
function my_theme_get_videos_by_section(string $section): array
{
    $section = sanitize_key($section);
    if ($section === '') {
        $section = 'installation';
    }

    $from_posts = my_theme_get_videos_from_posts();
    if ($from_posts !== []) {
        $out = [];
        foreach ($from_posts as $slug => $row) {
            if (($row['section'] ?? 'installation') !== $section) {
                continue;
            }
            if (! my_theme_video_row_is_displayable($row)) {
                continue;
            }
            $out[ $slug ] = $row;
        }

        return $out;
    }

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
