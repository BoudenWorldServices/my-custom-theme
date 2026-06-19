<?php
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
?>

<?php
$assets = [
    'img_left' => get_theme_file_uri('assets/images/Services/installation/install1.webp'),
    'img_right' => get_theme_file_uri('assets/images/Services/installation/install2.webp'),
    'tick' => get_theme_file_uri('assets/images/icons/Icon-1.svg'),
    'cta_arrow' => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];
?>

<main class="w-full bg-white overflow-x-hidden">
    <section class="w-full bg-[#020202]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[75px] lg:py-[128px]">
            <h1 class="font-montserrat text-[40px] font-bold leading-[44px] text-white lg:text-[60px] lg:leading-[60px]">
                <span class="text-[#ff5c00]">Racking </span><span class="text-white">Installations &amp; CDM</span>
            </h1>
            <p class="mt-6 max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#d1d5dc] lg:text-[20px]"><?php echo esc_html(get_option('my_theme_svc_cdm_hero_desc', 'Racking installations like Goliath™ is a way to prevent future damage whenever you install new uprights in your warehouse. Instead of waiting for issues to arise, you can build protection into the system from day one.')); ?></p>
        </div>
    </section>

    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[64px]">
            <p class="mx-auto max-w-[1183px] text-center font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_cdm_intro', 'Goliath™ can be installed as part of any new pallet racking installation. When this is done, it provides immediate racking upright protection in high-impact areas. This ensures your system is protected even before operations begin. This reduces the risk of damage to your structure and prevents any ongoing repair costs.')); ?></p>

            <div class="mt-10 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-8">
                <div class="h-[280px] overflow-hidden lg:h-[384px]">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_cdm_img_left', get_theme_file_uri('assets/images/Services/installation/install1.webp'))); ?>" alt="Goliath upright protection installed in warehouse" class="h-full w-full object-cover">
                </div>
                <div class="h-[280px] overflow-hidden lg:h-[384px]">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_cdm_img_right', get_theme_file_uri('assets/images/Services/installation/install2.webp'))); ?>" alt="Racking installation with Goliath system" class="h-full w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[60px]">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-12">
                <article>
                    <h2 class="font-montserrat text-[36px] font-bold leading-[40px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_cdm_build_h2', 'Build Protection into Your Project from Day One')); ?></h2>
                    <p class="mt-6 font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_cdm_build_p1', 'By integrating Goliath™, our pallet rack protection system, during installation, you eliminate the need to repair your racking upright later.')); ?></p>
                    <p class="mt-2 font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_cdm_build_p2', 'Approaching protection this way supports a long-term pallet racking damage prevention strategy from the start.')); ?></p>
                    <h3 class="mt-6 font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_cdm_build_h3', 'Goliath™ is suitable for:')); ?></h3>
                    <ul class="mt-6 space-y-3">
                        <?php
                        $suitable = [
                            get_option('my_theme_svc_cdm_build_item1', 'New warehouse developments'),
                            get_option('my_theme_svc_cdm_build_item2', 'Full racking fit-outs'),
                            get_option('my_theme_svc_cdm_build_item3', 'Expansion of existing facilities'),
                            get_option('my_theme_svc_cdm_build_item4', 'Racking relocation and reconfiguration'),
                        ];
                        foreach ($suitable as $item) : ?>
                            <li class="flex items-center gap-3">
                                <img src="<?php echo esc_url($assets['tick']); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                                <span class="font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </article>
                <article>
                    <h2 class="font-montserrat text-[36px] font-bold leading-[40px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_cdm_compliance_h2', 'Full CDM Management and Compliance')); ?></h2>
                    <p class="mt-6 font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_cdm_compliance_desc', 'All our installation work is carried out in line with CDM regulations to ensure safety, coordination, and compliance throughout the project.')); ?></p>
                    <div class="mt-8 bg-white px-8 py-8">
                        <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_cdm_compliance_h3', 'This includes:')); ?></h3>
                        <ul class="mt-6 space-y-3">
                            <?php
                            $cdm_items = [
                                get_option('my_theme_svc_cdm_compliance_item1', 'Planning and risk assessment'),
                                get_option('my_theme_svc_cdm_compliance_item2', 'Coordination with contractors and teams'),
                                get_option('my_theme_svc_cdm_compliance_item3', 'Safe installation processes'),
                                get_option('my_theme_svc_cdm_compliance_item4', 'Project oversight from start to completion'),
                            ];
                            foreach ($cdm_items as $item) : ?>
                                <li class="flex items-center gap-3">
                                    <img src="<?php echo esc_url($assets['tick']); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                                    <span class="font-roboto text-[16px] leading-[24px] text-[#020202]"><?php echo esc_html($item); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto grid w-full max-w-[1440px] grid-cols-1 gap-8 px-5 py-12 sm:px-6 lg:grid-cols-2 lg:items-center lg:gap-8 lg:px-[68px] lg:py-[80px]">
            <div>
                <h2 class="font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_cdm_protect_h2', 'Protect Your Investment from the Start')); ?></h2>
                <p class="mt-5 max-w-[485px] font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_cdm_protect_desc', 'Installing a new racking system is a significant investment. Installing Goliath™ during the initial setup ensures that your investment is protected from day one.')); ?></p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="mt-8 inline-flex h-[60px] w-full items-center justify-center bg-[#020202] font-roboto text-[18px] font-bold uppercase tracking-[0.45px] text-white sm:w-[310px]">
                    <span><?php echo esc_html(get_option('my_theme_svc_cdm_protect_cta', 'Get Free Site Survey')); ?></span>
                    <img src="<?php echo esc_url($assets['cta_arrow']); ?>" alt="" class="ml-3 size-5">
                </a>
            </div>
            <div class="bg-[#ff5c00] px-8 py-8 lg:h-[294px] lg:px-[32px] lg:py-[31px]">
                <p class="font-montserrat text-[24px] font-bold leading-[45px] text-white"><?php echo esc_html(get_option('my_theme_svc_cdm_protect_callout_h2', 'Instead of planning for future repairs, Goliath™ prevents damage entirely.')); ?></p>
                <p class="mt-6 max-w-[485px] font-montserrat text-[16px] font-medium leading-[24px] text-white"><?php echo esc_html(get_option('my_theme_svc_cdm_protect_callout_desc', 'This results in a safer, more efficient warehouse with lower long-term costs.')); ?></p>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 text-center sm:px-6 lg:px-[68px] lg:py-[80px]">
            <h2 class="mx-auto max-w-[768px] font-montserrat text-[36px] font-bold leading-[40px] text-white"><?php echo esc_html(get_option('my_theme_svc_cdm_final_h2', 'Start Your Installation with Goliath™ Protection')); ?></h2>
            <p class="mx-auto mt-7 max-w-[768px] font-roboto text-[20px] leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_svc_cdm_final_desc', 'Build damage prevention into your warehouse from the very beginning and save on future repair costs.')); ?></p>
            <a href="<?php echo esc_url(home_url('/how-it-works/')); ?>" class="mt-8 inline-flex h-[60px] w-full items-center justify-center bg-[#020202] font-roboto text-[18px] font-bold uppercase tracking-[0.45px] text-white sm:w-[214px]"><?php echo esc_html(get_option('my_theme_svc_cdm_final_cta', 'How It Works')); ?></a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
