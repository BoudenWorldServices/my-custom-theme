<?php
/**
 * Render: goliath/wg-dual-cta
 *
 * @var array $attributes
 */

$heading        = $attributes['heading']       ?? 'A Smarter Way to Handle Racking Damage';
$para1          = $attributes['para1']         ?? '';
$para2          = $attributes['para2']         ?? '';
$primary_text   = $attributes['primaryText']   ?? 'Get Free Site Survey';
$primary_url    = $attributes['primaryUrl']    ?? '/contact/';
$secondary_text = $attributes['secondaryText'] ?? 'View Compliance Info';
$secondary_url  = $attributes['secondaryUrl']  ?? '/compliance/';
?>
<section class="w-full bg-[#ff5c00]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-[32px] px-5 py-10 text-center lg:px-[283px] lg:py-[80px]">
        <h2 class="w-full font-montserrat text-[28px] font-bold leading-[40px] text-white lg:text-[36px]">
            <?php echo esc_html( $heading ); ?>
        </h2>
        <?php if ( $para1 ) : ?>
            <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-white lg:text-[20px]">
                <?php echo esc_html( $para1 ); ?>
            </p>
        <?php endif; ?>
        <?php if ( $para2 ) : ?>
            <p class="w-full max-w-[1020px] font-roboto text-[18px] font-normal leading-[28px] text-white">
                <?php echo esc_html( $para2 ); ?>
            </p>
        <?php endif; ?>
        <div class="flex flex-col items-center justify-center gap-4 sm:flex-row sm:gap-[16px]">
            <?php if ( $primary_text && $primary_url ) : ?>
                <a href="<?php echo esc_url( $primary_url ); ?>" class="relative inline-flex h-[60px] w-full items-center justify-center gap-2 bg-white px-[40px] font-roboto text-[18px] font-bold uppercase leading-[28px] tracking-[0.45px] text-[#ff5c00] hover:bg-[#f4f4f4] sm:w-[310px]">
                    <span class="text-center sm:whitespace-nowrap"><?php echo esc_html( $primary_text ); ?></span>
                    <img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/icons/hiw-cta-arrow.svg' ) ); ?>" alt="" class="size-5 shrink-0 sm:absolute sm:right-[20px] sm:top-1/2 sm:-translate-y-1/2" width="20" height="20" aria-hidden="true">
                </a>
            <?php endif; ?>
            <?php if ( $secondary_text && $secondary_url ) : ?>
                <a href="<?php echo esc_url( $secondary_url ); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-[#020202] font-roboto text-[18px] font-bold uppercase leading-[28px] tracking-[0.45px] text-white hover:bg-[#1a1a1a] sm:w-[295px]">
                    <?php echo esc_html( $secondary_text ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
