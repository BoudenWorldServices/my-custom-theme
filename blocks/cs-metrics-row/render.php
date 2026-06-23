<?php
/**
 * Case Study – Metrics Row block — render.php.
 *
 * Attributes:
 *   metric1Value … metric4Value  string  Large display value (e.g. "397", "100%", "£380k").
 *   metric1Label … metric4Label  string  Descriptive label shown below the value.
 *
 * Only metrics with a non-empty value are rendered.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$metrics = [];
for ($n = 1; $n <= 4; $n++) {
    $value = (string) ($attributes["metric{$n}Value"] ?? '');
    $label = (string) ($attributes["metric{$n}Label"] ?? '');
    if ($value !== '') {
        $metrics[] = ['value' => $value, 'label' => $label];
    }
}

if (empty($metrics)) {
    return;
}

$count       = count($metrics);
$col_classes = match ($count) {
    1       => 'grid-cols-1',
    2       => 'grid-cols-2',
    3       => 'grid-cols-1 sm:grid-cols-3',
    default => 'grid-cols-2 lg:grid-cols-4',
};
?>
<section class="w-full bg-[#020202]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[60px]">
        <div class="grid <?php echo esc_attr($col_classes); ?> gap-8 divide-y divide-[#333] sm:divide-y-0 sm:divide-x">
            <?php foreach ($metrics as $i => $metric) : ?>
                <div class="flex flex-col items-center gap-2 pt-8 text-center sm:pt-0 <?php echo $i === 0 ? 'sm:pl-0' : ''; ?>">
                    <span class="font-montserrat text-[48px] font-bold leading-none text-[#ff5c00] lg:text-[56px]">
                        <?php echo esc_html($metric['value']); ?>
                    </span>
                    <?php if ($metric['label'] !== '') : ?>
                        <span class="font-montserrat text-[16px] font-medium leading-[24px] text-white">
                            <?php echo esc_html($metric['label']); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
