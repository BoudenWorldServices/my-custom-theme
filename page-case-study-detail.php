<?php
/*
Template Name: Case Study Detail Page
*/

$slug    = $GLOBALS['my_theme_case_study_slug'] ?? '';
$library = my_theme_get_case_study_library();
$cs      = $library[$slug] ?? null;

if ($cs === null) {
    status_header(404);
    get_header();
    echo '<main class="w-full bg-white py-24 text-center"><p class="font-montserrat text-[18px] text-[#666]">Case study not found.</p></main>';
    get_footer();
    return;
}

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
    'section_arrow'     => get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg'),
    'icon_circle_check' => get_theme_file_uri('assets/images/icons/Icon-1.svg'),
    'icon_trend_down'   => get_theme_file_uri('assets/images/icons/Icon-3.svg'),
    'warranty_icon'     => get_theme_file_uri('assets/images/icons/case-study-banner-check.svg'),
    'cta_arrow'         => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];

$client  = $cs['client'] ?? '';
$title   = $cs['title'] ?? '';

/* ------------------------------------------------------------------
   Images
------------------------------------------------------------------ */
$listing_image  = my_theme_resolve_case_study_image(
    $cs['image'] ?? '',
    get_theme_file_uri('assets/images/caseStudy/B&M.webp')
);
$results_image  = my_theme_resolve_case_study_image(
    $cs['results_image'] ?? '',
    $listing_image
);

/* ------------------------------------------------------------------
   Video
------------------------------------------------------------------ */
$video_value     = $cs['video'] ?? '';
$has_video       = $video_value !== '' && my_theme_case_study_video_is_readable($video_value);
$video_uri       = $has_video ? my_theme_resolve_case_study_video($video_value) : '';

/* ------------------------------------------------------------------
   Result cards — only include rows that have a title
------------------------------------------------------------------ */
$result_cards = [];
for ($n = 1; $n <= 4; $n++) {
    $card_title = $cs["result{$n}_title"] ?? '';
    $card_text  = $cs["result{$n}_text"] ?? '';
    if ($card_title !== '' || $card_text !== '') {
        $result_cards[] = [
            'icon'  => $n === 1 ? $assets['icon_trend_down'] : $assets['icon_circle_check'],
            'title' => $card_title,
            'text'  => $card_text,
        ];
    }
}

/* ------------------------------------------------------------------
   Section visibility flags — sections only render when they have content
------------------------------------------------------------------ */
$show_problem    = !empty($cs['problem_text']);
$show_tried      = !empty($cs['tried_text']);
$show_solution   = $has_video || !empty($cs['solution_text']) || !empty($cs['solution_callout']);
$show_results    = !empty($cs['results_intro']) || !empty($result_cards) || !empty($cs['warranty_text']);
$show_testimonial = !empty($cs['testimonial_quote']);
?>

