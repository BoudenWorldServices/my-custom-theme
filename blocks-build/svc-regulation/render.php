<?php
/**
 * Block render: goliath/svc-regulation
 *
 * @var array $attributes Block attributes.
 */

$description = $attributes['description'] ?? 'GOLIATH™ meets all UK and EU safety standards for new installations.';
$cert_h3     = $attributes['certH3']      ?? 'Certified Protection';
$cert_line1  = $attributes['certLine1']   ?? 'UK Registered Design No. 6410620';
$cert_line2  = $attributes['certLine2']   ?? 'EU Design Registration No. DM/244641';
$cert_banner = $attributes['certBanner']  ?? 'Lifetime Warranty Included';

$compliance = [
    $attributes['item1'] ?? 'BS EN 15512:2020 + A1:2022 compliant',
    $attributes['item2'] ?? 'BS EN 15635:2008 certified',
    $attributes['item3'] ?? 'SEMA codes of practice adherence',
    $attributes['item4'] ?? 'Full compliance documentation provided',
];

$check_icon = get_theme_file_uri('assets/images/icons/Icon-1.svg');
$cert_icon  = get_theme_file_uri('assets/images/icons/badge.svg');
?>

<section class="w-full bg-[#020202]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-10 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-[68px] lg:py-[80px]">
        <div class="flex w-full flex-col lg:w-[569px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[42px] lg:leading-[52px]">UK Regulation</h2>
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">Compliant</h2>
            <p class="mt-6 max-w-[569px] font-montserrat text-[18px] font-normal leading-[28px] text-white/90">
                <?php echo esc_html($description); ?>
            </p>
            <ul class="mt-8 flex flex-col gap-[12px]">
                <?php foreach ($compliance as $item) : ?>
                    <li class="flex items-center gap-[12px]">
                        <img src="<?php echo esc_url($check_icon); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                        <span class="font-montserrat text-[15px] font-normal leading-[24px] text-white"><?php echo esc_html($item); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="flex w-full flex-col border-2 border-[#ff5c00] bg-white/5 lg:h-[416px] lg:w-[569px]">
            <div class="flex flex-1 flex-col items-center justify-center gap-6 px-8 py-10 text-center lg:px-[50px] lg:py-[50px]">
                <img src="<?php echo esc_url($cert_icon); ?>" alt="" class="size-20">
                <h3 class="font-montserrat text-[28px] font-bold leading-[42px] text-white"><?php echo esc_html($cert_h3); ?></h3>
                <div class="font-montserrat text-[16px] font-normal leading-[24px] text-white/80">
                    <p><?php echo esc_html($cert_line1); ?></p>
                    <p><?php echo esc_html($cert_line2); ?></p>
                </div>
            </div>
            <div class="flex h-[78px] w-full items-center justify-center bg-[#ff5c00]">
                <p class="font-montserrat text-[20px] font-bold leading-[30px] text-white"><?php echo esc_html($cert_banner); ?></p>
            </div>
        </div>
    </div>
</section>
