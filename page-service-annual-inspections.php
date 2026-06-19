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
    'inspection_img_1' => get_theme_file_uri('assets/images/Services/inspection/inspection1.webp'),
    'inspection_img_2' => get_theme_file_uri('assets/images/Services/inspection/inspection2.webp'),
    'tick' => get_theme_file_uri('assets/images/icons/Icon-1.svg'),
    'icon_left' => get_theme_file_uri('assets/images/icons/svc-speed-icon.svg'),
    'icon_reduce_risk' => get_theme_file_uri('assets/images/icons/svc-reduce-risk-warning.svg'),
    'icon_shield' => get_theme_file_uri('assets/images/icons/svc-shield-icon.svg'),
    'cta_arrow' => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];
?>

<main class="w-full bg-white overflow-x-hidden">
    <section class="w-full bg-[#020202]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[75px] lg:py-[128px]">
            <h1 class="font-montserrat text-[40px] font-bold leading-[44px] text-white lg:text-[60px] lg:leading-[60px]">
                <span class="text-white">Annual </span><span class="text-[#ff5c00]">Inspections</span>
            </h1>
            <p class="mt-6 max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#d1d5dc] lg:text-[20px]">
                <?php echo esc_html(get_option('my_theme_svc_inspections_hero_desc', 'Regular racking inspections are important for ensuring safety is maintained, structures are compliant, and operations are efficient. In many busy warehouse environments, minor damage can worsen if it is not identified and managed early.')); ?>
            </p>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <p class="font-montserrat text-[16px] font-medium leading-[24px] text-[#364153]">
                <?php echo esc_html(get_option('my_theme_svc_inspections_intro', 'Annual inspections are a structured way for warehouse owners and operators to assess the condition of pallet racking systems. These inspections identify damage, monitor wear and tear, and ensure that your storage systems meet the required safety standards, including SEMA racking inspection guidelines.')); ?>
            </p>
            <div class="mt-10 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-8">
                <article class="bg-[#f9fafb] p-8">
                    <h2 class="font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_inspections_covers_h2', 'A typical inspection covers:')); ?></h2>
                    <ul class="mt-6 space-y-3">
                        <?php
                        $inspection_points = [
                            get_option('my_theme_svc_inspections_covers_item1', 'The condition of your uprights and any impact damage'),
                            get_option('my_theme_svc_inspections_covers_item2', 'Beam integrity and load performance'),
                            get_option('my_theme_svc_inspections_covers_item3', 'Stability of the base plates and floor fixings'),
                            get_option('my_theme_svc_inspections_covers_item4', 'Pallet alignment and overall structural stability'),
                        ];
                        foreach ($inspection_points as $point) : ?>
                            <li class="flex items-start gap-3">
                                <img src="<?php echo esc_url($assets['tick']); ?>" alt="" class="mt-1 h-6 w-6 shrink-0" width="24" height="24">
                                <span class="font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html($point); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </article>
                <article class="bg-[#ff5c00] p-8">
                    <p class="font-montserrat text-[36px] font-bold leading-[44px] text-white"><?php echo esc_html(get_option('my_theme_svc_inspections_callout', 'The goal is simple. When risks are identified early, it prevents them from becoming costly problems.')); ?></p>
                </article>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[75px] lg:py-[64px]">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-8">
                <div class="h-[280px] overflow-hidden lg:h-[384px]">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_inspections_img1', get_theme_file_uri('assets/images/Services/inspection/inspection1.webp'))); ?>" alt="SEMA inspection recording in warehouse aisle" class="h-full w-full object-cover">
                </div>
                <div class="h-[280px] overflow-hidden lg:h-[384px]">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_inspections_img2', get_theme_file_uri('assets/images/Services/inspection/inspection2.webp'))); ?>" alt="Technician performing annual racking inspection" class="h-full w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:pb-[50px] lg:pt-[80px]">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-12">
                <article>
                    <img src="<?php echo esc_url($assets['icon_left']); ?>" alt="" class="block size-18 shrink-0" width="40" height="40">
                    <h2 class="mt-8 font-montserrat text-[36px] font-bold leading-[40px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_inspections_smarter_h2', 'Smarter Inspection Management')); ?></h2>
                    <p class="mt-6 max-w-[534px] font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_inspections_smarter_p1', 'Warehouse inspections are more effective when they are supported by clear data. Our digital racking management system helps to track the condition of your warehouse more effectively.')); ?></p>
                    <p class="mt-4 font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_inspections_smarter_p2', 'It creates a clear audit trail and helps prioritise repairs based on risk level.')); ?></p>
                </article>
                <article>
                    <img src="<?php echo esc_url($assets['icon_reduce_risk']); ?>" alt="" class="block size-18 shrink-0 object-contain" width="40" height="40">
                    <h2 class="mt-8 font-montserrat text-[36px] font-bold leading-[40px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_inspections_reduce_h2', 'Reduce Risk with Goliath™')); ?></h2>
                    <p class="mt-6 max-w-[534px] font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_inspections_reduce_p1', 'Inspections only identify the issues in your warehouse, but prevention reduces how often they occur.')); ?></p>
                    <p class="mt-4 font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_inspections_reduce_p2', 'Installing a highly durable pallet rack protection system like Goliath™ helps minimise damage between inspection cycles.')); ?></p>
                </article>
            </div>
            <div class="mt-12 bg-[#ff5c00] px-8 py-8">
                <p class="font-montserrat text-[20px] font-bold leading-[44px] text-white"><?php echo esc_html(get_option('my_theme_svc_inspections_banner', 'By combining annual inspections with long-term racking upright protection, your warehouse becomes a more controlled, lower-risk environment.')); ?></p>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <div class="mx-auto max-w-[900px] text-center">
                <img src="<?php echo esc_url($assets['icon_shield']); ?>" alt="" class="mx-auto size-20">
                <h2 class="mt-8 font-montserrat text-[36px] font-bold leading-[40px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_inspections_final_h2', 'Choose Goliath™ for Fewer Disruptions')); ?></h2>
                <p class="mt-6 font-roboto text-[20px] leading-[28px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_inspections_final_desc', 'Improved compliance, and a safer warehouse that stays working for longer.')); ?></p>
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-[#020202] font-roboto text-[18px] font-bold uppercase tracking-[0.45px] text-white sm:w-[310px]">
                        <span><?php echo esc_html(get_option('my_theme_svc_inspections_cta_btn1', 'Get Free Site Survey')); ?></span>
                        <img src="<?php echo esc_url($assets['cta_arrow']); ?>" alt="" class="ml-3 size-5">
                    </a>
                    <a href="<?php echo esc_url(home_url('/compliance/')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-[#ff5c00] font-roboto text-[18px] font-bold uppercase tracking-[0.45px] text-white sm:w-[295px]">
                        <?php echo esc_html(get_option('my_theme_svc_inspections_cta_btn2', 'View Compliance Info')); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
