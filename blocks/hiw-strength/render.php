<?php
/**
 * Render: goliath/hiw-strength
 *
 * @var array $attributes
 */

$heading = $attributes['heading'] ?? 'Strength Where It Matters Most';
$para1   = $attributes['para1']   ?? '';
$para2   = $attributes['para2']   ?? '';
$box     = $attributes['box']     ?? '';
$tagline = $attributes['tagline'] ?? '';
?>
<section class="w-full bg-black">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-[42px] px-5 py-10 text-center lg:px-[219px] lg:py-[80px]">
        <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-white lg:text-[36px]">
            <?php echo esc_html( $heading ); ?>
        </h2>
        <?php if ( $para1 ) : ?>
            <p class="font-roboto text-[18px] font-normal leading-[28px] text-white">
                <?php echo esc_html( $para1 ); ?>
            </p>
        <?php endif; ?>
        <?php if ( $para2 ) : ?>
            <p class="max-w-[896px] font-roboto text-[18px] font-normal leading-[28px] text-white">
                <?php echo esc_html( $para2 ); ?>
            </p>
        <?php endif; ?>
        <?php if ( $box ) : ?>
            <div class="w-full bg-[#ff5c00] p-[32px] text-center">
                <p class="max-w-[832px] font-roboto text-[18px] font-normal leading-[28px] text-white mx-auto">
                    <?php echo esc_html( $box ); ?>
                </p>
            </div>
        <?php endif; ?>
        <?php if ( $tagline ) : ?>
            <p class="max-w-[896px] font-montserrat text-[20px] font-bold leading-[32px] text-[#ff5c00] lg:text-[22px] lg:leading-[34px]">
                <?php echo esc_html( $tagline ); ?>
            </p>
        <?php endif; ?>
    </div>
</section>
