<?php
/*
Template Name: Video Detail Page
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

<?php
$slug = isset($GLOBALS['my_theme_video_detail_slug']) ? (string) $GLOBALS['my_theme_video_detail_slug'] : '';
if ($slug === '' && isset($_SERVER['REQUEST_URI'])) {
    $req_path = trim((string) parse_url(wp_unslash($_SERVER['REQUEST_URI']), PHP_URL_PATH), '/');
    if (preg_match('#^videos/([^/]+)$#', $req_path, $m)) {
        $slug = $m[1];
    } elseif (preg_match('#^video/([^/]+)$#', $req_path, $m)) {
        $slug = $m[1];
    }
}

$library = my_theme_get_video_library();
$video   = $library[ $slug ] ?? null;

if ($video === null || ! my_theme_video_file_is_readable($video['file'])) {
    wp_safe_redirect(home_url('/videos/'));
    exit;
}

$video_src = my_theme_get_video_file_uri($video['file']);
$related = my_theme_get_videos_hub_related($slug);

$video_poster = '';
if (function_exists('my_theme_video_thumbnail_is_readable') && my_theme_video_thumbnail_is_readable($video['file'])) {
    $video_poster = my_theme_get_video_thumbnail_uri($video['file']);
}

$assets = [
    'arrow'      => get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg'),
    'cta_arrow' => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
    'check_icon' => get_theme_file_uri('assets/images/icons/Icon-1.svg'),
];

$hero_title_raw = trim((string) ($video['title'] ?? 'Installation Video'));
$hero_parts     = preg_split('/\s+/', $hero_title_raw, 2);
$hero_orange    = $hero_parts[0] ?? $hero_title_raw;
$hero_white     = $hero_parts[1] ?? '';

$related_count = count($related);
$related_grid  = $related_count >= 3
    ? 'md:grid-cols-2 lg:grid-cols-3'
    : 'md:grid-cols-2 lg:grid-cols-2 lg:max-w-[900px] lg:mx-auto';
?>

<main class="w-full bg-white overflow-x-hidden">
    <!-- Hero -->
    <section
        class="relative w-full h-auto lg:min-h-[400px] hero-gradient-bg"
    >
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-4 lg:min-h-[223px] lg:justify-between lg:gap-0">
                <p class="font-montserrat text-[16px] font-medium leading-[24px] tracking-[0.07px] text-[#ff5c00]">Featured Video</p>
                <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <span class="text-[#ff5c00]"><?php echo esc_html($hero_orange); ?></span><?php if ($hero_white !== '') : ?> <span class="text-white"><?php echo esc_html($hero_white); ?></span><?php endif; ?>
                </h1>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    Watch Goliath in action and learn everything you need to know about warehouse racking safety, compliance, and cost-effective repair solutions.
                </p>
            </div>
        </div>
    </section>

    <!-- Main video block -->
    <section class="w-full bg-white">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:gap-[60px] lg:px-[68px] lg:pt-[80px] lg:pb-[70px]">
            <div class="w-full lg:flex-1">
                <video
                    id="video-player"
                    class="aspect-video w-full bg-black object-contain lg:h-[368px]"
                    src="<?php echo esc_url($video_src); ?>"
                    controls
                    playsinline
                    muted
                    autoplay
                    preload="auto"
                    <?php if ($video_poster !== '') : ?>
                    poster="<?php echo esc_url($video_poster); ?>"
                    <?php endif; ?>
                ></video>
                <script>
                    (function () {
                        var v = document.getElementById('video-player');
                        if (!v) return;
                        function tryPlay() {
                            v.muted = true;
                            var p = v.play();
                            if (p && typeof p.catch === 'function') {
                                p.catch(function () {});
                            }
                        }
                        if (v.readyState >= 2) {
                            tryPlay();
                        } else {
                            v.addEventListener('canplay', tryPlay, { once: true });
                        }
                    })();
                </script>
            </div>
            <div class="w-full lg:flex-1">
                <h2 class="font-montserrat text-[28px] font-bold leading-[36px] text-[#ff5c00] sm:text-[34px] sm:leading-[44px] lg:text-[42px] lg:leading-[52px]">
                    <?php echo esc_html($video['title']); ?>
                </h2>
                <p class="mt-4 font-montserrat text-[16px] font-normal leading-[26px] text-[#666]">
                    <?php echo esc_html($video['excerpt']); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Related videos (same three as /videos/, excluding current) -->
    <section class="w-full bg-[#fafafa]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[60px] lg:pb-[60px]">
            <?php if (! empty($related)) : ?>
            <div class="grid grid-cols-1 gap-[26px] <?php echo esc_attr($related_grid); ?>">
                <?php foreach ($related as $card) : ?>
                    <?php
                    $rel_slug = $card['slug'];
                    $rel_file = $card['file'];
                    ?>
                    <a href="<?php echo esc_url(home_url('/videos/' . $rel_slug . '/')); ?>" class="group border-t border-[#faf5ff] py-[10px]">
                        <div class="relative flex h-[206px] w-full overflow-hidden bg-black">
                            <?php if (function_exists('my_theme_video_thumbnail_is_readable') && my_theme_video_thumbnail_is_readable($rel_file)) : ?>
                                <img
                                    src="<?php echo esc_url(my_theme_get_video_thumbnail_uri($rel_file)); ?>"
                                    alt="<?php echo esc_attr($card['title']); ?>"
                                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                                    loading="lazy"
                                    decoding="async"
                                    width="640"
                                    height="360"
                                >
                            <?php else : ?>
                                <video
                                    class="h-full w-full object-cover opacity-90 transition-opacity group-hover:opacity-100"
                                    src="<?php echo esc_url(my_theme_get_video_file_uri($rel_file)); ?>"
                                    muted
                                    playsinline
                                    preload="metadata"
                                    aria-hidden="true"
                                ></video>
                            <?php endif; ?>
                        </div>
                        <div class="mt-[10px]">
                            <p class="font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]"><?php echo esc_html($card['title']); ?></p>
                            <p class="font-montserrat text-[12px] font-medium leading-[23px] text-[#364153]"><?php echo esc_html($card['excerpt']); ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Supporting text -->
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[80px]">
            <div class="max-w-[1211px]">
                <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                    <span class="text-[#020202]">What the Goliath™ </span><span class="text-[#ff5c00]">Video Series Covers</span>
                </h2>
                <p class="mt-4 font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                    The Goliath™ videos provide clear, practical insight into:
                </p>
                <ul class="mt-4 space-y-3">
                    <?php
                    $coverage_points = [
                        'Why repeated upright replacement leads to ongoing costs and disruption',
                        'How Goliath™ differs from standard pallet racking repair',
                        'The installation process in live warehouse environments',
                        'How damaged uprights are cut, reinforced, and fixed on site',
                        'How Goliath™ supports safety, compliance, and long-term cost control',
                    ];
                    foreach ($coverage_points as $point) :
                    ?>
                        <li class="flex items-start gap-3">
                            <img src="<?php echo esc_url($assets['check_icon']); ?>" alt="" class="mt-1 size-5 shrink-0" width="20" height="20" aria-hidden="true">
                            <span class="font-montserrat text-[18px] font-normal leading-[28px] text-[#666]"><?php echo esc_html($point); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="mt-5 font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                    Each video is designed to be easy to understand and relevant to real-world warehouse operations.
                </p>
            </div>
        </div>
    </section>

    <!-- Orange CTA -->
    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-8 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[42px] lg:leading-[52px]">
                Ready to See Goliath in Your Warehouse?
            </h2>
            <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-white">
                Book a free on-site demonstration and see first-hand how Goliath™ can improve your racking maintenance.
            </p>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex h-[60px] w-full max-w-[320px] items-center justify-center bg-[#020202] px-[32px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a] sm:w-auto sm:max-w-none">
                <span>Schedule Live Demo</span>
                <img src="<?php echo esc_url($assets['cta_arrow']); ?>" alt="" class="ml-3 size-5" width="20" height="20" aria-hidden="true">
            </a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
