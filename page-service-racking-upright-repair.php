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
    'hero_image'          => get_theme_file_uri('assets/images/Services/services-RackingUpright/case-study1.webp'),
    'cta_arrow'           => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
    'compatibility_icon'  => get_theme_file_uri('assets/images/icons/Icon-1.svg'),
    'durability_icon'     => get_theme_file_uri('assets/images/icons/badge.svg'),
    'sustainability_icon' => get_theme_file_uri('assets/images/icons/svc-shield-outline.svg'),
    'orange_button_arrow' => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];
?>

<main class="w-full bg-white overflow-x-hidden">
    <section class="w-full bg-[#020202]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[75px] lg:py-[96px]">
            <h1 class="font-montserrat text-[40px] font-bold leading-[44px] text-white lg:text-[60px] lg:leading-[60px]">
                <span class="text-white">Racking </span><span class="text-[#ff5c00]">Upright Repair</span>
            </h1>
            <p class="mt-6 max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#d1d5dc] lg:text-[20px]">
                <?php echo esc_html(get_option('my_theme_svc_upright_hero_desc', 'Racking uprights damaged in warehouses are one of the most common issues worldwide. Traditional repair methods are ineffective because they cost more, increase downtime, and have a higher risk of repeat damage.')); ?>
            </p>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[60px]">
            <div class="flex flex-col items-center text-center">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_upright_what_h2', 'What is Goliath™?')); ?></h2>
                <div class="mt-8 max-w-[1228px] font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]">
                    <p><?php echo esc_html(get_option('my_theme_svc_upright_what_p1', 'Damaged racking uprights are one of the most common issues in warehouses worldwide. This is because repeated impacts affect the structural integrity, reduce load capacity, and create ongoing safety risks for warehouses. Traditional repair methods are ineffective because they cost more, increase downtime, and have a higher risk of repeat damage.')); ?></p>
                    <p class="mt-4 font-montserrat text-[20px] font-bold leading-[23px] text-[#ff5c00]"><?php echo esc_html(get_option('my_theme_svc_upright_what_highlight', 'Goliath™ takes a different approach to ensuring safety.')); ?></p>
                    <p class="mt-4"><?php echo esc_html(get_option('my_theme_svc_upright_what_p2', 'Our solution is a permanent reinforcement system that protects uprights at their most vulnerable point. This eliminates recurring damage, reduces long-term spending, and keeps your operation running without interruption.')); ?></p>
                </div>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="mt-8 inline-flex h-[52px] w-full items-center justify-center bg-[#ff5c00] font-roboto text-[14px] font-bold uppercase tracking-[0.35px] text-white sm:w-[247px]">
                    <span><?php echo esc_html(get_option('my_theme_svc_upright_what_cta', 'Discover the Solution')); ?></span>
                    <img src="<?php echo esc_url($assets['cta_arrow']); ?>" alt="" class="ml-3 size-5">
                </a>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#f8f8f8]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-12 sm:px-6 lg:flex-row lg:justify-between lg:gap-10 lg:px-[68px] lg:py-[55px]">
            <div class="w-full lg:max-w-[684px]">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]"><?php echo esc_html(get_option('my_theme_svc_upright_how_h2', 'How Goliath™ Works')); ?></h2>
                <p class="mt-7 font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_upright_how_p1', 'Goliath™ is an engineered heavy-duty steel upright repair and protection system built for strength and long-term support.')); ?></p>
                <p class="mt-5 font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_upright_how_p2', 'Once Goliath™ is installed, it absorbs the force from repeated impacts that damage the racking itself. This prevents the need to replace uprights and reduces the risk of structural failure.')); ?></p>

                <h3 class="mt-8 font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_upright_how_h3', 'Compatible with:')); ?></h3>
                <div class="mt-4 grid grid-cols-1 gap-x-[40px] gap-y-4 sm:grid-cols-2">
                    <?php
                    $compatibility = [
                        get_option('my_theme_svc_upright_how_compat1', 'Adjustable pallet racking (APR)'),
                        get_option('my_theme_svc_upright_how_compat2', 'Wide aisle racking'),
                        get_option('my_theme_svc_upright_how_compat3', 'Narrow aisle racking'),
                        get_option('my_theme_svc_upright_how_compat4', 'High-bay warehouse systems'),
                    ];
                    foreach ($compatibility as $item) : ?>
                        <div class="flex items-center gap-3">
                            <img src="<?php echo esc_url($assets['compatibility_icon']); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                            <span class="font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html($item); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="w-full bg-[#ff5c00] px-8 py-8 lg:w-[532px] lg:px-[32px] lg:py-[30px]">
                <p class="font-montserrat text-[32px] font-bold leading-[44px] text-white lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_upright_how_callout', 'Goliath™ is not a temporary fix or a patch repair. It is a long-term structural solution built to outperform traditional repair methods.')); ?></p>
            </div>
        </div>
    </section>
    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[80px]">
            <div class="flex w-full max-w-[808px] flex-col items-start gap-4 text-left lg:gap-4">
                <img
                    src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-zig.svg')); ?>"
                    alt=""
                    class="size-12 shrink-0 sm:size-14"
                    width="56"
                    height="56"
                    aria-hidden="true"
                >
                <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#020202] lg:text-[46px] lg:leading-[44px] xl:whitespace-nowrap">
                    <?php echo esc_html(get_option('my_theme_svc_upright_cost_h2', 'A Lifetime Cost-Saving Solution')); ?>
                </h2>
                <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_svc_upright_cost_p1', 'Many warehouses in the UK treat damage to uprights as an ongoing maintenance cost. Repairs are carried out regularly as issues arise, which leads to continuous spending for the same problem.')); ?>
                </p>
                <p class="w-full font-roboto text-[20px] font-bold leading-[28px] text-[#ff5c00]">
                    <?php echo esc_html(get_option('my_theme_svc_upright_cost_highlight', 'Goliath™ proposes a lasting change.')); ?>
                </p>
                <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_svc_upright_cost_p2', 'With our permanent protection system, you stop the cycle of damage and repair. This leads to long-term savings in areas like:')); ?>
                </p>
                <ul class="grid w-full grid-cols-1 gap-x-8 gap-y-3 pt-1 sm:grid-cols-2 sm:gap-x-[44px] sm:gap-y-4">
                    <?php
                    $cost_saving_points = [
                        get_option('my_theme_svc_upright_cost_item1', 'Replacement uprights'),
                        get_option('my_theme_svc_upright_cost_item2', 'Labour and installation costs'),
                        get_option('my_theme_svc_upright_cost_item3', 'Operational downtime'),
                        get_option('my_theme_svc_upright_cost_item4', 'Safety compliance risks'),
                    ];
                    foreach ($cost_saving_points as $point) :
                        ?>
                        <li class="flex items-center gap-3">
                            <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/Icon-1.svg')); ?>" alt="" class="size-6 shrink-0" width="24" height="24" aria-hidden="true">
                            <span class="font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($point); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="w-full pt-1 font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_svc_upright_cost_p3', 'Goliath™ is a onetime structural investment that delivers clear financial benefits from the moment its installed. In high-traffic environments, these savings are even more significant.')); ?>
                </p>
            </div>
        </div>
    </section>

    <section class="relative h-[380px] w-full overflow-hidden lg:h-[604px]">
        <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_upright_hero_img', get_theme_file_uri('assets/images/Services/services-RackingUpright/case-study1.webp'))); ?>" alt="Warehouse technicians installing a racking upright repair solution" class="h-full w-full object-cover">
    </section>

    <section class="w-full bg-[#020202]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-12 sm:px-6 lg:flex-row lg:justify-between lg:px-[68px] lg:py-[80px]">
            <div class="w-full lg:max-w-[761px]">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_upright_proven_h2', 'Proven Results in High-Impact Environments')); ?></h2>
                <div class="mt-7 font-roboto text-[18px] leading-[28px] text-white">
                    <p><?php echo esc_html(get_option('my_theme_svc_upright_proven_p1', 'Goliath™ has been proven in real warehouse conditions where impact damage is frequent and costly.')); ?></p>
                    <p class="mt-4"><?php echo esc_html(get_option('my_theme_svc_upright_proven_p2', 'This is a typical result in operations where forklift movement and tight aisles increase the chances of bumping into uprights.')); ?></p>
                    <p class="mt-4"><?php echo esc_html(get_option('my_theme_svc_upright_proven_p3', 'Instead of reacting to damage, Goliath™ protects your structure.')); ?></p>
                </div>
            </div>
            <div class="w-full bg-[#ff5c00] px-8 py-8 lg:w-[436px] lg:px-[32px] lg:py-[32px]">
                <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-white"><?php echo esc_html(get_option('my_theme_svc_upright_case_h3', 'Case Study: B&M')); ?></h3>
                <p class="mt-4 font-roboto text-[18px] leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_svc_upright_case_desc', 'Our client, B&M, saw a reduction of over 30% in repair costs within the first 12 months of installing Goliath™. This was achieved by eliminating repeat damage to uprights in high-risk areas. Cost-conscious operators can imagine how much this equates to across a 5 or 10-year period.')); ?></p>
            </div>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-12 sm:px-6 lg:flex-row lg:gap-[74px] lg:px-[68px] lg:py-[80px]">
            <article class="w-full">
                <img src="<?php echo esc_url($assets['durability_icon']); ?>" alt="" class="h-12 w-12 shrink-0 object-contain" width="48" height="49">
                <h2 class="mt-6 font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_upright_dur_h2', 'Built for Durability and Backed by Warranty')); ?></h2>
                <div class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]">
                    <p><?php echo esc_html(get_option('my_theme_svc_upright_dur_p1', 'Goliath™ is engineered from high-strength steel to withstand repeated impacts in demanding environments.')); ?></p>
                    <p class="mt-4 font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_upright_dur_bold', 'Comprehensive Lifetime Impact Warranty')); ?></p>
                    <p class="mt-2"><?php echo esc_html(get_option('my_theme_svc_upright_dur_p2', '"If Goliath™ becomes damaged from normal use, we will replace or repair it for free - no questions asked."')); ?></p>
                </div>
            </article>
            <article class="w-full">
                <img src="<?php echo esc_url($assets['sustainability_icon']); ?>" alt="" class="h-12 w-12 shrink-0 object-contain" width="40" height="40">
                <h2 class="mt-6 font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_upright_sus_h2', 'A More Sustainable Approach to Racking Repairs')); ?></h2>
                <div class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]">
                    <p><?php echo esc_html(get_option('my_theme_svc_upright_sus_p1', 'Sustainability is a key priority for warehouse operations. When you constantly replace damaged uprights, it leads to unnecessary steel usage, increased waste, and higher environmental impact.')); ?></p>
                    <p class="mt-2 font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_upright_sus_bold', 'Goliath™ is the more sustainable alternative.')); ?></p>
                    <p class="mt-2"><?php echo esc_html(get_option('my_theme_svc_upright_sus_p2', 'The principle is simple: install once and stop the cycle of damage.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_svc_upright_sus_p3', 'This not only reduces waste but also aligns with broader sustainability goals across logistics and distribution operations.')); ?></p>
                </div>
            </article>
        </div>
    </section>

    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 text-center sm:px-6 lg:px-[68px] lg:py-[80px]">
            <h2 class="mx-auto max-w-[942px] font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_upright_cta_h2', 'Choose Strength and Support with Goliath™')); ?></h2>
            <p class="mx-auto mt-8 max-w-[911px] font-roboto text-[20px] leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_svc_upright_cta_desc', 'If your warehouse is dealing with repeated upright damage, the question is not whether to repair again. It is how to stop the damage from happening. Goliath™ is the answer.')); ?></p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-white font-roboto text-[18px] font-bold uppercase tracking-[0.45px] text-[#ff5c00] sm:w-[310px]">
                    <span><?php echo esc_html(get_option('my_theme_svc_upright_cta_btn1', 'Get Free Site Survey')); ?></span>
                    <img src="<?php echo esc_url($assets['orange_button_arrow']); ?>" alt="" class="ml-3 size-5">
                </a>
                <a href="<?php echo esc_url(home_url('/case-studies/')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-[#020202] font-roboto text-[18px] font-bold uppercase tracking-[0.45px] text-white sm:w-[257px]">
                    <?php echo esc_html(get_option('my_theme_svc_upright_cta_btn2', 'View Case Studies')); ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
