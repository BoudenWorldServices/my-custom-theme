<?php
/**
 * Render: goliath/comp-compatibility
 *
 * @var array $attributes
 */

$heading    = $attributes['heading'] ?? '';
$intro      = $attributes['intro']   ?? '';
$items_raw  = $attributes['items']   ?? '';
$box_h3     = $attributes['boxH3']   ?? '';
$box_p      = $attributes['boxP']    ?? '';
$box_cta    = $attributes['boxCta']  ?? 'Check Compatibility';
$image_attr = $attributes['image']      ?? '';
$box_cta_url = $attributes['boxCtaUrl'] ?? '/#contact';

$image_url = $image_attr
    ? esc_url( $image_attr )
    : esc_url( my_theme_get_image_url( 'my_theme_comp_compat_image', get_theme_file_uri( 'assets/images/Compliance/compatible.webp' ) ) );

$compat = array_map( 'trim', explode( ',', $items_raw ) );
$arrow  = get_theme_file_uri( 'assets/images/icons/hiw-link-arrow.svg' );

$h2_parts = preg_split( '/\b(GOLIATH™\??)/', $heading, 2, PREG_SPLIT_DELIM_CAPTURE );
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[80px]">
        <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
            <?php if ( count( $h2_parts ) >= 3 ) : ?>
                <span><?php echo esc_html( $h2_parts[0] ); ?></span><span class="text-[#ff5c00]"><?php echo esc_html( $h2_parts[1] ); ?></span>
            <?php else : ?>
                <span><?php echo esc_html( $heading ); ?></span>
            <?php endif; ?>
        </h2>
        <p class="mt-4 max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]"><?php echo esc_html( $intro ); ?></p>

        <div class="mt-8 flex flex-col gap-8 lg:flex-row lg:gap-[54px]">
            <div class="w-full space-y-[10px] lg:w-[591px]">
                <?php foreach ( $compat as $name ) : ?>
                    <div class="flex h-[66px] items-center gap-4 border border-[#e8e8e9] px-[21px]">
                        <svg class="size-6 shrink-0 text-[#ff5c00]" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                            <circle cx="10" cy="10" r="8.5" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M6.5 10.5l2.1 2.1 4.9-4.9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="font-montserrat text-[16px] font-bold leading-[24px] text-[#020202]"><?php echo esc_html( $name ); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="relative w-full overflow-hidden border border-black/10 lg:h-[750px] lg:w-[655px]">
                <img src="<?php echo $image_url; ?>" alt="Goliath upright repair compatible with major pallet racking systems" class="h-full w-full object-cover">
                <div class="pointer-events-none absolute inset-0 bg-black/45" aria-hidden="true"></div>
            </div>
        </div>

        <div class="mt-10 bg-[#020202] bg-[linear-gradient(165.798deg,rgba(2,2,2,1)_0%,rgba(51,51,51,1)_100%)] px-6 py-10 text-center lg:px-[48px]">
            <h3 class="font-montserrat text-[32px] font-bold leading-[48px] text-white"><?php echo esc_html( $box_h3 ); ?></h3>
            <p class="mx-auto mt-4 max-w-[600px] font-montserrat text-[18px] font-normal leading-[28px] text-white/90"><?php echo esc_html( $box_p ); ?></p>
            <a href="<?php echo esc_url( home_url( $box_cta_url ) ); ?>" class="mt-6 inline-flex h-[53px] w-full items-center justify-center bg-[#ff5c00] px-[32px] font-montserrat text-[14px] font-bold leading-[21px] tracking-[0.35px] text-white hover:bg-[#e55200] sm:w-auto">
                <span><?php echo esc_html( $box_cta ); ?></span>
                <img src="<?php echo esc_url( $arrow ); ?>" alt="" class="ml-3 size-5 shrink-0">
            </a>
        </div>
    </div>
</section>
