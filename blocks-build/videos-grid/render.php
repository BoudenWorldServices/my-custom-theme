<?php
/**
 * Block render: goliath/videos-grid
 *
 * Shows ALL videos from the library in each section using a carousel
 * with prev/next arrows when there are more than 3 videos.
 *
 * @var array $attributes Block attributes.
 */

$install_heading  = $attributes['installHeading']  ?? 'Installation & Product Demos';
$install_subtitle = $attributes['installSubtitle'] ?? 'Watch how Goliath™ is installed and see the product in action';
$safety_heading   = $attributes['safetyHeading']   ?? 'Safety & Compliance';
$safety_subtitle  = $attributes['safetySubtitle']  ?? 'Understanding warehouse racking safety regulations and best practices';

$installation_videos = [];
$safety_videos = [];

if (function_exists('my_theme_get_videos_by_section') && function_exists('my_theme_video_file_is_readable')) {
    $installation_videos = array_filter(
        my_theme_get_videos_by_section('installation'),
        static function (array $row): bool {
            return my_theme_video_file_is_readable($row['file']);
        }
    );
    $safety_videos = array_filter(
        my_theme_get_videos_by_section('safety'),
        static function (array $row): bool {
            return my_theme_video_file_is_readable($row['file']);
        }
    );
}

$carousel_id = 'videos-carousel-' . wp_unique_id();
?>

