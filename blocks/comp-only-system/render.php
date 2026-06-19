<?php
/**
 * Render: goliath/comp-only-system
 *
 * @var array $attributes
 */

$left_h2  = $attributes['leftH2']  ?? '';
$left_p1  = $attributes['leftP1']  ?? '';
$left_p2  = $attributes['leftP2']  ?? '';
$right_h3 = $attributes['rightH3'] ?? '';
$right_p1 = $attributes['rightP1'] ?? '';
$right_p2 = $attributes['rightP2'] ?? '';
?>
<section class="w-full bg-[#ff5c00]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[80px]">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-stretch lg:gap-[80px]">
            <div class="flex min-w-0 flex-1 flex-col lg:basis-0">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[36px]"><?php echo esc_html( $left_h2 ); ?></h2>
                <p class="mt-6 font-montserrat text-[20px] font-normal leading-[28px] text-white"><?php echo esc_html( $left_p1 ); ?></p>
                <p class="mt-4 font-montserrat text-[18px] font-normal leading-[28px] text-white"><?php echo esc_html( $left_p2 ); ?></p>
            </div>
            <div class="flex min-w-0 flex-1 flex-col bg-[#ff8f66] px-8 py-8 lg:basis-0 lg:px-[32px] lg:py-[32px]">
                <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-white"><?php echo esc_html( $right_h3 ); ?></h3>
                <p class="mt-4 font-montserrat text-[18px] font-normal leading-[28px] text-white"><?php echo esc_html( $right_p1 ); ?></p>
                <p class="mt-3 font-montserrat text-[18px] font-normal leading-[28px] text-white"><?php echo esc_html( $right_p2 ); ?></p>
            </div>
        </div>
    </div>
</section>
