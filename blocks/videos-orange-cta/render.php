<?php
/**
 * Block render: goliath/videos-orange-cta
 *
 * @var array $attributes Block attributes.
 */

$heading  = $attributes['heading'] ?? 'Ready to see Goliath™ in your warehouse?';
$body     = $attributes['body']    ?? 'Book a free on-site demonstration and see first-hand how Goliath™ can improve your racking maintenance.';
$btn_text = $attributes['btnText'] ?? 'Schedule live demo';
$btn_url  = $attributes['btnUrl']  ?? '/contact/';

$arrow = get_theme_file_uri('assets/images/icons/cta-arrow-right.svg');
?>

<section class="w-full bg-[#ff5c00]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-8 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
        <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[42px] lg:leading-[52px]">
            <?php echo esc_html($heading); ?>
        </h2>
        <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-white">
            <?php echo esc_html($body); ?>
        </p>
        <a href="<?php echo esc_url($btn_url); ?>" class="inline-flex h-[60px] items-center bg-[#020202] px-[32px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a]">
            <span><?php echo esc_html($btn_text); ?></span>
            <img src="<?php echo esc_url($arrow); ?>" alt="" class="ml-3 size-5 shrink-0" width="20" height="20" aria-hidden="true">
        </a>
    </div>
</section>
