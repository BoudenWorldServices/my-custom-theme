<?php
/**
 * Video Hero block – gradient background, label, title, description.
 *
 * @var array $attributes
 */

defined('ABSPATH') || exit;

$label        = esc_html($attributes['label'] ?? 'Featured Video');
$title_orange = esc_html($attributes['titleOrange'] ?? '');
$title_white  = esc_html($attributes['titleWhite'] ?? '');
$description  = esc_html($attributes['description'] ?? '');
?>
<section class="relative w-full h-auto lg:min-h-[400px] hero-gradient-bg">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
        <div class="flex w-full flex-col gap-4 lg:min-h-[223px] lg:justify-between lg:gap-0">
            <p class="font-montserrat text-[16px] font-medium leading-[24px] tracking-[0.07px] text-[#ff5c00]"><?php echo $label; ?></p>
            <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                <span class="text-[#ff5c00]"><?php echo $title_orange; ?></span><?php if ($title_white !== '') : ?> <span class="text-white"><?php echo $title_white; ?></span><?php endif; ?>
            </h1>
            <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                <?php echo $description; ?>
            </p>
        </div>
    </div>
</section>
