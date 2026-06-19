<?php
/**
 * Render: goliath/hiw-fix-warranty
 *
 * @var array $attributes
 */

$fix_h2_line1      = $attributes['fixH2Line1']      ?? 'Fix the Problem';
$fix_h2_line2      = $attributes['fixH2Line2']      ?? 'Without Stopping Your Business';
$fix_p             = $attributes['fixP']             ?? '';
$warranty_h2_line1 = $attributes['warrantyH2Line1'] ?? 'Our Lifetime';
$warranty_h2_line2 = $attributes['warrantyH2Line2'] ?? 'Impact Warranty';
$warranty_p1       = $attributes['warrantyP1']      ?? '';
$warranty_p2       = $attributes['warrantyP2']      ?? '';
?>
<section class="w-full bg-[#fafafa]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 lg:flex-row lg:gap-[30px] lg:px-[68px] lg:pt-[80px] lg:pb-0 lg:h-[464px]">
        <div class="flex w-full flex-col gap-[16px] p-[20px] lg:w-[657px] lg:h-[218px] lg:shrink-0">
            <h2 class="font-montserrat text-[32px] font-bold leading-[42px] lg:text-[42px] lg:leading-[52px] lg:w-[577px]">
                <span class="text-[#ff5c00]"><?php echo esc_html( $fix_h2_line1 ); ?></span><br>
                <span class="text-[#020202]"><?php echo esc_html( $fix_h2_line2 ); ?></span>
            </h2>
            <p class="max-w-[587px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                <?php echo esc_html( $fix_p ); ?>
            </p>
        </div>
        <div class="flex w-full flex-col gap-[16px] p-[20px] lg:w-[657px] lg:h-[218px] lg:shrink-0">
            <h2 class="font-montserrat text-[32px] font-bold leading-[42px] lg:text-[42px] lg:leading-[52px]">
                <span class="text-[#ff5c00]"><?php echo esc_html( $warranty_h2_line1 ); ?></span><br>
                <span class="text-[#020202]"><?php echo esc_html( $warranty_h2_line2 ); ?></span>
            </h2>
            <div class="max-w-[587px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                <p><?php echo esc_html( $warranty_p1 ); ?></p>
                <p class="mt-2"><?php echo esc_html( $warranty_p2 ); ?></p>
            </div>
        </div>
    </div>
</section>
