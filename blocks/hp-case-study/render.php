<?php
/**
 * Block render: goliath/hp-case-study
 *
 * @var array $attributes Block attributes.
 */

$eyebrow             = $attributes['eyebrow']            ?? 'Featured Case Study';
$heading             = $attributes['heading']            ?? 'UK leading retailer saved 70% on repairs in the first 12 months vs traditional replacement';
$body                = $attributes['body']               ?? 'As a result, Goliath is now being rolled out across all of their sites.';
$expert_badge        = $attributes['expertBadge']        ?? 'Free Audit';
$expert_headline     = $attributes['expertHeadline']     ?? 'Our SEMA qualified inspectors will assess your warehouse and demonstrate how Goliath can help you';
$expert_cta1         = $attributes['expertCta1Text']     ?? 'Interested in GOLIATH™?';
$expert_cta1_url     = $attributes['expertCta1Url']      ?? '#contact';
$expert_cta2         = $attributes['expertCta2Text']     ?? 'Book My Free Site Survey';
$expert_cta2_url     = $attributes['expertCta2Url']      ?? '#contact';
$kpi_eyebrow         = $attributes['kpiEyebrow']         ?? 'Proven Results';
$kpi_heading         = $attributes['kpiHeading']         ?? 'Real Results, Real ROI';
$kpi_subheading      = $attributes['kpiSubheading']      ?? 'Leading UK businesses trust Goliath to protect their warehouse infrastructure';

$kpi1_value          = $attributes['kpi1Value']          ?? '100%';
$kpi1_label          = $attributes['kpi1Label']          ?? 'Client Satisfaction';
$kpi2_value          = $attributes['kpi2Value']          ?? '70%';
$kpi2_label          = $attributes['kpi2Label']          ?? 'Average Cost Savings';
$kpi3_value          = $attributes['kpi3Value']          ?? '85%';
$kpi3_label          = $attributes['kpi3Label']          ?? 'Reduction in Downtime';

$case_img1           = ! empty( $attributes['caseImg1'] ) ? $attributes['caseImg1'] : '';
$case_img2           = ! empty( $attributes['caseImg2'] ) ? $attributes['caseImg2'] : '';
$case_img3           = ! empty( $attributes['caseImg3'] ) ? $attributes['caseImg3'] : '';

$img1 = $case_img1 ?: my_theme_get_image_url('my_theme_hp_casestudy_img1', get_theme_file_uri('assets/images/Homepage/case-study1.webp'));
$img2 = $case_img2 ?: my_theme_get_image_url('my_theme_hp_casestudy_img2', get_theme_file_uri('assets/images/Homepage/case-study2.webp'));
$img3 = $case_img3 ?: my_theme_get_image_url('my_theme_hp_casestudy_img3', get_theme_file_uri('assets/images/Homepage/case-study3.webp'));

$view_cs_text        = $attributes['viewCaseStudiesText'] ?? 'View Case Studies';
$view_cs_url         = $attributes['viewCaseStudiesUrl']  ?? '/case-studies/';

$feat1_title         = $attributes['expertFeature1Title'] ?? 'Qualified';
$feat1_sub           = $attributes['expertFeature1Sub']   ?? 'inspectors';
$feat2_title         = $attributes['expertFeature2Title'] ?? 'Tailored';
$feat2_sub           = $attributes['expertFeature2Sub']   ?? 'Solution';
$feat3_title         = $attributes['expertFeature3Title'] ?? 'Analysis';
$feat3_sub           = $attributes['expertFeature3Sub']   ?? 'Report';
?>

