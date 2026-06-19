<?php
/**
 * Block render: goliath/videos-copy
 *
 * @var array $attributes Block attributes.
 */

$left_heading  = $attributes['leftHeading']  ?? 'Goliath™ Rack Repair & Safety Videos';
$left_p1       = $attributes['leftP1']       ?? '';
$left_p2       = $attributes['leftP2']       ?? '';
$right_heading = $attributes['rightHeading'] ?? 'Learn How Goliath™ Breaks the Repair Cycle';
$right_p1      = $attributes['rightP1']      ?? '';
$right_p2      = $attributes['rightP2']      ?? '';

$left_parts   = explode(' ', $left_heading, 2);
$right_parts  = explode(' ', $right_heading, 4);
$right_white  = implode(' ', array_slice($right_parts, 0, 3));
$right_orange = implode(' ', array_slice($right_parts, 3));
?>

<section class="w-full bg-[#fafafa]">
    <div class="mx-auto grid w-full max-w-[1440px] grid-cols-1 gap-10 px-5 py-10 sm:px-6 lg:grid-cols-2 lg:gap-[60px] lg:px-[68px] lg:pt-[80px] lg:pb-[80px]">
        <div class="flex flex-col gap-6">
            <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                <span class="text-[#020202]"><?php echo esc_html($left_parts[0] ?? ''); ?> </span><span class="text-[#ff5c00]"><?php echo esc_html($left_parts[1] ?? ''); ?></span>
            </h2>
            <div class="space-y-5 font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                <?php if ($left_p1) : ?><p><?php echo esc_html($left_p1); ?></p><?php endif; ?>
                <?php if ($left_p2) : ?><p><?php echo esc_html($left_p2); ?></p><?php endif; ?>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                <span class="text-[#020202]"><?php echo esc_html($right_white); ?> </span><span class="text-[#ff5c00]"><?php echo esc_html($right_orange); ?></span>
            </h2>
            <div class="space-y-5 font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                <?php if ($right_p1) : ?><p><?php echo esc_html($right_p1); ?></p><?php endif; ?>
                <?php if ($right_p2) : ?><p><?php echo esc_html($right_p2); ?></p><?php endif; ?>
            </div>
        </div>
    </div>
</section>
