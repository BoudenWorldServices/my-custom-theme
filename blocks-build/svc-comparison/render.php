<?php
/**
 * Block render: goliath/svc-comparison
 *
 * @var array $attributes Block attributes.
 */

$heading        = $attributes['heading']       ?? 'New Installation Comparison';
$description    = $attributes['description']   ?? 'See how GOLIATH™-protected racking compares to standard new installations over the lifetime of your warehouse.';
$banner_heading = $attributes['bannerHeading'] ?? 'Smart Investment = Long-Term Savings';
$banner_desc    = $attributes['bannerDesc']    ?? 'Protect your new warehouse infrastructure from day one and eliminate future repair costs';

$rows = [
    [$attributes['row1LeftTitle'] ?? 'Standard new racking upright', $attributes['row1LeftDesc'] ?? 'Vulnerable to impact damage from day one', $attributes['row1RightTitle'] ?? 'New racking with GOLIATH™', $attributes['row1RightDesc'] ?? 'Protected against all impact damage permanently'],
    [$attributes['row2LeftTitle'] ?? '£675+ per replacement when damaged', $attributes['row2LeftDesc'] ?? 'Recurring expense with each incident', $attributes['row2RightTitle'] ?? '£0 future repair costs', $attributes['row2RightDesc'] ?? 'One-time investment with lifetime protection'],
    [$attributes['row3LeftTitle'] ?? '2-4 hours downtime per replacement', $attributes['row3LeftDesc'] ?? 'Repeated disruptions to operations', $attributes['row3RightTitle'] ?? 'Zero downtime after installation', $attributes['row3RightDesc'] ?? 'Uninterrupted warehouse productivity'],
    [$attributes['row4LeftTitle'] ?? 'No warranty against impact damage', $attributes['row4LeftDesc'] ?? 'Full financial risk on your business', $attributes['row4RightTitle'] ?? 'Lifetime impact warranty included', $attributes['row4RightDesc'] ?? 'Complete protection with no-questions-asked coverage'],
];
?>

<section class="w-full bg-[#fafafa]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[80px]">
        <div class="mb-8 lg:mb-[50px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                <span>New Installation </span><span class="text-[#ff5c00]">Comparison</span>
            </h2>
            <p class="mt-3 max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                <?php echo esc_html($description); ?>
            </p>
        </div>

        <div class="flex flex-col gap-0">
            <?php foreach ($rows as $c) : ?>
                <div class="flex flex-col overflow-hidden border border-[#e8e8e9] bg-white lg:h-[123px] lg:flex-row">
                    <div class="flex flex-1 flex-col gap-[8px] border-b border-[#e8e8e9] px-6 py-6 lg:border-b-0 lg:border-r lg:px-[32px] lg:py-[32px]">
                        <p class="font-montserrat text-[18px] font-bold leading-[27px] text-[#666]"><?php echo esc_html($c[0]); ?></p>
                        <p class="font-montserrat text-[14px] font-normal leading-[22px] text-[#666]"><?php echo esc_html($c[1]); ?></p>
                    </div>
                    <div class="flex flex-1 flex-col gap-[8px] bg-[#ff5c00]/5 px-6 py-6 lg:px-[32px] lg:py-[32px]">
                        <p class="font-montserrat text-[18px] font-bold leading-[27px] text-[#ff5c00]"><?php echo esc_html($c[2]); ?></p>
                        <p class="font-montserrat text-[14px] font-normal leading-[22px] text-[#020202]"><?php echo esc_html($c[3]); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="mt-6 flex flex-col items-center gap-[12px] bg-[#ff5c00] px-5 py-8 text-center lg:mt-6 lg:h-[145px] lg:justify-center">
                <p class="font-montserrat text-[26px] font-bold leading-[36px] text-white lg:text-[40px] lg:leading-[42px]">
                    <?php echo esc_html($banner_heading); ?>
                </p>
                <p class="max-w-[900px] font-montserrat text-[18px] font-normal leading-[27px] text-white/90">
                    <?php echo esc_html($banner_desc); ?>
                </p>
            </div>
        </div>
    </div>
</section>
