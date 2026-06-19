<?php
/**
 * Video Related block – auto-queries other Video CPT posts excluding the current.
 *
 * @var array $attributes
 */

defined('ABSPATH') || exit;

$current_id = get_the_ID();

$related_query = new WP_Query([
    'post_type'      => 'video',
    'posts_per_page' => 3,
    'post__not_in'   => [$current_id],
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

if (! $related_query->have_posts()) {
    wp_reset_postdata();
    return;
}

$related_count = $related_query->post_count;
$grid_class = $related_count >= 3
    ? 'md:grid-cols-2 lg:grid-cols-3'
    : 'md:grid-cols-2 lg:grid-cols-2 lg:max-w-[900px] lg:mx-auto';
?>
<section class="w-full bg-[#fafafa]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[60px] lg:pb-[60px]">
        <div class="grid grid-cols-1 gap-[26px] <?php echo esc_attr($grid_class); ?>">
            <?php
            $video_library = function_exists('my_theme_get_video_library') ? my_theme_get_video_library() : [];
            while ($related_query->have_posts()) : $related_query->the_post();
                $rel_slug = get_post_field('post_name', get_the_ID());
                $rel_file = $video_library[$rel_slug]['file'] ?? '';
                $has_thumb = has_post_thumbnail();
                $has_lib_thumb = !$has_thumb && $rel_file !== '' && function_exists('my_theme_video_thumbnail_is_readable') && my_theme_video_thumbnail_is_readable($rel_file);
            ?>
            <a href="<?php the_permalink(); ?>" class="group border-t border-[#faf5ff] py-[10px]">
                <div class="relative flex h-[206px] w-full overflow-hidden bg-black">
                    <?php if ($has_thumb) : ?>
                    <img
                        src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')); ?>"
                        alt="<?php echo esc_attr(get_the_title()); ?>"
                        class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                        loading="lazy"
                        decoding="async"
                        width="640"
                        height="360"
                    >
                    <?php elseif ($has_lib_thumb) : ?>
                    <img
                        src="<?php echo esc_url(my_theme_get_video_thumbnail_uri($rel_file)); ?>"
                        alt="<?php echo esc_attr(get_the_title()); ?>"
                        class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                        loading="lazy"
                        decoding="async"
                        width="640"
                        height="360"
                    >
                    <?php else : ?>
                    <video
                        class="h-full w-full object-cover opacity-90 transition-opacity group-hover:opacity-100"
                        src="<?php echo $rel_file !== '' ? esc_url(get_theme_file_uri('assets/videos/' . $rel_file)) : ''; ?>"
                        muted
                        playsinline
                        preload="metadata"
                        aria-hidden="true"
                    ></video>
                    <?php endif; ?>
                </div>
                <div class="mt-[10px]">
                    <p class="font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]"><?php the_title(); ?></p>
                    <p class="font-montserrat text-[12px] font-medium leading-[23px] text-[#364153]"><?php echo esc_html(get_the_excerpt()); ?></p>
                </div>
            </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); ?>
