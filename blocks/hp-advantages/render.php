<?php
/**
 * Block render: goliath/hp-advantages
 *
 * @var array $attributes Block attributes.
 */

$eyebrow    = $attributes['eyebrow'] ?? 'The Goliath Difference';
$heading    = $attributes['heading'] ?? '6 Reasons, 6 Advantages';
$intro1     = $attributes['intro1'] ?? 'Your customers aren\'t buying a "product" – they\'re buying risk reduction and peace of mind.';
$intro2     = $attributes['intro2'] ?? 'We don\'t sell products. We serve you with a solid, durable solution to your problems backed by lifetime guarantees and unwavering reassurance.';
$advantages = $attributes['advantages'] ?? [];
$bar_text   = $attributes['barText'] ?? '100% Client Satisfaction • Save 70% • 30min Installation • Lifetime Warranty';
$cta1_text  = $attributes['cta1Text'] ?? 'View case studies';
$cta1_url   = $attributes['cta1Url'] ?? '/case-studies/';
$cta2_text  = $attributes['cta2Text'] ?? 'Get Similar Results';
$cta2_url   = $attributes['cta2Url'] ?? '#contact';

$cta_arrow = get_theme_file_uri('assets/images/icons/cta-arrow-right.svg');

$left_advantages  = array_slice($advantages, 0, 3);
$right_advantages = array_slice($advantages, 3, 3);
?>

<section id="compliance" class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[70px]">

        <div class="flex flex-col gap-6">
            <div>
                <p class="font-montserrat font-medium text-[18px] lg:text-[20px] text-noir uppercase leading-[30px] lg:leading-[44px] mb-0"><?php echo esc_html($eyebrow); ?></p>
                <h2 class="font-montserrat font-bold text-[30px] lg:text-[36px] text-noir leading-[36px] lg:leading-[44px] mb-0"><?php echo esc_html($heading); ?></h2>
            </div>

            <div class="font-montserrat font-medium text-[16px] text-noir leading-[24px]">
                <p class="mb-0"><?php echo esc_html($intro1); ?></p>
                <p><?php echo esc_html($intro2); ?></p>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 xl:gap-[64px] relative">
                <div class="w-full flex flex-col gap-5">
                    <?php foreach ($left_advantages as $adv) : ?>
                        <div class="flex gap-[10px] items-start py-[10px]">
                            <div class="relative shrink-0">
                                <div class="w-[70px] h-[70px] bg-noir flex items-center justify-center overflow-hidden p-[20px]">
                                    <span class="font-montserrat font-medium text-[24px] text-white"><?php echo esc_html($adv['num']); ?></span>
                                </div>
                                <span class="absolute right-0 bottom-[-14px] w-0 h-0 border-l-[14px] border-l-transparent border-t-[14px] border-t-noir"></span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-montserrat font-bold text-[16px] text-noir leading-[23px] mb-0">
                                    <?php echo esc_html($adv['title']); ?>
                                    <?php if (!empty($adv['badge'])) : ?>
                                        <span class="inline-block align-middle ml-2 bg-[#ff5c00] text-white font-inter font-medium text-[12px] leading-[20px] tracking-[-0.15px] px-[10px] py-[3px] rounded-[3px]"><?php echo esc_html($adv['badge']); ?></span>
                                    <?php endif; ?>
                                </h3>
                                <p class="font-montserrat font-medium text-[12px] text-noir leading-[23px]"><?php echo esc_html($adv['desc']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="w-full flex flex-col gap-5">
                    <?php foreach ($right_advantages as $adv) : ?>
                        <div class="flex gap-[10px] items-start py-[10px]">
                            <div class="relative shrink-0">
                                <div class="w-[70px] h-[70px] <?php echo !empty($adv['highlight']) ? 'bg-[#ff5c00]' : 'bg-noir'; ?> flex items-center justify-center overflow-hidden p-[20px]">
                                    <span class="font-montserrat font-medium text-[24px] text-white"><?php echo esc_html($adv['num']); ?></span>
                                </div>
                                <span class="absolute right-0 bottom-[-14px] w-0 h-0 border-l-[14px] border-l-transparent <?php echo !empty($adv['highlight']) ? 'border-t-[14px] border-t-[#ff5c00]' : 'border-t-[14px] border-t-noir'; ?>"></span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-montserrat font-bold text-[16px] text-noir leading-[23px] mb-0"><?php echo esc_html($adv['title']); ?></h3>
                                <p class="font-montserrat font-medium text-[12px] text-noir leading-[23px]"><?php echo esc_html($adv['desc']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="mt-6 bg-[#020202] px-5 py-4 sm:px-6 lg:h-[96px] lg:px-[38px] lg:py-0">
            <div class="flex h-full flex-col gap-4 lg:flex-row lg:items-center lg:justify-between lg:gap-6">
                <p class="font-roboto text-[14px] font-bold leading-[22px] text-white sm:text-[16px] sm:leading-[24px] lg:flex-1 lg:text-[18px] lg:leading-[28px] lg:whitespace-nowrap"><?php echo esc_html($bar_text); ?></p>
                <div class="flex w-full flex-col gap-3 sm:flex-row sm:gap-4 lg:w-auto lg:shrink-0 lg:gap-4">
                    <a href="<?php echo esc_url(str_starts_with($cta1_url, '#') ? $cta1_url : home_url($cta1_url)); ?>" class="inline-flex h-[52px] w-full items-center justify-center border border-white font-roboto text-[16px] font-semibold text-white sm:w-[215px]">
                        <span><?php echo esc_html($cta1_text); ?></span>
                        <img src="<?php echo esc_url($cta_arrow); ?>" alt="" class="ml-3 size-5" aria-hidden="true">
                    </a>
                    <a href="<?php echo esc_url(str_starts_with($cta2_url, '#') ? $cta2_url : home_url($cta2_url)); ?>" class="inline-flex h-[52px] w-full items-center justify-center bg-[#ff5c00] font-roboto text-[16px] font-semibold text-white sm:w-[238px]">
                        <span><?php echo esc_html($cta2_text); ?></span>
                        <img src="<?php echo esc_url($cta_arrow); ?>" alt="" class="ml-3 size-5" aria-hidden="true">
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
