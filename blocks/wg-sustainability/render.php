<?php
/**
 * Block: goliath/wg-sustainability
 * Why Goliath – Sustainability — image and text split section.
 */

$heading = $attributes['heading'] ?? 'Supporting Sustainability, One Upright at a Time';
$p1      = $attributes['p1']      ?? 'The waste of steel, material, and labour costs when replacing uprights is a major problem in warehousing.';
$p2      = $attributes['p2']      ?? 'By replacing your racking, Goliath™ lowers the amount of steel required to achieve the same result. This means you\'ll never have to repair the upright again, eliminating steel waste from the most high-traffic areas of your warehouse.';
$p3      = $attributes['p3']      ?? 'This ensures a more sustainable warehouse operation and helps businesses reduce their environmental footprint.';
$tagline = $attributes['tagline'] ?? 'Choose Goliath™. Choose Support.';

if (! empty($attributes['image'])) {
    $image_url = esc_url($attributes['image']);
} else {
    $image_url = esc_url(my_theme_get_image_url('my_theme_wg_sus_img', get_theme_file_uri('assets/images/whyGoliath/solution.webp')));
}
?>
<section class="w-full bg-white py-10 lg:py-[80px]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col items-stretch gap-8 px-5 sm:px-6 lg:flex-row lg:items-center lg:gap-[30px] lg:px-[68px]">
        <div class="flex flex-1 overflow-hidden bg-black">
            <img
                src="<?php echo $image_url; ?>"
                alt="Goliath upright repair solution installed in warehouse"
                class="h-[300px] w-full object-cover sm:h-[400px] lg:h-[500px]"
                loading="lazy"
                decoding="async"
            >
        </div>
        <div class="flex flex-1 flex-col gap-[20px] lg:h-[432px] lg:gap-[24px]">
            <div class="flex gap-[16px] lg:h-[80px] lg:items-start">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-sustainability-icon.svg')); ?>" alt="" class="size-[48px] shrink-0">
                <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:max-w-[504px] lg:text-[36px]">
                    <?php echo esc_html($heading); ?>
                </h2>
            </div>
            <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#364153] lg:max-w-[568px]">
                <?php echo esc_html($p1); ?>
            </p>
            <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#364153] lg:max-w-[568px]">
                <?php echo esc_html($p2); ?>
            </p>
            <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#364153] lg:max-w-[568px]">
                <?php echo esc_html($p3); ?>
            </p>
            <p class="font-roboto text-[24px] font-bold leading-[32px] text-[#ff5c00]">
                <?php echo esc_html($tagline); ?>
            </p>
        </div>
    </div>
</section>
