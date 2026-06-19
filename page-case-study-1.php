<?php
/*
Template Name: Case Study 1 Page
*/

// Redirect permanently to the dynamic case study detail page.
if (!headers_sent()) {
    wp_redirect(home_url('/case-studies/bm-racking-damage/'), 301);
    exit;
}

get_header();

$assets = [
    'warehouse_photo'   => get_theme_file_uri('assets/images/caseStudy/case-study1/B&Mcase.webp'),
    'section_arrow'     => get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg'),
    /** Downward trend — “Lower maintenance costs” (Figma) */
    'icon_trend_down'   => get_theme_file_uri('assets/images/icons/Icon-3.svg'),
    /** Circle + tick — other result cards (Figma Icon-1) */
    'icon_circle_check' => get_theme_file_uri('assets/images/icons/Icon-1.svg'),
    /** White square + tick on dark strip (Figma warranty callout) */
    'warranty_icon'     => get_theme_file_uri('assets/images/icons/case-study-banner-check.svg'),
    'cta_arrow'         => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];

$goliath_demo_file = 'goliath-demo.mp4';
$goliath_demo_uri  = function_exists('my_theme_get_video_file_uri')
    ? my_theme_get_video_file_uri($goliath_demo_file)
    : get_theme_file_uri('assets/videos/' . $goliath_demo_file);
$has_goliath_demo  = ! function_exists('my_theme_video_file_is_readable')
    || my_theme_video_file_is_readable($goliath_demo_file);

$result_cards = [
    [
        'icon' => $assets['icon_trend_down'],
        'title' => 'Lower Maintenance Costs',
        'text' => 'No further spend in areas where Goliath™ was fitted',
    ],
    [
        'icon' => $assets['icon_circle_check'],
        'title' => 'Cheaper & Faster',
        'text' => 'Than fully replacing uprights',
    ],
    [
        'icon' => $assets['icon_circle_check'],
        'title' => 'No Disruption',
        'text' => 'To stock management or daily operational logistics',
    ],
    [
        'icon' => $assets['icon_circle_check'],
        'title' => 'Reduced Carbon Footprint',
        'text' => 'Through fewer steel upright replacements',
    ],
];
?>

