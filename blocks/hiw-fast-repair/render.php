<?php
/**
 * Render: goliath/hiw-fast-repair
 *
 * @var array $attributes
 */

$heading  = $attributes['heading'] ?? 'Fast, On-Site Repair with Minimal Disruption';
$para1    = $attributes['para1']   ?? '';
$para2    = $attributes['para2']   ?? '';
$para3    = $attributes['para3']   ?? '';
$box_h3   = $attributes['boxH3']   ?? '30 Minutes Installation';
$box_para = $attributes['boxPara'] ?? '';
?>
<section class="w-full bg-[#f9fafb]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 lg:flex-row lg:items-center lg:justify-between lg:gap-0 lg:px-[68px] lg:py-[80px]">
        <div class="flex w-full flex-col gap-[28px] lg:w-[734px] lg:shrink-0">
            <h2 class="max-w-[648px] font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html( $heading ); ?>
            </h2>
            <?php if ( $para1 ) : ?>
                <p class="max-w-[722px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html( $para1 ); ?>
                </p>
            <?php endif; ?>
            <?php if ( $para2 ) : ?>
                <p class="max-w-[720px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html( $para2 ); ?>
                </p>
            <?php endif; ?>
            <?php if ( $para3 ) : ?>
                <p class="max-w-[720px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html( $para3 ); ?>
                </p>
            <?php endif; ?>
        </div>
        <div class="w-full bg-[#ff5c00] px-[32px] py-[30px] lg:w-[392px] lg:shrink-0">
            <div class="flex flex-col gap-[8px]">
                <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-white">
                    <?php echo esc_html( $box_h3 ); ?>
                </h3>
                <p class="max-w-[328px] font-roboto text-[18px] font-normal leading-[28px] text-white">
                    <?php echo esc_html( $box_para ); ?>
                </p>
            </div>
        </div>
    </div>
</section>
