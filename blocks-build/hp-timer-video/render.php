<?php
/**
 * Block render: goliath/hp-timer-video
 *
 * @var array $attributes Block attributes.
 */

$eyebrow = $attributes['eyebrow'] ?? 'Never replace a racking upright again';
$heading = $attributes['heading'] ?? 'Installed in less than 30 minutes, covered for life';
$compat  = $attributes['compat']  ?? 'Compatible with all UK and EU racking systems';

$fallback_image = $attributes['fallbackImage'] ?: my_theme_get_image_url('my_theme_hp_hero_slide3', get_theme_file_uri('assets/images/Homepage/not-just-dent.webp'));

$video_url = $attributes['video'] ?: get_option('my_theme_hp_timer_video', '');
if ($video_url === '' || $video_url === false) {
    $video_url = get_theme_file_uri('assets/videos/Timer-install-video.mp4');
}
$has_video = ($video_url !== '');
?>

<section class="relative left-1/2 right-1/2 w-[100dvw] max-w-[100dvw] -ml-[50dvw] -mr-[50dvw] overflow-hidden bg-white" aria-label="<?php echo esc_attr($heading); ?>">
    <div class="flex w-full min-h-[520px] flex-col lg:min-h-[620px] lg:flex-row">
        <div class="flex w-full bg-[#ff6b2c] px-6 py-12 text-white sm:px-10 sm:py-14 lg:w-[500px] lg:shrink-0 lg:px-[70px] lg:py-0">
            <div class="flex h-full w-full max-w-[374px] flex-col justify-center text-left">
                <div class="mb-[36px]">
                    <p class="font-montserrat text-[8px] font-medium uppercase leading-[20px] tracking-[0.4px] lg:text-[14px] lg:leading-[30px]"><?php echo esc_html($eyebrow); ?></p>
                    <h2 class="mt-1 font-montserrat text-[36px] font-bold leading-[44px]"><?php echo esc_html($heading); ?></h2>
                </div>
                <p class="mt-10 max-w-[333px] font-montserrat text-[16px] font-bold leading-[23px] lg:mt-14"><?php echo esc_html($compat); ?></p>
            </div>
        </div>

        <div class="relative min-h-[360px] w-full min-w-0 overflow-visible sm:h-[480px] lg:min-h-[620px] lg:flex-1">
            <?php if ($has_video) : ?>
                <video
                    class="absolute inset-0 block h-full w-full max-w-none bg-black object-cover"
                    autoplay
                    muted
                    loop
                    playsinline
                    preload="none"
                    poster="<?php echo esc_url($fallback_image); ?>"
                    aria-label="<?php echo esc_attr('Goliath timer installation video'); ?>"
                >
                    <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                </video>
            <?php else : ?>
                <img src="<?php echo esc_url($fallback_image); ?>" alt="Damaged pallet racking upright in warehouse aisle" class="absolute inset-0 h-full w-full object-cover" loading="lazy" decoding="async">
            <?php endif; ?>
        </div>
    </div>
</section>
