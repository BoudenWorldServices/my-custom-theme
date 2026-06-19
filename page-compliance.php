<?php
/*
Template Name: Compliance Page
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

$assets = [
    'arrow' => get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg'),
    'hero_image_a' => get_theme_file_uri('assets/images/Compliance/compatible.webp'),
    'hero_image_b' => get_theme_file_uri('assets/images/Compliance/waranty-coverage.webp'),
    'hero_image_c' => get_theme_file_uri('assets/images/Compliance/waranty-coverage.webp'),
    'compat_image' => get_theme_file_uri('assets/images/Compliance/compatible.webp'),
    'shield' => get_theme_file_uri('assets/images/icons/Icon-4.svg'),
    'hse' => get_theme_file_uri('assets/images/icons/safe.svg'),
    'en' => get_theme_file_uri('assets/images/icons/doc.svg'),
    'sema' => get_theme_file_uri('assets/images/icons/badge.svg'),
    'check' => get_theme_file_uri('assets/images/icons/why-goliath-bullet-light.svg'),
    'concern_badge' => get_theme_file_uri('assets/images/icons/badge.svg'),
    'concern_shield' => get_theme_file_uri('assets/images/icons/safe.svg'),
    'compat_bullet' => get_theme_file_uri('assets/images/icons/why-goliath-bullet-dark.svg'),
    'doc_a' => get_theme_file_uri('assets/images/icons/doc.svg'),
    'doc_b' => get_theme_file_uri('assets/images/icons/badge.svg'),
    'doc_c' => get_theme_file_uri('assets/images/icons/hiw-standards-icon.svg'),
];
?>

<main class="w-full bg-white overflow-x-hidden">
    <!-- Hero -->
    <section
        class="relative w-full h-auto lg:h-[400px] hero-gradient-bg"
    >
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-4 lg:h-[264px] lg:justify-between lg:gap-0">
                <p class="font-montserrat text-[16px] font-medium leading-[24px] tracking-[0.07px] text-[#ff5c00]"><?php echo esc_html(get_option('my_theme_comp_hero_badge', 'SAFETY & STANDARDS')); ?></p>
                <h1 class="font-montserrat text-[28px] font-bold leading-[36px] text-white sm:text-[36px] sm:leading-[44px] lg:text-[60px] lg:leading-[60px]">
                    <?php
                    $hero_h1 = get_option('my_theme_comp_hero_h1', 'Compliance & Safety Standards');
                    $h1_parts = explode('&', $hero_h1, 2);
                    if (count($h1_parts) === 2) :
                    ?>
                        <span class="text-white"><?php echo esc_html(trim($h1_parts[0])) . ' &amp; '; ?></span><span class="text-[#ff5c00]"><?php echo esc_html(trim($h1_parts[1])); ?></span>
                    <?php else : ?>
                        <span class="text-white"><?php echo esc_html($hero_h1); ?></span>
                    <?php endif; ?>
                </h1>
                <p class="max-w-[1291px] font-montserrat text-[18px] font-normal leading-[28px] text-[#d1d5dc] lg:text-[20px]">
                    <?php echo esc_html(get_option('my_theme_comp_hero_desc', 'Safety concerning warehouse racking systems is controlled by clear expectations surrounding inspection, maintenance, and structural integrity. Goliath™ supports these requirements directly.')); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="inline-flex h-[53px] w-full items-center justify-center bg-[#ff5c00] px-[40px] font-montserrat text-[14px] font-bold leading-[21px] tracking-[0.35px] text-white hover:bg-[#e55200] sm:w-fit">
                    <span><?php echo esc_html(get_option('my_theme_comp_hero_cta', 'Get Certified Solution')); ?></span>
                    <img src="<?php echo esc_url($assets['arrow']); ?>" alt="" class="ml-3 size-5 shrink-0">
                </a>
            </div>
        </div>
    </section>

    <!-- Regulation compliant + guarantee -->
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[59px] lg:py-[80px]">
            <div class="flex flex-col gap-8">
                <?php
                $reg_h2 = get_option('my_theme_comp_reg_h2', 'Regulation Compliant');
                $reg_h2_parts = explode(' ', $reg_h2, 2);
                ?>
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                    <?php if (count($reg_h2_parts) === 2) : ?>
                        <?php echo esc_html($reg_h2_parts[0]); ?> <span class="text-[#ff5c00]"><?php echo esc_html($reg_h2_parts[1]); ?></span>
                    <?php else : ?>
                        <?php echo esc_html($reg_h2); ?>
                    <?php endif; ?>
                </h2>
                <div class="font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                    <p><?php echo esc_html(get_option('my_theme_comp_reg_p1', 'For warehouse owners and operators, compliance is more than just about meeting the laid-out standards. When followed properly, it helps reduce risk, protect people, and ensure that work is carried out without interrupting operations.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_comp_reg_p2', 'Goliath™ supports these requirements directly. Our permanent upright repair solution is tested and certified. Our product aligns with recognised UK and European standards, which address one of the most common causes of non-compliance in warehouses: impact damage to uprights.')); ?></p>
                </div>
                <div class="flex w-full items-start gap-5 bg-[#020202] px-[24px] py-[24px] lg:h-[156px] lg:px-[33px] lg:pt-[33px]">
                    <div class="flex h-[90px] w-[89px] shrink-0 items-center justify-center bg-[#ff5c00]">
                        <img src="<?php echo esc_url($assets['shield']); ?>" alt="" class="size-14 brightness-0">
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-montserrat text-[20px] font-bold leading-[30px] text-white"><?php echo esc_html(get_option('my_theme_comp_reg_box_h3', '100% UK Compliance Guaranteed')); ?></h3>
                        <p class="max-w-[1056px] font-montserrat text-[16px] font-normal leading-[26px] text-white"><?php echo esc_html(get_option('my_theme_comp_reg_box_p', 'Every GOLIATH™ installation is fully compliant with UK Health & Safety regulations. We provide complete documentation and certification for your records and inspections.')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HSE EN SEMA -->
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 pb-10 sm:px-6 lg:px-[59px] lg:pb-[80px]">
            <div class="flex flex-col gap-[37px]">
                <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_comp_std_h2', 'Built to Align with HSE, EN and SEMA Guidelines')); ?></h2>
                <div class="font-montserrat text-[18px] font-normal leading-[28px] text-[#364153]">
                    <p><?php echo esc_html(get_option('my_theme_comp_std_p1', 'Racking systems in the UK are assessed against guidelines from the HSE, EN standards, and industry best practice supported by SEMA.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_comp_std_p2', 'Goliath™ has been tested to comply with these expectations. It reinforces the part of the upright most susceptible to impact, helping maintain structural integrity and reduce the likelihood of damage being flagged during warehouse inspections.')); ?></p>
                </div>
                <?php
                $standards_cards = [
                    [
                        'title' => get_option('my_theme_comp_std_card1_title', 'BS EN 15512:2020 + A1:2022'),
                        'body'  => get_option('my_theme_comp_std_card1_body', 'Regulations for steel storage systems for adjustable pallet racking-principles for structural design'),
                    ],
                    [
                        'title' => get_option('my_theme_comp_std_card2_title', 'BS EN 15635:2008'),
                        'body'  => get_option('my_theme_comp_std_card2_body', 'Regulations for steel static storage systems application and maintenance of storage equipment'),
                    ],
                    [
                        'title' => get_option('my_theme_comp_std_card3_title', 'SEMA code of practice'),
                        'body'  => get_option('my_theme_comp_std_card3_body', 'for the design of adjustable pallet racking'),
                    ],
                    [
                        'title' => get_option('my_theme_comp_std_card4_title', 'SEMA code of practice'),
                        'body'  => get_option('my_theme_comp_std_card4_body', 'for the design and use of racking protection'),
                    ],
                ];
                ?>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5">
                    <?php foreach ($standards_cards as $card) : ?>
                        <article class="flex min-h-0 min-w-0 flex-col rounded-lg bg-[#f9fafb] p-6">
                            <img
                                src="<?php echo esc_url($assets['compat_bullet']); ?>"
                                alt=""
                                class="size-10 shrink-0 object-contain"
                                width="40"
                                height="40"
                                aria-hidden="true"
                            >
                            <h3 class="mt-4 font-montserrat text-[16px] font-bold leading-[24px] text-[#020202] sm:text-[17px] lg:text-[18px] lg:leading-[27px]">
                                <?php echo esc_html($card['title']); ?>
                            </h3>
                            <p class="mt-2 font-roboto text-[14px] font-normal leading-[22px] text-[#364153]">
                                <?php echo esc_html($card['body']); ?>
                            </p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Image with warranty overlay -->
    <section class="w-full bg-white pb-10 lg:pb-[80px]">
        <div class="mx-auto w-full max-w-[1440px] px-5 sm:px-6 lg:px-[59px]">
            <div class="relative">
                <div class="w-full overflow-hidden">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_comp_warranty_image', get_theme_file_uri('assets/images/Compliance/waranty-coverage.webp'))); ?>" alt="Warehouse racking upright protected by Goliath during compliance inspection" class="h-auto w-full object-cover" loading="lazy" decoding="async">
                </div>
                <div class="mt-6 bg-[#ff5c00] p-8 lg:absolute lg:-right-[130px] lg:top-[48%] lg:w-[532px] lg:-translate-y-1/2 lg:px-[42px] lg:py-[42px]">
                    <h3 class="font-montserrat text-[24px] font-bold leading-[36px] text-white"><?php echo esc_html(get_option('my_theme_comp_warranty_h3', 'Warranty Coverage Includes:')); ?></h3>
                    <ul class="mt-4 space-y-3">
                        <?php
                        $warranty_items = [
                            get_option('my_theme_comp_warranty_item1', 'Overall structure and repair process coverage for life'),
                            get_option('my_theme_comp_warranty_item2', 'Free replacement or repair if damaged from normal use'),
                            get_option('my_theme_comp_warranty_item3', 'Free from manufacturing defects guarantee'),
                            get_option('my_theme_comp_warranty_item4', 'No questions asked warranty claim process'),
                        ];
                        foreach ($warranty_items as $item) :
                            ?>
                            <li class="flex items-center gap-3">
                                <img src="<?php echo esc_url($assets['check']); ?>" alt="" class="h-6 w-6 shrink-0" width="24" height="24">
                                <span class="font-montserrat text-[15px] font-normal leading-[24px] text-white"><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Common concerns -->
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-10 pb-12 sm:px-6 sm:pb-14 lg:px-[68px] lg:pt-[80px] lg:pb-20">
            <div class="text-center">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_comp_concerns_h2', 'Addressing Common Compliance Concerns')); ?></h2>
                <p class="mx-auto mt-4 max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]"><?php echo esc_html(get_option('my_theme_comp_concerns_intro', 'The most common concern many operators have is whether installing a non-manufacturer product could affect compliance or warranties.')); ?></p>
            </div>
            <div class="mt-[60px] grid grid-cols-1 gap-6 lg:grid-cols-3">
                <article class="border border-[#e8e8e9] px-[41px] py-[41px] text-center">
                    <img src="<?php echo esc_url($assets['concern_badge']); ?>" alt="" class="mx-auto size-12 shrink-0 object-contain" width="48" height="48" aria-hidden="true">
                    <h3 class="mt-4 font-montserrat text-[20px] font-bold leading-[28px] text-[#020202]"><?php echo esc_html(get_option('my_theme_comp_concern1_h3', 'System Integration')); ?></h3>
                    <p class="mt-4 font-montserrat text-[14px] font-normal leading-[22px] text-[#666]"><?php echo esc_html(get_option('my_theme_comp_concern1_p', 'Goliath™ works alongside your existing racking systems without compromising their integrity. It does not change load characteristics or interfere with how your system performs under normal conditions.')); ?></p>
                </article>
                <article class="border border-[#e8e8e9] px-[41px] py-[41px] text-center">
                    <img src="<?php echo esc_url($assets['concern_badge']); ?>" alt="" class="mx-auto size-12 shrink-0 object-contain" width="48" height="48" aria-hidden="true">
                    <h3 class="mt-4 font-montserrat text-[20px] font-bold leading-[28px] text-[#020202]"><?php echo esc_html(get_option('my_theme_comp_concern2_h3', 'Impact Protection')); ?></h3>
                    <p class="mt-4 font-montserrat text-[14px] font-normal leading-[22px] text-[#666]"><?php echo esc_html(get_option('my_theme_comp_concern2_p', 'Instead, it protects the upright from external impact, which is one of the primary causes of structural failure.')); ?></p>
                </article>
                <article class="border border-[#e8e8e9] px-[41px] py-[41px] text-center">
                    <img src="<?php echo esc_url($assets['concern_shield']); ?>" alt="" class="mx-auto size-12 shrink-0 object-contain" width="48" height="48" aria-hidden="true">
                    <h3 class="mt-4 font-montserrat text-[20px] font-bold leading-[28px] text-[#020202]"><?php echo esc_html(get_option('my_theme_comp_concern3_h3', 'Breaking the Cycle')); ?></h3>
                    <p class="mt-4 font-montserrat text-[14px] font-normal leading-[22px] text-[#666]"><?php echo esc_html(get_option('my_theme_comp_concern3_p', "Goliath\u{2122} also challenges the \u{2018}replace-and-repeat\u{2019} model by preventing damage to your uprights. This changes the maintenance cycle, but it does not affect any compliance requirements.")); ?></p>
                </article>
            </div>
        </div>
    </section>

    <!-- Only system section -->
    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-stretch lg:gap-[80px]">
                <div class="flex min-w-0 flex-1 flex-col lg:basis-0">
                    <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[36px]"><?php echo esc_html(get_option('my_theme_comp_only_left_h2', 'The Only System of Its Kind in the UK and Europe')); ?></h2>
                    <p class="mt-6 font-montserrat text-[20px] font-normal leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_comp_only_left_p1', 'Goliath™ is the only pallet racking repair kit and protection system of its kind available across the UK and Europe.')); ?></p>
                    <p class="mt-4 font-montserrat text-[18px] font-normal leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_comp_only_left_p2', 'Unlike traditional repair methods, Goliath™ is a permanent solution for the most common racking problems in warehouses. It stops the cycle of damage during facility usage and replacement.')); ?></p>
                </div>
                <div class="flex min-w-0 flex-1 flex-col bg-[#ff8f66] px-8 py-8 lg:basis-0 lg:px-[32px] lg:py-[32px]">
                    <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-white"><?php echo esc_html(get_option('my_theme_comp_only_right_h3', 'From a Compliance Perspective')); ?></h3>
                    <p class="mt-4 font-montserrat text-[18px] font-normal leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_comp_only_right_p1', 'Continuous damage causes structural weaknesses, which raises concerns during inspections. A system that prevents that damage, like Goliath™, provides a more stable, consistent outcome.')); ?></p>
                    <p class="mt-3 font-montserrat text-[18px] font-normal leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_comp_only_right_p2', 'Goliath™ has also been independently tested and verified to perform excellently under real-world impact conditions. This provides additional assurance to our clients that the system is effective and suitable for long-term use in demanding warehouse environments.')); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Proven performance + case study -->
    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:justify-between lg:px-[68px] lg:py-[80px]">
            <div class="w-full lg:w-[632px]">
                <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_comp_proven_h2', 'Proven Performance Backed by Lifetime Warranty')); ?></h2>
                <div class="mt-6 font-montserrat text-[18px] font-normal leading-[28px] text-[#364153]">
                    <p><?php echo esc_html(get_option('my_theme_comp_proven_p1', 'Goliath™ is supported by a lifetime impact warranty, reflecting our confidence in its durability and long-term performance.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_comp_proven_p2', 'Once installed, it provides continuous protection in the same location without the need to change your uprights regularly. This reduces the frequency of repairs and keeps your uprights in good condition, through inspection cycles.')); ?></p>
                </div>
            </div>
            <aside class="w-full bg-[#020202] px-[32px] py-[32px] text-white lg:h-[248px] lg:w-[640px]">
                <h3 class="font-montserrat text-[24px] font-bold leading-[32px]"><?php echo esc_html(get_option('my_theme_comp_proven_case_h3', 'Case Study: B&M')); ?></h3>
                <p class="mt-4 font-montserrat text-[18px] font-normal leading-[28px]"><?php echo esc_html(get_option('my_theme_comp_proven_case_p', 'Our client, B&M, reduced racking repair costs by over 30% within the first 12 months of installation. This was achieved by preventing repeat damage to the uprights in their warehouse, which also reduces the likelihood of compliance issues arising from compromised uprights.')); ?></p>
            </aside>
        </div>
    </section>

    <!-- Compatibility -->
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[80px]">
            <?php
            $compat_h2 = get_option('my_theme_comp_compat_h2', 'How compatible is GOLIATH™?');
            $compat_h2_parts = preg_split('/\b(GOLIATH™\??)/', $compat_h2, 2, PREG_SPLIT_DELIM_CAPTURE);
            ?>
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                <?php if (count($compat_h2_parts) >= 3) : ?>
                    <span><?php echo esc_html($compat_h2_parts[0]); ?></span><span class="text-[#ff5c00]"><?php echo esc_html($compat_h2_parts[1]); ?></span>
                <?php else : ?>
                    <span><?php echo esc_html($compat_h2); ?></span>
                <?php endif; ?>
            </h2>
            <p class="mt-4 max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]"><?php echo esc_html(get_option('my_theme_comp_compat_intro', "GOLIATH™ is designed to work with all major pallet racking systems. Here's a list of the top 10 racking companies GOLIATH™ is compatible with:")); ?></p>
            <?php
            $compat_raw = get_option('my_theme_comp_compat_items', 'Link 51 XL, Dexion Mk3, Dexion P90, Mecalux, Stow, Apex, Redirack, PSS (all types), Bito, Hi-Lo Premier Rack & Rack Plan');
            $compat = array_map('trim', explode(',', $compat_raw));
            ?>
            <div class="mt-8 flex flex-col gap-8 lg:flex-row lg:gap-[54px]">
                <div class="w-full space-y-[10px] lg:w-[591px]">
                    <?php foreach ($compat as $name) : ?>
                        <div class="flex h-[66px] items-center gap-4 border border-[#e8e8e9] px-[21px]">
                            <svg class="size-6 shrink-0 text-[#ff5c00]" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <circle cx="10" cy="10" r="8.5" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M6.5 10.5l2.1 2.1 4.9-4.9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="font-montserrat text-[16px] font-bold leading-[24px] text-[#020202]"><?php echo esc_html($name); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="relative w-full overflow-hidden border border-black/10 lg:h-[750px] lg:w-[655px]">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_comp_compat_image', get_theme_file_uri('assets/images/Compliance/compatible.webp'))); ?>" alt="Goliath upright repair compatible with major pallet racking systems" class="h-full w-full object-cover">
                    <div class="pointer-events-none absolute inset-0 bg-black/45" aria-hidden="true"></div>
                </div>
            </div>
            <div class="mt-10 bg-[#020202] bg-[linear-gradient(165.798deg,rgba(2,2,2,1)_0%,rgba(51,51,51,1)_100%)] px-6 py-10 text-center lg:px-[48px]">
                <h3 class="font-montserrat text-[32px] font-bold leading-[48px] text-white"><?php echo esc_html(get_option('my_theme_comp_compat_box_h3', "Don't see your type?")); ?></h3>
                <p class="mx-auto mt-4 max-w-[600px] font-montserrat text-[18px] font-normal leading-[28px] text-white/90"><?php echo esc_html(get_option('my_theme_comp_compat_box_p', 'No problem. GOLIATH™ can be adapted to work with all pallet racking systems. Contact us to discuss your specific racking configuration.')); ?></p>
                <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="mt-6 inline-flex h-[53px] w-full items-center justify-center bg-[#ff5c00] px-[32px] font-montserrat text-[14px] font-bold leading-[21px] tracking-[0.35px] text-white hover:bg-[#e55200] sm:w-auto">
                    <span><?php echo esc_html(get_option('my_theme_comp_compat_box_cta', 'Check Compatibility')); ?></span>
                    <img src="<?php echo esc_url($assets['arrow']); ?>" alt="" class="ml-3 size-5 shrink-0">
                </a>
            </div>
        </div>
    </section>

    <!-- Documentation -->
    <section class="w-full bg-[#020202]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 text-white sm:px-6 lg:px-[68px] lg:py-[80px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_comp_doc_h2', 'Transparent Documentation and Certification')); ?></h2>
            <p class="mt-4 font-montserrat text-[20px] font-normal leading-[28px]"><?php echo esc_html(get_option('my_theme_comp_doc_subtitle', 'To support compliance requirements, Goliath™ provides access to detailed documentation.')); ?></p>
            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
                <article class="bg-white/10 px-[24px] py-[24px]">
                    <img src="<?php echo esc_url($assets['doc_a']); ?>" alt="" class="size-10 shrink-0 object-contain brightness-0 invert" width="40" height="40" aria-hidden="true">
                    <h3 class="mt-4 font-montserrat text-[18px] font-bold leading-[27px]"><?php echo esc_html(get_option('my_theme_comp_doc_card1_h3', 'Compliance Certification')); ?></h3>
                    <p class="mt-2 font-montserrat text-[14px] font-normal leading-[20px]"><?php echo esc_html(get_option('my_theme_comp_doc_card1_sub', 'From independent testing')); ?></p>
                </article>
                <article class="bg-white/10 px-[24px] py-[24px]">
                    <img src="<?php echo esc_url($assets['doc_b']); ?>" alt="" class="size-10 shrink-0 object-contain brightness-0 invert" width="40" height="40" aria-hidden="true">
                    <h3 class="mt-4 font-montserrat text-[18px] font-bold leading-[27px]"><?php echo esc_html(get_option('my_theme_comp_doc_card2_h3', 'Technical Specs')); ?></h3>
                    <p class="mt-2 font-montserrat text-[14px] font-normal leading-[20px]"><?php echo esc_html(get_option('my_theme_comp_doc_card2_sub', 'Performance data and specifications')); ?></p>
                </article>
                <article class="bg-white/10 px-[24px] py-[24px]">
                    <img src="<?php echo esc_url($assets['doc_c']); ?>" alt="" class="size-10 shrink-0 object-contain brightness-0 invert" width="40" height="40" aria-hidden="true">
                    <h3 class="mt-4 font-montserrat text-[18px] font-bold leading-[27px]"><?php echo esc_html(get_option('my_theme_comp_doc_card3_h3', 'Price Comparison')); ?></h3>
                    <p class="mt-2 font-montserrat text-[14px] font-normal leading-[20px]"><?php echo esc_html(get_option('my_theme_comp_doc_card3_sub', 'Insights vs. traditional methods')); ?></p>
                </article>
            </div>
            <p class="mt-8 max-w-[1284px] font-montserrat text-[18px] font-normal leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_comp_doc_closing', 'Downloadable PDFs are also available to support internal reviews, safety documentation, and procurement decisions. Our resources make it easier to show due diligence in the process and to explain clearly how Goliath™ contributes to safety and compliance.')); ?></p>
        </div>
    </section>

    <!-- Audit readiness -->
    <section class="w-full bg-[#fafafa]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:justify-between lg:px-[68px] lg:py-[80px]">
            <div class="w-full lg:w-[794px]">
                <h2 class="max-w-[758px] font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html(get_option('my_theme_comp_audit_h2', 'Supporting Inspection Outcomes and Audit Readiness')); ?></h2>
                <div class="mt-6 font-montserrat text-[18px] font-normal leading-[28px] text-[#364153]">
                    <p><?php echo esc_html(get_option('my_theme_comp_audit_p1', 'Regular inspections are an important part of ensuring compliance. A SEMA racking inspection or internal audit will assess the visible damage, structural condition, and overall system safety.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_comp_audit_p2', 'By reducing impact damage, Goliath™ improves your inspection outcomes. Fewer damaged uprights in your reports mean fewer red or amber risk classifications and little to no need for urgent corrective action.')); ?></p>
                </div>
            </div>
            <aside class="w-full border-2 border-[#ff5c00] bg-[#ff5c00] px-[42px] py-[42px] text-white lg:h-[302px] lg:w-[458px]">
                <h3 class="font-montserrat text-[24px] font-bold leading-[32px]"><?php echo esc_html(get_option('my_theme_comp_audit_aside_h3', 'Digital Racking Management')); ?></h3>
                <p class="mt-6 max-w-[306px] font-montserrat text-[16px] font-normal leading-[24px]"><?php echo esc_html(get_option('my_theme_comp_audit_aside_p', 'When combined with our digital racking management system, Goliath™ operators gain additional visibility through recorded inspection data and reports, proper risk categorisation, and repair documentation.')); ?></p>
            </aside>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-8 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[36px]"><?php echo esc_html(get_option('my_theme_comp_cta_h2', 'Ensure Compliance with Goliath™')); ?></h2>
            <p class="max-w-[768px] font-montserrat text-[20px] font-normal leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_comp_cta_p', 'Protect your warehouse, reduce risk, and maintain the highest safety standards with our proven upright repair solution.')); ?></p>
            <div class="flex w-full max-w-md flex-col items-center gap-4 sm:max-w-none sm:flex-row sm:justify-center sm:gap-[16px]">
                <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-white px-[40px] font-roboto text-[18px] font-bold uppercase leading-[28px] tracking-[0.45px] text-[#ff5c00] hover:bg-[#f4f4f4] sm:w-auto">
                    <?php echo esc_html(get_option('my_theme_comp_cta_primary', 'Get Free Site Survey')); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/faqs/')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-[#020202] px-[40px] font-roboto text-[18px] font-bold uppercase leading-[28px] tracking-[0.45px] text-white hover:bg-[#1a1a1a] sm:w-auto">
                    <?php echo esc_html(get_option('my_theme_comp_cta_secondary', 'View FAQs')); ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
