<?php
/**
 * Block: goliath/wg-compatible-systems
 * Why Goliath – Compatible Systems — white section with two-column bullet grid.
 */

$heading = $attributes['heading'] ?? 'Compatible with All Major Racking Systems';
$p1      = $attributes['p1']      ?? 'Warehouses are built differently, and so are racking systems.';
$p2      = $attributes['p2']      ?? 'Goliath™ retrofits to all major pallet racking systems used in the UK, making it a flexible solution for different industries and layouts. This allows you to upgrade your existing racks without having to replace the entire structure.';
$bold    = $attributes['bold']    ?? 'Goliath™ is suitable for:';
$items   = $attributes['items']   ?? ['Distribution centres', 'Logistics operations', 'Retail warehouses', 'Manufacturing facilities', 'Cold food stores', 'FMCG'];

$compat_rows = array_chunk($items, 2);
?>
<section class="w-full bg-white py-10 lg:h-[545px] lg:py-0">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-10 sm:px-6 lg:flex-row lg:items-center lg:gap-[90px] lg:px-[68px] lg:py-[80px]">
        <div class="w-full pt-0 lg:w-[896px] lg:pt-[80px]">
            <h2 class="mb-[24px] font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html($heading); ?>
            </h2>
            <p class="mb-[24px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                <?php echo esc_html($p1); ?>
            </p>
            <p class="mb-[32px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                <?php echo esc_html($p2); ?>
            </p>
            <p class="mb-[24px] font-roboto text-[20px] font-bold leading-[28px] text-[#020202]">
                <?php echo esc_html($bold); ?>
            </p>
            <div class="flex flex-col gap-[16px]">
                <?php foreach ($compat_rows as $row) : ?>
                    <div class="flex flex-col gap-4 lg:flex-row lg:gap-0">
                        <div class="flex w-full items-center gap-[12px] lg:w-[440px]">
                            <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-bullet-dark.svg')); ?>" alt="" class="size-6 shrink-0">
                            <span class="font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($row[0]); ?></span>
                        </div>
                        <?php if ( isset($row[1]) ) : ?>
                            <div class="flex w-full items-center gap-[12px] lg:ml-[16px] lg:w-[440px]">
                                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-bullet-dark.svg')); ?>" alt="" class="size-6 shrink-0">
                                <span class="font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($row[1]); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
