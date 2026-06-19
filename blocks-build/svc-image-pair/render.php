<?php
$img1 = $attributes['image1'] ?? '';
$img1_alt = esc_attr($attributes['image1Alt'] ?? '');
$img2 = $attributes['image2'] ?? '';
$img2_alt = esc_attr($attributes['image2Alt'] ?? '');
$intro = esc_html($attributes['introText'] ?? '');
?>
<section class="w-full bg-[#f9fafb]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[75px] lg:py-[64px]">
        <?php if ($intro) : ?>
            <p class="mx-auto mb-10 max-w-[1183px] text-center font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]"><?php echo $intro; ?></p>
        <?php endif; ?>
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-8">
            <?php if ($img1) : ?>
                <div class="h-[280px] overflow-hidden lg:h-[384px]">
                    <img src="<?php echo esc_url($img1); ?>" alt="<?php echo $img1_alt; ?>" class="h-full w-full object-cover">
                </div>
            <?php endif; ?>
            <?php if ($img2) : ?>
                <div class="h-[280px] overflow-hidden lg:h-[384px]">
                    <img src="<?php echo esc_url($img2); ?>" alt="<?php echo $img2_alt; ?>" class="h-full w-full object-cover">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
