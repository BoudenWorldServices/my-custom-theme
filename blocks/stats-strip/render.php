<?php
/**
 * Render callback for goliath/stats-strip.
 *
 * @package MyCustomTheme
 */

$stats = [
    [ 'value' => $attributes['stat1Value'] ?? '70%',      'label' => $attributes['stat1Label'] ?? 'Cost saving vs replacement' ],
    [ 'value' => $attributes['stat2Value'] ?? '30 mins',  'label' => $attributes['stat2Label'] ?? 'Average installation time' ],
    [ 'value' => $attributes['stat3Value'] ?? 'Lifetime', 'label' => $attributes['stat3Label'] ?? 'Structural warranty' ],
    [ 'value' => $attributes['stat4Value'] ?? '',         'label' => $attributes['stat4Label'] ?? '' ],
];

$stats = array_filter( $stats, fn( $s ) => $s['value'] !== '' );

if ( empty( $stats ) ) {
    return;
}

$col_class = count( $stats ) === 4 ? 'lg:grid-cols-4' : ( count( $stats ) === 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-2' );
?>
<section class="w-full bg-[#020202]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[60px]">
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 <?php echo esc_attr( $col_class ); ?>">
            <?php foreach ( $stats as $stat ) : ?>
                <div class="flex flex-col items-center gap-2 text-center">
                    <p class="font-montserrat text-[42px] font-bold leading-[52px] text-[#ff5c00] lg:text-[56px] lg:leading-[64px]">
                        <?php echo esc_html( $stat['value'] ); ?>
                    </p>
                    <p class="font-roboto text-[16px] font-normal leading-[24px] text-white/80">
                        <?php echo esc_html( $stat['label'] ); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
