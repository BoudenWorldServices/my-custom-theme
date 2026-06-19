<?php
$a1_icon = $attributes['article1Icon'] ?? '';
$a1_h = esc_html($attributes['article1Heading'] ?? '');
$a1_paras = $attributes['article1Paragraphs'] ?? [];
$a1_bold = esc_html($attributes['article1Bold'] ?? '');
$a1_sub = esc_html($attributes['article1SubHeading'] ?? '');
$a1_items = $attributes['article1Items'] ?? [];
$a2_icon = $attributes['article2Icon'] ?? '';
$a2_h = esc_html($attributes['article2Heading'] ?? '');
$a2_paras = $attributes['article2Paragraphs'] ?? [];
$a2_bold = esc_html($attributes['article2Bold'] ?? '');
$a2_sub = esc_html($attributes['article2SubHeading'] ?? '');
$a2_items = $attributes['article2Items'] ?? [];
$banner = esc_html($attributes['bannerText'] ?? '');
$tick = get_theme_file_uri('assets/images/icons/Icon-1.svg');
?>
<section class="w-full bg-white">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-12 sm:px-6 lg:flex-row lg:gap-[74px] lg:px-[68px] lg:py-[80px]">
        <article class="w-full">
            <?php if ($a1_icon) : ?>
                <img src="<?php echo esc_url($a1_icon); ?>" alt="" class="h-12 w-12 shrink-0 object-contain" width="48" height="49">
            <?php endif; ?>
            <?php if ($a1_h) : ?>
                <h2 class="<?php echo $a1_icon ? 'mt-6' : ''; ?> font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo $a1_h; ?></h2>
            <?php endif; ?>
            <div class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]">
                <?php foreach ($a1_paras as $i => $p) : ?>
                    <p<?php echo $i > 0 ? ' class="mt-2"' : ''; ?>><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
                <?php if ($a1_bold) : ?>
                    <p class="mt-4 font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]"><?php echo $a1_bold; ?></p>
                <?php endif; ?>
            </div>
            <?php if ($a1_sub) : ?>
                <h3 class="mt-6 font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo $a1_sub; ?></h3>
            <?php endif; ?>
            <?php if (!empty($a1_items)) : ?>
                <ul class="mt-6 space-y-3">
                    <?php foreach ($a1_items as $item) : ?>
                        <li class="flex items-center gap-3">
                            <img src="<?php echo esc_url($tick); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                            <span class="font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </article>
        <article class="w-full">
            <?php if ($a2_icon) : ?>
                <img src="<?php echo esc_url($a2_icon); ?>" alt="" class="h-12 w-12 shrink-0 object-contain" width="40" height="40">
            <?php endif; ?>
            <?php if ($a2_h) : ?>
                <h2 class="<?php echo $a2_icon ? 'mt-6' : ''; ?> font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo $a2_h; ?></h2>
            <?php endif; ?>
            <div class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]">
                <?php foreach ($a2_paras as $i => $p) : ?>
                    <p<?php echo $i > 0 ? ' class="mt-2"' : ''; ?>><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
                <?php if ($a2_bold) : ?>
                    <p class="mt-2 font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]"><?php echo $a2_bold; ?></p>
                <?php endif; ?>
            </div>
            <?php if ($a2_sub) : ?>
                <h3 class="mt-6 font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo $a2_sub; ?></h3>
            <?php endif; ?>
            <?php if (!empty($a2_items)) : ?>
                <ul class="mt-6 space-y-3">
                    <?php foreach ($a2_items as $item) : ?>
                        <li class="flex items-center gap-3">
                            <img src="<?php echo esc_url($tick); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                            <span class="font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </article>
    </div>
    <?php if ($banner) : ?>
        <div class="mx-auto w-full max-w-[1440px] px-5 sm:px-6 lg:px-[68px]">
            <div class="bg-[#ff5c00] px-8 py-8">
                <p class="font-montserrat text-[20px] font-bold leading-[44px] text-white"><?php echo $banner; ?></p>
            </div>
        </div>
    <?php endif; ?>
</section>
