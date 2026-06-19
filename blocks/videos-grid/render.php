<?php
/**
 * Block render: goliath/videos-grid
 *
 * @var array $attributes Block attributes.
 */

$install_heading  = $attributes['installHeading']  ?? 'Installation & Product Demos';
$install_subtitle = $attributes['installSubtitle'] ?? 'Watch how Goliath™ is installed and see the product in action';
$safety_heading   = $attributes['safetyHeading']   ?? 'Safety & Compliance';
$safety_subtitle  = $attributes['safetySubtitle']  ?? 'Understanding warehouse racking safety regulations and best practices';

$installation_videos = function_exists('my_theme_get_videos_hub_videos') ? my_theme_get_videos_hub_videos() : [];
$safety_videos = [];
if (function_exists('my_theme_get_videos_by_section') && function_exists('my_theme_video_file_is_readable')) {
    $safety_videos = array_filter(
        my_theme_get_videos_by_section('safety'),
        static function (array $row, string $slug): bool {
            return my_theme_video_file_is_readable($row['file']);
        },
        ARRAY_FILTER_USE_BOTH
    );
}
?>

<section class="w-full bg-white">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-5 px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[50px]">
        <h2 class="font-montserrat text-[32px] font-bold leading-[44px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
            <?php echo esc_html($install_heading); ?>
        </h2>
        <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#ff5c00]">
            <p><?php echo esc_html($install_subtitle); ?></p>
        </div>

        <?php if (! empty($installation_videos)) : ?>
            <div class="mt-1 grid grid-cols-1 gap-[26px] md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($installation_videos as $slug => $row) : ?>
                    <a href="<?php echo esc_url(home_url('/videos/' . $slug . '/')); ?>" class="group border-t border-[#faf5ff] py-[10px]">
                        <div class="relative flex h-[206px] w-full overflow-hidden bg-black">
                            <?php if (function_exists('my_theme_video_thumbnail_is_readable') && my_theme_video_thumbnail_is_readable($row['file'])) : ?>
                                <img
                                    src="<?php echo esc_url(my_theme_get_video_thumbnail_uri($row['file'])); ?>"
                                    alt="<?php echo esc_attr($row['title']); ?>"
                                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                                    loading="lazy"
                                    decoding="async"
                                    width="640"
                                    height="360"
                                >
                            <?php else : ?>
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
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (! empty($safety_videos)) : ?>
            <h2 class="mt-10 font-montserrat text-[32px] font-bold leading-[44px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
                <?php echo esc_html($safety_heading); ?>
            </h2>
            <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#ff5c00]">
                <p><?php echo esc_html($safety_subtitle); ?></p>
            </div>

            <div class="mt-1 grid grid-cols-1 gap-[26px] md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($safety_videos as $slug => $row) : ?>
                    <a href="<?php echo esc_url(home_url('/videos/' . $slug . '/')); ?>" class="group border-t border-[#faf5ff] py-[10px]">
                        <div class="relative flex h-[206px] w-full overflow-hidden bg-black">
                            <?php if (function_exists('my_theme_video_thumbnail_is_readable') && my_theme_video_thumbnail_is_readable($row['file'])) : ?>
                                <img
                                    src="<?php echo esc_url(my_theme_get_video_thumbnail_uri($row['file'])); ?>"
                                    alt="<?php echo esc_attr($row['title']); ?>"
                                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                                    loading="lazy"
                                    decoding="async"
                                    width="640"
                                    height="360"
                                >
                            <?php else : ?>
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
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
