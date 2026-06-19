<?php
/**
 * Render callback for goliath/testimonial.
 *
 * @package MyCustomTheme
 */

$pre_heading  = $attributes['preHeading'] ?? '';
$quote        = $attributes['quote'] ?? '';
$attribution  = $attributes['attribution'] ?? '';
$button_text  = $attributes['buttonText'] ?? 'Get Similar Results';
$button_url   = $attributes['buttonUrl'] ?? '/contact/';

if ( $quote === '' && $pre_heading === '' ) {
    return;
}

$cta_arrow = get_theme_file_uri( 'assets/images/icons/cta-arrow-right.svg' );
?>
<section class="w-full bg-[#ff5c00]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-3 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
        <?php if ( $pre_heading !== '' ) : ?>
            <h2 class="font-montserrat text-[22px] font-bold leading-[32px] text-white lg:text-[24px]">
                <?php echo esc_html( $pre_heading ); ?>
            </h2>
        <?php endif; ?>
        <?php if ( $quote !== '' ) : ?>
            <p class="max-w-[1146px] font-montserrat text-[18px] italic leading-[28px] text-white">
                <?php echo esc_html( $quote ); ?>
            </p>
        <?php endif; ?>
        <?php if ( $attribution !== '' ) : ?>
            <p class="max-w-[547px] font-roboto text-[16px] font-bold leading-[24px] text-white">
                — <?php echo esc_html( $attribution ); ?>
            </p>
        <?php endif; ?>
        <a
            href="<?php echo esc_url( home_url( $button_url ) ); ?>"
            class="mt-3 inline-flex h-[60px] w-full max-w-[320px] items-center justify-center bg-[#020202] px-[32px] font-roboto text-[16px] font-semibold leading-[24px] text-white hover:bg-[#1a1a1a] sm:w-auto sm:max-w-none"
        >
            <span><?php echo esc_html( $button_text ); ?></span>
            <img src="<?php echo esc_url( $cta_arrow ); ?>" alt="" class="ml-3 size-5">
        </a>
    </div>
</section>
