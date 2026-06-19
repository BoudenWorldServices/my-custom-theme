<?php
/*
Template Name: How It Works Page
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

$installation_video_file = 'goliath-demo.mp4';
$crash_test_video_file   = 'corporate-crash-test.mp4';
$how_it_works_assets     = [
    'process_1' => my_theme_get_image_url('my_theme_hiw_install_img1', get_theme_file_uri('assets/images/howITworks/process1.webp')),
    'process_2' => my_theme_get_image_url('my_theme_hiw_install_img2', get_theme_file_uri('assets/images/howITworks/process2.webp')),
    'process_3' => my_theme_get_image_url('my_theme_hiw_install_img3', get_theme_file_uri('assets/images/howITworks/process3.webp')),
    'installation_video_mp4' => function_exists('my_theme_get_video_file_uri')
        ? my_theme_get_video_file_uri($installation_video_file)
        : get_theme_file_uri('assets/videos/' . $installation_video_file),
    'installation_video_page' => home_url('/videos/goliath-demo/'),
    'installation_video_poster' => (
        function_exists('my_theme_video_thumbnail_is_readable')
        && function_exists('my_theme_get_video_thumbnail_uri')
        && my_theme_video_thumbnail_is_readable($installation_video_file)
    )
        ? my_theme_get_video_thumbnail_uri($installation_video_file)
        : get_theme_file_uri('assets/images/video-thumbnails/goliath-demo.jpg'),
    'crash_test_video_mp4' => function_exists('my_theme_get_video_file_uri')
        ? my_theme_get_video_file_uri($crash_test_video_file)
        : get_theme_file_uri('assets/videos/' . $crash_test_video_file),
    'crash_test_video_page' => home_url('/videos/corporate-crash-test/'),
    'crash_test_video_poster' => (
        function_exists('my_theme_video_thumbnail_is_readable')
        && function_exists('my_theme_get_video_thumbnail_uri')
        && my_theme_video_thumbnail_is_readable($crash_test_video_file)
    )
        ? my_theme_get_video_thumbnail_uri($crash_test_video_file)
        : get_theme_file_uri('assets/images/video-thumbnails/corporate-crash-test.jpg'),
];
$has_installation_mp4 = function_exists('my_theme_video_file_is_readable')
    ? my_theme_video_file_is_readable($installation_video_file)
    : is_readable(get_theme_file_path('assets/videos/' . $installation_video_file));
$has_crash_test_mp4 = function_exists('my_theme_video_file_is_readable')
    ? my_theme_video_file_is_readable($crash_test_video_file)
    : is_readable(get_theme_file_path('assets/videos/' . $crash_test_video_file));
?>

<main class="w-full bg-white overflow-x-hidden">

    <!-- Hero -->
    <section class="relative w-full h-auto bg-[#ff5c00] lg:h-[400px]">
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col justify-between lg:h-[266px]">
                <div class="flex flex-col gap-[10px]">
                    <p class="font-montserrat text-[16px] font-medium leading-[24px] tracking-[0.07px] text-white/90">
                        <?php echo esc_html(get_option('my_theme_hiw_hero_badge', 'GOLIATH SOLUTION')); ?>
                    </p>
                    <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                        <span><?php echo esc_html(get_option('my_theme_hiw_hero_h1', 'How it works')); ?></span>
                    </h1>
                    <p class="max-w-[1315px] font-montserrat text-[17px] font-normal leading-[28px] text-white lg:text-[20px] lg:leading-[32px]">
                        <?php echo esc_html(get_option('my_theme_hiw_hero_paragraph', 'Installing a Goliath™ upright in your warehouse can be done in 30 minutes.')); ?>
                    </p>
                </div>
                <div class="mt-6 flex lg:mt-0">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[57px] w-full items-center justify-center whitespace-nowrap bg-[#020202] px-[40px] font-montserrat text-[14px] font-bold leading-[21px] tracking-[0.35px] text-white hover:bg-[#1a1a1a] sm:w-[273px]">
                        <span><?php echo esc_html(get_option('my_theme_hiw_hero_cta', 'Get Free Assessment')); ?></span>
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/hiw-hero-arrow.svg')); ?>" alt="" class="ml-3 size-5 shrink-0">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats bar -->
    <section class="w-full border-b border-[#e8e8e9] bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-6 pb-4 lg:px-[68px] lg:pt-[40px] lg:pb-px lg:h-[139px]">
            <div class="flex flex-wrap items-start justify-between">
                <?php
                $stats = [
                    ['label' => get_option('my_theme_hiw_stat1_label', 'Installation'), 'value' => get_option('my_theme_hiw_stat1_value', '30 Minutes')],
                    ['label' => get_option('my_theme_hiw_stat2_label', 'Warranty'), 'value' => get_option('my_theme_hiw_stat2_value', 'Lifetime')],
                    ['label' => get_option('my_theme_hiw_stat3_label', 'UK Compliance'), 'value' => get_option('my_theme_hiw_stat3_value', '100%')],
                    ['label' => get_option('my_theme_hiw_stat4_label', 'Downtime'), 'value' => get_option('my_theme_hiw_stat4_value', 'Minimal')],
                ];
                foreach ($stats as $i => $stat) :
                    $border = $i < 3 ? 'lg:border-r lg:border-[#e8e8e9]' : '';
                    $width  = $i < 3 ? 'lg:w-[279.75px] lg:pr-[41px]' : 'lg:w-[238.75px]';
                ?>
                    <div class="flex w-1/2 flex-col gap-[4px] py-3 lg:h-[58px] lg:w-auto lg:py-0 <?php echo $border . ' ' . $width; ?>">
                        <p class="font-montserrat text-[12px] font-normal leading-[18px] text-[#666]"><?php echo esc_html($stat['label']); ?></p>
                        <p class="font-montserrat text-[20px] font-bold leading-[36px] text-[#020202] lg:text-[24px]"><?php echo esc_html($stat['value']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Installation process -->
    <section id="installation" class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 lg:px-[68px] lg:py-[70px]">
            <div class="flex flex-col gap-[20px]">
                <h2 class="font-montserrat text-[28px] font-bold leading-[44px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_hiw_install_h2', 'Installation process')); ?>
                </h2>
                <div class="flex flex-col gap-8 lg:flex-row lg:gap-[36px]">
                    <div class="flex min-w-0 flex-1 flex-col gap-0">
                        <div
                            class="relative h-[260px] w-full overflow-hidden bg-black sm:h-[340px] lg:h-[434px]"
                            data-hiw-installation-video-wrap
                        >
                            <video
                                id="hiw-installation-video"
                                class="block h-full w-full object-cover"
                                controls
                                playsinline
                                muted
                                preload="<?php echo $has_installation_mp4 ? 'metadata' : 'none'; ?>"
                                poster="<?php echo esc_url($how_it_works_assets['installation_video_poster']); ?>"
                                aria-label="<?php echo esc_attr('Goliath product demo: installation process'); ?>"
                            >
                                <?php if ($has_installation_mp4) : ?>
                                    <source src="<?php echo esc_url($how_it_works_assets['installation_video_mp4']); ?>" type="video/mp4">
                                <?php endif; ?>
                            </video>
                        </div>
                        <?php if ($has_installation_mp4) : ?>
                            <script>
                                (function () {
                                    var wrap = document.querySelector('[data-hiw-installation-video-wrap]');
                                    if (!wrap) return;
                                    var video = wrap.querySelector('#hiw-installation-video');
                                    if (!video || !('IntersectionObserver' in window)) return;
                                    var played = false;
                                    var io = new IntersectionObserver(
                                        function (entries) {
                                            entries.forEach(function (entry) {
                                                if (entry.isIntersecting && entry.intersectionRatio >= 0.35) {
                                                    played = true;
                                                    var p = video.play();
                                                    if (p && typeof p.catch === 'function') {
                                                        p.catch(function () {});
                                                    }
                                                } else if (!entry.isIntersecting && played) {
                                                    video.pause();
                                                }
                                            });
                                        },
                                        { root: null, rootMargin: '0px 0px -12% 0px', threshold: [0, 0.35, 0.6] }
                                    );
                                    io.observe(wrap);
                                })();
                            </script>
                        <?php endif; ?>
                        <a href="<?php echo esc_url($how_it_works_assets['installation_video_page']); ?>" class="inline-flex w-full items-center justify-between gap-4 bg-[#ff5c00] px-[28px] py-[18px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:opacity-95">
                            <span><?php echo esc_html(get_option('my_theme_hiw_install_video_text', 'Installation Video')); ?></span>
                            <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg')); ?>" alt="" class="size-5 shrink-0" width="20" height="20" aria-hidden="true">
                        </a>
                    </div>
                    <div class="flex flex-1 flex-col gap-[26px]">
                        <?php
                        $steps = [
                            ['title' => get_option('my_theme_hiw_step1_title', 'Precision Cutting'), 'desc' => get_option('my_theme_hiw_step1_desc', 'We use a specially designed cutting jig that\'s bolted to the existing damaged upright. This allows us to get a factory cut to the upright. The damaged section is cut out using a handheld bandsaw with a cutting jig that allows us to make a perfect cut every time. The damaged upright is removed. We use a prop system to hold the empty racking in place.')],
                            ['title' => get_option('my_theme_hiw_step2_title', 'Fitting Goliath™'), 'desc' => get_option('my_theme_hiw_step2_desc', 'Goliath™ is fitted into place and all nuts and bolts are loosely fitted, which connects the upright and repair kit together.')],
                            ['title' => get_option('my_theme_hiw_step3_title', 'Securing the Structure'), 'desc' => get_option('my_theme_hiw_step3_desc', 'Bracing is bolted to Goliath™, and the prop is lowered, allowing all nuts and bolts to be tightened.')],
                            ['title' => get_option('my_theme_hiw_step4_title', 'Floor Fixing'), 'desc' => get_option('my_theme_hiw_step4_desc', 'Goliath™ is fixed down using two no. M16 double helix floor bolts, designed to work with Goliath™ to offer extra strength.')],
                            ['title' => get_option('my_theme_hiw_step5_title', 'Installation Complete'), 'desc' => get_option('my_theme_hiw_step5_desc', 'Installation is complete. You can resume your warehouse operations, knowing that any previously damaged racking has been repaired.')],
                        ];
                        foreach ($steps as $i => $step) :
                        ?>
                            <div class="flex items-start gap-[10px] border-t border-[#faf5ff] pt-[10px]">
                                <div class="flex h-[49px] shrink-0 items-center justify-center bg-[#ff5c00] p-[20px]">
                                    <span class="font-montserrat text-[20px] font-medium text-white"><?php echo $i + 1; ?></span>
                                </div>
                                <div class="flex-1">
                                    <p class="font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]"><?php echo esc_html($step['title']); ?></p>
                                    <p class="font-montserrat text-[12px] font-medium leading-[23px] text-[#020202]"><?php echo esc_html($step['desc']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fix the Problem / Lifetime Warranty -->
    <section class="w-full bg-[#fafafa]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 lg:flex-row lg:gap-[30px] lg:px-[68px] lg:pt-[80px] lg:pb-0 lg:h-[464px]">
            <div class="flex w-full flex-col gap-[16px] p-[20px] lg:w-[657px] lg:h-[218px] lg:shrink-0">
                <h2 class="font-montserrat text-[32px] font-bold leading-[42px] lg:text-[42px] lg:leading-[52px] lg:w-[577px]">
                    <span class="text-[#ff5c00]"><?php echo esc_html(get_option('my_theme_hiw_fix_h2_line1', 'Fix the Problem')); ?></span><br>
                    <span class="text-[#020202]"><?php echo esc_html(get_option('my_theme_hiw_fix_h2_line2', 'Without Stopping Your Business')); ?></span>
                </h2>
                <p class="max-w-[587px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                    <?php echo esc_html(get_option('my_theme_hiw_fix_paragraph', 'With Goliath™, you can fix the problem without stopping your business. No downtime or delays.')); ?>
                </p>
            </div>
            <div class="flex w-full flex-col gap-[16px] p-[20px] lg:w-[657px] lg:h-[218px] lg:shrink-0">
                <h2 class="font-montserrat text-[32px] font-bold leading-[42px] lg:text-[42px] lg:leading-[52px]">
                    <span class="text-[#ff5c00]"><?php echo esc_html(get_option('my_theme_hiw_warranty_h2_line1', 'Our Lifetime')); ?></span><br>
                    <span class="text-[#020202]"><?php echo esc_html(get_option('my_theme_hiw_warranty_h2_line2', 'Impact Warranty')); ?></span>
                </h2>
                <div class="max-w-[587px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                    <p><?php echo esc_html(get_option('my_theme_hiw_warranty_para1', 'Lifetime impact warranty: if your racking upright is damaged under normal warehouse conditions, we repair or replace it, no questions asked.')); ?></p>
                    <p class="mt-2"><?php echo esc_html(get_option('my_theme_hiw_warranty_para2', 'Our product is a long-term solution that removes the risk of paying for repairs continuously.')); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Designed to Meet UK Standards (Figma: 4 equal cards, orange check, rounded panels) -->
    <section class="w-full bg-white" aria-labelledby="uk-standards-heading">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 lg:px-[68px] lg:pt-[80px] lg:pb-[60px]">
            <div class="flex flex-col gap-6 lg:gap-8">
                <h2 id="uk-standards-heading" class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_hiw_standards_h2', 'Designed to Meet UK Standards')); ?>
                </h2>
                <p class="max-w-[896px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_hiw_standards_intro1', 'Goliath™ is developed to meet the UK\'s racking regulations and industry best practices. This ensures every repair supports both safety and compliance.')); ?>
                </p>
                <p class="max-w-[896px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_hiw_standards_intro2', 'It aligns with key standards, including:')); ?>
                </p>
                <?php
                $standards_cards = [
                    [
                        'title' => get_option('my_theme_hiw_standards_card1_title', 'BS EN 15512:2020 + A1:2022'),
                        'body'  => get_option('my_theme_hiw_standards_card1_body', 'Regulations for steel storage systems for adjustable pallet racking-principles for structural design'),
                    ],
                    [
                        'title' => get_option('my_theme_hiw_standards_card2_title', 'BS EN 15635:2008'),
                        'body'  => get_option('my_theme_hiw_standards_card2_body', 'Regulations for steel static storage systems application and maintenance of storage equipment'),
                    ],
                    [
                        'title' => get_option('my_theme_hiw_standards_card3_title', 'SEMA code of practice'),
                        'body'  => get_option('my_theme_hiw_standards_card3_body', 'for the design of adjustable pallet racking'),
                    ],
                    [
                        'title' => get_option('my_theme_hiw_standards_card4_title', 'SEMA code of practice'),
                        'body'  => get_option('my_theme_hiw_standards_card4_body', 'for the design and use of racking protection'),
                    ],
                ];
                $standards_check_icon = get_theme_file_uri('assets/images/icons/why-goliath-bullet-dark.svg');
                ?>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5">
                    <?php foreach ($standards_cards as $card) : ?>
                        <div class="flex min-h-0 min-w-0 flex-col rounded-lg bg-[#f9fafb] p-6">
                            <img
                                src="<?php echo esc_url($standards_check_icon); ?>"
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
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="max-w-[896px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_hiw_standards_closing', 'We\'re proud that Goliath™ is reinforced in a way that supports ongoing safety, reduces risk, and meets the expectations of UK regulatory bodies. Our upright repair solution was built according to UK H&S specifications, making it a trusted solution for warehouses in the UK.')); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Crash test video band (orange headline + full-width player) -->
    <section class="mt-8 w-full bg-white lg:mt-10" aria-label="<?php echo esc_attr('Goliath crash test video'); ?>">
        <div class="mx-auto w-full max-w-[1440px] px-5 lg:px-[68px]">
            <div class="flex w-full flex-col overflow-hidden lg:flex-row lg:items-stretch">
                <div class="flex min-h-[240px] flex-none flex-col justify-center bg-[#ff5c00] px-8 py-10 lg:min-h-[580px] lg:w-[35%] lg:max-w-[480px] lg:px-10 lg:py-14">
                    <h2 class="font-montserrat text-[28px] font-bold leading-[1.2] text-white sm:text-[32px] lg:text-[36px] xl:text-[40px]">
                        <span class="block"><?php echo esc_html(get_option('my_theme_hiw_crash_headline', 'Install once stop damage for good.')); ?></span>
                    </h2>
                </div>
                <div
                    class="relative min-h-[320px] flex-1 bg-black sm:min-h-[380px] lg:min-h-[580px]"
                    data-hiw-crash-test-video-wrap
                >
                    <?php if ($has_crash_test_mp4) : ?>
                        <video
                            id="hiw-crash-test-video-band"
                            class="absolute inset-0 z-0 h-full w-full object-cover"
                            controls
                            playsinline
                            muted
                            loop
                            preload="metadata"
                            poster="<?php echo esc_url($how_it_works_assets['crash_test_video_poster']); ?>"
                            aria-label="<?php echo esc_attr('Goliath crash test: with versus without protection'); ?>"
                        >
                            <source src="<?php echo esc_url($how_it_works_assets['crash_test_video_mp4']); ?>" type="video/mp4">
                        </video>
                    <?php else : ?>
                        <a href="<?php echo esc_url($how_it_works_assets['crash_test_video_page']); ?>" class="relative flex min-h-[320px] w-full flex-col items-center justify-center bg-black sm:min-h-[380px] lg:min-h-[580px]">
                            <span class="flex size-12 items-center justify-center rounded-full bg-[#e53935] shadow-md sm:size-14" aria-hidden="true">
                                <span class="ml-px block h-0 w-0 border-y-[7px] border-l-[11px] border-y-transparent border-l-white sm:border-y-[8px] sm:border-l-[13px]"></span>
                            </span>
                            <span class="mt-4 font-montserrat text-[14px] font-bold uppercase tracking-[0.35px] text-white">Watch on video page</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ($has_crash_test_mp4) : ?>
            <script>
                (function () {
                    var wrap = document.querySelector('[data-hiw-crash-test-video-wrap]');
                    if (!wrap) return;
                    var video = wrap.querySelector('#hiw-crash-test-video-band');
                    if (!video || !('IntersectionObserver' in window)) return;
                    var played = false;
                    var io = new IntersectionObserver(
                        function (entries) {
                            entries.forEach(function (entry) {
                                if (entry.isIntersecting && entry.intersectionRatio >= 0.35) {
                                    played = true;
                                    var p = video.play();
                                    if (p && typeof p.catch === 'function') {
                                        p.catch(function () {});
                                    }
                                } else if (!entry.isIntersecting && played) {
                                    video.pause();
                                }
                            });
                        },
                        { root: null, rootMargin: '0px 0px -12% 0px', threshold: [0, 0.35, 0.6] }
                    );
                    io.observe(wrap);
                })();
            </script>
        <?php endif; ?>
    </section>

    <!-- Image gallery -->
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-10 lg:px-[68px] lg:pt-[80px]">
            <div class="flex flex-col gap-[24px] sm:flex-row">
                <div class="flex-1 h-[200px] overflow-clip sm:h-[283px]">
                    <img
                        src="<?php echo esc_url(my_theme_get_image_url('my_theme_hiw_gallery_img1', get_theme_file_uri('assets/images/howITworks/process1.webp'))); ?>"
                        alt="Initial stage of upright repair"
                        class="h-full w-full object-cover"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="w-full h-[200px] overflow-clip sm:w-[383px] sm:h-[283px] sm:shrink-0">
                    <img
                        src="<?php echo esc_url(my_theme_get_image_url('my_theme_hiw_gallery_img2', get_theme_file_uri('assets/images/howITworks/process2.webp'))); ?>"
                        alt="Mid-stage Goliath installation on damaged upright"
                        class="h-full w-full object-cover"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="flex-1 h-[200px] overflow-clip sm:h-[283px]">
                    <img
                        src="<?php echo esc_url(my_theme_get_image_url('my_theme_hiw_gallery_img3', get_theme_file_uri('assets/images/howITworks/process3.webp'))); ?>"
                        alt="Completed Goliath repair in warehouse environment"
                        class="h-full w-full object-cover"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Fast, On-Site Repair -->
    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 lg:flex-row lg:items-center lg:justify-between lg:gap-0 lg:px-[68px] lg:py-[80px]">
            <div class="flex w-full flex-col gap-[28px] lg:w-[734px] lg:shrink-0">
                <h2 class="max-w-[648px] font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_hiw_repair_h2', 'Fast, On-Site Repair with Minimal Disruption')); ?>
                </h2>
                <p class="max-w-[722px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_hiw_repair_para1', 'Racking damage needs to be addressed quickly. This is because unaddressed upright damage puts lives in danger. But replacing your racking should not be the reason to shut down your operation.')); ?>
                </p>
                <p class="max-w-[720px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_hiw_repair_para2', 'Goliath™ is fast and efficient. Installation within live warehouse environments is done without removing and replacing the existing full uprights. Only the damaged section is cut out and replaced with our high-strength steel repair. This reinforces the structure without major disruption.')); ?>
                </p>
                <p class="max-w-[720px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_hiw_repair_para3', 'Installation takes as little as 30 minutes per upright, allowing work to be completed while your warehouse continues to operate. This means minimal downtime and much higher safety standards whenever Goliath™ is installed.')); ?>
                </p>
            </div>
            <div class="w-full bg-[#ff5c00] px-[32px] py-[30px] lg:w-[392px] lg:shrink-0">
                <div class="flex flex-col gap-[8px]">
                    <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-white">
                        <?php echo esc_html(get_option('my_theme_hiw_repair_box_h3', '30 Minutes Installation')); ?>
                    </h3>
                    <p class="max-w-[328px] font-roboto text-[18px] font-normal leading-[28px] text-white">
                        <?php echo esc_html(get_option('my_theme_hiw_repair_box_para', 'Installation takes as little as 30 minutes per upright, allowing work to be completed while your warehouse continues to operate. This means minimal downtime and much higher safety standards whenever Goliath™ is installed.')); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Installation Process -->
    <section class="w-full bg-white" aria-labelledby="our-installation-process-heading">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 lg:flex-row lg:items-stretch lg:justify-between lg:gap-0 lg:px-[68px] lg:py-[55px]">
            <div class="flex w-full flex-col gap-[28px] lg:w-[734px] lg:shrink-0">
                <h2 id="our-installation-process-heading" class="max-w-[648px] font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_hiw_ourprocess_h2', 'Our Installation Process')); ?>
                </h2>
                <div class="max-w-[722px] space-y-4 font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <p><?php echo esc_html(get_option('my_theme_hiw_ourprocess_para1', 'The process starts by highlighting the damaged area of the upright. Instead of removing the entire upright when replacing, we only remove the affected area. This limits the area of focus.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_hiw_ourprocess_para2', 'Goliath™ is fitted in place of the damaged steel by securing it directly to the existing upright, forming a reinforced structure that restores load integrity and improves resistance to future impact.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_hiw_ourprocess_para3', 'Bracing is bolted to Goliath™, and the prop is lowered, allowing all nuts and bolts to be tightened. Goliath™ is fixed down using two no. M16 double helix floor bolts, designed to work with Goliath™ to offer extra strength.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_hiw_ourprocess_para4', 'Installation is complete. You can resume your warehouse operations safely, knowing that any previously damaged racking has been repaired.')); ?></p>
                </div>
            </div>
            <div class="flex w-full items-center justify-center bg-[#020202] px-[32px] py-[30px] lg:w-[392px] lg:shrink-0 lg:self-stretch">
                <p class="max-w-[310px] text-center font-roboto text-[20px] font-bold leading-[28px] text-white">
                    <?php echo esc_html(get_option('my_theme_hiw_ourprocess_quote', 'Installation is complete. You can resume your warehouse operations safely, knowing that any previously damaged racking has been repaired.')); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Strength Where It Matters Most -->
    <section class="w-full bg-black">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-[42px] px-5 py-10 text-center lg:px-[219px] lg:py-[80px]">
            <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-white lg:text-[36px]">
                <?php echo esc_html(get_option('my_theme_hiw_strength_h2', 'Strength Where It Matters Most')); ?>
            </h2>
            <p class="font-roboto text-[18px] font-normal leading-[28px] text-white">
                <?php echo esc_html(get_option('my_theme_hiw_strength_para1', 'Goliath™ focuses on the area most likely to be impacted by forklifts.')); ?>
            </p>
            <p class="max-w-[896px] font-roboto text-[18px] font-normal leading-[28px] text-white">
                <?php echo esc_html(get_option('my_theme_hiw_strength_para2', 'Once it is installed, the reinforced section becomes stronger than the original structure. It absorbs repeated impacts from movement and forklifts and prevents the same damage from happening again in that location.')); ?>
            </p>
            <div class="w-full bg-[#ff5c00] p-[32px] text-center">
                <p class="max-w-[832px] font-roboto text-[18px] font-normal leading-[28px] text-white mx-auto">
                    <?php echo esc_html(get_option('my_theme_hiw_strength_box', 'With Goliath™, you never have to pay for an upright replacement in the same area again. This is because Goliath™ is covered by a lifetime impact warranty; the only one of its kind in the UK or Europe.')); ?>
                </p>
            </div>
            <p class="max-w-[896px] font-montserrat text-[20px] font-bold leading-[32px] text-[#ff5c00] lg:text-[22px] lg:leading-[34px]">
                <?php echo esc_html(get_option('my_theme_hiw_strength_tagline', 'This turns a reactive repair into a structural upgrade.')); ?>
            </p>
        </div>
    </section>

    <!-- Installed in Real-World / Built to Support Compliance -->
    <section class="w-full bg-white">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-10 lg:flex-row lg:items-center lg:justify-center lg:gap-[100px] lg:px-[68px] lg:py-[55px]">
            <div class="flex w-full flex-col gap-[28px] lg:h-[432px] lg:w-[538px] lg:shrink-0">
                <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_hiw_realworld_h2', 'Installed in Real-World Environments')); ?>
                </h2>
                <div class="max-w-[525px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <p>Goliath™ is fitted directly onto existing racking and is installed at ground-level impact zones.</p>
                    <p class="mt-2">You'll see it in places like:</p>
                    <ul class="mt-1 list-none">
                        <li><span aria-hidden="true">+</span> Distribution centres</li>
                        <li><span aria-hidden="true">+</span> Logistics operations</li>
                        <li><span aria-hidden="true">+</span> Retail warehouses</li>
                        <li><span aria-hidden="true">+</span> Manufacturing facilities</li>
                        <li><span aria-hidden="true">+</span> Cold stores</li>
                        <li><span aria-hidden="true">+</span> Document storage warehouses</li>
                    </ul>
                    <p class="mt-2">Once it is installed, it becomes a part of the upright that provides continuous protection without affecting daily operations.</p>
                </div>
            </div>
            <div class="flex w-full flex-col gap-[28px] lg:h-[432px] lg:w-[538px] lg:shrink-0">
                <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_hiw_compliance_h2', 'Built to Support Compliance')); ?>
                </h2>
                <div class="max-w-[525px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <p>Goliath™ aligns with recognised UK standards:</p>
                    <ul class="mt-1 list-none">
                        <li><span aria-hidden="true">+</span> BS EN 15512</li>
                        <li><span aria-hidden="true">+</span> BS EN 15635</li>
                        <li><span aria-hidden="true">+</span> SEMA guidelines</li>
                    </ul>
                    <p class="mt-2">By reinforcing damaged uprights, our permanent upright repair helps maintain structural integrity and supports ongoing inspection requirements.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- A Smarter Way CTA -->
    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-[32px] px-5 py-10 text-center lg:px-[283px] lg:py-[80px]">
            <h2 class="w-full font-montserrat text-[28px] font-bold leading-[40px] text-white lg:text-[36px]">
                <?php echo esc_html(get_option('my_theme_hiw_cta_h2', 'A Smarter Way to Handle Racking Damage')); ?>
            </h2>
            <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-white lg:text-[20px]">
                <?php echo esc_html(get_option('my_theme_hiw_cta_para1', 'Instead of repeatedly repairing or replacing uprights, Goliath™ changes how damage is managed. It allows you to fix the issue quickly, strengthen the structure, and reduce the likelihood of recurrence without slowing your operation down.')); ?>
            </p>
            <p class="w-full max-w-[1020px] font-roboto text-[18px] font-normal leading-[28px] text-white">
                <?php echo esc_html(get_option('my_theme_hiw_cta_para2', 'There is no other system in the UK that offers the same assurance of reduced repairs, minimal downtime during installation, and cost-saving advantage that results in higher profitability for your warehouse like Goliath™.')); ?>
            </p>
            <div class="flex flex-col items-center justify-center gap-4 sm:flex-row sm:gap-[16px]">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="relative inline-flex h-[60px] w-full items-center justify-center gap-2 bg-white px-[40px] font-roboto text-[18px] font-bold uppercase leading-[28px] tracking-[0.45px] text-[#ff5c00] hover:bg-[#f4f4f4] sm:w-[310px]">
                    <span class="text-center sm:whitespace-nowrap"><?php echo esc_html(get_option('my_theme_hiw_cta_primary', 'Get Free Site Survey')); ?></span>
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/hiw-cta-arrow.svg')); ?>" alt="" class="size-5 shrink-0 sm:absolute sm:right-[20px] sm:top-1/2 sm:-translate-y-1/2" width="20" height="20" aria-hidden="true">
                </a>
                <a href="<?php echo esc_url(home_url('/compliance/')); ?>" class="inline-flex h-[60px] w-full items-center justify-center bg-[#020202] font-roboto text-[18px] font-bold uppercase leading-[28px] tracking-[0.45px] text-white hover:bg-[#1a1a1a] sm:w-[295px]">
                    <?php echo esc_html(get_option('my_theme_hiw_cta_secondary', 'View Compliance Info')); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
