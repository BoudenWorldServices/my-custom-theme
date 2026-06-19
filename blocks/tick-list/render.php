<?php
/**
 * Render: goliath/tick-list
 *
 * @var array $attributes
 */

$heading    = $attributes['heading'] ?? '';
$items      = $attributes['items'] ?? [];
$columns    = $attributes['columns'] ?? '1';
$theme      = $attributes['theme'] ?? 'light';
$background = $attributes['background'] ?? 'none';

$items = array_filter( $items, fn( $i ) => ! empty( $i['text'] ) );

if ( empty( $items ) ) {
    return;
}

$bg_classes   = [ 'none' => '', 'white' => 'bg-white', 'gray' => 'bg-[#f9fafb]' ];
$text_classes  = $theme === 'dark' ? 'text-white' : 'text-[#364153]';
$tick_class    = $theme === 'dark' ? 'text-white' : 'text-[#ff5c00]';
$grid_cols     = $columns === '2' ? 'sm:grid-cols-2' : 'grid-cols-1';
$section_bg    = $bg_classes[ $background ] ?? '';
?>
<section class="w-full <?php echo esc_attr( $section_bg ); ?>">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[60px]">
        <?php if ( $heading ) : ?>
            <h2 class="mb-8 font-montserrat text-[24px] font-bold leading-[32px] text-[#020202] <?php echo $theme === 'dark' ? 'text-white' : 'text-[#020202]'; ?> lg:text-[30px] lg:leading-[38px]">
                <?php echo esc_html( $heading ); ?>
            </h2>
        <?php endif; ?>
        <ul class="grid grid-cols-1 <?php echo esc_attr( $grid_cols ); ?> gap-y-4 gap-x-10">
            <?php foreach ( $items as $item ) : ?>
                <li class="flex items-start gap-3">
                    <svg class="mt-0.5 size-5 shrink-0 <?php echo esc_attr( $tick_class ); ?>" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-roboto text-[16px] leading-[26px] <?php echo esc_attr( $text_classes ); ?>">
                        <?php echo esc_html( $item['text'] ); ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
