<?php get_header(); ?>

<?php
// If the front page has been built with Gutenberg blocks, render those.
// Until the client builds the page in the block editor, the existing
// wp_options template below is used as a fallback — so nothing breaks.
$front_page_id = (int) get_option('page_on_front');
if ($front_page_id > 0 && has_blocks(get_post($front_page_id))) {
    global $post;
    $post = get_post($front_page_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
    setup_postdata($post);
    echo '<main class="w-full max-w-[1440px] mx-auto">';
    the_content();
    echo '</main>';
    wp_reset_postdata();
    get_footer();
    return;
}
?>

<?php
$hero_assets = [
    'slide_1'    => my_theme_get_image_url('my_theme_hp_hero_slide1', get_theme_file_uri('assets/images/Homepage/carousel-image1.webp')),
    'slide_2'    => my_theme_get_image_url('my_theme_hp_hero_slide2', get_theme_file_uri('assets/images/Homepage/carousel-image2.webp')),
    'slide_3'    => my_theme_get_image_url('my_theme_hp_hero_slide3', get_theme_file_uri('assets/images/Homepage/not-just-dent.webp')),
    'arrow_dark'  => get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg'),
    'arrow_light' => get_theme_file_uri('assets/images/icons/arrow-right-white.svg'),
    'cta_arrow'   => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];

$hero_carousel_image_slides = [
    ['kind' => 'image', 'src' => $hero_assets['slide_1'], 'alt' => 'Goliath racking repair in a warehouse'],
    ['kind' => 'image', 'src' => $hero_assets['slide_2'], 'alt' => 'Goliath installation on pallet racking'],
    ['kind' => 'image', 'src' => $hero_assets['slide_3'], 'alt' => 'Damaged racking upright showing dent impact'],
];

$hero_video_defaults = [
    get_theme_file_uri('assets/videos/explanation-video.mp4'),
    get_theme_file_uri('assets/videos/carousel-video1.mp4'),
    get_theme_file_uri('assets/videos/carousel-video2.mp4'),
];
$hero_video_alts = [
    'Goliath installation and explanation video',
    'Carousel video 1 preview',
    'Carousel video 2 preview',
];
$hero_carousel_video_slides = [];
for ($vi = 0; $vi < 3; $vi++) {
    $video_url = get_option('my_theme_hp_hero_video' . ($vi + 1), '');
    if ($video_url === '' || $video_url === false) {
        $video_url = $hero_video_defaults[$vi];
    }
    if ($video_url !== '') {
        $hero_carousel_video_slides[] = [
            'kind' => 'video',
            'src'  => $video_url,
            'alt'  => $hero_video_alts[$vi],
        ];
    }
}

/** @var list<array{kind: string, src: string, alt: string}> $hero_carousel_slides */
$hero_carousel_slides = array_merge($hero_carousel_video_slides, $hero_carousel_image_slides);

$timer_video_default = get_theme_file_uri('assets/videos/Timer-install-video.mp4');
$timer_video_url     = get_option('my_theme_hp_timer_video', '');
if ($timer_video_url === '' || $timer_video_url === false) {
    $timer_video_url = $timer_video_default;
}

$video_assets = [
    'bg_4'                => my_theme_get_image_url('my_theme_hp_hero_slide3', get_theme_file_uri('assets/images/Homepage/not-just-dent.webp')),
    'timer_install_video' => $timer_video_url,
];
$has_timer_install_video = ($timer_video_url !== '');
?>

<style>
    .hero-cta-hover {
        transition: box-shadow 0.2s ease, transform 0.2s ease, background-color 0.2s ease;
    }

    .hero-cta-hover:hover {
        box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.65);
        transform: translateY(-1px);
    }
</style>

