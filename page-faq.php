<?php
/*
Template Name: FAQ Page
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
    'link_arrow' => get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg'),
    'cta_image' => my_theme_get_image_url('my_theme_faqp_cta_image', get_theme_file_uri('assets/images/FAQ/installonce.webp')),
];

$faq_items = my_theme_get_faq_items();
?>

<main class="w-full bg-white overflow-x-hidden">
    <!-- Hero -->
    <section
        class="relative w-full h-auto lg:h-[400px] hero-gradient-bg"
    >
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-9 lg:gap-12">
                <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <?php
                    $faqp_h1 = get_option('my_theme_faqp_hero_h1', 'Frequently Asked Questions');
                    $faqp_h1_parts = explode(' ', $faqp_h1, 2);
                    ?>
                    <span class="text-white"><?php echo esc_html($faqp_h1_parts[0]); ?> </span><span class="text-[#ff5c00]"><?php echo esc_html($faqp_h1_parts[1] ?? ''); ?></span>
                </h1>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    <?php echo esc_html(get_option('my_theme_faqp_hero_desc', 'Everything you need to know about ' . (function_exists('my_theme_organization_name') ? my_theme_organization_name() : 'Goliath Pallet Racking Repair Ltd') . ', from installation and costs to safety compliance and warranty coverage.')); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- FAQ list (native details/summary accordions) -->
    <section class="w-full bg-white" aria-labelledby="faq-list-heading">
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-10 pb-8 sm:px-6 lg:px-[68px] lg:pt-[80px]">
            <h2 id="faq-list-heading" class="sr-only">Questions and answers</h2>
            <div class="space-y-4">
                <?php foreach ($faq_items as $item) : ?>
                    <details class="group border border-[#dedfe0] bg-white px-[28px] pb-[1px]">
                        <summary class="flex min-h-[76px] cursor-pointer list-none items-start justify-between gap-4 outline-none [&::-webkit-details-marker]:hidden focus-visible:ring-2 focus-visible:ring-[#ff5c00] focus-visible:ring-offset-2">
                            <h3 class="pt-[24px] font-montserrat text-[18px] font-bold leading-[28px] text-[#020202]"><?php echo esc_html($item['question']); ?></h3>
                            <svg class="mt-[26px] size-4 shrink-0 text-[#6b7280] transition-transform group-open:rotate-180" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <path d="M6 8l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </summary>
                        <div class="space-y-3 pb-5 pr-6">
                            <?php foreach ($item['paragraphs'] as $paragraph) : ?>
                                <p class="max-w-[844px] font-roboto text-[14px] leading-[22.75px] text-[#364153]"><?php echo esc_html($paragraph); ?></p>
                            <?php endforeach; ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Explore resources -->
    <section class="w-full bg-[#fafafa]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:h-[433px] lg:pt-[10px] lg:pb-0">
            <div class="flex h-full flex-col items-center justify-center gap-10 lg:gap-[60px]">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
                    <?php echo esc_html(get_option('my_theme_faqp_resources_h2', 'Explore More Resources')); ?>
                </h2>
                <div class="grid w-full grid-cols-1 gap-6 lg:grid-cols-3 lg:gap-[24px]">
                    <article class="bg-[#f9fafb] p-[24px]">
                        <h3 class="font-montserrat text-[20px] font-bold leading-[28px] text-[#020202]"><?php echo esc_html(get_option('my_theme_faqp_res1_title', 'How It Works')); ?></h3>
                        <p class="mt-[14px] max-w-[235px] font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html(get_option('my_theme_faqp_res1_desc', 'Learn about our 30-minute installation process')); ?></p>
                        <a href="<?php echo esc_url(home_url('/how-it-works/')); ?>" class="mt-[14px] inline-flex items-center gap-1 font-roboto text-[16px] leading-[24px] text-[#ff5c00]">Learn More <img src="<?php echo esc_url($assets['link_arrow']); ?>" alt="" class="size-4"></a>
                    </article>
                    <article class="bg-[#f9fafb] p-[24px]">
                        <h3 class="font-montserrat text-[20px] font-bold leading-[28px] text-[#020202]"><?php echo esc_html(get_option('my_theme_faqp_res2_title', 'Compliance')); ?></h3>
                        <p class="mt-[14px] max-w-[235px] font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html(get_option('my_theme_faqp_res2_desc', 'Understand how Goliath™ meets UK safety standards')); ?></p>
                        <a href="<?php echo esc_url(home_url('/compliance/')); ?>" class="mt-[14px] inline-flex items-center gap-1 font-roboto text-[16px] leading-[24px] text-[#ff5c00]">Learn More <img src="<?php echo esc_url($assets['link_arrow']); ?>" alt="" class="size-4"></a>
                    </article>
                    <article class="bg-[#f9fafb] p-[24px]">
                        <h3 class="font-montserrat text-[20px] font-bold leading-[28px] text-[#020202]"><?php echo esc_html(get_option('my_theme_faqp_res3_title', 'Case Studies')); ?></h3>
                        <p class="mt-[14px] max-w-[235px] font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html(get_option('my_theme_faqp_res3_desc', 'See real-world results from B&M and others')); ?></p>
                        <a href="<?php echo esc_url(home_url('/case-studies/')); ?>" class="mt-[14px] inline-flex items-center gap-1 font-roboto text-[16px] leading-[24px] text-[#ff5c00]">Learn More <img src="<?php echo esc_url($assets['link_arrow']); ?>" alt="" class="size-4"></a>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto grid w-full max-w-[1440px] grid-cols-1 gap-8 px-5 py-10 sm:px-6 lg:grid-cols-[1fr_minmax(0,634px)] lg:items-center lg:gap-8 lg:px-[68px] lg:py-[68px]">
            <div class="relative h-[280px] w-full overflow-hidden sm:h-[360px] lg:h-[516px] lg:min-h-[516px]">
                <img
                    src="<?php echo esc_url($assets['cta_image']); ?>"
                    alt="Goliath installation in a warehouse"
                    class="h-full w-full object-cover"
                    loading="lazy"
                    decoding="async"
                >
            </div>
            <div class="flex w-full max-w-[634px] flex-col gap-8">
                <p class="font-montserrat text-[28px] font-bold leading-[36px] text-[#020202] sm:text-[32px] sm:leading-[40px] lg:text-[36px] lg:leading-[44px]">
                    <?php echo esc_html(get_option('my_theme_faqp_cta_h3', 'Still Have Questions?')); ?>
                </p>
                <p class="max-w-[486px] font-montserrat text-[16px] font-bold leading-[23px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_faqp_cta_body', 'Our team of experts is ready to answer any questions you have about Goliath™ and how it can benefit your warehouse operations.')); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex w-full max-w-[320px] items-center justify-between bg-[#020202] px-[28px] py-[18px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a] sm:w-[234px] sm:max-w-none">
                    <span><?php echo esc_html(get_option('my_theme_faqp_cta_btn', 'Contact us')); ?></span>
                    <img src="<?php echo esc_url($assets['link_arrow']); ?>" alt="" class="size-5" aria-hidden="true">
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
