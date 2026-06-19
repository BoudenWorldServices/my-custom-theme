<?php
/**
 * Block: goliath/wg-vs-standard
 * Why Goliath vs Standard Repair — two-column comparison + three-image grid.
 */

$heading  = $attributes['heading']  ?? 'Goliath™ vs. Standard Repair';
$trad_h3  = $attributes['tradH3']   ?? 'Traditional Repair';
$trad_p   = $attributes['tradP']    ?? 'Traditional pallet racking repair\'s sole focus is on replacing damaged uprights. This means uprights have to be damaged first before being repaired. The biggest problem with standard repair is that it doesn\'t prevent the same issue from happening again.';
$trad_bold = $attributes['tradBold'] ?? 'This means uprights are replaced and eventually damaged again.';
$gol_h3   = $attributes['golH3']    ?? 'Goliath™ is Different';
$gol_p    = $attributes['golP']     ?? 'Instead of repeatedly replacing the upright with the standard system, the upright is replaced with our high-strength steel repair system. Goliath™ is built to brace for impact, ensuring the structure is stronger and more resilient to handle high-traffic environments more effectively.';
$gol_bold = $attributes['golBold']  ?? 'While standard repair methods are reactive, Goliath™ is a permanent upgrade for future circumstances.';

$img1     = $attributes['img1'] ?? '';
$img1_alt = $attributes['img1Alt'] ?? 'Goliath upright repair solution installed in warehouse';
$img2     = $attributes['img2'] ?? '';
$img2_alt = $attributes['img2Alt'] ?? 'Close-up of Goliath repair kit in use';
$img3     = $attributes['img3'] ?? '';
$img3_alt = $attributes['img3Alt'] ?? 'Before and after Goliath installation';

$trio = [
    [
        'src' => $img1 ? esc_url($img1) : esc_url(my_theme_get_image_url('my_theme_wg_vs_img1', get_theme_file_uri('assets/images/whyGoliath/solution.webp'))),
        'alt' => $img1 ? $img1_alt : 'Technician fitting a yellow Goliath repair sleeve to a pallet racking upright with a power tool.',
    ],
    [
        'src' => $img2 ? esc_url($img2) : esc_url(my_theme_get_image_url('my_theme_wg_vs_img2', get_theme_file_uri('assets/images/Homepage/review-3.webp'))),
        'alt' => $img2 ? $img2_alt : 'Warehouse racking upright showing a yellow Goliath base repair installed and fixed to the floor.',
    ],
    [
        'src' => $img3 ? esc_url($img3) : esc_url(my_theme_get_image_url('my_theme_wg_vs_img3', get_theme_file_uri('assets/images/Homepage/review-1.webp'))),
        'alt' => $img3 ? $img3_alt : 'Close-up of a completed yellow Goliath upright protection on industrial pallet racking.',
    ],
];
?>
<section class="w-full bg-white py-10 lg:py-[80px]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-[28px] px-5 sm:px-6 lg:gap-[36px] lg:px-[68px]">
        <div class="w-full max-w-[1024px] text-center">
            <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html($heading); ?>
            </h2>
        </div>
        <div class="flex w-full max-w-[1302px] flex-col lg:flex-row">
            <div class="flex flex-1 flex-col gap-[16px] bg-[#f9fafb] p-6 lg:p-[32px]">
                <h3 class="font-montserrat text-[22px] font-bold leading-[32px] text-[#364153] lg:text-[24px]">
                    <?php echo esc_html($trad_h3); ?>
                </h3>
                <p class="font-roboto text-[16px] font-normal leading-[24px] text-[#364153] lg:max-w-[504px]">
                    <?php echo esc_html($trad_p); ?>
                </p>
                <p class="font-roboto text-[16px] font-bold leading-[24px] text-[#364153] lg:max-w-[432px]">
                    <?php echo esc_html($trad_bold); ?>
                </p>
            </div>
            <div class="flex flex-1 flex-col gap-[20px] bg-[#ff5c00] p-6 lg:gap-[27px] lg:p-[32px]">
                <h3 class="font-montserrat text-[22px] font-bold leading-[32px] text-white lg:text-[24px]">
                    <?php echo esc_html($gol_h3); ?>
                </h3>
                <p class="font-roboto text-[16px] font-normal leading-[24px] text-white lg:max-w-[530px]">
                    <?php echo esc_html($gol_p); ?>
                </p>
                <p class="font-roboto text-[16px] font-bold leading-[24px] text-white lg:max-w-[432px]">
                    <?php echo esc_html($gol_bold); ?>
                </p>
            </div>
        </div>
        <div class="grid w-full max-w-[1302px] grid-cols-1 gap-2 sm:grid-cols-3 sm:gap-3 lg:gap-4">
            <?php foreach ($trio as $img) : ?>
                <div class="h-[220px] min-h-0 overflow-hidden sm:h-[320px] lg:h-[534px]">
                    <img
                        src="<?php echo $img['src']; ?>"
                        alt="<?php echo esc_attr($img['alt']); ?>"
                        class="h-full w-full object-cover"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
