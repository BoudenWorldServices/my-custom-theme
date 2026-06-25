<?php
/*
Template Name: Videos Page
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
    'arrow'     => get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg'),
    'cta_arrow' => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];

$installation_videos = array_filter(
    my_theme_get_videos_by_section('installation'),
    static function (array $row): bool {
        return my_theme_video_row_is_displayable($row);
    }
);

$safety_videos = array_filter(
    my_theme_get_videos_by_section('safety'),
    static function (array $row): bool {
        return my_theme_video_row_is_displayable($row);
    }
);
?>

<main class="w-full bg-white overflow-x-hidden">
    <!-- Hero -->
    <section
        class="relative w-full h-auto lg:h-[400px] hero-gradient-bg"
    >
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-4 lg:h-[223px] lg:justify-between lg:gap-0">
                <p class="font-montserrat text-[16px] font-medium leading-[24px] tracking-[0.07px] text-[#ff5c00]"><?php echo esc_html(get_option('my_theme_vp_hero_badge', 'Featured Video')); ?></p>
                <h1 class="font-montserrat text-[28px] font-bold leading-[36px] text-white sm:text-[36px] sm:leading-[44px] md:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <?php
                    $vp_h1 = get_option('my_theme_vp_hero_h1', 'Rack Safety & Installation Videos');
                    $vp_h1_parts = explode(' ', $vp_h1, 4);
                    $vp_h1_white = implode(' ', array_slice($vp_h1_parts, 0, 3));
                    $vp_h1_orange = implode(' ', array_slice($vp_h1_parts, 3));
                    ?>
                    <span class="text-white"><?php echo esc_html($vp_h1_white); ?> </span><span class="text-[#ff5c00]"><?php echo esc_html($vp_h1_orange); ?></span>
                </h1>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    <?php echo esc_html(get_option('my_theme_vp_hero_desc', 'Watch Goliath™ in action and learn everything you need to know about warehouse racking safety, compliance, and cost-effective repair solutions.')); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Installation videos -->
    <section class="w-full bg-white">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-5 px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[50px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[44px] text-[#020202] lg:text-[36px] lg:leading-[44px]"><?php echo esc_html(get_option('my_theme_vp_install_heading', 'Installation & Product Demos')); ?></h2>
            <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#ff5c00]">
                <p><?php echo esc_html(get_option('my_theme_vp_install_subtitle', 'Watch how Goliath™ is installed and see the product in action')); ?></p>
            </div>

            <?php
            $install_count = count($installation_videos);
            $show_install_arrows = $install_count > 3;
            ?>
            <div class="videos-carousel relative mt-1" data-carousel="page-install">
                <?php if ($show_install_arrows) : ?>
                    <button
                        type="button"
                        class="videos-carousel__arrow videos-carousel__arrow--prev absolute -left-3 top-[90px] z-10 flex h-10 w-10 items-center justify-center rounded-full bg-[#364153] text-white shadow-md transition-colors hover:bg-[#ff5c00] disabled:cursor-not-allowed disabled:opacity-30 lg:-left-5"
                        data-carousel-prev="page-install"
                        aria-label="Previous videos"
                        disabled
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </button>
                <?php endif; ?>

                <div class="overflow-hidden">
                    <div class="videos-carousel__track flex transition-transform duration-300 ease-in-out" data-carousel-track="page-install">
                        <?php foreach ($installation_videos as $slug => $row) : ?>
                            <?php my_theme_render_video_carousel_card($slug, $row); ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ($show_install_arrows) : ?>
                    <button
                        type="button"
                        class="videos-carousel__arrow videos-carousel__arrow--next absolute -right-3 top-[90px] z-10 flex h-10 w-10 items-center justify-center rounded-full bg-[#364153] text-white shadow-md transition-colors hover:bg-[#ff5c00] disabled:cursor-not-allowed disabled:opacity-30 lg:-right-5"
                        data-carousel-next="page-install"
                        aria-label="Next videos"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                <?php endif; ?>

                <?php if ($show_install_arrows) : ?>
                    <div class="mt-4 flex items-center justify-center gap-1.5" data-carousel-dots="page-install"></div>
                <?php endif; ?>
            </div>

            <?php if (! empty($safety_videos)) : ?>
                <?php
                $safety_count = count($safety_videos);
                $show_safety_arrows = $safety_count > 3;
                ?>
                <h2 class="mt-10 font-montserrat text-[32px] font-bold leading-[44px] text-[#020202] lg:text-[36px] lg:leading-[44px]"><?php echo esc_html(get_option('my_theme_vp_safety_heading', 'Safety & Compliance')); ?></h2>
                <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#ff5c00]">
                    <p><?php echo esc_html(get_option('my_theme_vp_safety_subtitle', 'Understanding warehouse racking safety regulations and best practices')); ?></p>
                </div>

                <div class="videos-carousel relative mt-1" data-carousel="page-safety">
                    <?php if ($show_safety_arrows) : ?>
                        <button
                            type="button"
                            class="videos-carousel__arrow videos-carousel__arrow--prev absolute -left-3 top-[90px] z-10 flex h-10 w-10 items-center justify-center rounded-full bg-[#364153] text-white shadow-md transition-colors hover:bg-[#ff5c00] disabled:cursor-not-allowed disabled:opacity-30 lg:-left-5"
                            data-carousel-prev="page-safety"
                            aria-label="Previous videos"
                            disabled
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </button>
                    <?php endif; ?>

                    <div class="overflow-hidden">
                        <div class="videos-carousel__track flex transition-transform duration-300 ease-in-out" data-carousel-track="page-safety">
                            <?php foreach ($safety_videos as $slug => $row) : ?>
                                <?php my_theme_render_video_carousel_card($slug, $row); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if ($show_safety_arrows) : ?>
                        <button
                            type="button"
                            class="videos-carousel__arrow videos-carousel__arrow--next absolute -right-3 top-[90px] z-10 flex h-10 w-10 items-center justify-center rounded-full bg-[#364153] text-white shadow-md transition-colors hover:bg-[#ff5c00] disabled:cursor-not-allowed disabled:opacity-30 lg:-right-5"
                            data-carousel-next="page-safety"
                            aria-label="Next videos"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </button>
                    <?php endif; ?>

                    <?php if ($show_safety_arrows) : ?>
                        <div class="mt-4 flex items-center justify-center gap-1.5" data-carousel-dots="page-safety"></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <script>
    (function() {
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.videos-carousel[data-carousel]').forEach(function(container) {
                var id = container.dataset.carousel;
                var track = container.querySelector('[data-carousel-track="' + id + '"]');
                var prevBtn = container.querySelector('[data-carousel-prev="' + id + '"]');
                var nextBtn = container.querySelector('[data-carousel-next="' + id + '"]');
                var dotsContainer = container.querySelector('[data-carousel-dots="' + id + '"]');

                if (!track) return;

                var slides = track.querySelectorAll('.videos-carousel__slide');
                var totalSlides = slides.length;
                var currentIndex = 0;

                function getSlidesPerView() {
                    if (window.innerWidth >= 1024) return 3;
                    if (window.innerWidth >= 768) return 2;
                    return 1;
                }

                function getMaxIndex() {
                    return Math.max(0, totalSlides - getSlidesPerView());
                }

                function buildDots() {
                    if (!dotsContainer) return;
                    dotsContainer.innerHTML = '';
                    var maxIdx = getMaxIndex();
                    for (var i = 0; i <= maxIdx; i++) {
                        var dot = document.createElement('button');
                        dot.type = 'button';
                        dot.className = 'h-2.5 w-2.5 rounded-full transition-colors ' + (i === currentIndex ? 'bg-[#ff5c00]' : 'bg-[#d1d5db]');
                        dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
                        dot.dataset.dotIndex = i;
                        dot.addEventListener('click', function() {
                            currentIndex = parseInt(this.dataset.dotIndex, 10);
                            update();
                        });
                        dotsContainer.appendChild(dot);
                    }
                }

                function update() {
                    var perView = getSlidesPerView();
                    var maxIdx = getMaxIndex();
                    if (currentIndex > maxIdx) currentIndex = maxIdx;
                    if (currentIndex < 0) currentIndex = 0;

                    var slideWidthPercent = 100 / perView;
                    track.style.transform = 'translateX(-' + (currentIndex * slideWidthPercent) + '%)';

                    if (prevBtn) prevBtn.disabled = currentIndex === 0;
                    if (nextBtn) nextBtn.disabled = currentIndex >= maxIdx;

                    if (dotsContainer) {
                        dotsContainer.querySelectorAll('button').forEach(function(dot, i) {
                            dot.className = 'h-2.5 w-2.5 rounded-full transition-colors ' + (i === currentIndex ? 'bg-[#ff5c00]' : 'bg-[#d1d5db]');
                        });
                    }
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        currentIndex--;
                        update();
                    });
                }
                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        currentIndex++;
                        update();
                    });
                }

                var resizeTimer;
                window.addEventListener('resize', function() {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(function() {
                        buildDots();
                        update();
                    }, 150);
                });

                buildDots();
                update();
            });
        });
    })();
    </script>

    <!-- Supporting copy -->
    <section class="w-full bg-[#fafafa]">
        <div class="mx-auto grid w-full max-w-[1440px] grid-cols-1 gap-10 px-5 py-10 sm:px-6 lg:grid-cols-2 lg:gap-[60px] lg:px-[68px] lg:pt-[80px] lg:pb-[80px]">
            <div class="flex flex-col gap-6">
                <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                    <?php
                    $vp_left_h2 = get_option('my_theme_vp_copy_left_h2', 'Goliath™ Rack Repair & Safety Videos');
                    $vp_left_parts = explode(' ', $vp_left_h2, 2);
                    ?>
                    <span class="text-[#020202]"><?php echo esc_html($vp_left_parts[0]); ?> </span><span class="text-[#ff5c00]"><?php echo esc_html($vp_left_parts[1] ?? ''); ?></span>
                </h2>
                <div class="space-y-5 font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                    <p><?php echo esc_html(get_option('my_theme_vp_copy_left_p1', 'Pallet racking damage is a constant issue in busy warehouses, but the real problem is how it is managed over time. Goliath™ is designed to break the cycle of repeated damage, costly replacements, and downtime.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_vp_copy_left_p2', 'Our video series shows how Goliath™ repairs and reinforces uprights differently from traditional methods, delivering a permanent solution that improves safety, reduces downtime, and lowers long-term maintenance costs.')); ?></p>
                </div>
            </div>
            <div class="flex flex-col gap-6">
                <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                    <?php
                    $vp_right_h2 = get_option('my_theme_vp_copy_right_h2', 'Learn How Goliath™ Breaks the Repair Cycle');
                    $vp_right_parts = explode(' ', $vp_right_h2, 4);
                    $vp_right_white = implode(' ', array_slice($vp_right_parts, 0, 3));
                    $vp_right_orange = implode(' ', array_slice($vp_right_parts, 3));
                    ?>
                    <span class="text-[#020202]"><?php echo esc_html($vp_right_white); ?> </span><span class="text-[#ff5c00]"><?php echo esc_html($vp_right_orange); ?></span>
                </h2>
                <div class="space-y-5 font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                    <p><?php echo esc_html(get_option('my_theme_vp_copy_right_p1', 'Traditional pallet racking repair replaces damaged uprights after impact, restoring the rack but not preventing future damage.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_vp_copy_right_p2', 'The Goliath™ video series shows how our high-strength steel repair system reinforces the impact zone, turning repeated repairs into a permanent structural upgrade.')); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Black CTA bar -->
    <section class="w-full bg-[#020202]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-6 sm:px-6 lg:px-[38px]">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <p class="font-roboto text-[18px] font-bold leading-[28px] text-white"><?php echo esc_html(get_option('my_theme_vp_black_cta_text', 'Ready to see Goliath™ in your warehouse?')); ?></p>
                <div class="flex flex-col gap-3 sm:flex-row sm:gap-[16px]">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[52px] items-center border border-white px-[20px] font-roboto text-[16px] font-semibold leading-[24px] text-white hover:bg-white/10">
                        <span><?php echo esc_html(get_option('my_theme_vp_black_cta_btn1', 'Book a free on-site demonstration')); ?></span>
                        <img src="<?php echo esc_url($assets['arrow']); ?>" alt="" class="ml-3 size-5 shrink-0" width="20" height="20" aria-hidden="true">
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[52px] items-center bg-[#ff5c00] px-[24px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#e55200]">
                        <span><?php echo esc_html(get_option('my_theme_vp_black_cta_btn2', 'Schedule live demo')); ?></span>
                        <img src="<?php echo esc_url($assets['arrow']); ?>" alt="" class="ml-3 size-5 shrink-0" width="20" height="20" aria-hidden="true">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Orange CTA -->
    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-8 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[42px] lg:leading-[52px]">
                <?php echo esc_html(get_option('my_theme_vp_orange_h2', 'Ready to see Goliath™ in your warehouse?')); ?>
            </h2>
            <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-white">
                <?php echo esc_html(get_option('my_theme_vp_orange_desc', 'Book a free on-site demonstration and see first-hand how Goliath™ can improve your racking maintenance.')); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[60px] items-center bg-[#020202] px-[32px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a]">
                <span><?php echo esc_html(get_option('my_theme_vp_orange_btn', 'Schedule live demo')); ?></span>
                <img src="<?php echo esc_url($assets['cta_arrow']); ?>" alt="" class="ml-3 size-5 shrink-0" width="20" height="20" aria-hidden="true">
            </a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
