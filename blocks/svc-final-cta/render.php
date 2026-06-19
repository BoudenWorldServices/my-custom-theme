<?php
/**
 * Block render: goliath/svc-final-cta
 *
 * @var array $attributes Block attributes.
 */

$description = $attributes['description'] ?? "Planning a new warehouse project? Get a tailored quote for Goliath™ protection.";
$btn_text    = $attributes['btnText']     ?? 'Get Your Project Quote';
$btn_url     = $attributes['btnUrl']      ?? '/contact/';

$arrow = get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg');
?>

<section class="w-full bg-[#ff5c00] py-14 lg:h-[420px] lg:py-0">
    <div class="mx-auto flex h-full w-full max-w-[1440px] flex-col items-center justify-center gap-6 px-5 text-center sm:px-6 lg:px-[68px]">
        <h2 class="font-montserrat text-[36px] font-bold leading-[44px] text-white lg:text-[42px] lg:leading-[52px]">
            <span>Interested in </span><span class="text-[#020202]">GOLIATH™?</span>
        </h2>
        <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-white">
            <?php echo esc_html($description); ?>
        </p>
        <a href="<?php echo esc_url($btn_url); ?>"
           class="inline-flex h-[60px] w-full max-w-[360px] items-center justify-center gap-4 bg-[#020202] px-[40px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white transition hover:bg-[#1a1a1a] sm:w-auto sm:max-w-none">
            <span><?php echo esc_html($btn_text); ?></span>
            <img src="<?php echo esc_url($arrow); ?>" alt="" class="size-5 shrink-0">
        </a>
    </div>
</section>
