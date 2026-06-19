<?php
/*
Template Name: Why Goliath Page
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
?>

<main class="w-full bg-white overflow-x-hidden">

    <!-- 610:23418 — Hero -->
    <section
        class="relative w-full h-auto lg:h-[400px] hero-gradient-bg"
    >
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-[10px]">
                <p class="font-montserrat text-[14px] font-medium leading-[22px] tracking-[0.07px] text-[#ff5c00] sm:text-[16px] sm:leading-[24px] sm:whitespace-nowrap">
                    <?php echo esc_html(get_option('my_theme_wg_hero_badge', 'THE GOLIATH DIFFERENCE')); ?>
                </p>
                <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <?php
                    $wg_h1 = get_option('my_theme_wg_hero_h1', 'Why GOLIATH™');
                    $wg_h1_parts = explode('GOLIATH', $wg_h1, 2);
                    ?>
                    <span><?php echo esc_html($wg_h1_parts[0]); ?></span><span class="text-[#ff5c00]"><?php echo esc_html('GOLIATH' . ($wg_h1_parts[1] ?? '™')); ?></span>
                </h1>
                <p class="max-w-[1288px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    <?php echo esc_html(get_option('my_theme_wg_hero_desc', 'Damage to racking happens frequently in busy warehouse environments. The actual problem is not just the damage, but how the damage is handled. The chosen repair method keeps warehouse owners or operators in a cycle of replace and repair, resulting in repeat costs and lower profitability.')); ?>
                </p>
                <a
                    href="<?php echo esc_url(home_url('/case-studies/')); ?>"
                    class="inline-flex h-[57px] w-full items-center justify-center bg-[#ff5c00] px-6 font-montserrat text-[14px] font-bold uppercase leading-[21px] tracking-[0.35px] text-white hover:opacity-95 sm:w-[257px]"
                >
                    <?php echo esc_html(get_option('my_theme_wg_hero_cta', 'View case studies')); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- 610:23431 — vs Standard -->
    <section class="w-full bg-white py-10 lg:py-[80px]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-[28px] px-5 sm:px-6 lg:gap-[36px] lg:px-[68px]">
            <div class="w-full max-w-[1024px] text-center">
                <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_wg_vs_h2', 'Goliath™ vs. Standard Repair')); ?>
                </h2>
            </div>
            <div class="flex w-full max-w-[1302px] flex-col lg:flex-row">
                <div class="flex flex-1 flex-col gap-[16px] bg-[#f9fafb] p-6 lg:p-[32px]">
                    <h3 class="font-montserrat text-[22px] font-bold leading-[32px] text-[#364153] lg:text-[24px]">
                        <?php echo esc_html(get_option('my_theme_wg_vs_trad_h3', 'Traditional Repair')); ?>
                    </h3>
                    <p class="font-roboto text-[16px] font-normal leading-[24px] text-[#364153] lg:max-w-[504px]">
                        <?php echo esc_html(get_option('my_theme_wg_vs_trad_p', 'Traditional pallet racking repair\'s sole focus is on replacing damaged uprights. This means uprights have to be damaged first before being repaired. The biggest problem with standard repair is that it doesn\'t prevent the same issue from happening again.')); ?>
                    </p>
                    <p class="font-roboto text-[16px] font-bold leading-[24px] text-[#364153] lg:max-w-[432px]">
                        <?php echo esc_html(get_option('my_theme_wg_vs_trad_bold', 'This means uprights are replaced and eventually damaged again.')); ?>
                    </p>
                </div>
                <div class="flex flex-1 flex-col gap-[20px] bg-[#ff5c00] p-6 lg:gap-[27px] lg:p-[32px]">
                    <h3 class="font-montserrat text-[22px] font-bold leading-[32px] text-white lg:text-[24px]">
                        <?php echo esc_html(get_option('my_theme_wg_vs_gol_h3', 'Goliath™ is Different')); ?>
                    </h3>
                    <p class="font-roboto text-[16px] font-normal leading-[24px] text-white lg:max-w-[530px]">
                        <?php echo esc_html(get_option('my_theme_wg_vs_gol_p', 'Instead of repeatedly replacing the upright with the standard system, the upright is replaced with our high-strength steel repair system. Goliath™ is built to brace for impact, ensuring the structure is stronger and more resilient to handle high-traffic environments more effectively.')); ?>
                    </p>
                    <p class="font-roboto text-[16px] font-bold leading-[24px] text-white lg:max-w-[432px]">
                        <?php echo esc_html(get_option('my_theme_wg_vs_gol_bold', 'While standard repair methods are reactive, Goliath™ is a permanent upgrade for future circumstances.')); ?>
                    </p>
                </div>
            </div>
            <?php
            $why_goliath_vs_standard_trio = [
                [
                    'src' => esc_url(my_theme_get_image_url('my_theme_wg_vs_img1', get_theme_file_uri('assets/images/whyGoliath/solution.webp'))),
                    'alt' => 'Technician fitting a yellow Goliath repair sleeve to a pallet racking upright with a power tool.',
                ],
                [
                    'src' => esc_url(my_theme_get_image_url('my_theme_wg_vs_img2', get_theme_file_uri('assets/images/Homepage/review-3.webp'))),
                    'alt' => 'Warehouse racking upright showing a yellow Goliath base repair installed and fixed to the floor.',
                ],
                [
                    'src' => esc_url(my_theme_get_image_url('my_theme_wg_vs_img3', get_theme_file_uri('assets/images/Homepage/review-1.webp'))),
                    'alt' => 'Close-up of a completed yellow Goliath upright protection on industrial pallet racking.',
                ],
            ];
            ?>
            <div class="grid w-full max-w-[1302px] grid-cols-1 gap-2 sm:grid-cols-3 sm:gap-3 lg:gap-4">
                <?php foreach ($why_goliath_vs_standard_trio as $img) : ?>
                    <div class="h-[220px] min-h-0 overflow-hidden sm:h-[320px] lg:h-[534px]">
                        <img
                            src="<?php echo $img['src']; ?>"
                            alt="<?php echo esc_attr($img['alt']); ?>"
                            class="h-full w-full object-cover"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 610:23452 — Future costs (full-width band, content left-aligned with page grid) -->
    <section class="w-full bg-[#f9fafb]" aria-labelledby="future-costs-heading">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[112px]">
            <div class="flex w-full max-w-[808px] flex-col items-start gap-5 text-left lg:gap-6">
                <img
                    src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-zig.svg')); ?>"
                    alt=""
                    class="size-12 shrink-0 sm:size-14 [transform:scaleY(-1)]"
                    width="56"
                    height="56"
                    aria-hidden="true"
                >
                <h2 id="future-costs-heading" class="font-montserrat text-[28px] font-bold leading-[36px] text-[#020202] sm:leading-[40px] lg:text-[36px] lg:leading-[44px]">
                    <?php echo esc_html(get_option('my_theme_wg_fc_h2', 'The Right Way to Save Future Costs')); ?>
                </h2>
                <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_wg_fc_p1', 'Choosing to replace uprights every time they are damaged is the most expensive solution.')); ?>
                </p>
                <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_wg_fc_p2', 'This is because every replacement involves:')); ?>
                </p>
                <ul class="flex w-full flex-col gap-3 lg:gap-4">
                    <?php
                    $future_cost_items = [
                        'New materials',
                        'Labour and installation costs',
                        'Disruptions to warehouse operations',
                        'Loss of storage capacity under certain conditions',
                    ];
                    foreach ($future_cost_items as $item) :
                    ?>
                        <li class="flex w-full items-start gap-3">
                            <img
                                src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-bullet-dark.svg')); ?>"
                                alt=""
                                class="mt-0.5 size-6 shrink-0"
                                width="24"
                                height="24"
                                aria-hidden="true"
                            >
                            <span class="font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_wg_fc_p3', 'Goliath™ reduces that recurring expense by strengthening the uprights and preventing repeat damage in the same location. By doing this, there is a reduced need for future repairs.')); ?>
                </p>
                <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_wg_fc_p4', 'That means lower maintenance costs, fewer repair runs, and better budget control.')); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- 610:23493 — Repair vs replace -->
    <section class="w-full bg-[#020202]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-10 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:gap-0 lg:px-[68px] lg:py-[80px]">
            <div class="flex w-full flex-col gap-[14px] lg:w-[685px] lg:shrink-0">
                <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-white lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_wg_rr_h2', 'Repair with Goliath™ vs. Replace the Upright')); ?>
                </h2>
                <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#d1d5dc]">
                    <?php echo esc_html(get_option('my_theme_wg_rr_subtitle', 'Why repair with Goliath™ vs. replace upright?')); ?>
                </p>
                <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#d1d5dc] lg:text-[20px]">
                    <?php echo esc_html(get_option('my_theme_wg_rr_p1', 'Replacing an upright restores it to an original, damage-free product. But it does not reduce or improve its resistance to impact. It merely restarts the process.')); ?>
                </p>
                <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#d1d5dc]">
                    <?php echo esc_html(get_option('my_theme_wg_rr_p2', 'Goliath™ is built for high-traffic warehouse environments where impact is unavoidable.')); ?>
                </p>
                <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#d1d5dc]">
                    <?php echo esc_html(get_option('my_theme_wg_rr_p3', 'With Goliath™, the focus shifts from reactive maintenance to proactive support, which reduces downtime and cuts costs.')); ?>
                </p>
            </div>
            <div class="flex w-full max-w-[512px] flex-col gap-[12px] bg-[#ff5c00] px-6 py-6 lg:h-[288px] lg:w-[512px] lg:px-[60px] lg:py-[30px]">
                <p class="font-roboto text-[22px] font-bold leading-[32px] text-white lg:text-[24px]">
                    <?php echo esc_html(get_option('my_theme_wg_rr_quote', 'Instead of resetting the problem, which replacement does, Goliath™ solves it.')); ?>
                </p>
                <?php
                $solves_items = [
                    'Manufactured from 6mm structural steel',
                    'Designed with a 100% overloading safety factor',
                    'Engineered to withstand repeated forklift impacts',
                ];
                foreach ($solves_items as $item) :
                ?>
                    <div class="flex items-center gap-[12px]">
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-bullet-light.svg')); ?>" alt="" class="size-6 shrink-0">
                        <span class="font-roboto text-[16px] font-normal leading-[24px] text-white"><?php echo esc_html($item); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 610:23526 — Compatible -->
    <section class="w-full bg-white py-10 lg:h-[545px] lg:py-0">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-10 sm:px-6 lg:flex-row lg:items-center lg:gap-[90px] lg:px-[68px] lg:py-[80px]">
            <div class="w-full pt-0 lg:w-[896px] lg:pt-[80px]">
                <h2 class="mb-[24px] font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_wg_cs_h2', 'Compatible with All Major Racking Systems')); ?>
                </h2>
                <p class="mb-[24px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_wg_cs_p1', 'Warehouses are built differently, and so are racking systems.')); ?>
                </p>
                <p class="mb-[32px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_wg_cs_p2', 'Goliath™ retrofits to all major pallet racking systems used in the UK, making it a flexible solution for different industries and layouts. This allows you to upgrade your existing racks without having to replace the entire structure.')); ?>
                </p>
                <p class="mb-[24px] font-roboto text-[20px] font-bold leading-[28px] text-[#020202]">
                    <?php echo esc_html(get_option('my_theme_wg_cs_bold', 'Goliath™ is suitable for:')); ?>
                </p>
                <?php
                $compat_items = [
                    ['Distribution centres', 'Logistics operations'],
                    ['Retail warehouses', 'Manufacturing facilities'],
                    ['Cold food stores', 'FMCG'],
                ];
                ?>
                <div class="flex flex-col gap-[16px]">
                    <?php foreach ($compat_items as $row) : ?>
                        <div class="flex flex-col gap-4 lg:flex-row lg:gap-0">
                            <div class="flex w-full items-center gap-[12px] lg:w-[440px]">
                                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-bullet-dark.svg')); ?>" alt="" class="size-6 shrink-0">
                                <span class="font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($row[0]); ?></span>
                            </div>
                            <div class="flex w-full items-center gap-[12px] lg:ml-[16px] lg:w-[440px]">
                                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-bullet-dark.svg')); ?>" alt="" class="size-6 shrink-0">
                                <span class="font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($row[1]); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- 610:23572 — End the Repair Cycle (Figma: light section + orange callout) -->
    <section class="w-full bg-[#f9fafb]" aria-labelledby="end-repair-cycle-heading">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-10 sm:px-6 lg:flex-row lg:items-center lg:gap-[90px] lg:px-[68px] lg:py-[80px]">
            <div class="flex w-full min-w-0 flex-col gap-4 lg:max-w-[694px]">
                <h2 id="end-repair-cycle-heading" class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_wg_erc_h2', 'End the Repair Cycle')); ?>
                </h2>
                <p class="max-w-[604px] font-roboto text-[18px] font-normal leading-[28px] text-[#020202] lg:text-[20px]">
                    <?php echo esc_html(get_option('my_theme_wg_erc_p1', 'The cost of the repair cycle is not determined by the first repair. It is measured by the cost of every repair after the first.')); ?>
                </p>
                <p class="font-roboto text-[18px] font-bold leading-[28px] text-[#020202] lg:text-[20px]">
                    <?php echo esc_html(get_option('my_theme_wg_erc_p2', 'Goliath™ was built to break the cycle.')); ?>
                </p>
                <p class="font-roboto text-[16px] font-normal leading-[28px] text-[#020202] lg:text-[18px]">
                    <?php echo esc_html(get_option('my_theme_wg_erc_p3', 'With our permanent upright repair solution:')); ?>
                </p>
                <?php
                $end_cycle_icon = get_theme_file_uri('assets/images/icons/Icon-1.svg');
                $end_cycle_items = [
                    'No more replacing uprights',
                    'No more recurring repair costs in the same location',
                    'No more disruption from preventable damage',
                ];
                ?>
                <ul class="flex flex-col gap-3">
                    <?php foreach ($end_cycle_items as $item) : ?>
                        <li class="flex items-start gap-3">
                            <img src="<?php echo esc_url($end_cycle_icon); ?>" alt="" class="mt-1 size-6 shrink-0 brightness-0" width="24" height="24" aria-hidden="true">
                            <span class="font-roboto text-[16px] font-normal leading-[24px] text-[#020202]"><?php echo esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="w-full shrink-0 lg:w-[467px] lg:max-w-[467px]">
                <div class="flex min-h-[288px] w-full items-center justify-center bg-[#ff5c00] p-[30px]">
                    <p class="font-montserrat text-[16px] font-bold leading-[23px] text-white">
                        <?php echo esc_html(get_option('my_theme_wg_erc_callout', 'Once installed, Goliath™ continues to protect your racking forever, and we\'re confident that if it were to be damaged by usual FLT damage, we will replace it for free.')); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 610:23602 — Sustainability -->
    <section class="w-full bg-white py-10 lg:py-[80px]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-stretch gap-8 px-5 sm:px-6 lg:flex-row lg:items-center lg:gap-[30px] lg:px-[68px]">
            <div class="flex flex-1 overflow-hidden bg-black">
                <img
                    src="<?php echo esc_url(my_theme_get_image_url('my_theme_wg_sus_img', get_theme_file_uri('assets/images/whyGoliath/solution.webp'))); ?>"
                    alt="Goliath upright repair solution installed in warehouse"
                    class="h-[300px] w-full object-cover sm:h-[400px] lg:h-[500px]"
                    loading="lazy"
                    decoding="async"
                >
            </div>
            <div class="flex flex-1 flex-col gap-[20px] lg:h-[432px] lg:gap-[24px]">
                <div class="flex gap-[16px] lg:h-[80px] lg:items-start">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-sustainability-icon.svg')); ?>" alt="" class="size-[48px] shrink-0">
                    <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:max-w-[504px] lg:text-[36px]">
                        <?php echo esc_html(get_option('my_theme_wg_sus_h2', 'Supporting Sustainability, One Upright at a Time')); ?>
                    </h2>
                </div>
                <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#364153] lg:max-w-[568px]">
                    <?php echo esc_html(get_option('my_theme_wg_sus_p1', 'The waste of steel, material, and labour costs when replacing uprights is a major problem in warehousing.')); ?>
                </p>
                <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#364153] lg:max-w-[568px]">
                    <?php echo esc_html(get_option('my_theme_wg_sus_p2', 'By replacing your racking, Goliath™ lowers the amount of steel required to achieve the same result. This means you\'ll never have to repair the upright again, eliminating steel waste from the most high-traffic areas of your warehouse.')); ?>
                </p>
                <p class="font-roboto text-[18px] font-normal leading-[28px] text-[#364153] lg:max-w-[568px]">
                    <?php echo esc_html(get_option('my_theme_wg_sus_p3', 'This ensures a more sustainable warehouse operation and helps businesses reduce their environmental footprint.')); ?>
                </p>
                <p class="font-roboto text-[24px] font-bold leading-[32px] text-[#ff5c00]">
                    <?php echo esc_html(get_option('my_theme_wg_sus_tagline', 'Choose Goliath™. Choose Support.')); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- 610:23620 — CTA -->
    <section id="ready" class="w-full bg-[#ff5c00] py-10 lg:h-[380px] lg:py-0">
        <div class="mx-auto w-full max-w-[1440px] px-5 sm:px-6 lg:px-0 lg:pl-[283px] lg:pr-[389px]">
            <div class="w-full pt-0 text-center lg:w-[768px] lg:pt-[80px]">
                <h2 class="mb-[24px] font-montserrat text-[28px] font-bold leading-[40px] text-white lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_wg_cta_h2', 'Ready to Break the Repair Cycle?')); ?>
                </h2>
                <p class="mb-[40px] font-roboto text-[18px] font-normal leading-[28px] text-white lg:text-[20px]">
                    <?php echo esc_html(get_option('my_theme_wg_cta_desc', 'Discover how Goliath™ can save your warehouse thousands in recurring repair costs while improving safety and compliance.')); ?>
                </p>
                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row lg:gap-[16px] lg:px-[92px]">
                    <a
                        href="<?php echo esc_url(home_url('/contact/')); ?>"
                        class="relative inline-flex h-[60px] w-full items-center justify-center bg-[#020202] font-roboto text-[18px] font-bold uppercase leading-[28px] tracking-[0.45px] text-white hover:bg-[#1a1a1a] sm:w-[310px]"
                    >
                        <span class="text-center sm:whitespace-nowrap"><?php echo esc_html(get_option('my_theme_wg_cta_primary', 'Get Free Site Survey')); ?></span>
                        <img
                            src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-btn-arrow.svg')); ?>"
                            alt=""
                            class="absolute right-[20px] top-1/2 size-5 -translate-y-1/2"
                        >
                    </a>
                    <a
                        href="<?php echo esc_url(home_url('/case-studies/')); ?>"
                        class="inline-flex h-[60px] w-full items-center justify-center bg-white font-roboto text-[18px] font-bold uppercase leading-[28px] tracking-[0.45px] text-[#ff5c00] transition-colors hover:bg-[#f4f4f4] sm:w-[257px]"
                    >
                        <?php echo esc_html(get_option('my_theme_wg_cta_secondary', 'View Case Studies')); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
