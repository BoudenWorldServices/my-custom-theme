<?php
/**
 * Render: goliath/service-orange-banner
 *
 * Faithful dark hero banner used at the top of service sub-pages.
 * Based on page-service-racking-upright-repair.php lines ~29–38.
 *
 * @var array $attributes
 */

$heading     = $attributes['heading']     ?? '';
$description = $attributes['description'] ?? '';
$image       = $attributes['image']       ?? '';
$image_alt   = $attributes['imageAlt']    ?? '';

$h1_parts = explode( ' ', $heading, 2 );
?>
<section class="w-full bg-[#020202]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[75px] lg:py-[96px]">
        <h1 class="font-montserrat text-[40px] font-bold leading-[44px] text-white lg:text-[60px] lg:leading-[60px]">
            <?php if ( count( $h1_parts ) === 2 ) : ?>
                <span class="text-white"><?php echo esc_html( $h1_parts[0] ); ?> </span><span class="text-[#ff5c00]"><?php echo esc_html( $h1_parts[1] ); ?></span>
            <?php else : ?>
                <span class="text-white"><?php echo esc_html( $heading ); ?></span>
            <?php endif; ?>
        </h1>
        <?php if ( $description ) : ?>
            <p class="mt-6 max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#d1d5dc] lg:text-[20px]">
                <?php echo esc_html( $description ); ?>
            </p>
        <?php endif; ?>
    </div>
    <?php if ( $image ) : ?>
        <div class="relative h-[380px] w-full overflow-hidden lg:h-[604px]">
            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="h-full w-full object-cover">
        </div>
    <?php endif; ?>
</section>
