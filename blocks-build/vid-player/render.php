<?php
/**
 * Video Player block – video embed + heading + description.
 *
 * @var array $attributes
 */

defined('ABSPATH') || exit;

$video_url   = esc_url($attributes['videoUrl'] ?? '');
$poster_url  = esc_url($attributes['posterUrl'] ?? '');
$heading     = esc_html($attributes['heading'] ?? '');
$description = esc_html($attributes['description'] ?? '');

$poster_attr = $poster_url ? ' poster="' . $poster_url . '"' : '';
?>
<section class="w-full bg-white">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:gap-[60px] lg:px-[68px] lg:pt-[80px] lg:pb-[70px]">
        <div class="w-full lg:flex-1">
            <?php if ($video_url) : ?>
            <video
                class="aspect-video w-full bg-black object-contain lg:h-[368px]"
                src="<?php echo $video_url; ?>"
                controls
                playsinline
                muted
                autoplay
                preload="auto"
                <?php echo $poster_attr; ?>
            ></video>
            <?php else : ?>
            <div class="aspect-video w-full bg-black flex items-center justify-center lg:h-[368px]">
                <p class="text-white/60 font-montserrat text-lg">No video URL set</p>
            </div>
            <?php endif; ?>
        </div>
        <div class="w-full lg:flex-1">
            <h2 class="font-montserrat text-[28px] font-bold leading-[36px] text-[#ff5c00] sm:text-[34px] sm:leading-[44px] lg:text-[42px] lg:leading-[52px]">
                <?php echo $heading; ?>
            </h2>
            <p class="mt-4 font-montserrat text-[16px] font-normal leading-[26px] text-[#666]">
                <?php echo $description; ?>
            </p>
        </div>
    </div>
</section>
