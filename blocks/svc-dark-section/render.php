<?php
$heading = esc_html($attributes['heading'] ?? '');
$paragraphs = $attributes['paragraphs'] ?? [];
$tick_items = $attributes['tickItems'] ?? [];
$after_list = esc_html($attributes['afterListText'] ?? '');
$callout_icon = $attributes['calloutIcon'] ?? '';
$callout_h = esc_html($attributes['calloutHeading'] ?? '');
$callout_d = esc_html($attributes['calloutDesc'] ?? '');
$bold_text = esc_html($attributes['boldText'] ?? '');
$callout_position = $attributes['calloutPosition'] ?? 'right';
$callout_height = $attributes['calloutHeight'] ?? '';
$callout_text_size = $attributes['calloutTextSize'] ?? '';
$heading_size = $attributes['headingSize'] ?? '';
$paragraph_spacing = $attributes['paragraphSpacing'] ?? '';
$tick = get_theme_file_uri('assets/images/icons/Icon-1.svg');

$h2_classes = 'font-montserrat font-bold text-white';
if ($heading_size === '36') {
    $h2_classes .= ' text-[36px] leading-[40px]';
} else {
    $h2_classes .= ' text-[32px] leading-[40px] lg:text-[36px]';
}

$callout_h_class = $callout_height ? ' lg:h-[' . esc_attr($callout_height) . 'px]' : '';
$callout_py = $callout_height ? 'lg:py-[31px]' : 'lg:py-[32px]';

$p_mt = $paragraph_spacing === '8' ? 'mt-8' : 'mt-7';
?>
<section class="w-full bg-[#020202]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-12 sm:px-6 lg:flex-row lg:justify-between lg:px-[68px] lg:py-[80px]">
        <?php if ($callout_position === 'left') : ?>
            <div class="w-full bg-[#ff5c00] px-8 py-8 lg:w-[436px] lg:px-[32px] <?php echo $callout_py; ?><?php echo $callout_h_class; ?>">
                <?php if ($callout_icon) : ?>
                    <img src="<?php echo esc_url($callout_icon); ?>" alt="" class="h-8 w-8 shrink-0 object-contain" width="32" height="32">
                <?php endif; ?>
                <?php if ($callout_h) : ?>
                    <h3 class="<?php echo $callout_icon ? 'mt-8 ' : ''; ?>font-montserrat text-[24px] font-bold leading-[32px] text-white"><?php echo $callout_h; ?></h3>
                <?php endif; ?>
                <?php if ($callout_d) : ?>
                    <p class="mt-4 font-roboto text-[18px] leading-[28px] text-white"><?php echo $callout_d; ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="w-full lg:max-w-[761px]">
            <?php if ($heading) : ?>
                <h2 class="<?php echo $h2_classes; ?>"><?php echo $heading; ?></h2>
            <?php endif; ?>

            <?php if ($bold_text) : ?>
                <p class="mt-5 font-montserrat text-[16px] font-bold leading-[23px] text-white"><?php echo $bold_text; ?></p>
            <?php endif; ?>

            <?php if (!empty($paragraphs)) : ?>
                <div class="<?php echo $p_mt; ?> font-roboto text-[18px] leading-[28px] text-white">
                    <?php foreach ($paragraphs as $i => $p) : ?>
                        <p<?php echo $i > 0 ? ' class="mt-4"' : ''; ?>><?php echo esc_html($p); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($tick_items)) : ?>
                <ul class="mt-5 space-y-3">
                    <?php foreach ($tick_items as $item) : ?>
                        <li class="flex items-center gap-3">
                            <img src="<?php echo esc_url($tick); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                            <span class="font-roboto text-[16px] leading-[24px] text-white"><?php echo esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if ($after_list) : ?>
                <p class="mt-5 max-w-[523px] font-roboto text-[18px] leading-[28px] text-white"><?php echo $after_list; ?></p>
            <?php endif; ?>
        </div>

        <?php if ($callout_position !== 'left') : ?>
            <div class="w-full bg-[#ff5c00] px-8 py-8 lg:w-[436px] lg:px-[32px] <?php echo $callout_py; ?><?php echo $callout_h_class; ?>">
                <?php if ($callout_icon) : ?>
                    <img src="<?php echo esc_url($callout_icon); ?>" alt="" class="h-8 w-8 shrink-0 object-contain" width="32" height="32">
                <?php endif; ?>
                <?php if ($callout_h) : ?>
                    <h3 class="<?php echo $callout_icon ? 'mt-8 ' : ''; ?>font-montserrat text-[24px] font-bold leading-[32px] text-white"><?php echo $callout_h; ?></h3>
                <?php endif; ?>
                <?php if (!$callout_h && $callout_text_size) : ?>
                    <?php /* Reconfiguration variant: just a paragraph in the callout */ ?>
                    <p class="font-montserrat text-[20px] font-bold leading-[33px] text-white"><?php echo $callout_d; ?></p>
                <?php elseif ($callout_d) : ?>
                    <p class="mt-4 font-roboto text-[18px] leading-[28px] text-white"><?php echo $callout_d; ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
