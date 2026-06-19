<?php
/**
 * Render callback for goliath/hero-section.
 *
 * Faithful to the dark-gradient hero sections used across all marketing pages.
 * Supports optional badge (orange small text above H1), two-part H1 colouring,
 * description paragraph, and optional CTA button.
 *
 * @package MyCustomTheme
 */

$badge             = $attributes['badge'] ?? '';
$heading           = $attributes['heading'] ?? 'Page Heading';
$heading_highlight = $attributes['headingHighlight'] ?? '';
$description       = $attributes['description'] ?? '';
$cta_text          = $attributes['ctaText'] ?? '';
$cta_url           = $attributes['ctaUrl'] ?? '/contact/';
$min_height        = $attributes['minHeight'] ?? 'medium';

$height_class = match ( $min_height ) {
    'small'  => 'lg:h-[320px]',
    'large'  => 'lg:h-[500px]',
    default  => 'lg:h-[400px]',
};
?>
<section class="relative w-full h-auto <?php echo esc_attr( $height_class ); ?> hero-gradient-bg">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
        <div class="flex w-full flex-col gap-4 lg:gap-6">
            <?php if ( $badge !== '' ) : ?>
                <p class="font-montserrat text-[14px] font-medium leading-[22px] tracking-[0.07px] text-[#ff5c00] sm:text-[16px] sm:leading-[24px] sm:whitespace-nowrap">
                    <?php echo esc_html( $badge ); ?>
                </p>
            <?php endif; ?>
            <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                <span class="text-white"><?php echo esc_html( $heading ); ?></span>
                <?php if ( $heading_highlight !== '' ) : ?>
                    <span class="text-[#ff5c00]"> <?php echo esc_html( $heading_highlight ); ?></span>
                <?php endif; ?>
            </h1>
            <?php if ( $description !== '' ) : ?>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    <?php echo nl2br( esc_html( $description ) ); ?>
                </p>
            <?php endif; ?>
            <?php if ( $cta_text !== '' ) : ?>
                <div>
                    <a
                        href="<?php echo esc_url( home_url( $cta_url ) ); ?>"
                        class="inline-flex h-[57px] w-full items-center justify-center bg-[#ff5c00] px-6 font-montserrat text-[14px] font-bold uppercase leading-[21px] tracking-[0.35px] text-white hover:opacity-95 sm:w-[257px]"
                    >
                        <?php echo esc_html( $cta_text ); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