<main class="w-full bg-white overflow-x-hidden">

    <!-- Hero -->
    <section class="relative w-full h-auto lg:h-[400px] hero-gradient-bg">
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-5 lg:h-[223px] lg:gap-5">
                <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <span class="text-white">Case Study: </span>
                    <span class="text-[#ff5c00]"><?php echo esc_html($client); ?></span>
                </h1>
                <?php if (!empty($cs['hero_intro'])) : ?>
                    <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                        <?php echo esc_html($cs['hero_intro']); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Problem + What They Tried -->
    <?php if ($show_problem || $show_tried) : ?>
        <section class="w-full bg-white">
            <div class="mx-auto w-full max-w-[1440px] px-5 py-8 sm:px-6 lg:px-[68px] lg:pt-[30px] lg:pb-[40px]">
                <div class="border-b border-[#dedfe0] pb-8 lg:pb-[32px]">
                    <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">
                        <?php echo esc_html($title); ?>
                    </h2>

                    <div class="mt-6 grid grid-cols-1 gap-8 lg:mt-[24px] lg:grid-cols-2 lg:gap-6">
                        <?php if ($show_problem) : ?>
                            <div>
                                <h3 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">The Problem</h3>
                                <?php foreach (array_filter(array_map('trim', explode("\n\n", $cs['problem_text']))) as $para) : ?>
                                    <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                                        <?php echo nl2br(esc_html($para)); ?>
                                    </p>
                                <?php endforeach; ?>
                                <?php if (!empty($cs['problem_callout'])) : ?>
                                    <p class="mt-6 font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]">
                                        <?php echo esc_html($cs['problem_callout']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($show_tried) : ?>
                            <div>
                                <h3 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">What They Tried</h3>
                                <?php foreach (array_filter(array_map('trim', explode("\n\n", $cs['tried_text']))) as $para) : ?>
                                    <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                                        <?php echo nl2br(esc_html($para)); ?>
                                    </p>
                                <?php endforeach; ?>
                                <?php if (!empty($cs['tried_callout'])) : ?>
                                    <p class="mt-6 font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]">
                                        <?php echo esc_html($cs['tried_callout']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Solution -->
    <?php if ($show_solution) : ?>
        <section class="w-full bg-white">
            <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:gap-[30px] lg:px-[68px] lg:pt-[80px] lg:pb-[70px]">
                <?php if ($has_video) : ?>
                    <div class="w-full min-w-0 lg:flex-1">
                        <video
                            class="aspect-video w-full bg-black object-contain"
                            controls
                            playsinline
                            preload="metadata"
                            aria-label="<?php echo esc_attr($client . ' — solution video'); ?>"
                        >
                            <source src="<?php echo esc_url($video_uri); ?>" type="video/mp4">
                        </video>
                    </div>
                <?php endif; ?>
                <div class="w-full <?php echo $has_video ? 'lg:flex-1' : 'max-w-3xl'; ?>">
                    <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">The Solution: Goliath™</h2>
                    <?php if (!empty($cs['solution_text'])) : ?>
                        <?php foreach (array_filter(array_map('trim', explode("\n\n", $cs['solution_text']))) as $para) : ?>
                            <p class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#666]">
                                <?php echo nl2br(esc_html($para)); ?>
                            </p>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($cs['solution_callout'])) : ?>
                        <div class="mt-6 flex flex-col gap-3 bg-[#ff6b2c] px-[24px] py-[18px] sm:flex-row sm:items-center sm:justify-between lg:w-[631px] lg:px-[39px]">
                            <p class="font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white">
                                <?php echo nl2br(esc_html($cs['solution_callout'])); ?>
                            </p>
                            <img src="<?php echo esc_url($assets['section_arrow']); ?>" alt="" class="size-5 shrink-0 sm:ml-4">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Results -->
    <?php if ($show_results) : ?>
        <section class="w-full bg-white">
            <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[60px]">
                <img
                    src="<?php echo esc_url($results_image); ?>"
                    alt="<?php echo esc_attr($client . ' warehouse results'); ?>"
                    class="h-auto w-full object-cover lg:h-[464px]"
                >

                <div class="mt-10 lg:mt-[60px]">
                    <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">The Results</h2>

                    <?php if (!empty($cs['results_intro'])) : ?>
                        <p class="mt-6 max-w-[1024px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                            <?php echo esc_html($cs['results_intro']); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($result_cards)) : ?>
                        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
                            <?php foreach ($result_cards as $card) : ?>
                                <div class="bg-[#f9fafb] px-6 pt-6 pb-6">
                                    <div class="flex items-start gap-4">
                                        <img src="<?php echo esc_url($card['icon']); ?>" alt="" class="size-10 shrink-0 object-contain" width="40" height="40">
                                        <div>
                                            <h4 class="font-montserrat text-[16px] font-bold leading-[24px] text-[#020202]"><?php echo esc_html($card['title']); ?></h4>
                                            <?php if (!empty($card['text'])) : ?>
                                                <p class="mt-2 font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($card['text']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($cs['warranty_text'])) : ?>
                        <div class="mt-6 flex flex-col gap-4 bg-[#020202] px-6 pt-8 pb-8 lg:h-auto lg:flex-row lg:items-start lg:gap-4 lg:px-8">
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
                                <?php foreach (array_filter(array_map('trim', explode("\n\n", $cs['warranty_text']))) as $para) : ?>
                                    <p class="font-roboto text-[18px] font-normal leading-[28px] text-white">
                                        <?php echo nl2br(esc_html($para)); ?>
                                    </p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Testimonial / Final CTA -->
    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-3 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
            <?php if ($show_testimonial) : ?>
                <h2 class="font-montserrat text-[22px] font-bold leading-[32px] text-white lg:text-[24px]">
                    A Word from <?php echo esc_html($client); ?>
                </h2>
                <p class="max-w-[1146px] font-montserrat text-[18px] italic leading-[28px] text-white">
                    <?php echo esc_html($cs['testimonial_quote']); ?>
                </p>
                <?php if (!empty($cs['testimonial_attr'])) : ?>
                    <p class="max-w-[547px] font-roboto text-[16px] font-bold leading-[24px] text-white">
                        — <?php echo esc_html($cs['testimonial_attr']); ?>
                    </p>
                <?php endif; ?>
            <?php else : ?>
                <h2 class="font-montserrat text-[22px] font-bold leading-[32px] text-white lg:text-[24px]">
                    Ready to Get Similar Results?
                </h2>
            <?php endif; ?>
            <a
                href="<?php echo esc_url(home_url('/contact/')); ?>"
                class="mt-3 inline-flex h-[60px] w-full max-w-[320px] items-center justify-center bg-[#020202] px-[32px] font-roboto text-[16px] font-semibold leading-[24px] text-white hover:bg-[#1a1a1a] sm:w-auto sm:max-w-none"
            >
                <span>Get Similar Results</span>
                <img src="<?php echo esc_url($assets['cta_arrow']); ?>" alt="" class="ml-3 size-5">
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
