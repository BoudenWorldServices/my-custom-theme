<?php
/*
Template Name: Services Page
*/
get_header();
// If this page has Gutenberg blocks, render the block editor content.
// Otherwise the existing template below is used unchanged.
$_current_page = get_queried_object();
if ($_current_page instanceof WP_Post && has_blocks($_current_page)) {
    setup_postdata($_current_page);
    echo "<main class=\"w-full bg-white overflow-x-hidden\">";
    the_content();
    echo "</main>";
    wp_reset_postdata();
    get_footer();
    return;
}

$figma_assets = [
    'arrow' => get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg'),
    'before_image' => get_theme_file_uri('assets/images/Services/before.webp'),
    'after_image' => get_theme_file_uri('assets/images/Services/after.webp'),
    'hero_main' => get_theme_file_uri('assets/images/Services/foreveryproject.webp'),
    'project_main' => get_theme_file_uri('assets/images/Services/foreveryproject.webp'),
    'gallery_1' => get_theme_file_uri('assets/images/Services/solution1.webp'),
    'gallery_2' => get_theme_file_uri('assets/images/Services/solution2.webp'),
    'gallery_3' => get_theme_file_uri('assets/images/Services/solution3.webp'),
    'gallery_4' => get_theme_file_uri('assets/images/Services/solution5.webp'),
    'gallery_tall' => get_theme_file_uri('assets/images/Services/solution4.webp'),
    'feat_1' => get_theme_file_uri('assets/images/icons/safe.svg'),
    'feat_2' => get_theme_file_uri('assets/images/icons/Icon-5.svg'),
    'feat_3' => get_theme_file_uri('assets/images/icons/Icon-4.svg'),
    'feat_4' => get_theme_file_uri('assets/images/icons/Icon-3.svg'),
    'check' => get_theme_file_uri('assets/images/icons/Icon-1.svg'),
    'cert' => get_theme_file_uri('assets/images/icons/badge.svg'),
];
?>

