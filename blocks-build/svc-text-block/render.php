<?php
$bg = $attributes['bgColor'] ?? 'white';
$bg_class = $bg === 'grey' ? 'bg-[#f9fafb]' : 'bg-white';
$align = $attributes['align'] ?? 'center';
$icon = $attributes['icon'] ?? '';
$heading = esc_html($attributes['heading'] ?? '');
$paragraphs = $attributes['paragraphs'] ?? [];
$highlight = esc_html($attributes['highlight'] ?? '');
$highlight_pos = $attributes['highlightPosition'] ?? 'after-first';
$tick_items = $attributes['tickItems'] ?? [];
$after_list = esc_html($attributes['afterListText'] ?? '');
$cta_text = esc_html($attributes['ctaText'] ?? '');
$cta_url = esc_url($attributes['ctaUrl'] ?? '');
$stats_banner = esc_html($attributes['statsBanner'] ?? '');
$stats_cta_text = esc_html($attributes['statsBannerCtaText'] ?? '');
$stats_cta_url = esc_url($attributes['statsBannerCtaUrl'] ?? '');

$tick_icon = get_theme_file_uri('assets/images/icons/Icon-1.svg');
$cta_arrow = get_theme_file_uri('assets/images/icons/cta-arrow-right.svg');

$is_centered = ($align === 'center');
$container_py = $is_centered ? 'lg:py-[60px]' : 'lg:pt-[80px] lg:pb-[80px]';
?>
<section class="w-full <?php echo $bg_class; ?>">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] <?php echo $container_py; ?>">
        <?php if ($is_centered) : ?>
            <div class="flex flex-col items-center text-center">
                <?php if ($heading) : ?>
                    <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo $heading; ?></h2>
                <?php endif; ?>
                <div class="mt-8 max-w-[1228px] font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]">
                    <?php foreach ($paragraphs as $i => $p) :
                        $p_text = esc_html($p);
                        if ($highlight && $highlight_pos === 'after-first' && $i === 0) : ?>
                            <p><?php echo $p_text; ?></p>
                            <p class="mt-4 font-montserrat text-[20px] font-bold leading-[23px] text-[#ff5c00]"><?php echo $highlight; ?></p>
                        <?php else : ?>
                            <p class="mt-4"><?php echo $p_text; ?></p>
                        <?php endif;
                    endforeach; ?>
                </div>
                <?php if ($cta_text && $cta_url) : ?>
                    <a href="<?php echo $cta_url; ?>" class="mt-8 inline-flex h-[52px] w-full items-center justify-center bg-[#ff5c00] font-roboto text-[14px] font-bold uppercase tracking-[0.35px] text-white sm:w-[247px]">
                        <span><?php echo $cta_text; ?></span>
                        <img src="<?php echo esc_url($cta_arrow); ?>" alt="" class="ml-3 size-5">
                    </a>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <div class="flex w-full max-w-[808px] flex-col items-start gap-4 text-left lg:gap-4">
                <?php if ($icon) : ?>
                    <img src="<?php echo esc_url($icon); ?>" alt="" class="size-12 shrink-0 sm:size-14" width="56" height="56" aria-hidden="true">
                <?php endif; ?>

                <?php if ($heading) : ?>
                    <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#020202] lg:text-[46px] lg:leading-[44px] xl:whitespace-nowrap"><?php echo $heading; ?></h2>
                <?php endif; ?>

                <?php
                foreach ($paragraphs as $i => $p) :
                    $p_text = esc_html($p);
                    if ($highlight && $highlight_pos === 'after-first' && $i === 0) : ?>
                        <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]"><?php echo $p_text; ?></p>
                        <p class="w-full font-roboto text-[20px] font-bold leading-[28px] text-[#ff5c00]"><?php echo $highlight; ?></p>
                    <?php else : ?>
                        <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]"><?php echo $p_text; ?></p>
                    <?php endif;
                endforeach; ?>

                <?php if (!empty($tick_items)) : ?>
                    <ul class="grid w-full grid-cols-1 gap-x-8 gap-y-3 pt-1 sm:grid-cols-2 sm:gap-x-[44px] sm:gap-y-4">
                        <?php foreach ($tick_items as $item) : ?>
                            <li class="flex items-center gap-3">
                                <img src="<?php echo esc_url($tick_icon); ?>" alt="" class="size-6 shrink-0" width="24" height="24" aria-hidden="true">
                                <span class="font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php if ($highlight && $highlight_pos === 'after-list') : ?>
                    <p class="w-full pt-1 font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]"><?php echo $highlight; ?></p>
                <?php endif; ?>

                <?php if ($after_list) : ?>
                    <p class="w-full pt-1 font-roboto text-[18px] font-normal leading-[28px] text-[#364153]"><?php echo $after_list; ?></p>
                <?php endif; ?>

                <?php if ($cta_text && $cta_url) : ?>
                    <a href="<?php echo $cta_url; ?>" class="mt-8 inline-flex h-[52px] w-full items-center justify-center bg-[#ff5c00] font-roboto text-[14px] font-bold uppercase tracking-[0.35px] text-white sm:w-[247px]">
                        <span><?php echo $cta_text; ?></span>
                        <img src="<?php echo esc_url($cta_arrow); ?>" alt="" class="ml-3 size-5">
                    </a>
                <?php endif; ?>
            </div>

            <?php if ($stats_banner) : ?>
                <div class="mt-8 bg-[#e8e8e9] px-5 py-5 lg:h-[104px] lg:px-[38px] lg:py-0">
                    <div class="flex h-full w-full flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <p class="font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]"><?php echo $stats_banner; ?></p>
                        <?php if ($stats_cta_text && $stats_cta_url) : ?>
                            <a href="<?php echo $stats_cta_url; ?>" class="inline-flex h-[52px] w-full items-center justify-center bg-[#020202] font-roboto text-[16px] font-semibold text-white sm:w-[286px]">
                                <span><?php echo $stats_cta_text; ?></span>
                                <img src="<?php echo esc_url($cta_arrow); ?>" alt="" class="ml-8 size-5">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
