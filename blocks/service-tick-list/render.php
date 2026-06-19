<?php
/**
 * Render: goliath/service-tick-list
 *
 * Based on the tick list + compatibility grid from service sub-pages.
 *
 * @var array $attributes
 */

$heading   = $attributes['heading']  ?? '';
$items     = $attributes['items']    ?? [];
$image     = $attributes['image']    ?? '';
$image_alt = $attributes['imageAlt'] ?? '';
$cta_text  = $attributes['ctaText']  ?? '';
$cta_url   = $attributes['ctaUrl']   ?? '/contact/';

$tick = get_theme_file_uri( 'assets/images/icons/Icon-1.svg' );
$arrow = get_theme_file_uri( 'assets/images/icons/cta-arrow-right.svg' );
?>
<section class="w-full bg-[#f8f8f8]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-12 sm:px-6 lg:flex-row lg:justify-between lg:gap-10 lg:px-[68px] lg:py-[55px]">
        <div class="w-full lg:max-w-[684px]">
            <?php if ( $heading ) : ?>
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]"><?php echo esc_html( $heading ); ?></h2>
            <?php endif; ?>
            <?php if ( ! empty( $items ) ) : ?>
                <div class="mt-4 grid grid-cols-1 gap-x-[40px] gap-y-4 sm:grid-cols-2">
                    <?php foreach ( $items as $item ) : ?>
                        <div class="flex items-center gap-3">
                            <img src="<?php echo esc_url( $tick ); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                            <span class="font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html( $item ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ( $cta_text ) : ?>
                <a href="<?php echo esc_url( $cta_url ); ?>" class="mt-8 inline-flex h-[52px] w-full items-center justify-center bg-[#ff5c00] font-roboto text-[14px] font-bold uppercase tracking-[0.35px] text-white sm:w-[247px]">
                    <span><?php echo esc_html( $cta_text ); ?></span>
                    <img src="<?php echo esc_url( $arrow ); ?>" alt="" class="ml-3 size-5">
                </a>
            <?php endif; ?>
        </div>
        <?php if ( $image ) : ?>
            <div class="w-full bg-[#ff5c00] px-8 py-8 lg:w-[532px] lg:px-[32px] lg:py-[30px]">
                <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="h-full w-full object-cover">
            </div>
        <?php endif; ?>
    </div>
</section>
