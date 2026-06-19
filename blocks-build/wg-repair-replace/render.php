<?php
/**
 * Block: goliath/wg-repair-replace
 * Why Goliath – Repair vs Replace — dark section with two-column layout and orange quote box.
 */

$heading      = $attributes['heading']      ?? 'Repair with Goliath™ vs. Replace the Upright';
$subtitle     = $attributes['subtitle']     ?? 'Why repair with Goliath™ vs. replace upright?';
$p1           = $attributes['p1']           ?? 'Replacing an upright restores it to an original, damage-free product. But it does not reduce or improve its resistance to impact. It merely restarts the process.';
$p2           = $attributes['p2']           ?? 'Goliath™ is built for high-traffic warehouse environments where impact is unavoidable.';
$p3           = $attributes['p3']           ?? 'With Goliath™, the focus shifts from reactive maintenance to proactive support, which reduces downtime and cuts costs.';
$quote        = $attributes['quote']        ?? 'Instead of resetting the problem, which replacement does, Goliath™ solves it.';
$quoteBullets = $attributes['quoteBullets'] ?? ['Manufactured from 6mm structural steel', 'Designed with a 100% overloading safety factor', 'Engineered to withstand repeated forklift impacts'];
?>
<section class="w-full bg-[#020202]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-10 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:gap-0 lg:px-[68px] lg:py-[80px]">
        <div class="flex w-full flex-col gap-[14px] lg:w-[685px] lg:shrink-0">
            <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-white lg:text-[36px]">
                <?php echo esc_html($heading); ?>
            </h2>
            <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#d1d5dc]">
                <?php echo esc_html($subtitle); ?>
            </p>
            <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#d1d5dc] lg:text-[20px]">
                <?php echo esc_html($p1); ?>
            </p>
            <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#d1d5dc]">
                <?php echo esc_html($p2); ?>
            </p>
            <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#d1d5dc]">
                <?php echo esc_html($p3); ?>
            </p>
        </div>
        <div class="flex w-full max-w-[512px] flex-col gap-[12px] bg-[#ff5c00] px-6 py-6 lg:h-[288px] lg:w-[512px] lg:px-[60px] lg:py-[30px]">
            <p class="font-roboto text-[22px] font-bold leading-[32px] text-white lg:text-[24px]">
                <?php echo esc_html($quote); ?>
            </p>
            <?php foreach ($quoteBullets as $item) : ?>
                <div class="flex items-center gap-[12px]">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-bullet-light.svg')); ?>" alt="" class="size-6 shrink-0">
                    <span class="font-roboto text-[16px] font-normal leading-[24px] text-white"><?php echo esc_html($item); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
