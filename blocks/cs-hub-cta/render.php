<?php
$heading = esc_html($attributes['heading'] ?? 'Ready to Write Your Success Story?');
$desc = esc_html($attributes['description'] ?? '');
$cta_text = esc_html($attributes['ctaText'] ?? 'Book Free Assessment');
$cta_url = esc_url($attributes['ctaUrl'] ?? '/contact/');
$cta_arrow = get_theme_file_uri('assets/images/icons/cta-arrow-right.svg');
?>
<section class="w-full bg-[#ff5c00]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-8 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
        <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[42px] lg:leading-[52px]"><?php echo $heading; ?></h2>
        <?php if ($desc) : ?>
            <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-white"><?php echo $desc; ?></p>
        <?php endif; ?>
        <a href="<?php echo $cta_url; ?>" class="inline-flex h-[60px] w-full max-w-[320px] items-center justify-center gap-3 bg-[#020202] px-[32px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a] sm:w-auto sm:max-w-none">
            <span><?php echo $cta_text; ?></span>
            <img src="<?php echo esc_url($cta_arrow); ?>" alt="" class="size-5">
        </a>
    </div>
</section>
