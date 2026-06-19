<?php
$heading = esc_html($attributes['heading'] ?? 'Case Studies');
$desc = $attributes['description'] ?? '';
$parts = explode(' ', $heading, 2);
?>
<section class="relative w-full h-auto lg:h-[400px] hero-gradient-bg">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
        <div class="flex w-full flex-col gap-5 lg:h-[223px] lg:justify-between lg:gap-0">
            <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                <span class="text-white"><?php echo esc_html($parts[0]); ?> </span><span class="text-[#ff5c00]"><?php echo esc_html($parts[1] ?? ''); ?></span>
            </h1>
            <?php if ($desc) : ?>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    <?php echo nl2br(esc_html($desc)); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>
