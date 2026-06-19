<?php
/**
 * Render: goliath/comp-proven
 *
 * @var array $attributes
 */

$heading = $attributes['heading'] ?? '';
$p1      = $attributes['p1']      ?? '';
$p2      = $attributes['p2']      ?? '';
$case_h3 = $attributes['caseH3']  ?? '';
$case_p  = $attributes['caseP']   ?? '';
?>
<section class="w-full bg-[#f9fafb]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:justify-between lg:px-[68px] lg:py-[80px]">
        <div class="w-full lg:w-[632px]">
            <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html( $heading ); ?></h2>
            <div class="mt-6 font-montserrat text-[18px] font-normal leading-[28px] text-[#364153]">
                <?php if ( $p1 ) : ?><p><?php echo esc_html( $p1 ); ?></p><?php endif; ?>
                <?php if ( $p2 ) : ?><p><?php echo esc_html( $p2 ); ?></p><?php endif; ?>
            </div>
        </div>
        <aside class="w-full bg-[#020202] px-[32px] py-[32px] text-white lg:h-[248px] lg:w-[640px]">
            <h3 class="font-montserrat text-[24px] font-bold leading-[32px]"><?php echo esc_html( $case_h3 ); ?></h3>
            <p class="mt-4 font-montserrat text-[18px] font-normal leading-[28px]"><?php echo esc_html( $case_p ); ?></p>
        </aside>
    </div>
</section>