<main class="w-full max-w-[1440px] mx-auto">

    <!-- ============================================ -->
    <!-- 1. HERO SECTION                              -->
    <!-- ============================================ -->
    <section id="hero" class="relative left-1/2 right-1/2 w-[100dvw] max-w-[100dvw] -ml-[50dvw] -mr-[50dvw] overflow-hidden bg-white">
        <div class="flex w-full flex-col lg:flex-row lg:items-stretch">
            <div class="relative flex w-full shrink-0 flex-col bg-[#ff5c00] px-6 pb-10 pt-20 sm:px-8 sm:pb-12 sm:pt-24 lg:w-[500px] lg:h-[720px] lg:px-[60px] lg:pb-[80px] lg:pt-[120px]">
                <div class="flex min-h-0 flex-1 flex-col gap-8 sm:gap-10">
                    <div class="w-full max-w-[418px]">
                        <p class="font-montserrat font-medium text-[16px] uppercase leading-[22px] tracking-[0.0703px] text-[#020202]">
                            <?php echo esc_html(function_exists('my_theme_organization_name') ? my_theme_organization_name() : 'Goliath Pallet Racking Repair Ltd'); ?>
                        </p>
                        <h1 class="mt-3 font-montserrat font-bold text-[36px] leading-[44px] text-white normal-case sm:mt-4">
                            <?php echo esc_html(get_option('my_theme_hp_hero_h1', 'Safe, Instant Repair for Damaged Uprights')); ?>
                        </h1>
                    </div>

                    <div class="flex flex-wrap gap-[10px]">
                        <?php
                        $hero_stats = [
                            ['label' => 'Installation', 'value' => '30 Minutes', 'label_size' => 'text-[11px]'],
                            ['label' => 'Warranty', 'value' => 'Lifetime', 'label_size' => 'text-[12px]'],
                            ['label' => 'UK Compliance', 'value' => '100%', 'label_size' => 'text-[11px]'],
                        ];
                        foreach ($hero_stats as $stat) : ?>
                            <div class="flex h-[40px] min-w-0 flex-1 basis-[100px] items-end border-l border-[#e8e8e9] pl-[11px] pr-[10px] sm:flex-none sm:basis-auto sm:w-[115px]">
                                <div class="flex h-[44px] flex-col justify-end">
                                    <p class="font-inter <?php echo esc_attr($stat['label_size']); ?> leading-[20px] tracking-[-0.1504px] text-[#020202]">
                                        <?php echo esc_html($stat['label']); ?>
                                    </p>
                                    <p class="font-montserrat text-[14px] font-bold leading-[22px] tracking-[0.0703px] text-[#020202]">
                                        <?php echo esc_html($stat['value']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="w-full max-w-[416px] space-y-1">
                        <p class="font-montserrat text-[16px] leading-[22px] tracking-[0.0703px] text-[#020202]"><?php echo esc_html(get_option('my_theme_hp_hero_tagline_1', 'Minimal Downtime, Maximum Safety')); ?></p>
                        <p class="font-montserrat text-[16px] font-semibold leading-[22px] tracking-[0.0703px] text-[#020202]"><?php echo esc_html(get_option('my_theme_hp_hero_tagline_2', 'Lifetime Warranty')); ?></p>
                    </div>
                </div>

                <div class="mt-10 flex flex-col gap-3 sm:mt-12 sm:flex-row sm:flex-wrap lg:mt-auto lg:pt-4">
                    <a href="<?php echo esc_url(home_url(get_option('my_theme_hp_hero_cta_url', '/contact/'))); ?>"
                       class="hero-cta-hover inline-flex h-[52px] w-full items-center justify-center gap-2 bg-[#020202] px-5 font-roboto text-[12px] font-bold uppercase tracking-[0.35px] text-white sm:w-[247px]">
                        <span><?php echo esc_html(get_option('my_theme_hp_hero_cta_text', 'Get Your Free Assessment')); ?></span>
                        <img src="<?php echo esc_url($hero_assets['cta_arrow']); ?>" alt="" class="size-5" aria-hidden="true">
                    </a>
                    <a href="#solution"
                       class="hero-cta-hover inline-flex h-[52px] w-full items-center justify-center border border-white px-5 font-roboto text-[12px] font-bold uppercase tracking-[0.35px] text-white sm:w-[119px] sm:shrink-0">
                        <?php echo esc_html(get_option('my_theme_hp_hero_secondary_cta_text', 'View more')); ?>
                    </a>
                </div>
            </div>

            <div class="relative h-[380px] min-h-0 w-full min-w-0 overflow-hidden [contain:paint] sm:h-[480px] lg:h-[720px] lg:min-h-0 lg:flex-1 js-hero-carousel">
                <div class="absolute inset-0 bg-[#39251c]"></div>
                <?php foreach ($hero_carousel_slides as $index => $slide) : ?>
                    <?php if ($slide['kind'] === 'image') : ?>
                        <img
                            src="<?php echo esc_url($slide['src']); ?>"
                            alt="<?php echo esc_attr($slide['alt']); ?>"
                            data-hero-slide
                            class="absolute inset-0 h-full w-full object-cover transition-opacity duration-300 <?php echo $index === 0 ? 'z-10 opacity-100' : 'z-0 opacity-0 pointer-events-none'; ?>"
                            width="1920"
                            height="1080"
                            decoding="async"
                            <?php if ($index === 0) : ?>fetchpriority="high"<?php endif; ?>
                        >
                    <?php else : ?>
                        <video
                            src="<?php echo esc_url($slide['src']); ?>"
                            data-hero-slide
                            class="absolute inset-0 block h-full w-full max-w-none bg-black object-contain xl:object-cover xl:[object-position:100%_0%] transition-opacity duration-300 <?php echo $index === 0 ? 'z-10 opacity-100' : 'z-0 opacity-0 pointer-events-none'; ?>"
                            autoplay
                            muted
                            loop
                            playsinline
                            preload="none"
                            aria-label="<?php echo esc_attr($slide['alt']); ?>"
                        ></video>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="pointer-events-none absolute inset-0 bg-black/20" aria-hidden="true"></div>

                <div class="absolute bottom-0 right-0 z-20 flex h-[63.7px]">
                    <button class="js-hero-prev relative h-[63.7px] w-[70px] bg-white" aria-label="Previous">
                        <span class="absolute left-[-3px] top-0 flex h-[70px] w-[73px] items-center justify-center px-[21.5px] py-[20px]">
                            <img src="<?php echo esc_url($hero_assets['arrow_dark']); ?>" alt="" class="size-[30px] -scale-x-100 invert" aria-hidden="true">
                        </span>
                    </button>
                    <button class="js-hero-next relative h-[63.7px] w-[70px] bg-[#ff5c00]" aria-label="Next">
                        <span class="absolute left-0 top-0 flex h-[70px] w-[73px] items-center justify-center px-[21.5px] py-[20px]">
                            <img src="<?php echo esc_url($hero_assets['arrow_light']); ?>" alt="" class="size-[30px]" aria-hidden="true">
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var carousel = document.querySelector('.js-hero-carousel');
            if (carousel) {
                var slides = Array.prototype.slice.call(carousel.querySelectorAll('[data-hero-slide]'));
                var prevBtn = carousel.querySelector('.js-hero-prev');
                var nextBtn = carousel.querySelector('.js-hero-next');
                var currentIndex = 0;

                function renderSlide(index) {
                    slides.forEach(function (slide, i) {
                        var isActive = i === index;
                        slide.classList.toggle('opacity-100', isActive);
                        slide.classList.toggle('opacity-0', !isActive);
                        slide.classList.toggle('pointer-events-none', !isActive);
                        slide.classList.toggle('z-10', isActive);
                        slide.classList.toggle('z-0', !isActive);

                        if (slide.tagName === 'VIDEO') {
                            slide.muted = true;
                            slide.loop = true;
                            if (isActive) {
                                var previewPlay = slide.play();
                                if (previewPlay && typeof previewPlay.catch === 'function') {
                                    previewPlay.catch(function () {});
                                }
                            } else {
                                slide.pause();
                                slide.currentTime = 0;
                            }
                        }
                    });
                    currentIndex = index;
                }

                if (slides.length && prevBtn && nextBtn) {
                    renderSlide(0);
                    prevBtn.addEventListener('click', function () {
                        var next = (currentIndex - 1 + slides.length) % slides.length;
                        renderSlide(next);
                    });

                    nextBtn.addEventListener('click', function () {
                        var next = (currentIndex + 1) % slides.length;
                        renderSlide(next);
                    });
                }
            }
        });
    </script>

    <!-- ============================================ -->
    <!-- 2. INSTALLATION PROCESS                      -->
    <!-- ============================================ -->
    <section id="process" class="section-shell py-6 lg:py-10">

        <!-- Heading -->
        <div class="mb-5">
            <p class="font-montserrat font-bold text-[30px] lg:text-[36px] text-noir leading-[36px] lg:leading-[44px] mb-0"><?php echo esc_html(get_option('my_theme_hp_process_heading', 'Installation process')); ?></p>
            <p class="font-montserrat font-medium text-[18px] lg:text-[20px] text-noir leading-[28px] lg:leading-[44px] mb-0"><?php echo esc_html(get_option('my_theme_hp_process_subheading', 'Fast, Easy, Guaranteed')); ?></p>
        </div>

        <!-- Description -->
        <div class="mb-[20px]">
            <p class="font-montserrat font-medium text-[16px] text-[#ff5c00] leading-[24px] mb-0"><?php echo esc_html(get_option('my_theme_hp_process_accent', 'Unique solution to end the repetitive cycle of upright damage.')); ?></p>
            <p class="font-roboto font-medium text-[16px] text-black leading-[24px] mb-0"><?php echo esc_html(get_option('my_theme_hp_process_body_1', 'From assessment to installation to lifetime protection – we handle everything so you can focus on your business.')); ?></p>
            <p class="font-roboto font-medium text-[16px] text-black leading-[24px] mb-0"><?php echo esc_html(get_option('my_theme_hp_process_body_2', 'Our team can install GOLIATH™ in your warehouse in as little as 30 minutes.')); ?></p>
        </div>

        <!-- 4 Steps: gap-[26px] -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
            <?php
            $step_icons = ['proccess-1.svg', 'proccess-2.svg', 'proccess-3.svg', 'proccess-4.svg'];
            $steps = get_option('my_theme_hp_process_steps');
            if (!is_array($steps) || empty($steps)) {
                $steps = [
                    ['title' => 'Identify Damaged Upright', 'description' => 'Comprehensive evaluation of your racking system. Our expert team identifies all areas of concern and provides detailed recommendations.'],
                    ['title' => 'Apply Fast, Permanent Repair', 'description' => 'Installation takes just 30 minutes per upright. Minimal disruption to your operations – get back to work quickly.'],
                    ['title' => 'Lifetime Warranty Activated', 'description' => 'Your repair is covered forever. If any impact damage occurs, we replace the affected parts at no cost to you.'],
                    ['title' => 'Peace of Mind Guaranteed', 'description' => 'Rest easy knowing your racking is safe, compliant, and protected. Focus on running your business, not worrying about safety.'],
                ];
            }
            foreach ($steps as $i => $step) : ?>
                <div class="border-t border-[#faf5ff] w-full min-h-[232px] py-[24px] lg:py-[30px] flex flex-col gap-[10px]">
                    <div class="h-[70px] w-[59px] shrink-0">
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/' . ($step_icons[$i] ?? 'proccess-1.svg'))); ?>"
                             alt="<?php echo esc_attr($step['title'] . ' icon'); ?>"
                             width="59"
                             height="70"
                             class="block h-full w-full object-contain object-left-top"
                             loading="lazy"
                             decoding="async">
                    </div>
                    <div class="w-full max-w-[273px]">
                        <h3 class="font-montserrat font-bold text-[16px] text-noir leading-[23px] mb-0"><?php echo esc_html($step['title']); ?></h3>
                        <p class="font-montserrat font-medium text-[12px] text-noir leading-[23px]"><?php echo esc_html($step['description'] ?? $step['desc'] ?? ''); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </section>

    <!-- ============================================ -->
    <!-- 3. PREVIEW / REVIEW PROCESS SECTION          -->
    <!-- ============================================ -->
    <section id="preview" class="relative left-1/2 right-1/2 w-[100dvw] max-w-[100dvw] -ml-[50dvw] -mr-[50dvw] bg-[#f9fafb]">
        <?php
        $review_assets = [
            'img_1' => my_theme_get_image_url('my_theme_hp_review_img1', get_theme_file_uri('assets/images/Homepage/review-1.webp')),
            'img_2' => my_theme_get_image_url('my_theme_hp_review_img2', get_theme_file_uri('assets/images/Homepage/review-2.webp')),
            'img_3' => my_theme_get_image_url('my_theme_hp_review_img3', get_theme_file_uri('assets/images/Homepage/review-3.webp')),
        ];
        ?>
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[50px]">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[307px_307px_1fr] lg:gap-[24px]">
                <img src="<?php echo esc_url($review_assets['img_1']); ?>" alt="Repaired upright close-up" class="h-[360px] w-full object-cover" loading="lazy" decoding="async">
                <img src="<?php echo esc_url($review_assets['img_2']); ?>" alt="Engineer installing repair" class="h-[359px] w-full object-cover" loading="lazy" decoding="async">
                <img src="<?php echo esc_url($review_assets['img_3']); ?>" alt="Installed racking upright in warehouse aisle" class="h-[359px] w-full object-cover" loading="lazy" decoding="async">
            </div>

            <div class="mt-6">
                <p class="font-montserrat text-[20px] font-medium uppercase leading-[44px] text-[#020202]"><?php echo esc_html(get_option('my_theme_hp_preview_eyebrow', 'Preview Process')); ?></p>
                <h2 class="font-montserrat text-[36px] font-bold leading-[44px] text-[#12192d]"><?php echo esc_html(get_option('my_theme_hp_preview_heading', 'Racking upright repair built to last')); ?></h2>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-5">
                <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                    <p class="mb-1 font-montserrat text-[20px] font-bold uppercase leading-[44px] text-[#ff5c00]">Racking upright repair built to last</p>
                    <p>Goliath™ is a permanent racking upright repair that stops repeat damage and keeps your warehouse operating safely.</p>
                    <p>Installed in minutes. Built to withstand impact.</p>
                    <div class="h-4"></div>
                    <h3 class="mb-1 font-montserrat text-[20px] font-bold uppercase leading-[44px] text-[#ff5c00]">Why Goliath™? (Money saving proposition)</h3>
                    <p>When warehouse racking damage happens, you know it is not a one-off issue. It is a cycle of hit, repair, and replacement happening continuously. Every incident carries its own cost and risk.</p>
                </div>

                <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                    <h3 class="mb-1 font-montserrat text-[20px] font-bold uppercase leading-[44px] text-[#ff5c00]">Goliath is the Solution</h3>
                    <p>Our permanent racking upright repair system is a durable setup that is engineered to meet UK safety standards. Once installed, it absorbs continuous impacts and prevents future damage. We're the smart solution to repeated upright replacement.</p>
                    <p>That means:</p>
                    <p>Never replace an upright again</p>
                    <p>Lower maintenance costs</p>
                    <p>Reduced operational disruption</p>
                    <p>Long lifespan for racking systems</p>
                    <p>Goliath™ doesn't offer a short-term fix. Ours is a long-term cost-saving solution for warehouse racking damage.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- 4. SOLUTION / PEACE OF MIND                  -->
    <!-- ============================================ -->
    <section id="solution" class="w-full bg-white">
        <?php
        $promise_assets = [
            'img_main' => my_theme_get_image_url('my_theme_hp_solution_img', get_theme_file_uri('assets/images/Homepage/installonce.webp')),
        ];
        ?>
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[120px]">
            <div class="relative flex flex-col items-start gap-8 lg:flex-row lg:items-center lg:justify-end lg:gap-[44px]">
                <div class="relative h-[744px] w-full overflow-hidden lg:w-[570px]">
                    <img src="<?php echo esc_url($promise_assets['img_main']); ?>" alt="Goliath team installing upright repair" class="absolute inset-0 h-full w-full object-cover" loading="lazy" decoding="async">
                </div>

                <div class="w-full lg:w-[635px]">
                    <div class="mb-1 flex items-center gap-3">
                        <p class="font-montserrat text-[20px] font-medium uppercase leading-[44px] text-[#020202]"><?php echo esc_html(get_option('my_theme_hp_solution_eyebrow', 'INSTALL ONCE,')); ?></p>
                        <span class="inline-flex rounded-[6px] bg-[#ff5c00] px-[10px] py-[6px] font-inter text-[12px] font-medium text-white tracking-[-0.1504px]"><?php echo esc_html(get_option('my_theme_hp_solution_badge', 'Forever Protected')); ?></span>
                    </div>
                    <h2 class="font-montserrat text-[36px] font-bold leading-[44px] text-[#020202]"><?php echo esc_html(get_option('my_theme_hp_solution_heading', 'Protect for lifetime')); ?></h2>
                    <p class="mt-1 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]"><?php echo esc_html(get_option('my_theme_hp_solution_intro', 'Every warehouse is a high-pressure environment. Tight deadlines, high traffic, and continuous forklift movement increase the risk of damage to warehouse racks.')); ?></p>

                    <div class="mt-6 space-y-5">
                        <div class="border-l border-[#ff5c00] px-[20px]">
                            <h3 class="font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]">Cost Savings That Add Up</h3>
                            <p class="font-montserrat text-[12px] font-medium leading-[23px] text-[#020202]">Install Goliath™ once and save thousands on your maintenance budgets and ongoing repairs. One of our clients, B&M, noted a reduction in their repair and maintenance costs, with no further costs required in the locations where Goliath™ had been fitted, improving ROI in the long term.</p>
                        </div>
                        <div class="border-l border-[#ff5c00] px-[20px]">
                            <h3 class="font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]">Sustainability</h3>
                            <p class="font-montserrat text-[12px] font-medium leading-[23px] text-[#020202]">Traditional upright repairs mean more steel is used during continuous replacement. With Goliath, you fix it once, and it reduces steel consumption and encourages sustainable warehouse operation.</p>
                        </div>
                        <div class="border-l border-[#ff5c00] px-[20px]">
                            <h3 class="font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]">Health &amp; safety improvements</h3>
                            <p class="font-montserrat text-[12px] font-medium leading-[23px] text-[#020202]">In areas where the upright takes the most damage, Goliath™'s engineered structure reduces the risk of damage significantly, creating a safe working environment. We also ensure repairs are completed smoothly with minimal disruption.</p>
                        </div>
                        <div class="border-l border-[#ff5c00] px-[20px]">
                            <h3 class="font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]">Designed for durability</h3>
                            <p class="font-montserrat text-[12px] font-medium leading-[23px] text-[#020202]">Goliath™ is engineered for impact resistance in high-traffic warehouse environments. It provides long-term protection during use.</p>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-[26px] left-0 flex h-[286px] w-full max-w-[435px] items-center bg-[#ff5c00] pl-[52px] pr-[32px]">
                    <div class="w-[325.5px] text-white">
                        <p class="font-montserrat text-[36px] font-bold leading-[44px]"><?php echo esc_html(get_option('my_theme_hp_promise_title', 'Goliath Promise')); ?></p>
                        <p class="font-montserrat text-[22px] font-medium leading-[29px]"><?php echo esc_html(get_option('my_theme_hp_promise_quote', '"We offer more than repairs. We deliver confidence, safety, and the certainty that your warehouse is protected for life."')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================ -->
    <!-- 6. 6 REASONS / 6 ADVANTAGES + CTA BAR       -->
    <!-- ============================================ -->
    <section id="compliance" class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[70px]">

        <div class="flex flex-col gap-6">
            <div>
                <p class="font-montserrat font-medium text-[18px] lg:text-[20px] text-noir uppercase leading-[30px] lg:leading-[44px] mb-0"><?php echo esc_html(get_option('my_theme_hp_advantages_eyebrow', 'The Goliath Difference')); ?></p>
                <h2 class="font-montserrat font-bold text-[30px] lg:text-[36px] text-noir leading-[36px] lg:leading-[44px] mb-0"><?php echo esc_html(get_option('my_theme_hp_advantages_heading', '6 Reasons, 6 Advantages')); ?></h2>
            </div>

            <div class="font-montserrat font-medium text-[16px] text-noir leading-[24px]">
                <p class="mb-0">Your customers aren't buying a "product" – they're buying risk reduction and peace of mind.</p>
                <p>We don't sell products. We serve you with a solid, durable solution to your problems backed by lifetime guarantees and unwavering reassurance.</p>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 xl:gap-[64px] relative">
                <div class="w-full flex flex-col gap-5">
                    <?php
                    $left_advantages = [
                        ['num' => '01', 'title' => 'Lifetime Impact Warranty', 'desc' => "Our lifetime warranty means you're protected forever. No time limits, no hidden clauses – complete peace of mind.", 'badge' => 'Forever'],
                        ['num' => '02', 'title' => '6mm Construction Steel', 'desc' => 'Military-grade robust construction designed to withstand the toughest warehouse environments.', 'badge' => ''],
                        ['num' => '03', 'title' => 'Exclusive Design', 'desc' => 'Design registration protected. Available only through Goliath in the UK/EU.', 'badge' => ''],
                    ];
                    foreach ($left_advantages as $adv) : ?>
                        <div class="flex gap-[10px] items-start py-[10px]">
                            <div class="relative shrink-0">
                                <div class="w-[70px] h-[70px] bg-noir flex items-center justify-center overflow-hidden p-[20px]">
                                    <span class="font-montserrat font-medium text-[24px] text-white"><?php echo esc_html($adv['num']); ?></span>
                                </div>
                                <span class="absolute right-0 bottom-[-14px] w-0 h-0 border-l-[14px] border-l-transparent border-t-[14px] border-t-noir"></span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-montserrat font-bold text-[16px] text-noir leading-[23px] mb-0">
                                    <?php echo esc_html($adv['title']); ?>
                                    <?php if ($adv['badge']) : ?>
                                        <span class="inline-block align-middle ml-2 bg-[#ff5c00] text-white font-inter font-medium text-[12px] leading-[20px] tracking-[-0.15px] px-[10px] py-[3px] rounded-[3px]"><?php echo esc_html($adv['badge']); ?></span>
                                    <?php endif; ?>
                                </h3>
                                <p class="font-montserrat font-medium text-[12px] text-noir leading-[23px]"><?php echo esc_html($adv['desc']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="w-full flex flex-col gap-5">
                    <?php
                    $right_advantages = [
                        ['num' => '04', 'title' => 'Fully UK Compliant', 'desc' => 'Meets all UK warehouse safety regulations. HSE approved and certified.', 'highlight' => true],
                        ['num' => '05', 'title' => '70% Cost Reduction', 'desc' => '£350 vs £2,025 for traditional replacement. Save thousands without compromising safety.', 'highlight' => false],
                        ['num' => '06', 'title' => 'Universal Compatibility', 'desc' => 'Adapts to all major UK and EU racking brands. One solution fits all.', 'highlight' => false],
                    ];
                    foreach ($right_advantages as $adv) : ?>
                        <div class="flex gap-[10px] items-start py-[10px]">
                            <div class="relative shrink-0">
                                <div class="w-[70px] h-[70px] <?php echo $adv['highlight'] ? 'bg-[#ff5c00]' : 'bg-noir'; ?> flex items-center justify-center overflow-hidden p-[20px]">
                                    <span class="font-montserrat font-medium text-[24px] text-white"><?php echo esc_html($adv['num']); ?></span>
                                </div>
                                <span class="absolute right-0 bottom-[-14px] w-0 h-0 border-l-[14px] border-l-transparent <?php echo $adv['highlight'] ? 'border-t-[14px] border-t-[#ff5c00]' : 'border-t-[14px] border-t-noir'; ?>"></span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-montserrat font-bold text-[16px] text-noir leading-[23px] mb-0"><?php echo esc_html($adv['title']); ?></h3>
                                <p class="font-montserrat font-medium text-[12px] text-noir leading-[23px]"><?php echo esc_html($adv['desc']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="mt-6 bg-[#020202] px-5 py-4 sm:px-6 lg:h-[96px] lg:px-[38px] lg:py-0">
            <div class="flex h-full flex-col gap-4 lg:flex-row lg:items-center lg:justify-between lg:gap-6">
                <p class="font-roboto text-[14px] font-bold leading-[22px] text-white sm:text-[16px] sm:leading-[24px] lg:flex-1 lg:text-[18px] lg:leading-[28px] lg:whitespace-nowrap">100% Client Satisfaction • Save 70% • 30min Installation • Lifetime Warranty</p>
                <div class="flex w-full flex-col gap-3 sm:flex-row sm:gap-4 lg:w-auto lg:shrink-0 lg:gap-4">
                    <a href="<?php echo esc_url(home_url('/case-studies/')); ?>" class="inline-flex h-[52px] w-full items-center justify-center border border-white font-roboto text-[16px] font-semibold text-white sm:w-[215px]">
                        <span>View case studies</span>
                        <img src="<?php echo esc_url($hero_assets['cta_arrow']); ?>" alt="" class="ml-3 size-5" aria-hidden="true">
                    </a>
                    <a href="#contact" class="inline-flex h-[52px] w-full items-center justify-center bg-[#ff5c00] font-roboto text-[16px] font-semibold text-white sm:w-[238px]">
                        <span>Get Similar Results</span>
                        <img src="<?php echo esc_url($hero_assets['cta_arrow']); ?>" alt="" class="ml-3 size-5" aria-hidden="true">
                    </a>
                </div>
            </div>
        </div>

        </div>
    </section>

    <!-- ============================================ -->
    <!-- 5. 3D PRODUCT IMAGE + WARRANTY BANNER        -->
    <!-- ============================================ -->
    <section class="relative left-1/2 right-1/2 w-[100dvw] max-w-[100dvw] -ml-[50dvw] -mr-[50dvw] overflow-hidden bg-white" aria-label="Installed in less than 30 minutes, covered for life">
        <div class="flex w-full min-h-[520px] flex-col lg:min-h-[620px] lg:flex-row">
            <div class="flex w-full bg-[#ff6b2c] px-6 py-12 text-white sm:px-10 sm:py-14 lg:w-[500px] lg:shrink-0 lg:px-[70px] lg:py-0">
                <div class="flex h-full w-full max-w-[374px] flex-col justify-center text-left">
                    <div class="mb-[36px]">
                        <p class="font-montserrat text-[8px] font-medium uppercase leading-[20px] tracking-[0.4px] lg:text-[14px] lg:leading-[30px]"><?php echo esc_html(get_option('my_theme_hp_timer_eyebrow', 'Never replace a racking upright again')); ?></p>
                        <h2 class="mt-1 font-montserrat text-[36px] font-bold leading-[44px]"><?php echo esc_html(get_option('my_theme_hp_timer_heading', 'Installed in less than 30 minutes, covered for life')); ?></h2>
                    </div>
                    <p class="mt-10 max-w-[333px] font-montserrat text-[16px] font-bold leading-[23px] lg:mt-14"><?php echo esc_html(get_option('my_theme_hp_timer_compat', 'Compatible with all UK and EU racking systems')); ?></p>
                </div>
            </div>

            <div class="relative min-h-[360px] w-full min-w-0 overflow-visible sm:h-[480px] lg:min-h-[620px] lg:flex-1">
                <?php if ($has_timer_install_video) : ?>
                    <video
                        class="absolute inset-0 block h-full w-full max-w-none bg-black object-cover"
                        autoplay
                        muted
                        loop
                        playsinline
                        preload="none"
                        poster="<?php echo esc_url($video_assets['bg_4']); ?>"
                        aria-label="<?php echo esc_attr('Goliath timer installation video'); ?>"
                    >
                        <source src="<?php echo esc_url($video_assets['timer_install_video']); ?>" type="video/mp4">
                    </video>
                <?php else : ?>
                    <img src="<?php echo esc_url($video_assets['bg_4']); ?>" alt="Damaged pallet racking upright in warehouse aisle" class="absolute inset-0 h-full w-full object-cover" loading="lazy" decoding="async">
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- 7. CASE STUDY + RESULTS + ASSESSMENT         -->
    <!-- ============================================ -->
    <section id="case-studies" class="section-shell py-12 lg:py-[80px]">

        <p class="font-roboto text-[14px] text-noir uppercase tracking-[0.7px] mb-4 lg:mb-5"><?php echo esc_html(get_option('my_theme_hp_casestudy_eyebrow', 'Featured Case Study')); ?></p>
        <h2 class="font-montserrat font-bold text-[30px] lg:text-[36px] text-noir leading-[36px] lg:leading-[44px] mb-2">
            <?php echo esc_html(get_option('my_theme_hp_casestudy_heading', 'UK leading retailer saved 70% on repairs in the first 12 months vs traditional replacement')); ?>
        </h2>
        <p class="font-montserrat font-medium text-[16px] text-noir leading-[24px] mb-6 lg:mb-8"><?php echo esc_html(get_option('my_theme_hp_casestudy_body', 'As a result, Goliath is now being rolled out across all of their sites and is even being installed as standard for all new fit-out projects.')); ?></p>

        <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mb-4 lg:mb-6">
            <div class="w-full lg:w-[640px] overflow-hidden aspect-[640/592]">
                <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_hp_casestudy_img1', get_theme_file_uri('assets/images/Homepage/case-study1.webp'))); ?>" alt="Engineers installing Goliath system" class="w-full h-full object-cover" loading="lazy" decoding="async">
            </div>
            <div class="flex-1 flex flex-col gap-4 lg:gap-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                    <a href="<?php echo esc_url(home_url('/case-studies/')); ?>" class="bg-[#ff5c00] min-h-[220px] lg:h-[284px] flex flex-col items-start justify-center px-8">
                        <span class="text-white text-[22px] leading-none mb-6">→</span>
                        <span class="font-roboto font-semibold text-[30px] text-white leading-[24px]">View Case Studies</span>
                    </a>
                    <div class="overflow-hidden min-h-[220px] lg:h-[284px]">
                        <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_hp_casestudy_img2', get_theme_file_uri('assets/images/Homepage/case-study2.webp'))); ?>" alt="Installed rack upright close-up" class="w-full h-full object-cover" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="overflow-hidden h-[220px] lg:h-[284px]">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_hp_casestudy_img3', get_theme_file_uri('assets/images/Homepage/case-study3.webp'))); ?>" alt="Goliath repaired upright detail" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>
        </div>

        <!-- Results Stats -->
        <div id="kpi" class="text-center py-10 lg:py-[80px]">
            <p class="font-montserrat font-medium text-[20px] text-noir uppercase leading-[44px] mb-0"><?php echo esc_html(get_option('my_theme_hp_kpi_eyebrow', 'Proven Results')); ?></p>
            <h3 class="font-montserrat font-bold text-[34px] lg:text-[36px] text-noir leading-[40px] lg:leading-[44px] mb-1"><?php echo esc_html(get_option('my_theme_hp_kpi_heading', 'Real Results, Real ROI')); ?></h3>
            <p class="font-montserrat font-bold text-[16px] text-noir leading-[23px] mb-8 lg:mb-10"><?php echo esc_html(get_option('my_theme_hp_kpi_subheading', 'Leading UK businesses trust Goliath to protect their warehouse infrastructure')); ?></p>

            <div class="flex flex-col md:flex-row items-center justify-center gap-10 lg:gap-[160px]">
                <div class="relative mx-auto flex h-[200px] w-[200px] max-w-full items-center justify-center sm:h-[235px] sm:w-[231px]">
                    <div class="absolute inset-[2px] rounded-full border-[7px] border-[#ff5c00]" aria-hidden="true"></div>
                    <div class="pointer-events-none absolute inset-0 z-10 flex flex-col items-center justify-center px-2 text-center">
                        <p class="font-yantramanav font-bold text-[60px] text-noir leading-[57.6px] tracking-[-1.2px] mb-0">100<span class="text-[38px]">%</span></p>
                        <p class="font-roboto text-[14px] text-noir uppercase tracking-[0.7px] leading-[20px] mb-0">CLIENT SATISFACTION</p>
                    </div>
                </div>

                <div class="relative mx-auto flex h-[200px] w-[200px] max-w-full items-center justify-center sm:h-[235px] sm:w-[231px]">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/kpi-ring-70.svg')); ?>" alt="70 percent average cost savings indicator ring" class="pointer-events-none absolute inset-0 h-full w-full object-contain" width="231" height="235">
                    <div class="pointer-events-none absolute inset-0 z-10 flex flex-col items-center justify-center px-2 text-center">
                        <p class="font-yantramanav font-bold text-[60px] text-noir leading-[57.6px] tracking-[-1.2px] mb-0">70<span class="text-[38px]">%</span></p>
                        <p class="font-roboto text-[14px] text-noir uppercase tracking-[0.7px] leading-[20px] mb-0">AVERAGE COST SAVINGS</p>
                    </div>
                </div>

                <div class="relative mx-auto flex h-[200px] w-[200px] max-w-full items-center justify-center sm:h-[235px] sm:w-[231px]">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/kpi-ring-85.svg')); ?>" alt="85 percent reduction in downtime indicator ring" class="pointer-events-none absolute inset-0 h-full w-full object-contain" width="231" height="235">
                    <div class="pointer-events-none absolute inset-0 z-10 flex flex-col items-center justify-center px-2 text-center">
                        <p class="font-yantramanav font-bold text-[60px] text-noir leading-[57.6px] tracking-[-1.2px] mb-0">85<span class="text-[38px]">%</span></p>
                        <p class="font-roboto text-[14px] text-noir uppercase tracking-[0.7px] leading-[20px] mb-0">REDUCTION IN DOWNTIME</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assessment / Dark CTA -->
        <div id="expertise" class="relative mt-10 w-full">
            <div class="relative bg-noir w-full lg:w-[1304px] min-h-[420px] lg:h-[534px] overflow-hidden">
                <div class="px-6 sm:px-8 lg:px-[44px] pt-10 lg:pt-[76px] pb-10 lg:pb-[85px] lg:w-[874px]">
                    <div class="relative">
                        <div class="flex items-center gap-2 mb-2 flex-wrap">
                            <span class="font-montserrat font-bold text-[20px] text-white uppercase leading-[44px]">A Goliath expert</span>
                            <span class="inline-block bg-[#ff5c00] text-white text-[12px] font-bold px-[10px] py-[4px] rounded-[2px]"><?php echo esc_html(get_option('my_theme_hp_expert_badge', 'Free Audit')); ?></span>
                        </div>
                        <p class="font-montserrat font-bold text-[24px] lg:text-[36px] text-white uppercase leading-[34px] lg:leading-[44px] mb-8 max-w-[820px]"><?php echo esc_html(get_option('my_theme_hp_expert_headline', 'Our SEMA qualified inspectors will assess your warehouse and demonstrate how Goliath can help you')); ?></p>
                    </div>

                    <div class="flex flex-wrap gap-[30px] mb-8">
                        <?php
                        $features = [
                            ['top' => 'Qualified', 'bottom' => 'inspectors'],
                            ['top' => 'Tailored', 'bottom' => 'Solution'],
                            ['top' => 'Analysis', 'bottom' => 'Report'],
                        ];
                        foreach ($features as $feat) : ?>
                            <div class="border-l border-gray-300 pl-[11px] pr-[10px] flex min-w-0 flex-1 basis-[140px] items-end gap-2 h-[51px] sm:flex-none sm:basis-auto sm:w-[169px]">
                                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/expertise-feature-icon.svg')); ?>" alt="" class="w-8 h-8 shrink-0 mb-1" aria-hidden="true">
                                <div>
                                    <span class="text-white text-[15px] leading-[20px] block"><?php echo esc_html($feat['top']); ?></span>
                                    <span class="text-white font-bold text-[18px] leading-[20px] block <?php echo $feat['bottom'] === 'Report' ? 'tracking-[2.85px]' : ''; ?>"><?php echo esc_html($feat['bottom']); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-[30px]">
                        <a href="#contact" class="btn-primary h-[52px] w-full px-8 text-[14px] uppercase sm:w-[282px]">
                            <?php echo esc_html(get_option('my_theme_hp_expert_cta_1_text', 'Interested in GOLIATH™?')); ?>
                            <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/cta-arrow-right.svg')); ?>" alt="" class="w-5 h-5" aria-hidden="true">
                        </a>
                        <a href="#contact" class="btn-outline-light border-white/60 h-[52px] w-full px-8 text-[14px] uppercase whitespace-nowrap sm:w-[286px]">
                            <?php echo esc_html(get_option('my_theme_hp_expert_cta_2_text', 'Book My Free Site Survey')); ?>
                            <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/cta-arrow-right.svg')); ?>" alt="" class="w-5 h-5" aria-hidden="true">
                        </a>
                    </div>
                </div>

                <div class="relative lg:absolute lg:right-0 lg:top-0 w-full lg:w-[430px] h-[300px] sm:h-[420px] lg:h-[534px] mt-6 lg:mt-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/expertise-photo-layer-1.png')); ?>" alt="Warehouse interior with Goliath repair area" class="absolute inset-0 w-full h-full object-cover" loading="lazy" decoding="async">
                    </div>
                    <div class="absolute inset-0 overflow-hidden">
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/expertise-photo-layer-2.png')); ?>" alt="Close-up of warehouse racking section" class="absolute top-0 left-[-3.86%] w-[103.86%] h-[103.57%] object-cover" loading="lazy" decoding="async">
                    </div>
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/expertise-photo-layer-3.png')); ?>" alt="Goliath engineer preparing upright assessment" class="absolute inset-0 w-full h-full object-bottom" loading="lazy" decoding="async">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/expertise-photo-layer-4.png')); ?>"
                         alt="Goliath expert assessment"
                         class="absolute inset-0 w-full h-full object-cover">
                </div>
            </div>
        </div>

        <!-- Performance copy -->
        <div class="py-10">
            <h2 class="font-montserrat font-bold text-[36px] text-noir leading-[44px] mb-5"><?php echo esc_html(get_option('my_theme_hp_performance_heading', 'Performance you can trust')); ?></h2>
            <div class="font-montserrat font-medium text-[16px] text-noir leading-[24px]">
                <p class="mb-0">Reliability is one of the most important factors that govern warehouse safety, efficiency, and profitability. With Goliath, you can expect:</p>
                <p class="mb-0">+ Consistent protection against forklift impact across your warehouse</p>
                <p class="mb-0">+ Reduced repairs and replacements of uprights</p>
                <p class="mb-0">+ Improved structural integrity of racking systems</p>
                <p class="mb-0">+ Long-term cost savings across your operations</p>
                <p class="mb-0">From large distribution centres to growing logistics operations, Goliath™ is trusted by businesses who want to reduce downtime, improve safety, and ensure proper racking maintenance.</p>
                <p>Goliath™ is supported by a lifetime impact warranty, helping you rest in comfort that your investment is protected.</p>
            </div>
        </div>

    </section>

    <!-- ============================================ -->
    <!-- 8. "IS IT JUST A DENT?" SECTION              -->
    <!-- ============================================ -->
    <section id="dent-risk" class="section-shell py-[10px]">
        <div class="bg-white overflow-hidden">
            <div class="flex flex-col xl:flex-row">
                <div class="shrink-0 w-full xl:w-[640px] h-[340px] xl:h-[427px] overflow-hidden">
                    <img src="<?php echo esc_url(my_theme_get_image_url('my_theme_hp_dent_img', get_theme_file_uri('assets/images/Homepage/not-just-dent.webp'))); ?>"
                         alt="Damaged warehouse upright"
                         class="w-full h-full object-cover object-bottom">
                </div>
                <div class="w-full xl:w-[672px] pt-8 xl:pt-[76px] pb-8 xl:pb-[85px] pl-0 xl:pl-[36px] pr-0 xl:pr-[92px]">
                    <div class="flex flex-col gap-[12px]">
                        <p class="font-yantramanav font-medium text-[14px] text-noir uppercase tracking-[1.4px] leading-[28px] mb-0"><?php echo esc_html(get_option('my_theme_hp_dent_eyebrow', 'Explore the Features')); ?></p>
                        <h2 class="font-montserrat font-bold text-[30px] xl:text-[36px] text-[#ff5c00] leading-[36px] xl:leading-[44px] mb-0"><?php echo esc_html(get_option('my_theme_hp_dent_heading', 'It is not just a dent...')); ?></h2>
                        <p class="font-montserrat font-bold text-[16px] text-noir leading-[23px] max-w-[472px] mb-0"><?php echo esc_html(get_option('my_theme_hp_dent_stat', 'The Real Cost , Structural collapse risk increases by 60% with each unrepaired impact')); ?></p>
                        <p class="font-montserrat font-medium text-[16px] text-noir leading-[24px] max-w-[544px] mb-0"><?php echo esc_html(get_option('my_theme_hp_dent_body', 'You deserve a solution that\'s fast, permanent, and guaranteed. Traditional repairs are temporary patches. Full replacements are expensive and disruptive. There has to be a better way.')); ?></p>
                        <a href="#contact" class="btn-primary h-[52px] w-full text-[14px] uppercase sm:w-[247px] mt-2">
                            <?php echo esc_html(get_option('my_theme_hp_dent_cta_text', 'Discover the Solution')); ?>
                            <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/cta-arrow-right.svg')); ?>" alt="" class="w-5 h-5" aria-hidden="true">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- 9. CONTACT / CONSULTATION FORM               -->
    <!-- ============================================ -->
    <section id="contact" class="relative left-1/2 right-1/2 w-[100dvw] max-w-[100dvw] -ml-[50dvw] -mr-[50dvw] bg-[#ff5c00] lg:bg-[linear-gradient(to_bottom,_#ff5c00_0%,_#ff5c00_58%,_#020202_58%,_#020202_100%)] pt-8 lg:pt-[40px] pb-10 lg:pb-[80px]">
        <div class="px-4 sm:px-6 lg:px-10">
            <!-- Node 610:22999 CTA strip -->
            <div class="bg-white max-w-[1328px] mx-auto px-5 lg:px-[38px] py-5 lg:py-0 lg:h-[96px] mb-8 lg:mb-[51px]">
                <div class="w-full flex flex-col lg:flex-row gap-4 lg:h-full lg:items-center">
                    <p class="font-montserrat font-bold text-[16px] text-noir leading-[23px] mb-0">100% Client Satisfaction • Save 70% • 30min Installation • Lifetime Warranty</p>
                </div>
            </div>

            <!-- White form container: max-w-[1328px] -->
            <div class="bg-white max-w-[1328px] mx-auto">
                <div class="flex flex-col lg:flex-row gap-8 lg:gap-[48px] px-5 sm:px-8 lg:px-[18px] py-6 lg:py-[28px]">

                <!-- Left info: 445px wide -->
                <div class="lg:w-[445px] shrink-0">
                    <div class="mb-[10px]">
                        <p class="font-montserrat font-bold text-[30px] lg:text-[36px] text-noir leading-[38px] lg:leading-[44px] mb-0"><?php echo esc_html(get_option('my_theme_hp_contact_heading_1', 'Get Your Free')); ?></p>
                        <p class="font-montserrat font-bold text-[32px] text-noir leading-[40px] sm:text-[40px] sm:leading-[48px] lg:text-[56px] lg:leading-[75px] mb-0"><?php echo esc_html(get_option('my_theme_hp_contact_heading_2', 'Consultation')); ?></p>
                    </div>
                    <div class="w-[80px] h-[4px] bg-[#ff5c00] mb-[27px]"></div>
                    <p class="font-montserrat font-medium text-[16px] text-noir leading-[24px] mb-10 max-w-[417px]">
                        <?php echo esc_html(get_option('my_theme_hp_contact_intro', 'Lifetime warranty, 30-minute installation, minimal downtime. Find out how Goliath can reduce your racking repair costs.')); ?>
                    </p>

                    <div class="flex flex-col gap-[24px] mb-10">
                        <?php
                        $contact_items = [
                            [
                                'label' => 'Phone',
                                'value' => my_theme_contact_phone_display(),
                                'href'  => my_theme_contact_phone_href(),
                            ],
                            [
                                'label' => 'Email',
                                'value' => my_theme_contact_email(),
                                'href'  => my_theme_contact_mailto_href(),
                            ],
                            [
                                'label' => 'Location',
                                'value' => get_option('my_theme_hp_contact_location_label', 'Serving UK &amp; EU'),
                                'href'  => '',
                            ],
                        ];
                        foreach ($contact_items as $item) : ?>
                            <div class="flex items-center gap-[16px]">
                                <div class="w-[56px] h-[56px] bg-noir flex items-center justify-center shrink-0">
                                    <?php
                                    $contact_icon_map = [
                                        'Phone' => 'contact-phone-icon.svg',
                                        'Email' => 'contact-email-icon.svg',
                                        'Location' => 'contact-location-icon.svg',
                                    ];
                                    $icon_file = $contact_icon_map[$item['label']] ?? '';
                                    ?>
                                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/' . $icon_file)); ?>" alt="" class="h-7 w-7 object-contain" aria-hidden="true">
                                </div>
                                <div>
                                    <p class="font-roboto text-[14px] text-[#666] uppercase tracking-[0.35px] leading-[20px] mb-[4px]"><?php echo esc_html($item['label']); ?></p>
                                    <?php if (! empty($item['href'])) : ?>
                                        <p class="mb-0 font-roboto text-[18px] font-semibold leading-[28px] text-noir">
                                            <a class="text-noir underline-offset-2 hover:underline" href="<?php echo esc_url($item['href']); ?>"><?php echo esc_html($item['value']); ?></a>
                                        </p>
                                    <?php else : ?>
                                        <p class="font-roboto font-semibold text-[18px] text-noir leading-[28px] mb-0"><?php echo esc_html($item['value']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="pt-8 px-3 sm:px-6 lg:px-8">
                        <h3 class="font-montserrat font-bold text-[18px] text-noir leading-[27px] mb-4">Why Request an Assessment?</h3>
                        <ul class="flex flex-col gap-[12px]">
                            <?php
                            $reasons = ['Free, no-obligation evaluation', 'Response within 1 working day', 'Transparent, honest pricing', 'Expert safety advice'];
                            foreach ($reasons as $reason) : ?>
                                <li class="font-roboto text-[16px] text-[#1a1a1a] leading-[24px]"><?php echo esc_html($reason); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Form: flex-1 -->
                <div class="flex-1 bg-white">
                    <?php $form_status = isset($_GET['form_status']) ? sanitize_key(wp_unslash((string) $_GET['form_status'])) : ''; ?>
                    <?php $form_error = isset($_GET['form_error']) ? sanitize_key(wp_unslash((string) $_GET['form_error'])) : ''; ?>
                    <?php if ($form_status === 'success') : ?>
                        <p class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 font-roboto text-[14px] text-green-800">Thanks, your request has been submitted successfully.</p>
                    <?php elseif ($form_status === 'error') : ?>
                        <p class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 font-roboto text-[14px] text-red-700"><?php echo esc_html(my_theme_get_protection_error_message($form_error)); ?></p>
                    <?php endif; ?>
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="pt-[8px]">
                        <input type="hidden" name="action" value="my_theme_contact_form">
                        <?php wp_nonce_field('my_theme_contact_form_submit', 'my_theme_contact_nonce'); ?>
                        <?php my_theme_render_time_trap(); ?>
                        <div class="hidden" aria-hidden="true">
                            <label>Leave this field blank
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </label>
                        </div>
                        <div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
                            <label>Fax
                                <input type="text" name="fax_number" tabindex="-1" autocomplete="off" value="">
                            </label>
                        </div>
                        <div class="flex flex-col md:flex-row gap-4 lg:gap-[24px] mb-[24px]">
                            <div class="flex-1">
                                <label for="hp-name" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Your Name *</label>
                                <input type="text" id="hp-name" name="name" autocomplete="name" placeholder="John Smith" required
                                       class="w-full border-b-2 border-black/8 h-[58px] p-[16px] text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors">
                            </div>
                            <div class="flex-1">
                                <label for="hp-company" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Company Name *</label>
                                <input type="text" id="hp-company" name="company" autocomplete="organization" placeholder="Your Company Ltd" required
                                       class="w-full border-b-2 border-black/8 h-[58px] p-[16px] text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors">
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-4 lg:gap-[24px] mb-[24px]">
                            <div class="flex-1">
                                <label for="hp-email" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Email Address *</label>
                                <input type="email" id="hp-email" name="email" autocomplete="email" placeholder="john@company.co.uk" required
                                       class="w-full border-b-2 border-black/8 h-[58px] p-[16px] text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors">
                            </div>
                            <div class="flex-1">
                                <label for="hp-phone" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Phone Number</label>
                                <input type="tel" id="hp-phone" name="phone" autocomplete="tel" placeholder="07XXX XXXXXX"
                                       class="w-full border-b-2 border-black/8 h-[58px] p-[16px] text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors">
                            </div>
                        </div>
                        <div class="mb-[24px]">
                            <label for="hp-uprights" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Number of Damaged Uprights</label>
                            <div class="border-b-2 border-black/8 h-[55px]">
                                <select id="hp-uprights" name="uprights"
                                        class="w-full h-full bg-white text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors appearance-none px-[16px]">
                                    <option value="">Select range</option>
                                    <option value="1-10">1-10</option>
                                    <option value="11-25">11-25</option>
                                    <option value="26-50">26-50</option>
                                    <option value="50+">50+</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-[32px]">
                            <label for="hp-message" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Additional Information</label>
                            <textarea id="hp-message" name="message" rows="5" placeholder="Tell us about your requirements..."
                                      class="w-full border-2 border-black/8 h-[156px] p-[16px] text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors resize-none"></textarea>
                        </div>
                        <?php my_theme_render_turnstile_widget(); ?>
                        <button type="submit"
                                class="w-full bg-[#ff5c00] text-white h-[68px] font-roboto font-semibold text-[18px] text-center hover:bg-orange-light transition-colors">
                            <?php echo esc_html(get_option('my_theme_hp_contact_submit_text', 'Request Free Assessment')); ?>
                        </button>
                        <p class="text-center font-roboto text-[16px] text-[#020202] mt-4"><?php echo esc_html(get_option('my_theme_hp_contact_privacy_note', 'Your information is confidential and secure.')); ?></p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>