<section id="case-studies" class="section-shell py-12 lg:py-[80px]">

    <p class="font-roboto text-[14px] text-noir uppercase tracking-[0.7px] mb-4 lg:mb-5"><?php echo esc_html($eyebrow); ?></p>
    <h2 class="font-montserrat font-bold text-[30px] lg:text-[36px] text-noir leading-[36px] lg:leading-[44px] mb-2">
        <?php echo esc_html($heading); ?>
    </h2>
    <p class="font-montserrat font-medium text-[16px] text-noir leading-[24px] mb-6 lg:mb-8"><?php echo esc_html($body); ?></p>

    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mb-4 lg:mb-6">
        <div class="w-full lg:w-[640px] overflow-hidden aspect-[640/592]">
            <img src="<?php echo esc_url($img1); ?>" alt="Engineers installing Goliath system" class="w-full h-full object-cover" loading="lazy" decoding="async">
        </div>
        <div class="flex-1 flex flex-col gap-4 lg:gap-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                <a href="<?php echo esc_url( $view_cs_url ? home_url( $view_cs_url ) : home_url( '/case-studies/' ) ); ?>" class="bg-[#ff5c00] min-h-[220px] lg:h-[284px] flex flex-col items-start justify-center px-8">
                    <span class="text-white text-[22px] leading-none mb-6">→</span>
                    <span class="font-roboto font-semibold text-[30px] text-white leading-[24px]"><?php echo esc_html($view_cs_text); ?></span>
                </a>
                <div class="overflow-hidden min-h-[220px] lg:h-[284px]">
                    <img src="<?php echo esc_url($img2); ?>" alt="Installed rack upright close-up" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="overflow-hidden h-[220px] lg:h-[284px]">
                <img src="<?php echo esc_url($img3); ?>" alt="Goliath repaired upright detail" class="w-full h-full object-cover" loading="lazy" decoding="async">
            </div>
        </div>
    </div>

    <!-- KPI stats -->
    <div id="kpi" class="text-center py-10 lg:py-[80px]">
        <p class="font-montserrat font-medium text-[20px] text-noir uppercase leading-[44px] mb-0"><?php echo esc_html($kpi_eyebrow); ?></p>
        <h3 class="font-montserrat font-bold text-[34px] lg:text-[36px] text-noir leading-[40px] lg:leading-[44px] mb-1"><?php echo esc_html($kpi_heading); ?></h3>
        <p class="font-montserrat font-bold text-[16px] text-noir leading-[23px] mb-8 lg:mb-10"><?php echo esc_html($kpi_subheading); ?></p>

        <div class="flex flex-col md:flex-row items-center justify-center gap-10 lg:gap-[160px]">
            <div class="relative mx-auto flex h-[200px] w-[200px] max-w-full items-center justify-center sm:h-[235px] sm:w-[231px]">
                <div class="absolute inset-[2px] rounded-full border-[7px] border-[#ff5c00]" aria-hidden="true"></div>
                <div class="pointer-events-none absolute inset-0 z-10 flex flex-col items-center justify-center px-2 text-center">
                    <p class="font-yantramanav font-bold text-[60px] text-noir leading-[57.6px] tracking-[-1.2px] mb-0"><?php echo esc_html($kpi1_value); ?></p>
                    <p class="font-roboto text-[14px] text-noir uppercase tracking-[0.7px] leading-[20px] mb-0"><?php echo esc_html($kpi1_label); ?></p>
                </div>
            </div>

            <div class="relative mx-auto flex h-[200px] w-[200px] max-w-full items-center justify-center sm:h-[235px] sm:w-[231px]">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/kpi-ring-70.svg')); ?>" alt="<?php echo esc_attr($kpi2_value . ' ' . $kpi2_label); ?> indicator ring" class="pointer-events-none absolute inset-0 h-full w-full object-contain" width="231" height="235">
                <div class="pointer-events-none absolute inset-0 z-10 flex flex-col items-center justify-center px-2 text-center">
                    <p class="font-yantramanav font-bold text-[60px] text-noir leading-[57.6px] tracking-[-1.2px] mb-0"><?php echo esc_html($kpi2_value); ?></p>
                    <p class="font-roboto text-[14px] text-noir uppercase tracking-[0.7px] leading-[20px] mb-0"><?php echo esc_html($kpi2_label); ?></p>
                </div>
            </div>

            <div class="relative mx-auto flex h-[200px] w-[200px] max-w-full items-center justify-center sm:h-[235px] sm:w-[231px]">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/kpi-ring-85.svg')); ?>" alt="<?php echo esc_attr($kpi3_value . ' ' . $kpi3_label); ?> indicator ring" class="pointer-events-none absolute inset-0 h-full w-full object-contain" width="231" height="235">
                <div class="pointer-events-none absolute inset-0 z-10 flex flex-col items-center justify-center px-2 text-center">
                    <p class="font-yantramanav font-bold text-[60px] text-noir leading-[57.6px] tracking-[-1.2px] mb-0"><?php echo esc_html($kpi3_value); ?></p>
                    <p class="font-roboto text-[14px] text-noir uppercase tracking-[0.7px] leading-[20px] mb-0"><?php echo esc_html($kpi3_label); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Expert CTA -->
    <div id="expertise" class="relative mt-10 w-full">
        <div class="relative bg-noir w-full lg:w-[1304px] min-h-[420px] lg:h-[534px] overflow-hidden">
            <div class="px-6 sm:px-8 lg:px-[44px] pt-10 lg:pt-[76px] pb-10 lg:pb-[85px] lg:w-[874px]">
                <div class="flex items-center gap-2 mb-2 flex-wrap">
                    <span class="font-montserrat font-bold text-[20px] text-white uppercase leading-[44px]">A Goliath expert</span>
                    <span class="inline-block bg-[#ff5c00] text-white text-[12px] font-bold px-[10px] py-[4px] rounded-[2px]"><?php echo esc_html($expert_badge); ?></span>
                </div>
                <p class="font-montserrat font-bold text-[24px] lg:text-[36px] text-white uppercase leading-[34px] lg:leading-[44px] mb-8 max-w-[820px]"><?php echo esc_html($expert_headline); ?></p>

                <div class="flex flex-wrap gap-[30px] mb-8">
                    <?php
                    $features = [
                        ['top' => $feat1_title, 'bottom' => $feat1_sub],
                        ['top' => $feat2_title, 'bottom' => $feat2_sub],
                        ['top' => $feat3_title, 'bottom' => $feat3_sub],
                    ];
                    foreach ($features as $feat) : ?>
                        <div class="border-l border-gray-300 pl-[11px] pr-[10px] flex min-w-0 flex-1 basis-[140px] items-end gap-2 h-[51px] sm:flex-none sm:basis-auto sm:w-[169px]">
                            <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/expertise-feature-icon.svg')); ?>" alt="" class="w-8 h-8 shrink-0 mb-1" aria-hidden="true">
                            <div>
                                <span class="text-white text-[15px] leading-[20px] block"><?php echo esc_html($feat['top']); ?></span>
                                <span class="text-white font-bold text-[18px] leading-[20px] block"><?php echo esc_html($feat['bottom']); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="flex flex-col sm:flex-row gap-[30px]">
                    <a href="<?php echo esc_url($expert_cta1_url); ?>" class="btn-primary h-[52px] w-full px-8 text-[14px] uppercase sm:w-[282px]">
                        <?php echo esc_html($expert_cta1); ?>
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/cta-arrow-right.svg')); ?>" alt="" class="w-5 h-5" aria-hidden="true">
                    </a>
                    <a href="<?php echo esc_url($expert_cta2_url); ?>" class="btn-outline-light border-white/60 h-[52px] w-full px-8 text-[14px] uppercase whitespace-nowrap sm:w-[286px]">
                        <?php echo esc_html($expert_cta2); ?>
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/cta-arrow-right.svg')); ?>" alt="" class="w-5 h-5" aria-hidden="true">
                    </a>
                </div>
            </div>

            <div class="relative lg:absolute lg:right-0 lg:top-0 w-full lg:w-[430px] h-[300px] sm:h-[420px] lg:h-[534px] mt-6 lg:mt-0 overflow-hidden">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/expertise-photo-layer-1.png')); ?>" alt="Warehouse interior with Goliath repair area" class="absolute inset-0 w-full h-full object-cover" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/expertise-photo-layer-2.png')); ?>" alt="Close-up of warehouse racking section" class="absolute top-0 left-[-3.86%] w-[103.86%] h-[103.57%] object-cover" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/expertise-photo-layer-3.png')); ?>" alt="Goliath engineer preparing upright assessment" class="absolute inset-0 w-full h-full object-bottom" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/expertise-photo-layer-4.png')); ?>" alt="Goliath expert assessment" class="absolute inset-0 w-full h-full object-cover">
            </div>
        </div>
    </div>

</section>
