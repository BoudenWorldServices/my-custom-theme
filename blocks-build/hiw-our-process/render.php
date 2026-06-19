<?php
/**
 * Render: goliath/hiw-our-process
 *
 * @var array $attributes
 */

$heading = $attributes['heading'] ?? 'Our Installation Process';
$para1   = $attributes['para1']   ?? '';
$para2   = $attributes['para2']   ?? '';
$para3   = $attributes['para3']   ?? '';
$para4   = $attributes['para4']   ?? '';
$quote   = $attributes['quote']   ?? '';
?>
<section class="w-full bg-white" aria-labelledby="our-installation-process-heading">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 lg:flex-row lg:items-stretch lg:justify-between lg:gap-0 lg:px-[68px] lg:py-[55px]">
        <div class="flex w-full flex-col gap-[28px] lg:w-[734px] lg:shrink-0">
            <h2 id="our-installation-process-heading" class="max-w-[648px] font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html( $heading ); ?>
            </h2>
            <div class="max-w-[722px] space-y-4 font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                <?php if ( $para1 ) : ?>
                    <p><?php echo esc_html( $para1 ); ?></p>
                <?php endif; ?>
                <?php if ( $para2 ) : ?>
                    <p><?php echo esc_html( $para2 ); ?></p>
                <?php endif; ?>
                <?php if ( $para3 ) : ?>
                    <p><?php echo esc_html( $para3 ); ?></p>
                <?php endif; ?>
                <?php if ( $para4 ) : ?>
                    <p><?php echo esc_html( $para4 ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="flex w-full items-center justify-center bg-[#020202] px-[32px] py-[30px] lg:w-[392px] lg:shrink-0 lg:self-stretch">
            <p class="max-w-[310px] text-center font-roboto text-[20px] font-bold leading-[28px] text-white">
                <?php echo esc_html( $quote ); ?>
            </p>
        </div>
    </div>
</section>
