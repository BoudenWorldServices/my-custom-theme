<?php
/**
 * Render: goliath/comp-audit
 *
 * @var array $attributes
 */

$heading  = $attributes['heading']  ?? '';
$p1       = $attributes['p1']       ?? '';
$p2       = $attributes['p2']       ?? '';
$aside_h3 = $attributes['asideH3']  ?? '';
$aside_p  = $attributes['asideP']   ?? '';
?>
<section class="w-full bg-[#fafafa]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:justify-between lg:px-[68px] lg:py-[80px]">
        <div class="w-full lg:w-[794px]">
            <h2 class="max-w-[758px] font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html( $heading ); ?></h2>
            <div class="mt-6 font-montserrat text-[18px] font-normal leading-[28px] text-[#364153]">
                <?php if ( $p1 ) : ?><p><?php echo esc_html( $p1 ); ?></p><?php endif; ?>
                <?php if ( $p2 ) : ?><p><?php echo esc_html( $p2 ); ?></p><?php endif; ?>
            </div>
        </div>
        <aside class="w-full border-2 border-[#ff5c00] bg-[#ff5c00] px-[42px] py-[42px] text-white lg:h-[302px] lg:w-[458px]">
            <h3 class="font-montserrat text-[24px] font-bold leading-[32px]"><?php echo esc_html( $aside_h3 ); ?></h3>
            <p class="mt-6 max-w-[306px] font-montserrat text-[16px] font-normal leading-[24px]"><?php echo esc_html( $aside_p ); ?></p>
        </aside>
    </div>
</section>
