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
    'split_image' => get_theme_file_uri('assets/images/Services/damage/dent.webp'),
    'support_image' => get_theme_file_uri('assets/images/Services/damage/support.webp'),
    'warning_icon' => get_theme_file_uri('assets/images/icons/safe.svg'),
    'cta_arrow' => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
    'list_tick' => get_theme_file_uri('assets/images/icons/Icon-1.svg'),
    'section_icon' => get_theme_file_uri('assets/images/icons/why-goliath-zig.svg'),
    'orange_button_arrow' => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
    'black_button_arrow' => get_theme_file_uri('assets/images/icons/arrow-right-white.svg'),
    'card_icon' => get_theme_file_uri('assets/images/icons/svc-shield-outline.svg'),
    'orange_card_icon' => get_theme_file_uri('assets/images/icons/svc-shield-on-orange.svg'),
    'shield_icon' => get_theme_file_uri('assets/images/icons/svc-shield-outline.svg'),
];
?>

<main class="w-full bg-white overflow-x-hidden">
    <section class="w-full bg-[#020202]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[75px] lg:py-[128px]">
            <h1 class="font-montserrat text-[40px] font-bold leading-[44px] text-white lg:text-[60px] lg:leading-[60px]">
                <span class="text-white">Damage </span><span class="text-[#ff5c00]">Prevention</span>
            </h1>
            <p class="mt-6 max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#d1d5dc] lg:text-[20px]">
                <?php echo esc_html(get_option('my_theme_svc_prevention_hero_desc', 'Whenever racking damage happens, it is often overlooked until it becomes a problem big enough to affect operations. Most impact-related issues can be avoided entirely if you have the right type of protection in place.')); ?>
            </p>
        </div>
    </section>

    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col px-5 py-10 sm:px-6 lg:flex-row lg:items-stretch lg:px-[68px] lg:py-[64px]">
            <div class="h-[460px] min-h-[400px] w-full overflow-hidden sm:h-[540px] sm:min-h-[480px] lg:h-[640px] lg:min-h-[640px] xl:h-[680px] xl:min-h-[680px] lg:flex-1">
                <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_prevention_split_img', get_theme_file_uri('assets/images/Services/damage/dent.webp'))); ?>" alt="Damaged racking upright beside a Goliath-protected upright in a warehouse" class="h-full w-full object-cover object-bottom">
            </div>
            <div class="flex min-h-[460px] w-full items-center justify-center bg-[#ff5c00] px-8 py-12 text-center sm:min-h-[540px] lg:min-h-[640px] xl:min-h-[680px] lg:flex-1 lg:py-14">
                <div>
                    <p class="font-montserrat text-[32px] font-bold leading-[44px] text-white lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_prevention_split_h2', 'Goliath™ is the upright repair that stops any damage before it happens.')); ?></p>
                    <p class="mt-4 font-montserrat text-[16px] font-medium leading-[23px] text-white"><?php echo esc_html(get_option('my_theme_svc_prevention_split_desc', 'It reinforces the most exposed section of the upright, delivering reliable protection against forklift and pallet truck impacts.')); ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:pb-[90px] lg:pt-[80px]">
            <h2 class="max-w-[896px] font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_prevention_costly_h2', 'Prevent Pallet Racking Damage Before It Becomes Costly')); ?></h2>
            <p class="mt-8 max-w-[1013px] font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_prevention_costly_p1', 'Many warehouse supervisors search for racking repairs in the UK after significant damage has already occurred. Every one of these reactive incidents carries direct repair costs and a wider operational impact.')); ?></p>
            <p class="mt-6 max-w-[991px] font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_prevention_costly_p2', 'It is critical to ensure your upright is protected against forklift impacts because even minor collisions can lead to:')); ?></p>

            <div class="mt-10 grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-6">
                <?php
                $risk_cards = [
                    ['title' => get_option('my_theme_svc_prevention_card1_title', 'Complete aisle closures'), 'desc' => get_option('my_theme_svc_prevention_card1_desc', 'Restricted access affecting operations')],
                    ['title' => get_option('my_theme_svc_prevention_card2_title', 'Unplanned maintenance'), 'desc' => get_option('my_theme_svc_prevention_card2_desc', 'Unplanned maintenance and inspections')],
                    ['title' => get_option('my_theme_svc_prevention_card3_title', 'Picking delays'), 'desc' => get_option('my_theme_svc_prevention_card3_desc', 'Delays in picking and fulfilment')],
                    ['title' => get_option('my_theme_svc_prevention_card4_title', 'Racking collapse risk'), 'desc' => get_option('my_theme_svc_prevention_card4_desc', 'Putting staff at serious risk of injury')],
                ];
                foreach ($risk_cards as $card) : ?>
                    <article class="bg-[#f9fafb] p-6">
                        <img src="<?php echo esc_url($assets['warning_icon']); ?>" alt="" class="size-8">
                        <h3 class="mt-4 font-montserrat text-[18px] font-bold leading-[27px] text-[#020202]"><?php echo esc_html($card['title']); ?></h3>
                        <p class="mt-2 font-roboto text-[14px] leading-[20px] text-[#364153]"><?php echo esc_html($card['desc']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="mt-6 bg-[#020202] px-8 py-8">
                <p class="font-roboto text-[18px] leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_svc_prevention_dark_p1', 'The direct effect of this is warehouse downtime, one of the most expensive hidden costs in logistics. When racking is damaged, your operations slow down or stop while repairs are carried out.')); ?></p>
                <p class="mt-4 font-roboto text-[20px] font-bold leading-[28px] text-[#ff5c00]"><?php echo esc_html(get_option('my_theme_svc_prevention_dark_highlight', 'Goliath™ breaks this cycle by acting as a permanent pallet rack protection system.')); ?></p>
            </div>

            <p class="mt-6 max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_prevention_after_p', 'It prevents impacts and keeps your warehouse running without disruption. This is the best pallet racking repair kit alternative that eliminates repeat damage completely.')); ?></p>
        </div>
    </section>

    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-6 px-5 py-10 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-[68px] lg:py-[32px]">
            <div>
                <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-white"><?php echo esc_html(get_option('my_theme_svc_prevention_case_h3', 'Case Study: B&M')); ?></h3>
                <p class="mt-2 max-w-[693px] font-roboto text-[18px] leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_svc_prevention_case_desc', 'The financial impact is also clear. Our client, B&M, reduced repair costs by over 30% within the first 12 months of installing Goliath™. That reduction came from preventing repeat damage to their uprights, not simply fixing it faster.')); ?></p>
            </div>
            <a href="<?php echo esc_url(home_url('/case-studies/bm-racking-damage/')); ?>" class="inline-flex h-[52px] items-center bg-[#020202] px-[38px] py-[18px] font-montserrat text-[16px] font-bold tracking-[0.35px] text-white">
                <span><?php echo esc_html(get_option('my_theme_svc_prevention_case_cta', 'Full Case Study')); ?></span>
                <img src="<?php echo esc_url($assets['black_button_arrow']); ?>" alt="" class="ml-14 size-5">
            </a>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <img src="<?php echo esc_url($assets['section_icon']); ?>" alt="" class="h-12 w-12 object-contain" width="64" height="64">
            <h2 class="mt-6 max-w-[808px] font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_prevention_savings_h2', 'Long-Term Savings with Lifetime Impact Warranty')); ?></h2>
            <p class="mt-6 max-w-[1024px] font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_prevention_savings_p1', 'Goliath™ is a onetime investment that replaces the ongoing cycle of carrying out racking repairs, on which operations rely.')); ?></p>
            <p class="mt-4 max-w-[1036px] font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_prevention_savings_p2', 'With our lifetime impact warranty, we provide continuous protection to our clients without repeat costs in the same location.')); ?></p>
            <p class="mt-4 font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_prevention_savings_p3', 'You can save across:')); ?></p>

            <div class="mt-4 grid grid-cols-1 gap-x-4 gap-y-3 sm:grid-cols-2 lg:w-[584px]">
                <?php
                $savings = [
                    get_option('my_theme_svc_prevention_savings_item1', 'Replacing uprights'),
                    get_option('my_theme_svc_prevention_savings_item2', 'Downtime and lost productivity'),
                    get_option('my_theme_svc_prevention_savings_item3', 'Labour and installation'),
                    get_option('my_theme_svc_prevention_savings_item4', 'Repeated inspection-triggered repairs'),
                ];
                foreach ($savings as $saving) : ?>
                    <div class="flex items-center gap-3">
                        <img src="<?php echo esc_url($assets['list_tick']); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                        <span class="font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html($saving); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <p class="mt-6 max-w-[808px] font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]"><?php echo esc_html(get_option('my_theme_svc_prevention_savings_highlight', 'Over time, preventing pallet racking damage has more value than managing the problem when it arises.')); ?></p>

            <div class="mt-8 bg-[#e8e8e9] px-5 py-5 lg:px-[38px] lg:py-0 lg:h-[104px]">
                <div class="flex h-full w-full flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <p class="font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_prevention_savings_banner', '100% Client Satisfaction • Save 70% • 30min Installation • Lifetime Warranty')); ?></p>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[52px] w-full items-center justify-center bg-[#020202] font-roboto text-[16px] font-semibold text-white sm:w-[286px]">
                        <span><?php echo esc_html(get_option('my_theme_svc_prevention_savings_cta', 'Get Similar Results')); ?></span>
                        <img src="<?php echo esc_url($assets['cta_arrow']); ?>" alt="" class="ml-8 size-5">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <h2 class="mx-auto max-w-[979px] text-center font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_prevention_suitable_h2', 'Suitable for New and Existing Racking Installations')); ?></h2>
            <p class="mx-auto mt-10 max-w-[1031px] text-center font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_prevention_suitable_desc', 'If you\'re thinking about installing Goliath™, note that it can be integrated into both existing systems and new warehouse projects.')); ?></p>

            <div class="mt-10 grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-6">
                <article class="h-full border-2 border-[#ff5c00] bg-white px-[34px] pb-[34px] pt-[34px]">
                    <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_prevention_existing_h3', 'Existing Sites')); ?></h3>
                    <p class="mt-4 font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_prevention_existing_desc', 'For sites in operation, it provides instant racking upright protection in areas with high-impact.')); ?></p>
                </article>
                <article class="h-full border-2 border-[#ff5c00] bg-white px-[34px] pb-[34px] pt-[34px]">
                    <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_prevention_new_h3', 'New Installations')); ?></h3>
                    <p class="mt-4 font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html(get_option('my_theme_svc_prevention_new_desc', 'For new installations, it can serve as part of your original warehouse design as a complete pallet racking damage prevention strategy. This ensures protection is in place before any damage occurs.')); ?></p>
                </article>
            </div>
        </div>
    </section>

    <section class="w-full bg-white">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-12 sm:px-6 lg:flex-row lg:items-start lg:gap-10 lg:px-[68px] lg:py-[80px]">
            <div class="w-full lg:max-w-[597px]">
                <img src="<?php echo esc_url($assets['card_icon']); ?>" alt="" class="h-12 w-12 shrink-0 object-contain" width="40" height="40">
                <h2 class="mt-6 max-w-[545px] font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_prevention_sema_h2', 'Support SEMA Racking Inspection and Compliance')); ?></h2>
                <div class="mt-6 font-roboto text-[18px] leading-[28px] text-[#364153]">
                    <p><?php echo esc_html(get_option('my_theme_svc_prevention_sema_p1', 'Safety compliance is important in warehouse operations. An annual SEMA racking inspection is crucial for identifying risks and maintaining safe load conditions.')); ?></p>
                    <p class="mt-4"><?php echo esc_html(get_option('my_theme_svc_prevention_sema_p2', 'Damaged uprights are one of the most common issues identified during inspections. By installing Goliath™, you reduce the likelihood of damage being flagged at all. This supports ongoing compliance while reducing the need for corrective action between inspections.')); ?></p>
                </div>
            </div>
            <div class="w-full overflow-hidden lg:h-[427px] lg:w-[640px]">
                <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_svc_prevention_sema_img', get_theme_file_uri('assets/images/Services/damage/support.webp'))); ?>" alt="Warehouse operative inspecting racking with tablet" class="h-full w-full object-cover">
            </div>
        </div>
    </section>

    <section class="w-full bg-[#020202]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-12 sm:px-6 lg:flex-row lg:items-start lg:justify-between lg:px-[68px] lg:py-[80px]">
            <div class="w-full bg-[#ff5c00] px-8 py-10 lg:w-[532px] lg:h-[392px] lg:px-[32px]">
                <img src="<?php echo esc_url($assets['orange_card_icon']); ?>" alt="" class="h-8 w-8 shrink-0 object-contain" width="32" height="32">
                <h3 class="mt-8 max-w-[458px] font-montserrat text-[32px] font-bold leading-[44px] text-white lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_prevention_risk_h3', 'Smarter Racking Management and Risk Visibility')); ?></h3>
            </div>
            <div class="w-full lg:w-[736px]">
                <p class="font-montserrat text-[16px] font-bold leading-[23px] text-white"><?php echo esc_html(get_option('my_theme_svc_prevention_risk_bold', 'Effective pallet racking damage prevention also requires visibility across your warehouse.')); ?></p>
                <p class="mt-5 max-w-[645px] font-roboto text-[18px] leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_svc_prevention_risk_p1', 'Goliath™ supports a digital system that manages and monitors your racking. This includes:')); ?></p>
                <ul class="mt-5 space-y-3">
                    <?php
                    $visibility_points = [
                        get_option('my_theme_svc_prevention_risk_item1', 'Warehouse mapping'),
                        get_option('my_theme_svc_prevention_risk_item2', 'Risk categorisation'),
                        get_option('my_theme_svc_prevention_risk_item3', 'Digitally recorded racking upright repair history'),
                        get_option('my_theme_svc_prevention_risk_item4', 'Signed documentation for audits and compliance'),
                    ];
                    foreach ($visibility_points as $point) : ?>
                        <li class="flex items-center gap-3">
                            <img src="<?php echo esc_url($assets['list_tick']); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                            <span class="font-roboto text-[16px] leading-[24px] text-white"><?php echo esc_html($point); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="mt-5 max-w-[523px] font-roboto text-[18px] leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_svc_prevention_risk_p2', 'This structured approach supports both internal safety processes and external inspection requirements.')); ?></p>
            </div>
        </div>
    </section>

    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <div class="mx-auto max-w-[768px] text-center">
                <img src="<?php echo esc_url($assets['shield_icon']); ?>" alt="" class="mx-auto h-16 w-16 object-contain" width="40" height="40">
                <h2 class="mt-12 font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_svc_prevention_stop_h2', 'Stop Damage Before It Starts')); ?></h2>
                <p class="mt-12 font-roboto text-[20px] leading-[28px] text-[#020202]"><?php echo esc_html(get_option('my_theme_svc_prevention_stop_desc', 'There\'s no need to search for a pallet racking repair kit or racking upright repair. Goliath™ addresses repeated impact damage before the worst happens. Our superior upright repair solution allows you to prevent pallet racking damage rather than respond to it. This results in fewer repairs, reduced downtime, and a safer, more efficient warehouse operation.')); ?></p>
                <div class="mt-12 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-[#ff5c00] font-roboto text-[18px] font-bold uppercase tracking-[0.45px] text-white sm:w-[310px]">
                        <span><?php echo esc_html(get_option('my_theme_svc_prevention_cta_btn1', 'Get Free Site Survey')); ?></span>
                        <img src="<?php echo esc_url($assets['orange_button_arrow']); ?>" alt="" class="ml-3 size-5">
                    </a>
                    <a href="<?php echo esc_url(home_url('/services/annual-inspections/')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-[#020202] font-roboto text-[18px] font-bold uppercase tracking-[0.45px] text-white sm:w-[279px]">
                        <?php echo esc_html(get_option('my_theme_svc_prevention_cta_btn2', 'Annual Inspections')); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