<main class="w-full bg-white overflow-x-hidden">
    <!-- Hero -->
    <section
        class="relative w-full h-auto lg:h-[400px] hero-gradient-bg"
    >
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-5 lg:h-[223px] lg:gap-5">
                <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <span class="text-white">Case Study: </span><span class="text-[#ff5c00]">B&amp;M</span>
                </h1>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    The UK warehousing industry loses up to £1.5 billion every year. This is due to racking damage and collapse incidents. For high-volume retailers like B&M, damaged pallet racking uprights are a costly maintenance headache that have become a direct threat to warehouse staff safety, availability of stock, and the ability to operate without disturbance.
                </p>
            </div>
        </div>
    </section>

    <!-- Problem and what they tried -->
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-8 sm:px-6 lg:px-[68px] lg:pt-[30px] lg:pb-[40px]">
            <div class="border-b border-[#dedfe0] pb-8 lg:pb-[32px]">
                <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">
                    How B&M Eliminated Pallet Racking Damage with Goliath™
                </h2>

                <div class="mt-6 grid grid-cols-1 gap-8 lg:mt-[24px] lg:grid-cols-2 lg:gap-6">
                    <div>
                        <h3 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">The Problem</h3>
                        <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">B&M operates over 700 stores and has the distribution infrastructure to match. This company has also invested heavily in forklift driver training and traffic management.</p>
                        <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">Still, their warehouses kept experiencing recurring damage to their pallet racking uprights from continuous vehicle impacts, making it a safety hazard for warehouse staff, causing operational downtime, and increasing repair costs exponentially.</p>
                        <p class="mt-6 font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]">
                            Every solution available was reactive. Fix it today and impact damages it again tomorrow.
                        </p>
                    </div>

                    <div>
                        <h3 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">What They Tried</h3>
                        <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">B&M tried many of the most common racking protection products on the market. They tried clip-on, floor-mounted, tie-on, and bolt-on column guards. None of these options successfully prevented severe impact damage.</p>
                        <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">Many of them simply covered the impact, making inspections less reliable and creating hidden compliance risks.</p>
                        <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">Floor-mounted guards were also a problem that caused secondary damage when these guards were peeled off by repeated impacts.</p>
                        <p class="mt-6 font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]">
                            Standard racking protection products on the market weren't fit for the purpose.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Solution -->
    <section class="w-full bg-white">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:gap-[30px] lg:px-[68px] lg:pt-[80px] lg:pb-[70px]">
            <div class="w-full min-w-0 lg:flex-1">
                <?php if ($has_goliath_demo) : ?>
                    <video
                        class="aspect-video w-full bg-black object-contain"
                        controls
                        playsinline
                        preload="metadata"
                        aria-label="<?php echo esc_attr('Goliath product demo'); ?>"
                    >
                        <source src="<?php echo esc_url($goliath_demo_uri); ?>" type="video/mp4">
                    </video>
                <?php else : ?>
                    <div class="aspect-video w-full bg-[#d9d9d9]" role="img" aria-label="<?php echo esc_attr('Video unavailable'); ?>"></div>
                <?php endif; ?>
            </div>
            <div class="w-full lg:flex-1">
                <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">The Solution: Goliath™</h2>
                <p class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#666]">
                    Goliath™, our patented upright repair kit was created to not just fix damaged racking. It prevents future damage from occurring at all.
                </p>
                <p class="mt-2 font-montserrat text-[16px] font-medium leading-[24px] text-[#666]">
                    This permanent racking upright repair is designed to fit all standard pallet racking systems and can be installed quickly by in-house teams. What makes installing Goliath™ more appealing is that there is no loss of pallet locations and no operational downtime.
                </p>

                <div class="mt-6 flex flex-col gap-3 bg-[#ff6b2c] px-[24px] py-[18px] sm:flex-row sm:items-center sm:justify-between lg:w-[631px] lg:px-[39px]">
                    <p class="font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white">
                        What Goliath™ provides is not just a repair.<br>
                        It's a permanent structural reinforcement that breaks<br>
                        the damage-and-replace cycle for good.
                    </p>
                    <img src="<?php echo esc_url($assets['section_arrow']); ?>" alt="" class="size-5 shrink-0 sm:ml-4">
                </div>
            </div>
        </div>
    </section>

    <!-- Results -->
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[60px]">
            <img src="<?php echo esc_url($assets['warehouse_photo']); ?>" alt="Warehouse team reviewing racking aisle" class="h-auto w-full object-cover lg:h-[464px]">

            <div class="mt-10 lg:mt-[60px]">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">The Results</h2>
                <p class="mt-6 max-w-[1024px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    At B&M, the impact was immediate. Zero upright damage was recorded in every location where Goliath™ was fitted. This was recorded over a 12-month period following installation.
                </p>

                <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
                    <?php foreach ($result_cards as $card) : ?>
                        <div class="bg-[#f9fafb] px-6 pt-6 pb-6">
                            <div class="flex items-start gap-4">
                                <img src="<?php echo esc_url($card['icon']); ?>" alt="" class="size-10 shrink-0 object-contain" width="40" height="40">
                                <div>
                                    <h4 class="font-montserrat text-[16px] font-bold leading-[24px] text-[#020202]"><?php echo esc_html($card['title']); ?></h4>
                                    <p class="mt-2 font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($card['text']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-6 flex flex-col gap-4 bg-[#020202] px-6 pt-8 pb-8 lg:h-[164px] lg:flex-row lg:items-start lg:gap-4 lg:px-8">
                    <div class="shrink-0">
                        <img
                            src="<?php echo esc_url($assets['warranty_icon']); ?>"
                            alt=""
                            class="h-12 w-12 shrink-0 object-contain lg:h-14 lg:w-14"
                            width="56"
                            height="56"
                        >
                    </div>
                    <div class="space-y-4">
                        <p class="font-roboto text-[18px] font-normal leading-[28px] text-white">
                            After the initial installation, B&M installed over 250 Goliath™ kits across one of their distribution centres and committed to using Goliath™ as their standard solution for all future racking repairs.
                        </p>
                        <p class="font-roboto text-[18px] font-normal leading-[28px] text-white">
                            Every one of our kits comes with a Lifetime Warranty against any manufacturing defects.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-3 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
            <h2 class="font-montserrat text-[22px] font-bold leading-[32px] text-white lg:text-[24px]">
                A Word from B&M Retailers
            </h2>
            <p class="max-w-[1146px] font-montserrat text-[18px] italic leading-[28px] text-white">
                "Goliath™ Upright Repair Kit has been a game changer for us. We've had zero impact damage in the locations that Goliath™ has been fitted since installation took place over 12 months ago."
            </p>
            <p class="max-w-[547px] font-roboto text-[16px] font-bold leading-[24px] text-white">
                — Kenny Hudson, National Facilities & Maintenance Manager, B&M Retailers
            </p>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[60px] w-full max-w-[320px] items-center justify-center bg-[#020202] px-[32px] font-roboto text-[16px] font-semibold leading-[24px] text-white hover:bg-[#1a1a1a] sm:w-auto sm:max-w-none">
                <span>Get Similar Results</span>
                <img src="<?php echo esc_url($assets['cta_arrow']); ?>" alt="" class="ml-3 size-5">
            </a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
