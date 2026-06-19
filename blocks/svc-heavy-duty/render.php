<?php
/**
 * Block render: goliath/svc-heavy-duty
 *
 * @var array $attributes Block attributes.
 */

$heading     = $attributes['heading']     ?? 'Heavy Duty.';
$h3          = $attributes['h3']          ?? 'Built to Last.';
$description = $attributes['description'] ?? 'Installing GOLIATH™ on new racking projects provides unmatched protection and long-term value for your warehouse infrastructure.';
$feat1_title = $attributes['feat1Title']  ?? 'Protection from Day One';
$feat1_desc  = $attributes['feat1Desc']   ?? 'Install GOLIATH™ on new racking to prevent damage before it happens.';
$feat2_title = $attributes['feat2Title']  ?? 'Faster Installation';
$feat2_desc  = $attributes['feat2Desc']   ?? 'Installing GOLIATH™ during initial setup is even quicker than retrofitting.';
$feat3_title = $attributes['feat3Title']  ?? 'Lifetime Warranty';
$feat3_desc  = $attributes['feat3Desc']   ?? 'Your new racking comes with permanent protection.';
$feat4_title = $attributes['feat4Title']  ?? 'Lower Total Cost';
$feat4_desc  = $attributes['feat4Desc']   ?? 'Avoid future repair costs entirely.';
$before_img  = $attributes['beforeImage'] ?: my_theme_get_image_url('my_theme_svc_before_img', get_theme_file_uri('assets/images/Services/before.webp'));
$after_img   = $attributes['afterImage']  ?: my_theme_get_image_url('my_theme_svc_after_img', get_theme_file_uri('assets/images/Services/after.webp'));

$arrow     = get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg');
$feat_icons = [
    get_theme_file_uri('assets/images/icons/safe.svg'),
    get_theme_file_uri('assets/images/icons/Icon-5.svg'),
    get_theme_file_uri('assets/images/icons/Icon-4.svg'),
    get_theme_file_uri('assets/images/icons/Icon-3.svg'),
];

$features = [
    [$feat_icons[0], $feat1_title, $feat1_desc],
    [$feat_icons[1], $feat2_title, $feat2_desc],
    [$feat_icons[2], $feat3_title, $feat3_desc],
    [$feat_icons[3], $feat4_title, $feat4_desc],
];
?>

<section id="built-to-last" class="w-full bg-[#fafafa]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[80px]">
        <div class="flex flex-col items-center gap-[14px] text-center">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                <?php echo esc_html($heading); ?>
            </h2>
            <h3 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">
                <?php echo esc_html($h3); ?>
            </h3>
            <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                <?php echo esc_html($description); ?>
            </p>
        </div>

        <div class="mt-10 flex flex-col gap-8 lg:mt-[60px] lg:flex-row lg:items-start lg:justify-between">
            <div class="group relative w-full overflow-hidden bg-[#d9d9d9] lg:h-[892px] lg:w-[570px] lg:shrink-0">
                <img
                    src="<?php echo esc_url($before_img); ?>"
                    alt="Racking upright before Goliath installation"
                    class="h-full w-full object-cover transition-opacity duration-300 group-hover:opacity-0"
                    loading="lazy"
                    decoding="async"
                >
                <img
                    src="<?php echo esc_url($after_img); ?>"
                    alt="Racking upright after Goliath installation"
                    class="absolute inset-0 h-full w-full object-cover opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                    loading="lazy"
                    decoding="async"
                >
                <div class="absolute left-[16px] right-4 top-[16px] inline-flex max-w-[calc(100%-2rem)] items-center gap-4 bg-[#ff5c00] px-[20px] py-2 transition-colors duration-300 group-hover:bg-[#020202] sm:h-[52px] sm:gap-8 sm:px-[30px] lg:left-[16px] lg:right-auto lg:top-[23px] lg:h-[52px] lg:w-[238px] lg:justify-between lg:px-[42px]">
                    <div class="relative h-[23px] min-w-[64px]">
                        <span class="absolute left-0 top-0 font-montserrat text-[16px] font-bold leading-[23px] text-white transition-opacity duration-300 group-hover:opacity-0">Before</span>
                        <span class="absolute left-0 top-0 font-montserrat text-[16px] font-bold leading-[23px] text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100">After</span>
                    </div>
                    <img src="<?php echo esc_url($arrow); ?>" alt="" class="size-5 shrink-0">
                </div>
            </div>

            <div class="flex w-full flex-col lg:w-[628px] lg:shrink-0">
                <?php foreach ($features as $f) : ?>
                    <div class="flex flex-col gap-[16px] px-2 py-4 lg:px-[40px] lg:py-[20px]">
                        <img src="<?php echo esc_url($f[0]); ?>" alt="" class="size-[40px] shrink-0">
                        <h3 class="font-montserrat text-[22px] font-bold leading-[33px] text-[#020202]">
                            <?php echo esc_html($f[1]); ?>
                        </h3>
                        <p class="max-w-[495px] font-montserrat text-[16px] font-normal leading-[26px] text-[#666]">
                            <?php echo esc_html($f[2]); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
