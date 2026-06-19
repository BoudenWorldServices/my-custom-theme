<?php
/**
 * Block render: goliath/videos-dark-bar
 *
 * @var array $attributes Block attributes.
 */

$text     = $attributes['text']    ?? 'Ready to see Goliath™ in your warehouse?';
$btn1     = $attributes['btn1']    ?? 'Book a free on-site demonstration';
$btn2     = $attributes['btn2']    ?? 'Schedule live demo';
$btn1_url = $attributes['btn1Url'] ?? '/contact/';
$btn2_url = $attributes['btn2Url'] ?? '/contact/';

$arrow = get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg');
?>

<section class="w-full bg-[#020202]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-6 sm:px-6 lg:px-[38px]">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <p class="font-roboto text-[18px] font-bold leading-[28px] text-white"><?php echo esc_html($text); ?></p>
            <div class="flex flex-col gap-3 sm:flex-row sm:gap-[16px]">
                <a href="<?php echo esc_url($btn1_url); ?>" class="inline-flex h-[52px] items-center border border-white px-[20px] font-roboto text-[16px] font-semibold leading-[24px] text-white hover:bg-white/10">
                    <span><?php echo esc_html($btn1); ?></span>
                    <img src="<?php echo esc_url($arrow); ?>" alt="" class="ml-3 size-5 shrink-0" width="20" height="20" aria-hidden="true">
                </a>
                <a href="<?php echo esc_url($btn2_url); ?>" class="inline-flex h-[52px] items-center bg-[#ff5c00] px-[24px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#e55200]">
                    <span><?php echo esc_html($btn2); ?></span>
                    <img src="<?php echo esc_url($arrow); ?>" alt="" class="ml-3 size-5 shrink-0" width="20" height="20" aria-hidden="true">
                </a>
            </div>
        </div>
    </div>
</section>
