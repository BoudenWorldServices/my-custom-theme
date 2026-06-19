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
    'img_left' => get_theme_file_uri('assets/images/Services/Reconfiguration/config1.webp'),
    'img_right' => get_theme_file_uri('assets/images/Services/Reconfiguration/config2.webp'),
    'tick' => get_theme_file_uri('assets/images/icons/Icon-1.svg'),
    'icon_left' => get_theme_file_uri('assets/images/icons/svc-speed-icon.svg'),
    'icon_right' => get_theme_file_uri('assets/images/icons/svc-shield-outline.svg'),
    'cta_arrow_orange' => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];
?>

<main class="w-full bg-white overflow-x-hidden">
    <section class="w-full bg-[#020202]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[75px] lg:py-[128px]">
            <h1 class="font-montserrat text-[40px] font-bold leading-[44px] text-white lg:text-[60px] lg:leading-[60px]">
                <span class="text-[#ff5c00]">Racking </span><span class="text-white">Reconfiguration Services</span>
            </h1>
            <p class="mt-6 max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#d1d5dc] lg:text-[20px]"><?php echo esc_html(get_option('my_theme_svc_reconfig_hero_desc', 'Your warehouse operations can change. You may grow, have new product lines, and demand may shift in ways that require adjustments to your existing racking layout.')); ?></p>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <p class="font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_reconfig_intro', 'Our racking reconfiguration services allow you to change your existing storage system without fully replacing it. Our process minimises disruption and maintains operation.')); ?></p>

            <div class="mt-12 grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-12">
                <article>
                    <img src="<?php echo esc_url($assets['icon_left']); ?>" alt="" class="h-12 w-12 shrink-0 object-contain" width="40" height="40">
                    <h2 class="mt-6 font-montserrat text-[36px] font-bold leading-[40px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_reconfig_flex_h2', 'Flexible Racking Relocation and Redesign')); ?></h2>
                    <div class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]">
                        <p><?php echo esc_html(get_option('my_theme_svc_reconfig_flex_p1', 'With our racking skates, there is no need to dismantle your racking system. We can move unloaded racking with ease, reducing downtime.')); ?></p>
                        <p class="mt-2 font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_reconfig_flex_bold', 'What would normally take weeks, depending on the size of your warehouse, can be done in days or hours.')); ?></p>
                        <p class="mt-2"><?php echo esc_html(get_option('my_theme_svc_reconfig_flex_p2', 'Every project is planned carefully to ensure that reconfiguration is carried out safely and efficiently, with little to no downtime.')); ?></p>
                    </div>
                </article>
                <article>
                    <img src="<?php echo esc_url($assets['icon_right']); ?>" alt="" class="h-12 w-12 shrink-0 object-contain" width="40" height="40">
                    <h2 class="mt-6 font-montserrat text-[36px] font-bold leading-[40px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_reconfig_safety_h2', 'Maintain Safety During Change')); ?></h2>
                    <div class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]">
                        <p><?php echo esc_html(get_option('my_theme_svc_reconfig_safety_p1', 'When reconfiguring or moving racking, it is important to maintain the structural integrity of your warehouse. With our team, all work is carried out safely, according to regulations.')); ?></p>
                        <p class="mt-2"><?php echo esc_html(get_option('my_theme_svc_reconfig_safety_p2', 'This ensures your system meets required standards once reinstalled.')); ?></p>
                        <p class="mt-2"><?php echo esc_html(get_option('my_theme_svc_reconfig_safety_p3', 'This is also an ideal time to assess any damage in your racking and identify areas that may need reinforcement or repair.')); ?></p>
                    </div>
                </article>
            </div>

            <div class="mt-10 bg-[#ff5c00] px-8 py-8">
                <p class="font-montserrat text-[20px] font-bold leading-[44px] text-white"><?php echo esc_html(get_option('my_theme_svc_reconfig_banner', 'By combining annual inspections with long-term racking upright protection, your warehouse becomes a more controlled, lower-risk environment.')); ?></p>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[64px]">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-8">
                <div class="h-[280px] overflow-hidden lg:h-[384px]">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_reconfig_img_left', get_theme_file_uri('assets/images/Services/Reconfiguration/config1.webp'))); ?>" alt="Warehouse aisle after racking reconfiguration" class="h-full w-full object-cover">
                </div>
                <div class="h-[280px] overflow-hidden lg:h-[384px]">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_reconfig_img_right', get_theme_file_uri('assets/images/Services/Reconfiguration/config2.webp'))); ?>" alt="Reconfigured warehouse rack upright with reinforcement" class="h-full w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#020202]">
        <div class="mx-auto grid w-full max-w-[1440px] grid-cols-1 gap-8 px-5 py-12 sm:px-6 lg:grid-cols-[1fr_570px] lg:items-start lg:gap-8 lg:px-[68px] lg:py-[80px]">
            <div>
                <h2 class="font-montserrat text-[36px] font-bold leading-[40px] text-white"><?php echo esc_html(get_option('my_theme_svc_reconfig_integrate_h2', 'Integrate Damage Prevention During Reconfiguration')); ?></h2>
                <p class="mt-8 max-w-[540px] font-roboto text-[18px] leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_svc_reconfig_integrate_desc', 'When changing warehouse racking, there\'s an opportunity to improve long-term performance. High-risk areas can be identified and strengthened with our pallet rack protection system, Goliath™, during the reconfiguration process.')); ?></p>
            </div>
            <div class="bg-[#ff5c00] px-8 py-8 lg:h-[225px] lg:px-[32px] lg:py-[31px]">
                <p class="font-montserrat text-[20px] font-bold leading-[33px] text-white"><?php echo esc_html(get_option('my_theme_svc_reconfig_integrate_callout', 'Installing Goliath™ on the weak areas provides racking upright protection, which reduces the risk of future impact damage on the same areas when operations resume.')); ?></p>
            </div>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <h2 class="font-montserrat text-[36px] font-bold leading-[40px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_reconfig_adapt_h2', 'Adapt Without Starting Over')); ?></h2>
            <p class="mt-8 max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_reconfig_adapt_desc', 'Reconfiguration is a way to learn more about your existing infrastructure. By combining our relocation services with Goliath™, you can improve your warehouse efficiency, reduce risk, and extend the lifespan of your racking system without the cost of a full replacement.')); ?></p>

            <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-6">
                <?php
                $adapt_items = [
                    [get_option('my_theme_svc_reconfig_adapt_card1_title', 'Improve Efficiency'), get_option('my_theme_svc_reconfig_adapt_card1_desc', 'Optimize your warehouse layout for better operations')],
                    [get_option('my_theme_svc_reconfig_adapt_card2_title', 'Reduce Risk'), get_option('my_theme_svc_reconfig_adapt_card2_desc', 'Identify and strengthen vulnerable areas')],
                    [get_option('my_theme_svc_reconfig_adapt_card3_title', 'Extend Lifespan'), get_option('my_theme_svc_reconfig_adapt_card3_desc', 'Protect your racking investment for the long term')],
                ];
                foreach ($adapt_items as $item) : ?>
                    <article class="bg-[#f9fafb] p-6">
                        <img src="<?php echo esc_url($assets['tick']); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                        <h3 class="mt-4 font-montserrat text-[18px] font-bold leading-[27px] text-[#020202]"><?php echo esc_html($item[0]); ?></h3>
                        <p class="mt-2 font-roboto text-[14px] leading-[20px] text-[#364153]"><?php echo esc_html($item[1]); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 text-center sm:px-6 lg:px-[68px] lg:py-[80px]">
            <h2 class="mx-auto max-w-[768px] font-montserrat text-[36px] font-bold leading-[40px] text-white"><?php echo esc_html(get_option('my_theme_svc_reconfig_final_h2', 'Reconfigure with Confidence')); ?></h2>
            <p class="mx-auto mt-8 max-w-[768px] font-roboto text-[20px] leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_svc_reconfig_final_desc', 'Transform your warehouse layout while protecting your investment with Goliath™ damage prevention.')); ?></p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-white font-roboto text-[18px] font-bold uppercase tracking-[0.45px] text-[#ff5c00] sm:w-[310px]">
                    <span><?php echo esc_html(get_option('my_theme_svc_reconfig_cta_btn1', 'Get Free Site Survey')); ?></span>
                    <img src="<?php echo esc_url($assets['cta_arrow_orange']); ?>" alt="" class="ml-3 size-5">
                </a>
                <a href="<?php echo esc_url(home_url('/services/racking-upright-repair/')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-[#020202] font-roboto text-[18px] font-bold uppercase tracking-[0.45px] text-white sm:w-[227px]"><?php echo esc_html(get_option('my_theme_svc_reconfig_cta_btn2', 'Upright Repair')); ?></a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
