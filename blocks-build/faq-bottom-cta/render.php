<?php
/**
 * Render callback for goliath/faq-bottom-cta.
 *
 * Orange CTA section: tall image on the left, heading + body + dark button on the right.
 *
 * @package MyCustomTheme
 */

$image       = $attributes['image']      ?? '';
$image_alt   = $attributes['imageAlt']   ?? 'Goliath installation in a warehouse';
$heading     = $attributes['heading']    ?? 'Still Have Questions?';
$body        = $attributes['body']       ?? 'Our team of experts is ready to answer any questions you have about Goliath™ and how it can benefit your warehouse operations.';
$button_text = $attributes['buttonText'] ?? 'Contact us';
$button_url  = $attributes['buttonUrl']  ?? '/contact/';

if ( $image === '' ) {
    $image = my_theme_get_image_url( 'my_theme_faqp_cta_image', get_theme_file_uri( 'assets/images/FAQ/installonce.webp' ) );
}

$link_arrow = get_theme_file_uri( 'assets/images/icons/hiw-link-arrow.svg' );
?>
<section class="w-full bg-[#ff5c00]">
    <div class="mx-auto grid w-full max-w-[1440px] grid-cols-1 gap-8 px-5 py-10 sm:px-6 lg:grid-cols-[1fr_minmax(0,634px)] lg:items-center lg:gap-8 lg:px-[68px] lg:py-[68px]">
        <div class="relative h-[280px] w-full overflow-hidden sm:h-[360px] lg:h-[516px] lg:min-h-[516px]">
            <img
                src="<?php echo esc_url( $image ); ?>"
                alt="<?php echo esc_attr( $image_alt ); ?>"
                class="h-full w-full object-cover"
                loading="lazy"
                decoding="async"
            >
        </div>
        <div class="flex w-full max-w-[634px] flex-col gap-8">
            <p class="font-montserrat text-[28px] font-bold leading-[36px] text-[#020202] sm:text-[32px] sm:leading-[40px] lg:text-[36px] lg:leading-[44px]">
                <?php echo esc_html( $heading ); ?>
            </p>
            <p class="max-w-[486px] font-montserrat text-[16px] font-bold leading-[23px] text-[#364153]">
                <?php echo esc_html( $body ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( $button_url ) ); ?>" class="inline-flex w-full max-w-[320px] items-center justify-between bg-[#020202] px-[28px] py-[18px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a] sm:w-[234px] sm:max-w-none">
                <span><?php echo esc_html( $button_text ); ?></span>
                <img src="<?php echo esc_url( $link_arrow ); ?>" alt="" class="size-5" aria-hidden="true">
            </a>
        </div>
    </div>
</section>
