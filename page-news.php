<?php
/**
 * Template Name: News Page
 *
 * Hub listing page for the News section at /news/.
 *
 * Primary path: if the page has Gutenberg blocks (news-hub-hero, news-hub-list,
 * news-hub-cta), render via the_content() so the client can edit everything
 * in the block editor — identical to how case studies hub works.
 *
 * Fallback: minimal PHP-rendered layout when no blocks are present.
 *
 * @package MyCustomTheme
 */

get_header();

$_current_page = get_queried_object();

if ($_current_page instanceof WP_Post && has_blocks($_current_page)) {
    setup_postdata($_current_page);
    echo '<main class="w-full bg-white overflow-x-hidden">';
    the_content();
    echo '</main>';
    wp_reset_postdata();
    get_footer();
    return;
}

// Fallback: plain PHP rendering when the page has not yet been set up with blocks.
$arrow = get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg');

$news_posts = get_posts([
    'post_type'      => 'news',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>
<main class="w-full bg-white overflow-x-hidden">

    <!-- Hero -->
    <section class="relative w-full h-auto lg:h-[400px] hero-gradient-bg">
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-5 lg:h-[223px] lg:justify-between lg:gap-0">
                <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <span class="text-white">Industry </span><span class="text-[#ff5c00]">News</span>
                </h1>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    Goliath's innovative approach to pallet racking safety has been featured across leading industry publications. Explore the latest coverage highlighting our impact on warehouse operations throughout the UK.
                </p>
            </div>
        </div>
    </section>

    <!-- News list -->
    <?php if (empty($news_posts)) : ?>
        <section class="w-full bg-white">
            <div class="mx-auto w-full max-w-[1440px] px-5 py-16 sm:px-6 lg:px-[68px]">
                <p class="font-roboto text-[16px] leading-[24px] text-[#364153]">No news articles have been published yet.</p>
            </div>
        </section>
    <?php else : ?>
        <section class="w-full bg-white">
            <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-[10px] px-5 py-6 sm:px-6 lg:px-[68px] lg:pt-[30px] lg:pb-[70px]">
                <?php foreach ($news_posts as $news_post) : ?>
                    <?php
                    $thumb_url   = get_the_post_thumbnail_url($news_post->ID, 'large');
                    $pub_date    = get_post_meta($news_post->ID, '_news_publication_date', true);
                    $excerpt     = $news_post->post_excerpt;
                    $article_url = get_permalink($news_post->ID);

                    // Resolve all press links; fall back to legacy single-link fields.
                    $raw_links   = get_post_meta($news_post->ID, '_news_press_links', true);
                    $press_links = [];
                    if ($raw_links !== '') {
                        $decoded = json_decode($raw_links, true);
                        if (is_array($decoded)) {
                            $press_links = array_values(array_filter($decoded, static function (array $l): bool {
                                return ! empty($l['url']);
                            }));
                        }
                    }
                    if (empty($press_links)) {
                        $legacy_name = (string) get_post_meta($news_post->ID, '_news_source', true);
                        $legacy_url  = (string) get_post_meta($news_post->ID, '_news_source_url', true);
                        if ($legacy_url !== '') {
                            $press_links = [['name' => $legacy_name, 'url' => $legacy_url]];
                        }
                    }
                    // Legacy variable kept for the outlet badge above the title.
                    $source = $press_links[0]['name'] ?? (string) get_post_meta($news_post->ID, '_news_source', true);
                    ?>
                    <article class="border-b border-[#dedfe0] py-8">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:gap-8">
                            <?php if ($thumb_url) : ?>
                                <div class="w-full lg:w-[420px] lg:shrink-0">
                                    <img
                                        src="<?php echo esc_url($thumb_url); ?>"
                                        alt="<?php echo esc_attr($news_post->post_title); ?>"
                                        class="h-[240px] w-full object-cover lg:h-[280px]"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                            <?php endif; ?>
                            <div class="w-full lg:pt-1">
                                <?php if ($source || $pub_date) : ?>
                                    <div class="mb-3 flex flex-wrap items-center gap-3">
                                        <?php if ($source) : ?>
                                            <span class="font-montserrat text-[13px] font-semibold uppercase tracking-[0.8px] text-[#ff5c00]"><?php echo esc_html($source); ?></span>
                                        <?php endif; ?>
                                        <?php if ($source && $pub_date) : ?>
                                            <span class="text-[#dedfe0]" aria-hidden="true">|</span>
                                        <?php endif; ?>
                                        <?php if ($pub_date) : ?>
                                            <span class="font-roboto text-[13px] text-[#6b7280]"><?php echo esc_html($pub_date); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <h2 class="font-montserrat text-[22px] font-semibold leading-[30px] text-[#020202] lg:text-[20px] lg:leading-[28px]">
                                    <?php echo esc_html($news_post->post_title); ?>
                                </h2>
                                <?php if ($excerpt) : ?>
                                    <p class="mt-4 font-roboto text-[16px] font-normal leading-[26px] text-[#364153]">
                                        <?php echo esc_html($excerpt); ?>
                                    </p>
                                <?php endif; ?>
                                <div class="mt-6 flex flex-col gap-3">
                                    <a
                                        href="<?php echo esc_url($article_url); ?>"
                                        class="inline-flex w-full max-w-[300px] items-center justify-center gap-3 bg-[#020202] px-[38px] py-[18px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a] sm:w-fit sm:max-w-none sm:justify-between sm:gap-0"
                                    >
                                        <span>Read article</span>
                                        <img src="<?php echo esc_url($arrow); ?>" alt="" class="size-5 sm:ml-10">
                                    </a>
                                    <?php foreach ($press_links as $pl) : ?>
                                        <a
                                            href="<?php echo esc_url($pl['url']); ?>"
                                            class="inline-flex items-center gap-1 font-montserrat text-[14px] font-semibold text-[#ff5c00] underline underline-offset-2 hover:no-underline"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            Read on <?php echo esc_html($pl['name'] ?: 'the original outlet'); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- CTA -->
    <section class="w-full bg-[#ff5c00]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-8 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[42px] lg:leading-[52px]">
                Want to See Goliath in Action?
            </h2>
            <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-white">
                Book a free on-site assessment and discover how we can permanently solve your racking damage problems.
            </p>
            <a
                href="<?php echo esc_url(home_url('/contact/')); ?>"
                class="inline-flex h-[60px] w-full max-w-[320px] items-center justify-center gap-3 bg-[#020202] px-[32px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a] sm:w-auto sm:max-w-none"
            >
                <span>Book Free Assessment</span>
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
