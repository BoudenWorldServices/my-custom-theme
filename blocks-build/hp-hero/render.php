<?php
/**
 * Block render: goliath/hp-hero
 *
 * @var array $attributes Block attributes.
 */

$company_name       = $attributes['companyName']      ?? 'Goliath Pallet Racking Repair Ltd';
$heading            = $attributes['heading']           ?? 'Safe, Instant Repair for Damaged Uprights';
$tagline1           = $attributes['tagline1']          ?? 'Minimal Downtime, Maximum Safety';
$tagline2           = $attributes['tagline2']          ?? 'Lifetime Warranty';
$cta_text           = $attributes['ctaText']           ?? 'Get Your Free Assessment';
$cta_url            = $attributes['ctaUrl']            ?? '/contact/';
$secondary_cta_text = $attributes['secondaryCtaText']  ?? 'View more';
$secondary_cta_url  = $attributes['secondaryCtaUrl']   ?? '#solution';

$slide1 = $attributes['slide1'] ?: my_theme_get_image_url('my_theme_hp_hero_slide1', get_theme_file_uri('assets/images/Homepage/carousel-image1.webp'));
$slide2 = $attributes['slide2'] ?: my_theme_get_image_url('my_theme_hp_hero_slide2', get_theme_file_uri('assets/images/Homepage/carousel-image2.webp'));
$slide3 = $attributes['slide3'] ?: my_theme_get_image_url('my_theme_hp_hero_slide3', get_theme_file_uri('assets/images/Homepage/not-just-dent.webp'));

$slide1_alt = $attributes['slide1Alt'] ?? 'Goliath racking repair in a warehouse';
$slide2_alt = $attributes['slide2Alt'] ?? 'Goliath installation on pallet racking';
$slide3_alt = $attributes['slide3Alt'] ?? 'Damaged racking upright showing dent impact';

$hero_assets = [
    'arrow_dark'  => get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg'),
    'arrow_light' => get_theme_file_uri('assets/images/icons/arrow-right-white.svg'),
    'cta_arrow'   => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];

$hero_carousel_image_slides = [
    ['kind' => 'image', 'src' => $slide1, 'alt' => $slide1_alt],
    ['kind' => 'image', 'src' => $slide2, 'alt' => $slide2_alt],
    ['kind' => 'image', 'src' => $slide3, 'alt' => $slide3_alt],
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
    $attr_key = 'video' . ($vi + 1);
    $video_url = !empty($attributes[$attr_key]) ? $attributes[$attr_key] : '';
    if ($video_url === '') {
        $video_url = get_option('my_theme_hp_hero_video' . ($vi + 1), '');
    }
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

$stat1_label = $attributes['stat1Label'] ?? 'Installation';
$stat1_value = $attributes['stat1Value'] ?? '30 Minutes';
$stat2_label = $attributes['stat2Label'] ?? 'Warranty';
$stat2_value = $attributes['stat2Value'] ?? 'Lifetime';
$stat3_label = $attributes['stat3Label'] ?? 'UK Compliance';
$stat3_value = $attributes['stat3Value'] ?? '100%';

$hero_stats = [
    ['label' => $stat1_label, 'value' => $stat1_value, 'label_size' => 'text-[11px]'],
    ['label' => $stat2_label, 'value' => $stat2_value, 'label_size' => 'text-[12px]'],
    ['label' => $stat3_label, 'value' => $stat3_value, 'label_size' => 'text-[11px]'],
];
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

<section id="hero" class="relative left-1/2 right-1/2 w-[100dvw] max-w-[100dvw] -ml-[50dvw] -mr-[50dvw] overflow-hidden bg-white">
    <div class="flex w-full flex-col lg:flex-row lg:items-stretch">
        <div class="relative flex w-full shrink-0 flex-col bg-[#ff5c00] px-6 pb-10 pt-20 sm:px-8 sm:pb-12 sm:pt-24 lg:w-[500px] lg:h-[720px] lg:px-[60px] lg:pb-[80px] lg:pt-[120px]">
            <div class="flex min-h-0 flex-1 flex-col gap-8 sm:gap-10">
                <div class="w-full max-w-[418px]">
                    <p class="font-montserrat font-medium text-[16px] uppercase leading-[22px] tracking-[0.0703px] text-[#020202]">
                        <?php echo esc_html($company_name); ?>
                    </p>
                    <h1 class="mt-3 font-montserrat font-bold text-[36px] leading-[44px] text-white normal-case sm:mt-4">
                        <?php echo esc_html($heading); ?>
                    </h1>
                </div>

                <div class="flex flex-wrap gap-[10px]">
                    <?php foreach ($hero_stats as $stat) : ?>
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
                    <p class="font-montserrat text-[16px] leading-[22px] tracking-[0.0703px] text-[#020202]"><?php echo esc_html($tagline1); ?></p>
                    <p class="font-montserrat text-[16px] font-semibold leading-[22px] tracking-[0.0703px] text-[#020202]"><?php echo esc_html($tagline2); ?></p>
                </div>
            </div>

            <div class="mt-10 flex flex-col gap-3 sm:mt-12 sm:flex-row sm:flex-wrap lg:mt-auto lg:pt-4">
                <a href="<?php echo esc_url(home_url($cta_url)); ?>"
                   class="hero-cta-hover inline-flex h-[52px] w-full items-center justify-center gap-2 bg-[#020202] px-5 font-roboto text-[12px] font-bold uppercase tracking-[0.35px] text-white sm:w-[247px]">
                    <span><?php echo esc_html($cta_text); ?></span>
                    <img src="<?php echo esc_url($hero_assets['cta_arrow']); ?>" alt="" class="size-5" aria-hidden="true">
                </a>
                <a href="<?php echo esc_url($secondary_cta_url); ?>"
                   class="hero-cta-hover inline-flex h-[52px] w-full items-center justify-center border border-white px-5 font-roboto text-[12px] font-bold uppercase tracking-[0.35px] text-white sm:w-[119px] sm:shrink-0">
                    <?php echo esc_html($secondary_cta_text); ?>
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
