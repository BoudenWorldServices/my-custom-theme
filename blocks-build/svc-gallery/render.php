<?php
/**
 * Block render: goliath/svc-gallery
 *
 * @var array $attributes Block attributes.
 */

$heading  = $attributes['heading'] ?? 'Simple Solution, Peace of Mind,';
$cta_text = $attributes['ctaText'] ?? 'View more';

$img1 = $attributes['img1'] ?: my_theme_get_image_url('my_theme_svc_gallery_img1', get_theme_file_uri('assets/images/Services/solution1.webp'));
$img2 = $attributes['img2'] ?: my_theme_get_image_url('my_theme_svc_gallery_img2', get_theme_file_uri('assets/images/Services/solution2.webp'));
$img3 = $attributes['img3'] ?: my_theme_get_image_url('my_theme_svc_gallery_img3', get_theme_file_uri('assets/images/Services/solution3.webp'));
$img4 = $attributes['img4'] ?: my_theme_get_image_url('my_theme_svc_gallery_img4', get_theme_file_uri('assets/images/Services/solution5.webp'));
$img5 = $attributes['img5'] ?: my_theme_get_image_url('my_theme_svc_gallery_img5', get_theme_file_uri('assets/images/Services/solution4.webp'));

$heading_parts = explode(',', $heading, 2);
$heading_black  = trim($heading_parts[0]);
$heading_orange = isset($heading_parts[1]) ? ',' . $heading_parts[1] : '';
?>

<section class="w-full bg-[#fafafa] py-10 lg:py-[80px]">
    <div class="mx-auto w-full max-w-[1440px] px-5 sm:px-6 lg:px-[68px]">
        <h2 class="mb-6 font-montserrat text-[32px] font-bold leading-[40px] lg:text-[36px] lg:leading-[44px]">
            <span class="text-[#020202]"><?php echo esc_html($heading_black); ?></span><span class="text-[#ff5c00]"><?php echo esc_html($heading_orange); ?></span>
        </h2>

        <div class="flex flex-col gap-5 lg:flex-row lg:gap-5">
            <div class="flex flex-1 flex-col gap-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div class="aspect-[307/284] overflow-hidden bg-[#d9d9d9]"><img src="<?php echo esc_url($img1); ?>" alt="Racking upright reinforcement installed in warehouse bay" class="h-full w-full object-cover" loading="lazy" decoding="async"></div>
                    <div class="aspect-[307/284] overflow-hidden bg-[#d9d9d9]"><img src="<?php echo esc_url($img2); ?>" alt="Goliath upright repair fitted to pallet racking" class="h-full w-full object-cover" loading="lazy" decoding="async"></div>
                    <div class="aspect-[309/284] overflow-hidden bg-[#d9d9d9]"><img src="<?php echo esc_url($img3); ?>" alt="Warehouse racking aisle with protected uprights" class="h-full w-full object-cover" loading="lazy" decoding="async"></div>
                </div>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-[2fr_1fr] lg:grid-cols-[640px_307px]">
                    <div class="aspect-[640/284] overflow-hidden bg-[#d9d9d9]"><img src="<?php echo esc_url($img4); ?>" alt="Close-up of reinforced racking column in operation" class="h-full w-full object-cover" loading="lazy" decoding="async"></div>
                    <div class="relative aspect-[307/284] bg-[#ff5c00]">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <a href="<?php echo esc_url(home_url('/videos/')); ?>" class="inline-flex h-full w-full items-center justify-center">
                                <span class="font-montserrat text-[16px] font-semibold uppercase leading-[24px] text-white"><?php echo esc_html($cta_text); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full overflow-hidden bg-[#d9d9d9] lg:h-[591px] lg:w-[307px] lg:shrink-0">
                <img src="<?php echo esc_url($img5); ?>" alt="Goliath protection installed on upright near loading zone" class="h-full w-full object-cover" loading="lazy" decoding="async">
            </div>
        </div>
    </div>
</section>
