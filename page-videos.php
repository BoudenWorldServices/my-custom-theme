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

$installation_videos = my_theme_get_videos_hub_videos();

$safety_videos = array_filter(
    my_theme_get_videos_by_section('safety'),
    static function (array $row, string $slug): bool {
        return my_theme_video_file_is_readable($row['file']);
    },
    ARRAY_FILTER_USE_BOTH
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

            <div class="mt-1 grid grid-cols-1 gap-[26px] md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($installation_videos as $slug => $row) : ?>
                    <a href="<?php echo esc_url(home_url('/videos/' . $slug . '/')); ?>" class="group border-t border-[#faf5ff] py-[10px]">
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

            <?php if (! empty($safety_videos)) : ?>
                <h2 class="mt-10 font-montserrat text-[32px] font-bold leading-[44px] text-[#020202] lg:text-[36px] lg:leading-[44px]"><?php echo esc_html(get_option('my_theme_vp_safety_heading', 'Safety & Compliance')); ?></h2>
                <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#ff5c00]">
                    <p><?php echo esc_html(get_option('my_theme_vp_safety_subtitle', 'Understanding warehouse racking safety regulations and best practices')); ?></p>
                </div>

                <div class="mt-1 grid grid-cols-1 gap-[26px] md:grid-cols-2 lg:grid-cols-3">
                    <?php foreach ($safety_videos as $slug => $row) : ?>
                        <a href="<?php echo esc_url(home_url('/videos/' . $slug . '/')); ?>" class="group border-t border-[#faf5ff] py-[10px]">
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
            <?php endif; ?>
        </div>
    </section>

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
