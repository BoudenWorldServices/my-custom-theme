<?php
/**
 * Block: goliath/wg-end-repair-cycle
 * Why Goliath – End the Repair Cycle — grey band with left content column and right orange callout box.
 */

$heading = $attributes['heading'] ?? 'End the Repair Cycle';
$p1      = $attributes['p1']      ?? 'The cost of the repair cycle is not determined by the first repair. It is measured by the cost of every repair after the first.';
$p2      = $attributes['p2']      ?? 'Goliath™ was built to break the cycle.';
$p3      = $attributes['p3']      ?? 'With our permanent upright repair solution:';
$callout = $attributes['callout'] ?? 'Once installed, Goliath™ continues to protect your racking forever, and we\'re confident that if it were to be damaged by usual FLT damage, we will replace it for free.';

$end_cycle_icon  = get_theme_file_uri('assets/images/icons/Icon-1.svg');
$bullets = $attributes['bullets'] ?? ['No more replacing uprights', 'No more recurring repair costs every time racking is damaged', 'No more disruption to your warehouse operations'];
?>
<section class="w-full bg-[#f9fafb]" aria-labelledby="end-repair-cycle-heading">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-10 sm:px-6 lg:flex-row lg:items-center lg:gap-[90px] lg:px-[68px] lg:py-[80px]">
        <div class="flex w-full min-w-0 flex-col gap-4 lg:max-w-[694px]">
            <h2 id="end-repair-cycle-heading" class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html($heading); ?>
            </h2>
            <p class="max-w-[604px] font-roboto text-[18px] font-normal leading-[28px] text-[#020202] lg:text-[20px]">
                <?php echo esc_html($p1); ?>
            </p>
            <p class="font-roboto text-[18px] font-bold leading-[28px] text-[#020202] lg:text-[20px]">
                <?php echo esc_html($p2); ?>
            </p>
            <p class="font-roboto text-[16px] font-normal leading-[28px] text-[#020202] lg:text-[18px]">
                <?php echo esc_html($p3); ?>
            </p>
            <ul class="flex flex-col gap-3">
                <?php foreach ($bullets as $item) : ?>
                    <li class="flex items-start gap-3">
                        <img src="<?php echo esc_url($end_cycle_icon); ?>" alt="" class="mt-1 size-6 shrink-0 brightness-0" width="24" height="24" aria-hidden="true">
                        <span class="font-roboto text-[16px] font-normal leading-[24px] text-[#020202]"><?php echo esc_html($item); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="w-full shrink-0 lg:w-[467px] lg:max-w-[467px]">
            <div class="flex min-h-[288px] w-full items-center justify-center bg-[#ff5c00] p-[30px]">
                <p class="font-montserrat text-[16px] font-bold leading-[23px] text-white">
                    <?php echo esc_html($callout); ?>
                </p>
            </div>
        </div>
    </div>
</section>