<main class="w-full bg-white overflow-x-hidden">

    <!-- 610:23127 — Hero -->
    <section
        class="relative w-full h-auto lg:h-[400px] hero-gradient-bg"
    >
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-4 lg:h-[284px] lg:justify-between lg:gap-0">
                <p class="font-montserrat text-[16px] font-medium leading-[24px] tracking-[0.07px] text-[#ff5c00]">
                    <?php echo esc_html(get_option('my_theme_svc_hero_badge', 'PROACTIVE PROTECTION')); ?>
                </p>
                <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <span class="text-white">Service </span><span class="text-[#ff5c00]">Portfolio</span>
                </h1>
                <p class="max-w-[1304px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    <?php echo esc_html(get_option('my_theme_svc_hero_desc', 'Building a new warehouse or installing new racking? Start with GOLIATH™ protection from day one. Prevent damage before it happens and eliminate future repair costs entirely.')); ?>
                </p>
                <div class="flex w-full max-w-full flex-col gap-3 sm:flex-row sm:gap-[16px]">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>"
                       class="inline-flex h-[57px] w-full items-center justify-center bg-[#ff5c00] px-[40px] font-montserrat text-[14px] font-bold leading-[21px] tracking-[0.35px] text-white transition hover:bg-[#e55200] sm:w-auto">
                        <span class="text-center sm:whitespace-nowrap"><?php echo esc_html(get_option('my_theme_svc_hero_cta1', 'Get Project Quote')); ?></span>
                        <img src="<?php echo esc_url($figma_assets['arrow']); ?>" alt="" class="ml-3 size-5 shrink-0">
                    </a>
                    <a href="#built-to-last"
                       class="inline-flex h-[57px] w-full items-center justify-center border-2 border-white px-[40px] font-montserrat text-[14px] font-bold leading-[21px] tracking-[0.35px] text-white transition hover:bg-white/10 sm:w-auto">
                        <span class="text-center sm:whitespace-nowrap"><?php echo esc_html(get_option('my_theme_svc_hero_cta2', 'Learn More')); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 610:23143 — Heavy Duty / Built to Last -->
    <section id="built-to-last" class="w-full bg-[#fafafa]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[80px]">
            <div class="flex flex-col items-center gap-[14px] text-center">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                    <?php echo esc_html(get_option('my_theme_svc_built_h2', 'Heavy Duty.')); ?>
                </h2>
                <h3 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">
                    <?php echo esc_html(get_option('my_theme_svc_built_h3', 'Built to Last.')); ?>
                </h3>
                <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                    <?php echo esc_html(get_option('my_theme_svc_built_desc', 'Installing GOLIATH™ on new racking projects provides unmatched protection and long-term value for your warehouse infrastructure.')); ?>
                </p>
            </div>

            <div class="mt-10 flex flex-col gap-8 lg:mt-[60px] lg:flex-row lg:items-start lg:justify-between">
                <div class="group relative w-full overflow-hidden bg-[#d9d9d9] lg:h-[892px] lg:w-[570px] lg:shrink-0">
                    <img
                        src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_before_img', get_theme_file_uri('assets/images/Services/before.webp'))); ?>"
                        alt="Racking upright before Goliath installation"
                        class="h-full w-full object-cover transition-opacity duration-300 group-hover:opacity-0"
                    >
                    <img
                        src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_after_img', get_theme_file_uri('assets/images/Services/after.webp'))); ?>"
                        alt="Racking upright after Goliath installation"
                        class="absolute inset-0 h-full w-full object-cover opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                    >
                    <div class="absolute left-[16px] right-4 top-[16px] inline-flex max-w-[calc(100%-2rem)] items-center gap-4 bg-[#ff5c00] px-[20px] py-2 transition-colors duration-300 group-hover:bg-[#020202] sm:h-[52px] sm:gap-8 sm:px-[30px] lg:left-[16px] lg:right-auto lg:top-[23px] lg:h-[52px] lg:w-[238px] lg:justify-between lg:px-[42px]">
                        <div class="relative h-[23px] min-w-[64px]">
                            <span class="absolute left-0 top-0 font-montserrat text-[16px] font-bold leading-[23px] text-white transition-opacity duration-300 group-hover:opacity-0">Before</span>
                            <span class="absolute left-0 top-0 font-montserrat text-[16px] font-bold leading-[23px] text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100">After</span>
                        </div>
                        <img src="<?php echo esc_url($figma_assets['arrow']); ?>" alt="" class="size-5 shrink-0">
                    </div>
                </div>

                <?php
                $features = [
                    [$figma_assets['feat_1'], get_option('my_theme_svc_feat1_title', 'Protection from Day One'), get_option('my_theme_svc_feat1_desc', 'Install GOLIATH™ on new racking to prevent damage before it happens. Proactive protection saves money and ensures safety from the start.')],
                    [$figma_assets['feat_2'], get_option('my_theme_svc_feat2_title', 'Faster Installation'), get_option('my_theme_svc_feat2_desc', 'Installing GOLIATH™ during initial setup is even quicker than retrofitting. Integrate protection seamlessly into your new warehouse project.')],
                    [$figma_assets['feat_3'], get_option('my_theme_svc_feat3_title', 'Lifetime Warranty'), get_option('my_theme_svc_feat3_desc', 'Your new racking comes with permanent protection. Never worry about upright damage again with our comprehensive lifetime warranty.')],
                    [$figma_assets['feat_4'], get_option('my_theme_svc_feat4_title', 'Lower Total Cost'), get_option('my_theme_svc_feat4_desc', 'Avoid future repair costs entirely. Installing GOLIATH™ upfront is the most cost-effective approach for long-term warehouse operations.')],
                ];
                ?>
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

    <!-- 610:23188 — New Installation Comparison -->
    <section class="w-full bg-[#fafafa]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <div class="mb-8 lg:mb-[50px]">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                    <span>New Installation </span><span class="text-[#ff5c00]">Comparison</span>
                </h2>
                <p class="mt-3 max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                    <?php echo esc_html(get_option('my_theme_svc_comp_desc', 'See how GOLIATH™-protected racking compares to standard new installations over the lifetime of your warehouse.')); ?>
                </p>
            </div>

            <?php
            $comparisons = [
                [get_option('my_theme_svc_comp_row1_left_title', 'Standard new racking upright'), get_option('my_theme_svc_comp_row1_left_desc', 'Vulnerable to impact damage from day one'), get_option('my_theme_svc_comp_row1_right_title', 'New racking with GOLIATH™'), get_option('my_theme_svc_comp_row1_right_desc', 'Protected against all impact damage permanently')],
                [get_option('my_theme_svc_comp_row2_left_title', '£675+ per replacement when damaged'), get_option('my_theme_svc_comp_row2_left_desc', 'Recurring expense with each incident'), get_option('my_theme_svc_comp_row2_right_title', '£0 future repair costs'), get_option('my_theme_svc_comp_row2_right_desc', 'One-time investment with lifetime protection')],
                [get_option('my_theme_svc_comp_row3_left_title', '2-4 hours downtime per replacement'), get_option('my_theme_svc_comp_row3_left_desc', 'Repeated disruptions to operations'), get_option('my_theme_svc_comp_row3_right_title', 'Zero downtime after installation'), get_option('my_theme_svc_comp_row3_right_desc', 'Uninterrupted warehouse productivity')],
                [get_option('my_theme_svc_comp_row4_left_title', 'No warranty against impact damage'), get_option('my_theme_svc_comp_row4_left_desc', 'Full financial risk on your business'), get_option('my_theme_svc_comp_row4_right_title', 'Lifetime impact warranty included'), get_option('my_theme_svc_comp_row4_right_desc', 'Complete protection with no-questions-asked coverage')],
            ];
            ?>
            <div class="flex flex-col gap-0">
                <?php foreach ($comparisons as $c) : ?>
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
                        <?php echo esc_html(get_option('my_theme_svc_comp_banner_h2', 'Smart Investment = Long-Term Savings')); ?>
                    </p>
                    <p class="max-w-[900px] font-montserrat text-[18px] font-normal leading-[27px] text-white/90">
                        <?php echo esc_html(get_option('my_theme_svc_comp_banner_desc', 'Protect your new warehouse infrastructure from day one and eliminate future repair costs')); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 610:23248 — Perfect for Every Project -->
    <section class="w-full bg-[#fafafa]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[80px]">
            <div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:gap-[60px]">
                <div class="flex flex-1 flex-col gap-[28px]">
                    <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                        <span>Perfect for </span><span class="text-[#ff5c00]">Every Project</span>
                    </h2>
                    <p class="max-w-[569px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                        <?php echo esc_html(get_option('my_theme_svc_project_desc', 'Whether you\'re building from scratch, expanding operations, or upgrading your storage systems, GOLIATH™ provides the protection your investment deserves.')); ?>
                    </p>

                    <?php
                    $projects = [
                        [get_option('my_theme_svc_project1_title', 'New Warehouse Builds'), get_option('my_theme_svc_project1_desc', 'Complete warehouse construction projects with GOLIATH™ protection integrated from the ground up.')],
                        [get_option('my_theme_svc_project2_title', 'Warehouse Expansions'), get_option('my_theme_svc_project2_desc', 'Expanding your facility? Protect new racking installations while maintaining consistency with existing systems.')],
                        [get_option('my_theme_svc_project3_title', 'Racking System Upgrades'), get_option('my_theme_svc_project3_desc', 'Upgrading your storage system? Add GOLIATH™ to ensure your investment is protected for decades.')],
                        [get_option('my_theme_svc_project4_title', 'High-Traffic Zones'), get_option('my_theme_svc_project4_desc', 'Identify high-risk areas and install proactive protection where forklift traffic is heaviest.')],
                    ];
                    ?>
                    <div class="flex flex-col gap-[18px]">
                        <?php foreach ($projects as $p) : ?>
                            <div>
                                <p class="font-montserrat text-[18px] font-bold leading-[27px] text-[#020202]">
                                    <?php echo esc_html($p[0]); ?>
                                </p>
                                <p class="mt-2 max-w-[621px] font-montserrat text-[14px] font-normal leading-[22px] text-[#666]">
                                    <?php echo esc_html($p[1]); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <a href="<?php echo esc_url(home_url('/videos/explanation-video/')); ?>"
                       class="inline-flex h-[52px] w-full items-center justify-center gap-3 bg-[#ff5c00] px-[26px] font-montserrat text-[14px] font-bold leading-[20px] tracking-[0.35px] text-white transition hover:bg-[#e55200] sm:w-fit">
                        <span class="text-center sm:whitespace-nowrap"><?php echo esc_html(get_option('my_theme_svc_project_cta', 'watch the video')); ?></span>
                        <img src="<?php echo esc_url($figma_assets['arrow']); ?>" alt="" class="size-5 shrink-0">
                    </a>
                </div>

                <div class="w-full shrink-0 bg-[#d9d9d9] lg:h-[790px] lg:w-[570px]">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_project_img', get_theme_file_uri('assets/images/Services/foreveryproject.webp'))); ?>" alt="Warehouse racking project with Goliath protection installed" class="h-full w-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </section>

    <!-- 610:23273 — UK Regulation Compliant -->
    <section class="w-full bg-[#020202]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-10 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-[68px] lg:py-[80px]">
            <div class="flex w-full flex-col lg:w-[569px]">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[42px] lg:leading-[52px]">UK Regulation</h2>
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">Compliant</h2>
                <p class="mt-6 max-w-[569px] font-montserrat text-[18px] font-normal leading-[28px] text-white/90">
                    <?php echo esc_html(get_option('my_theme_svc_reg_desc', 'GOLIATH™ meets all UK and EU safety standards for new installations. Your project will pass inspections with complete compliance documentation.')); ?>
                </p>
                <ul class="mt-8 flex flex-col gap-[12px]">
                    <?php
                    $compliance = [
                        get_option('my_theme_svc_reg_item1', 'BS EN 15512:2020 + A1:2022 compliant'),
                        get_option('my_theme_svc_reg_item2', 'BS EN 15635:2008 certified'),
                        get_option('my_theme_svc_reg_item3', 'SEMA codes of practice adherence'),
                        get_option('my_theme_svc_reg_item4', 'Full compliance documentation provided'),
                    ];
                    foreach ($compliance as $item) :
                    ?>
                        <li class="flex items-center gap-[12px]">
                            <img src="<?php echo esc_url($figma_assets['check']); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                            <span class="font-montserrat text-[15px] font-normal leading-[24px] text-white"><?php echo esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="flex w-full flex-col border-2 border-[#ff5c00] bg-white/5 lg:h-[416px] lg:w-[569px]">
                <div class="flex flex-1 flex-col items-center justify-center gap-6 px-8 py-10 text-center lg:px-[50px] lg:py-[50px]">
                    <img src="<?php echo esc_url($figma_assets['cert']); ?>" alt="" class="size-20">
                    <h3 class="font-montserrat text-[28px] font-bold leading-[42px] text-white"><?php echo esc_html(get_option('my_theme_svc_reg_cert_h3', 'Certified Protection')); ?></h3>
                    <div class="font-montserrat text-[16px] font-normal leading-[24px] text-white/80">
                        <p><?php echo esc_html(get_option('my_theme_svc_reg_cert_line1', 'UK Registered Design No. 6410620')); ?></p>
                        <p><?php echo esc_html(get_option('my_theme_svc_reg_cert_line2', 'EU Design Registration No. DM/244641')); ?></p>
                    </div>
                </div>
                <div class="flex h-[78px] w-full items-center justify-center bg-[#ff5c00]">
                    <p class="font-montserrat text-[20px] font-bold leading-[30px] text-white"><?php echo esc_html(get_option('my_theme_svc_reg_cert_banner', 'Lifetime Warranty Included')); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- 610:23318 — Simple Solution, Peace of Mind -->
    <section class="w-full bg-[#fafafa] py-10 lg:py-[80px]">
        <div class="mx-auto w-full max-w-[1440px] px-5 sm:px-6 lg:px-[68px]">
            <h2 class="mb-6 font-montserrat text-[32px] font-bold leading-[40px] lg:text-[36px] lg:leading-[44px]">
                <span class="text-[#020202]">Simple</span><span class="text-[#ff5c00]"> Solution, Peace of Mind,</span>
            </h2>

            <div class="flex flex-col gap-5 lg:flex-row lg:gap-5">
                <div class="flex flex-1 flex-col gap-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <div class="aspect-[307/284] overflow-hidden bg-[#d9d9d9]"><img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_gallery_img1', get_theme_file_uri('assets/images/Services/solution1.webp'))); ?>" alt="Racking upright reinforcement installed in warehouse bay" class="h-full w-full object-cover" loading="lazy" decoding="async"></div>
                        <div class="aspect-[307/284] overflow-hidden bg-[#d9d9d9]"><img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_gallery_img2', get_theme_file_uri('assets/images/Services/solution2.webp'))); ?>" alt="Goliath upright repair fitted to pallet racking" class="h-full w-full object-cover" loading="lazy" decoding="async"></div>
                        <div class="aspect-[309/284] overflow-hidden bg-[#d9d9d9]"><img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_gallery_img3', get_theme_file_uri('assets/images/Services/solution3.webp'))); ?>" alt="Warehouse racking aisle with protected uprights" class="h-full w-full object-cover" loading="lazy" decoding="async"></div>
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-[2fr_1fr] lg:grid-cols-[640px_307px]">
                        <div class="aspect-[640/284] overflow-hidden bg-[#d9d9d9]"><img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_gallery_img4', get_theme_file_uri('assets/images/Services/solution5.webp'))); ?>" alt="Close-up of reinforced racking column in operation" class="h-full w-full object-cover" loading="lazy" decoding="async"></div>
                        <div class="relative aspect-[307/284] bg-[#ff5c00]">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <a href="<?php echo esc_url(home_url('/videos/')); ?>" class="inline-flex h-full w-full items-center justify-center">
                                    <span class="font-montserrat text-[16px] font-semibold uppercase leading-[24px] text-white"><?php echo esc_html(get_option('my_theme_svc_gallery_cta', 'View more')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full overflow-hidden bg-[#d9d9d9] lg:h-[591px] lg:w-[307px] lg:shrink-0">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_gallery_img5', get_theme_file_uri('assets/images/Services/solution4.webp'))); ?>" alt="Goliath protection installed on upright near loading zone" class="h-full w-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </section>

    <!-- 610:23338 — Interested in GOLIATH™ -->
    <section class="w-full bg-[#ff5c00] py-14 lg:h-[420px] lg:py-0">
        <div class="mx-auto flex h-full w-full max-w-[1440px] flex-col items-center justify-center gap-6 px-5 text-center sm:px-6 lg:px-[68px]">
            <h2 class="font-montserrat text-[36px] font-bold leading-[44px] text-white lg:text-[42px] lg:leading-[52px]">
                <span>Interested in </span><span class="text-[#020202]">GOLIATH™?</span>
            </h2>
            <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-white">
                <?php echo esc_html(get_option('my_theme_svc_final_desc', 'Planning a new warehouse project? Get a tailored quote for Goliath™ protection. Our team will work with your specifications to provide clear pricing and a realistic timeline.')); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>"
               class="inline-flex h-[60px] w-full max-w-[360px] items-center justify-center gap-4 bg-[#020202] px-[40px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white transition hover:bg-[#1a1a1a] sm:w-auto sm:max-w-none">
                <span><?php echo esc_html(get_option('my_theme_svc_final_cta', 'Get Your Project Quote')); ?></span>
                <img src="<?php echo esc_url($figma_assets['arrow']); ?>" alt="" class="size-5 shrink-0">
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
