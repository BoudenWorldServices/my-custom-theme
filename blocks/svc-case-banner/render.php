<?php
$heading = esc_html($attributes['heading'] ?? '');
$desc = esc_html($attributes['description'] ?? '');
$cta_text = esc_html($attributes['ctaText'] ?? '');
$cta_url = esc_url($attributes['ctaUrl'] ?? '');
$arrow = get_theme_file_uri('assets/images/icons/arrow-right-white.svg');
?>
<section class="w-full bg-[#ff5c00]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-6 px-5 py-10 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-[68px] lg:py-[32px]">
        <div>
            <?php if ($heading) : ?>
                <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-white"><?php echo $heading; ?></h3>
            <?php endif; ?>
            <?php if ($desc) : ?>
                <p class="mt-2 max-w-[693px] font-roboto text-[18px] leading-[28px] text-white"><?php echo $desc; ?></p>
            <?php endif; ?>
        </div>
        <?php if ($cta_text && $cta_url) : ?>
            <a href="<?php echo $cta_url; ?>" class="inline-flex h-[52px] items-center bg-[#020202] px-[38px] py-[18px] font-montserrat text-[16px] font-bold tracking-[0.35px] text-white">
                <span><?php echo $cta_text; ?></span>
                <img src="<?php echo esc_url($arrow); ?>" alt="" class="ml-14 size-5">
            </a>
        <?php endif; ?>
    </div>
</section>
