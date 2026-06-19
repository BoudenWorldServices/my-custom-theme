<?php
/**
 * Render: goliath/comp-regulation
 *
 * @var array $attributes
 */

$heading = $attributes['heading'] ?? 'Regulation Compliant';
$p1      = $attributes['p1']      ?? '';
$p2      = $attributes['p2']      ?? '';
$box_h3  = $attributes['boxH3']   ?? '';
$box_p   = $attributes['boxP']    ?? '';

$h2_parts = explode( ' ', $heading, 2 );
$shield   = get_theme_file_uri( 'assets/images/icons/Icon-4.svg' );
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[59px] lg:py-[80px]">
        <div class="flex flex-col gap-8">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                <?php if ( count( $h2_parts ) === 2 ) : ?>
                    <?php echo esc_html( $h2_parts[0] ); ?> <span class="text-[#ff5c00]"><?php echo esc_html( $h2_parts[1] ); ?></span>
                <?php else : ?>
                    <?php echo esc_html( $heading ); ?>
                <?php endif; ?>
            </h2>
            <div class="font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                <?php if ( $p1 ) : ?><p><?php echo esc_html( $p1 ); ?></p><?php endif; ?>
                <?php if ( $p2 ) : ?><p><?php echo esc_html( $p2 ); ?></p><?php endif; ?>
            </div>
            <div class="flex w-full items-start gap-5 bg-[#020202] px-[24px] py-[24px] lg:h-[156px] lg:px-[33px] lg:pt-[33px]">
                <div class="flex h-[90px] w-[89px] shrink-0 items-center justify-center bg-[#ff5c00]">
                    <img src="<?php echo esc_url( $shield ); ?>" alt="" class="size-14 brightness-0">
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="font-montserrat text-[20px] font-bold leading-[30px] text-white"><?php echo esc_html( $box_h3 ); ?></h3>
                    <p class="max-w-[1056px] font-montserrat text-[16px] font-normal leading-[26px] text-white"><?php echo esc_html( $box_p ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
