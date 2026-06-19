<?php
/*
Template Name: Case Studies Page
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
$assets = [
    'arrow'     => get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg'),
    'cta_arrow' => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];

// Query published case-study CPT posts.
$cpt_posts = get_posts([
    'post_type'      => 'case-study',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

// Fallback to legacy library if no CPT posts have been migrated yet.
$use_legacy = empty($cpt_posts);
$legacy_case_studies = $use_legacy ? my_theme_get_case_study_library() : [];
?>

<main class="w-full bg-white overflow-x-hidden">
    <!-- Hero -->
    <section
        class="relative w-full h-auto lg:h-[400px] hero-gradient-bg"
    >
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-5 lg:h-[223px] lg:justify-between lg:gap-0">
                <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <?php
                    $cs_h1 = get_option('my_theme_cs_hero_h1', 'Case Studies');
                    $cs_h1_parts = explode(' ', $cs_h1, 2);
                    ?>
                    <span class="text-white"><?php echo esc_html($cs_h1_parts[0]); ?> </span><span class="text-[#ff5c00]"><?php echo esc_html($cs_h1_parts[1] ?? ''); ?></span>
                </h1>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    <?php
                    $cs_desc = get_option(
                        'my_theme_cs_hero_desc',
                        "Seeing is believing. Our case studies showcase real-world results from warehouses across the UK that have made the switch to Goliath™.\nThese numbers cover everything from reducing racking maintenance costs to eliminating upright damage completely. Browse through to see how teams like yours have solved one of warehousing's most expensive problems, and what this solution has done for their safety record, their bottom line, and their daily operations."
                    );
                    echo nl2br(esc_html($cs_desc));
                    ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Case studies list -->
    <section class="w-full bg-white">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-[10px] px-5 py-6 sm:px-6 lg:px-[68px] lg:pt-[30px] lg:pb-[70px]">
            <?php if (!$use_legacy) : ?>
                <?php foreach ($cpt_posts as $cs_post) : ?>
                    <?php
                    $cs_image   = get_post_meta($cs_post->ID, '_cs_image', true);
                    $thumb_url  = get_the_post_thumbnail_url($cs_post->ID, 'large');
                    $display_image = $thumb_url ?: ($cs_image ?: get_theme_file_uri('assets/images/caseStudy/B&M.webp'));
                    $cs_href    = get_permalink($cs_post->ID);
                    $challenge  = get_post_meta($cs_post->ID, '_cs_challenge', true);
                    $solution   = get_post_meta($cs_post->ID, '_cs_solution', true);
                    $metrics    = [];
                    for ($n = 1; $n <= 3; $n++) {
                        $val = get_post_meta($cs_post->ID, "_cs_metric_{$n}_value", true);
                        $lbl = get_post_meta($cs_post->ID, "_cs_metric_{$n}_label", true);
                        if ($val || $lbl) {
                            $metrics[] = ['value' => $val, 'label' => $lbl];
                        }
                    }
                    ?>
                    <article class="border-b border-[#dedfe0] py-8">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:gap-6">
                            <div class="w-full lg:w-[619px] lg:shrink-0">
                                <img
                                    src="<?php echo esc_url($display_image); ?>"
                                    alt="<?php echo esc_attr($cs_post->post_title); ?>"
                                    class="h-[280px] w-full object-cover lg:h-[575px]"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <div class="w-full lg:w-[594px] lg:pt-1">
                                <h2 class="font-montserrat text-[24px] font-semibold leading-[32px] text-[#020202] lg:text-[20px] lg:leading-[30px]">
                                    <?php echo esc_html($cs_post->post_title); ?>
                                </h2>
                                <?php if ($challenge) : ?>
                                    <div class="mt-6">
                                        <h3 class="font-montserrat text-[18px] font-semibold leading-[27px] text-[#ff5c00]">Challenge</h3>
                                        <p class="mt-2 font-roboto text-[16px] font-normal leading-[24px] text-[#364153]">
                                            <?php echo esc_html($challenge); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <?php if ($solution) : ?>
                                    <div class="mt-6">
                                        <h3 class="font-montserrat text-[18px] font-semibold leading-[27px] text-[#ff5c00]">Solution</h3>
                                        <p class="mt-2 font-roboto text-[16px] font-normal leading-[24px] text-[#364153]">
                                            <?php echo esc_html($solution); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($metrics)) : ?>
                                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-4">
                                        <?php foreach ($metrics as $metric) : ?>
                                            <div class="bg-[#f9fafb] px-4 py-4 text-center">
                                                <p class="font-roboto text-[24px] font-normal leading-[32px] text-[#ff5c00]"><?php echo esc_html($metric['value']); ?></p>
                                                <p class="font-roboto text-[12px] font-normal leading-[16px] text-[#4a5565]"><?php echo esc_html($metric['label']); ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <a
                                    href="<?php echo esc_url($cs_href); ?>"
                                    class="mt-6 inline-flex w-full max-w-[320px] items-center justify-center gap-3 bg-[#020202] px-[38px] py-[18px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a] sm:w-fit sm:max-w-none sm:justify-between sm:gap-0"
                                >
                                    <span>Full Case Study</span>
                                    <img src="<?php echo esc_url($assets['arrow']); ?>" alt="" class="size-5 sm:ml-11">
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ($legacy_case_studies as $slug => $cs) : ?>
                    <?php
                    $cs_image = my_theme_resolve_case_study_image(
                        $cs['image'] ?? '',
                        get_theme_file_uri('assets/images/caseStudy/B&M.webp')
                    );
                    $cs_href  = home_url('/case-studies/' . $slug . '/');
                    $metrics  = [
                        ['value' => $cs['metric1_value'] ?? '', 'label' => $cs['metric1_label'] ?? ''],
                        ['value' => $cs['metric2_value'] ?? '', 'label' => $cs['metric2_label'] ?? ''],
                        ['value' => $cs['metric3_value'] ?? '', 'label' => $cs['metric3_label'] ?? ''],
                    ];
                    $metrics = array_filter($metrics, fn($m) => $m['value'] !== '' || $m['label'] !== '');
                    ?>
                    <article class="border-b border-[#dedfe0] py-8">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:gap-6">
                            <div class="w-full lg:w-[619px] lg:shrink-0">
                                <img
                                    src="<?php echo esc_url($cs_image); ?>"
                                    alt="<?php echo esc_attr($cs['title'] ?? ''); ?>"
                                    class="h-[280px] w-full object-cover lg:h-[575px]"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <div class="w-full lg:w-[594px] lg:pt-1">
                                <h2 class="font-montserrat text-[24px] font-semibold leading-[32px] text-[#020202] lg:text-[20px] lg:leading-[30px]">
                                    <?php echo esc_html($cs['title'] ?? ''); ?>
                                </h2>
                                <?php if (!empty($cs['challenge'])) : ?>
                                    <div class="mt-6">
                                        <h3 class="font-montserrat text-[18px] font-semibold leading-[27px] text-[#ff5c00]">Challenge</h3>
                                        <p class="mt-2 font-roboto text-[16px] font-normal leading-[24px] text-[#364153]">
                                            <?php echo esc_html($cs['challenge']); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($cs['solution'])) : ?>
                                    <div class="mt-6">
                                        <h3 class="font-montserrat text-[18px] font-semibold leading-[27px] text-[#ff5c00]">Solution</h3>
                                        <p class="mt-2 font-roboto text-[16px] font-normal leading-[24px] text-[#364153]">
                                            <?php echo esc_html($cs['solution']); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($metrics)) : ?>
                                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-4">
                                        <?php foreach ($metrics as $metric) : ?>
                                            <div class="bg-[#f9fafb] px-4 py-4 text-center">
                                                <p class="font-roboto text-[24px] font-normal leading-[32px] text-[#ff5c00]"><?php echo esc_html($metric['value']); ?></p>
                                                <p class="font-roboto text-[12px] font-normal leading-[16px] text-[#4a5565]"><?php echo esc_html($metric['label']); ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <a
                                    href="<?php echo esc_url($cs_href); ?>"
                                    class="mt-6 inline-flex w-full max-w-[320px] items-center justify-center gap-3 bg-[#020202] px-[38px] py-[18px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a] sm:w-fit sm:max-w-none sm:justify-between sm:gap-0"
                                >
                                    <span>Full Case Study</span>
                                    <img src="<?php echo esc_url($assets['arrow']); ?>" alt="" class="size-5 sm:ml-11">
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Orange CTA -->
    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-8 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[42px] lg:leading-[52px]">
                <?php echo esc_html(get_option('my_theme_cs_cta_h2', 'Ready to Write Your Success Story?')); ?>
            </h2>
            <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-white">
                <?php echo esc_html(get_option('my_theme_cs_cta_desc', 'Join hundreds of UK warehouses saving costs and improving safety with Goliath.')); ?>
            </p>
            <a
                href="<?php echo esc_url(home_url('/contact/')); ?>"
                class="inline-flex h-[60px] w-full max-w-[320px] items-center justify-center gap-3 bg-[#020202] px-[32px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a] sm:w-auto sm:max-w-none"
            >
                <span><?php echo esc_html(get_option('my_theme_cs_cta_btn', 'Book Free Assessment')); ?></span>
                <img src="<?php echo esc_url($assets['cta_arrow']); ?>" alt="" class="size-5">
            </a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
