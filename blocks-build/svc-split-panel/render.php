<?php
$bg = $attributes['bgColor'] ?? 'grey';
$bg_class = $bg === 'dark' ? 'bg-[#020202]' : ($bg === 'light-grey' ? 'bg-[#f9fafb]' : ($bg === 'grey' ? 'bg-[#f8f8f8]' : 'bg-white'));
$text_color = $bg === 'dark' ? 'text-white' : 'text-[#364153]';
$heading_color = $bg === 'dark' ? 'text-white' : 'text-[#020202]';
$heading = esc_html($attributes['heading'] ?? '');
$paragraphs = $attributes['paragraphs'] ?? [];
$sub_heading = esc_html($attributes['subHeading'] ?? '');
$tick_items = $attributes['tickItems'] ?? [];
$callout = esc_html($attributes['calloutText'] ?? '');
$callout_desc = esc_html($attributes['calloutDesc'] ?? '');
$image = $attributes['image'] ?? '';
$image_alt = esc_attr($attributes['imageAlt'] ?? '');
$image_pos = $attributes['imagePosition'] ?? 'right';
$cta_text = esc_html($attributes['ctaText'] ?? '');
$cta_url = esc_url($attributes['ctaUrl'] ?? '');
$variant = $attributes['variant'] ?? 'default';
$intro_text = esc_html($attributes['introText'] ?? '');
$tick_icon = get_theme_file_uri('assets/images/icons/Icon-1.svg');
$cta_arrow = get_theme_file_uri('assets/images/icons/cta-arrow-right.svg');

$has_text_content = $heading || !empty($paragraphs) || $sub_heading || !empty($tick_items) || ($cta_text && $cta_url);
$is_image_callout_only = $image && $callout && !$has_text_content && $variant === 'default';
?>
<?php if ($variant === 'two-cards') : ?>
<section class="w-full <?php echo $bg_class; ?>">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
        <?php if ($intro_text) : ?>
            <p class="font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]"><?php echo $intro_text; ?></p>
        <?php endif; ?>
        <div class="mt-10 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-8">
            <article class="bg-[#f9fafb] p-8">
                <?php if ($heading) : ?>
                    <h2 class="font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo $heading; ?></h2>
                <?php endif; ?>
                <?php if (!empty($tick_items)) : ?>
                    <ul class="mt-6 space-y-3">
                        <?php foreach ($tick_items as $item) : ?>
                            <li class="flex items-start gap-3">
                                <img src="<?php echo esc_url($tick_icon); ?>" alt="" class="mt-1 h-6 w-6 shrink-0" width="24" height="24">
                                <span class="font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </article>
            <article class="bg-[#ff5c00] p-8">
                <p class="font-montserrat text-[36px] font-bold leading-[44px] text-white"><?php echo $callout; ?></p>
            </article>
        </div>
    </div>
</section>
<?php elseif ($is_image_callout_only) : ?>
<section class="w-full <?php echo $bg_class; ?>">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col px-5 py-10 sm:px-6 lg:flex-row lg:items-stretch lg:px-[68px] lg:py-[64px]">
        <?php if ($image_pos === 'left') : ?>
            <div class="h-[460px] min-h-[400px] w-full overflow-hidden sm:h-[540px] sm:min-h-[480px] lg:h-[640px] lg:min-h-[640px] xl:h-[680px] xl:min-h-[680px] lg:flex-1">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo $image_alt; ?>" class="h-full w-full object-cover object-bottom">
            </div>
        <?php endif; ?>
        <div class="flex min-h-[460px] w-full items-center justify-center bg-[#ff5c00] px-8 py-12 text-center sm:min-h-[540px] lg:min-h-[640px] xl:min-h-[680px] lg:flex-1 lg:py-14">
            <div>
                <p class="font-montserrat text-[32px] font-bold leading-[44px] text-white lg:text-[36px]"><?php echo $callout; ?></p>
                <?php if ($callout_desc) : ?>
                    <p class="mt-4 font-montserrat text-[16px] font-medium leading-[23px] text-white"><?php echo $callout_desc; ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($image_pos === 'right') : ?>
            <div class="h-[460px] min-h-[400px] w-full overflow-hidden sm:h-[540px] sm:min-h-[480px] lg:h-[640px] lg:min-h-[640px] xl:h-[680px] xl:min-h-[680px] lg:flex-1">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo $image_alt; ?>" class="h-full w-full object-cover object-bottom">
            </div>
        <?php endif; ?>
    </div>
</section>
<?php else : ?>
<section class="w-full <?php echo $bg_class; ?>">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-12 sm:px-6 lg:flex-row lg:justify-between lg:gap-10 lg:px-[68px] lg:py-[55px]">
        <?php if ($image && $image_pos === 'left') : ?>
            <div class="w-full overflow-hidden lg:h-[427px] lg:w-[640px]">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo $image_alt; ?>" class="h-full w-full object-cover">
            </div>
        <?php endif; ?>

        <div class="w-full lg:max-w-[684px]">
            <?php if ($heading) : ?>
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] <?php echo $heading_color; ?> lg:text-[36px] lg:leading-[44px]"><?php echo $heading; ?></h2>
            <?php endif; ?>

            <?php foreach ($paragraphs as $i => $p) : ?>
                <p class="<?php echo $i === 0 ? 'mt-7' : 'mt-5'; ?> font-roboto text-[18px] leading-[28px] <?php echo $text_color; ?>"><?php echo esc_html($p); ?></p>
            <?php endforeach; ?>

            <?php if ($sub_heading) : ?>
                <h3 class="mt-8 font-montserrat text-[24px] font-bold leading-[32px] <?php echo $heading_color; ?>"><?php echo $sub_heading; ?></h3>
            <?php endif; ?>

            <?php if (!empty($tick_items)) : ?>
                <div class="mt-4 grid grid-cols-1 gap-x-[40px] gap-y-4 sm:grid-cols-2">
                    <?php foreach ($tick_items as $item) : ?>
                        <div class="flex items-center gap-3">
                            <img src="<?php echo esc_url($tick_icon); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                            <span class="font-roboto text-[16px] leading-[24px] <?php echo $text_color; ?>"><?php echo esc_html($item); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($cta_text && $cta_url) : ?>
                <a href="<?php echo $cta_url; ?>" class="mt-8 inline-flex h-[52px] items-center bg-[#ff5c00] px-[32px] font-roboto text-[14px] font-bold uppercase tracking-[0.35px] text-white">
                    <span><?php echo $cta_text; ?></span>
                    <img src="<?php echo esc_url($cta_arrow); ?>" alt="" class="ml-3 size-5">
                </a>
            <?php endif; ?>
        </div>

        <?php if ($callout) : ?>
            <div class="w-full bg-[#ff5c00] px-8 py-8 lg:w-[532px] lg:px-[32px] lg:py-[30px]">
                <p class="font-montserrat text-[32px] font-bold leading-[44px] text-white lg:text-[36px]"><?php echo $callout; ?></p>
                <?php if ($callout_desc) : ?>
                    <p class="mt-4 font-montserrat text-[16px] font-medium leading-[23px] text-white"><?php echo $callout_desc; ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($image && $image_pos === 'right') : ?>
            <div class="w-full overflow-hidden lg:h-[427px] lg:w-[640px]">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo $image_alt; ?>" class="h-full w-full object-cover">
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
