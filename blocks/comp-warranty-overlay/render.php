<?php
/**
 * Render: goliath/comp-warranty-overlay
 *
 * @var array $attributes
 */

$h3    = $attributes['h3']    ?? 'Warranty Coverage Includes:';
$items = [
    $attributes['item1'] ?? '',
    $attributes['item2'] ?? '',
    $attributes['item3'] ?? '',
    $attributes['item4'] ?? '',
];
$image_attr = $attributes['image'] ?? '';

$image_url = $image_attr
    ? esc_url( $image_attr )
    : esc_url( my_theme_get_image_url( 'my_theme_comp_warranty_image', get_theme_file_uri( 'assets/images/Compliance/waranty-coverage.webp' ) ) );

$check = get_theme_file_uri( 'assets/images/icons/why-goliath-bullet-light.svg' );
?>
<section class="w-full bg-white pb-10 lg:pb-[80px]">
    <div class="mx-auto w-full max-w-[1440px] px-5 sm:px-6 lg:px-[59px]">
        <div class="relative">
            <div class="w-full overflow-hidden">
                <img src="<?php echo $image_url; ?>" alt="Warehouse racking upright protected by Goliath during compliance inspection" class="h-auto w-full object-cover" loading="lazy" decoding="async">
            </div>
            <div class="mt-6 bg-[#ff5c00] p-8 lg:absolute lg:-right-[130px] lg:top-[48%] lg:w-[532px] lg:-translate-y-1/2 lg:px-[42px] lg:py-[42px]">
                <h3 class="font-montserrat text-[24px] font-bold leading-[36px] text-white"><?php echo esc_html( $h3 ); ?></h3>
                <ul class="mt-4 space-y-3">
                    <?php foreach ( array_filter( $items ) as $item ) : ?>
                        <li class="flex items-center gap-3">
                            <img src="<?php echo esc_url( $check ); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                            <span class="font-montserrat text-[15px] font-normal leading-[24px] text-white"><?php echo esc_html( $item ); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
