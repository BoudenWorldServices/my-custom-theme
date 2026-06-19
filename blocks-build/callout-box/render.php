<?php
/**
 * Render: goliath/callout-box
 *
 * @var array $attributes
 */

$text       = $attributes['text'] ?? '';
$subtext    = $attributes['subtext'] ?? '';
$theme      = $attributes['theme'] ?? 'orange';
$show_arrow = (bool) ( $attributes['showArrow'] ?? true );
$layout     = $attributes['layout'] ?? 'full-width';

if ( ! $text ) {
    return;
}

$bg_classes   = [ 'orange' => 'bg-[#ff5c00]', 'dark' => 'bg-[#020202]', 'gray' => 'bg-[#f3f4f6]' ];
$text_classes = [ 'orange' => 'text-white', 'dark' => 'text-white', 'gray' => 'text-[#020202]' ];
$sub_classes  = [ 'orange' => 'text-white/80', 'dark' => 'text-white/70', 'gray' => 'text-[#364153]' ];

$outer_class = $layout === 'inset' ? 'px-5 sm:px-6 lg:px-[68px]' : '';
?>
<div class="w-full <?php echo esc_attr( $outer_class ); ?>">
    <div class="<?php echo esc_attr( $bg_classes[ $theme ] ?? 'bg-[#ff5c00]' ); ?> flex items-center justify-between gap-6 px-8 py-7 lg:px-[68px] lg:py-9">
        <div>
            <p class="font-montserrat text-[18px] font-bold leading-[28px] <?php echo esc_attr( $text_classes[ $theme ] ?? 'text-white' ); ?> lg:text-[20px] lg:leading-[30px]">
                <?php echo esc_html( $text ); ?>
            </p>
            <?php if ( $subtext ) : ?>
                <p class="mt-1 font-roboto text-[15px] leading-[24px] <?php echo esc_attr( $sub_classes[ $theme ] ?? 'text-white/80' ); ?>">
                    <?php echo esc_html( $subtext ); ?>
                </p>
            <?php endif; ?>
        </div>
        <?php if ( $show_arrow ) : ?>
            <svg class="size-8 shrink-0 <?php echo esc_attr( $text_classes[ $theme ] ?? 'text-white' ); ?>" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                <path d="M6 16h20M18 8l8 8-8 8"/>
            </svg>
        <?php endif; ?>
    </div>
</div>