<section class="w-full bg-white">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-5 px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[50px]">
        <h2 class="font-montserrat text-[32px] font-bold leading-[44px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
            <?php echo esc_html($install_heading); ?>
        </h2>
        <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#ff5c00]">
            <p><?php echo esc_html($install_subtitle); ?></p>
        </div>

        <?php if (! empty($installation_videos)) : ?>
            <?php
            $install_id    = $carousel_id . '-install';
            $install_count = count($installation_videos);
            $show_arrows   = $install_count > 3;
            ?>
            <div class="videos-carousel relative mt-1" data-carousel="<?php echo esc_attr($install_id); ?>">
                <?php if ($show_arrows) : ?>
                    <button
                        type="button"
                        class="videos-carousel__arrow videos-carousel__arrow--prev absolute -left-3 top-[90px] z-10 flex h-10 w-10 items-center justify-center rounded-full bg-[#364153] text-white shadow-md transition-colors hover:bg-[#ff5c00] disabled:cursor-not-allowed disabled:opacity-30 lg:-left-5"
                        data-carousel-prev="<?php echo esc_attr($install_id); ?>"
                        aria-label="Previous videos"
                        disabled
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </button>
                <?php endif; ?>

                <div class="overflow-hidden">
                    <div class="videos-carousel__track flex transition-transform duration-300 ease-in-out" data-carousel-track="<?php echo esc_attr($install_id); ?>">
                        <?php foreach ($installation_videos as $slug => $row) : ?>
                            <a href="<?php echo esc_url(home_url('/videos/' . $slug . '/')); ?>" class="videos-carousel__slide group w-full flex-shrink-0 border-t border-[#faf5ff] px-[13px] py-[10px] md:w-1/2 lg:w-1/3">
                                <div class="relative flex h-[206px] w-full overflow-hidden bg-black">
                                    <?php if (function_exists('my_theme_video_thumbnail_is_readable') && my_theme_video_thumbnail_is_readable($row['file'])) : ?>
                                        <img
                                            src="<?php echo esc_url(my_theme_get_video_thumbnail_uri($row['file'])); ?>"
                                            alt="<?php echo esc_attr($row['title']); ?>"
                                            class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                                            loading="lazy"
                                            decoding="async"
                                            width="640"
                                            height="360"
                                        >
                                    <?php else : ?>
                                        <video
                                            class="h-full w-full object-cover opacity-90 transition-opacity group-hover:opacity-100"
                                            src="<?php echo esc_url(my_theme_get_video_file_uri($row['file'])); ?>"
                                            muted
                                            playsinline
                                            preload="metadata"
                                            aria-hidden="true"
                                        ></video>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-[10px]">
                                    <p class="font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]"><?php echo esc_html($row['title']); ?></p>
                                    <p class="mt-1 font-montserrat text-[12px] font-medium leading-[23px] text-[#364153]"><?php echo esc_html($row['excerpt']); ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ($show_arrows) : ?>
                    <button
                        type="button"
                        class="videos-carousel__arrow videos-carousel__arrow--next absolute -right-3 top-[90px] z-10 flex h-10 w-10 items-center justify-center rounded-full bg-[#364153] text-white shadow-md transition-colors hover:bg-[#ff5c00] disabled:cursor-not-allowed disabled:opacity-30 lg:-right-5"
                        data-carousel-next="<?php echo esc_attr($install_id); ?>"
                        aria-label="Next videos"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                <?php endif; ?>

                <?php if ($show_arrows) : ?>
                    <div class="mt-4 flex items-center justify-center gap-1.5" data-carousel-dots="<?php echo esc_attr($install_id); ?>"></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (! empty($safety_videos)) : ?>
            <?php
            $safety_id    = $carousel_id . '-safety';
            $safety_count = count($safety_videos);
            $show_safety_arrows = $safety_count > 3;
            ?>
            <h2 class="mt-10 font-montserrat text-[32px] font-bold leading-[44px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
                <?php echo esc_html($safety_heading); ?>
            </h2>
            <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#ff5c00]">
                <p><?php echo esc_html($safety_subtitle); ?></p>
            </div>

            <div class="videos-carousel relative mt-1" data-carousel="<?php echo esc_attr($safety_id); ?>">
                <?php if ($show_safety_arrows) : ?>
                    <button
                        type="button"
                        class="videos-carousel__arrow videos-carousel__arrow--prev absolute -left-3 top-[90px] z-10 flex h-10 w-10 items-center justify-center rounded-full bg-[#364153] text-white shadow-md transition-colors hover:bg-[#ff5c00] disabled:cursor-not-allowed disabled:opacity-30 lg:-left-5"
                        data-carousel-prev="<?php echo esc_attr($safety_id); ?>"
                        aria-label="Previous videos"
                        disabled
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </button>
                <?php endif; ?>

                <div class="overflow-hidden">
                    <div class="videos-carousel__track flex transition-transform duration-300 ease-in-out" data-carousel-track="<?php echo esc_attr($safety_id); ?>">
                        <?php foreach ($safety_videos as $slug => $row) : ?>
                            <a href="<?php echo esc_url(home_url('/videos/' . $slug . '/')); ?>" class="videos-carousel__slide group w-full flex-shrink-0 border-t border-[#faf5ff] px-[13px] py-[10px] md:w-1/2 lg:w-1/3">
                                <div class="relative flex h-[206px] w-full overflow-hidden bg-black">
                                    <?php if (function_exists('my_theme_video_thumbnail_is_readable') && my_theme_video_thumbnail_is_readable($row['file'])) : ?>
                                        <img
                                            src="<?php echo esc_url(my_theme_get_video_thumbnail_uri($row['file'])); ?>"
                                            alt="<?php echo esc_attr($row['title']); ?>"
                                            class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                                            loading="lazy"
                                            decoding="async"
                                            width="640"
                                            height="360"
                                        >
                                    <?php else : ?>
                                        <video
                                            class="h-full w-full object-cover opacity-90 transition-opacity group-hover:opacity-100"
                                            src="<?php echo esc_url(my_theme_get_video_file_uri($row['file'])); ?>"
                                            muted
                                            playsinline
                                            preload="metadata"
                                            aria-hidden="true"
                                        ></video>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-[10px]">
                                    <p class="font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]"><?php echo esc_html($row['title']); ?></p>
                                    <p class="mt-1 font-montserrat text-[12px] font-medium leading-[23px] text-[#364153]"><?php echo esc_html($row['excerpt']); ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ($show_safety_arrows) : ?>
                    <button
                        type="button"
                        class="videos-carousel__arrow videos-carousel__arrow--next absolute -right-3 top-[90px] z-10 flex h-10 w-10 items-center justify-center rounded-full bg-[#364153] text-white shadow-md transition-colors hover:bg-[#ff5c00] disabled:cursor-not-allowed disabled:opacity-30 lg:-right-5"
                        data-carousel-next="<?php echo esc_attr($safety_id); ?>"
                        aria-label="Next videos"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                <?php endif; ?>

                <?php if ($show_safety_arrows) : ?>
                    <div class="mt-4 flex items-center justify-center gap-1.5" data-carousel-dots="<?php echo esc_attr($safety_id); ?>"></div>
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
