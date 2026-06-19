<?php
$heading = esc_html($attributes['heading'] ?? '');
$intro = $attributes['introParagraphs'] ?? [];
$columns = $attributes['columns'] ?? 4;
$cards = $attributes['cards'] ?? [];
$dark_callout = esc_html($attributes['darkCallout'] ?? '');
$dark_highlight = esc_html($attributes['darkCalloutHighlight'] ?? '');
$after_text = esc_html($attributes['afterText'] ?? '');
$card_icon_type = $attributes['cardIcon'] ?? 'safe';
$intro_spacing = $attributes['introSpacing'] ?? '6';
$grid_spacing = $attributes['gridSpacing'] ?? '10';
$container_padding = $attributes['containerPadding'] ?? '';

$icon_safe = get_theme_file_uri('assets/images/icons/safe.svg');
$icon_tick = get_theme_file_uri('assets/images/icons/Icon-1.svg');

$col_class = $columns === 3 ? 'sm:grid-cols-2 lg:grid-cols-3' : 'lg:grid-cols-4';
$py_class = $container_padding === 'equal' ? 'lg:py-[80px]' : 'lg:pb-[90px] lg:pt-[80px]';
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] <?php echo $py_class; ?>">
        <?php if ($heading) : ?>
            <h2 class="max-w-[896px] font-montserrat text-[36px] font-bold leading-[40px] text-[#020202]"><?php echo $heading; ?></h2>
        <?php endif; ?>

        <?php foreach ($intro as $i => $p) : ?>
            <p class="mt-<?php echo $intro_spacing; ?> max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html($p); ?></p>
        <?php endforeach; ?>

        <?php if (!empty($cards)) : ?>
            <div class="mt-<?php echo $grid_spacing; ?> grid grid-cols-1 gap-6 <?php echo $col_class; ?> lg:gap-6">
                <?php foreach ($cards as $card) : ?>
                    <article class="bg-[#f9fafb] p-6">
                        <?php if ($card_icon_type === 'tick') : ?>
                            <img src="<?php echo esc_url($icon_tick); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                        <?php else : ?>
                            <img src="<?php echo esc_url($icon_safe); ?>" alt="" class="size-8">
                        <?php endif; ?>
                        <h3 class="mt-4 font-montserrat text-[18px] font-bold leading-[27px] text-[#020202]"><?php echo esc_html($card['title'] ?? ''); ?></h3>
                        <?php if (!empty($card['desc'])) : ?>
                            <p class="mt-2 font-roboto text-[14px] leading-[20px] text-[#364153]"><?php echo esc_html($card['desc']); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($dark_callout) : ?>
            <div class="mt-6 bg-[#020202] px-8 py-8">
                <p class="font-roboto text-[18px] leading-[28px] text-white"><?php echo $dark_callout; ?></p>
                <?php if ($dark_highlight) : ?>
                    <p class="mt-4 font-roboto text-[20px] font-bold leading-[28px] text-[#ff5c00]"><?php echo $dark_highlight; ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($after_text) : ?>
            <p class="mt-6 max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo $after_text; ?></p>
        <?php endif; ?>
    </div>
</section>
