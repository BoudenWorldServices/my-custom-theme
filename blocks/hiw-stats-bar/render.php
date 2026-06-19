<?php
/**
 * Render: goliath/hiw-stats-bar
 *
 * @var array $attributes
 */

$stats = [
    [
        'value' => $attributes['stat1Value'] ?? '30 Minutes',
        'label' => $attributes['stat1Label'] ?? 'Installation',
    ],
    [
        'value' => $attributes['stat2Value'] ?? 'Lifetime',
        'label' => $attributes['stat2Label'] ?? 'Warranty',
    ],
    [
        'value' => $attributes['stat3Value'] ?? '100%',
        'label' => $attributes['stat3Label'] ?? 'UK Compliance',
    ],
    [
        'value' => $attributes['stat4Value'] ?? 'Minimal',
        'label' => $attributes['stat4Label'] ?? 'Downtime',
    ],
];
?>
<section class="w-full border-b border-[#e8e8e9] bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-6 pb-4 lg:px-[68px] lg:pt-[40px] lg:pb-px lg:h-[139px]">
        <div class="flex flex-wrap items-start justify-between">
            <?php foreach ( $stats as $i => $stat ) :
                $border = $i < 3 ? 'lg:border-r lg:border-[#e8e8e9]' : '';
                $width  = $i < 3 ? 'lg:w-[279.75px] lg:pr-[41px]' : 'lg:w-[238.75px]';
            ?>
                <div class="flex w-1/2 flex-col gap-[4px] py-3 lg:h-[58px] lg:w-auto lg:py-0 <?php echo esc_attr( $border . ' ' . $width ); ?>">
                    <p class="font-montserrat text-[12px] font-normal leading-[18px] text-[#666]"><?php echo esc_html( $stat['label'] ); ?></p>
                    <p class="font-montserrat text-[20px] font-bold leading-[36px] text-[#020202] lg:text-[24px]"><?php echo esc_html( $stat['value'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
