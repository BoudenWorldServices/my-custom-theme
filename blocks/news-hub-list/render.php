<?php
/**
 * News Hub List block — render.php.
 *
 * Queries published 'news' CPT posts and renders listing cards showing
 * featured image, title, source/outlet, publication date, excerpt, and
 * a link to the full article detail page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$arrow = get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg');

$news_posts = get_posts([
    'post_type'      => 'news',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'DESC',
]);

if (empty($news_posts)) {
    ?>
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-16 sm:px-6 lg:px-[68px]">
            <p class="font-roboto text-[16px] leading-[24px] text-[#364153]">No news articles have been published yet.</p>
        </div>
    </section>
    <?php
    return;
}
?>
<section class="w-full bg-white">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-[10px] px-5 py-6 sm:px-6 lg:px-[68px] lg:pt-[30px] lg:pb-[70px]">
        <?php foreach ($news_posts as $news_post) : ?>
            <?php
            $thumb_url   = get_the_post_thumbnail_url($news_post->ID, 'large');
            $source      = get_post_meta($news_post->ID, '_news_source', true);
            $source_url  = get_post_meta($news_post->ID, '_news_source_url', true);
            $pub_date    = get_post_meta($news_post->ID, '_news_publication_date', true);
            $excerpt     = $news_post->post_excerpt;
            $article_url = get_permalink($news_post->ID);
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
                                    <span class="font-montserrat text-[13px] font-semibold uppercase tracking-[0.8px] text-[#ff5c00]">
                                        <?php echo esc_html($source); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ($source && $pub_date) : ?>
                                    <span class="text-[#dedfe0]" aria-hidden="true">|</span>
                                <?php endif; ?>
                                <?php if ($pub_date) : ?>
                                    <span class="font-roboto text-[13px] text-[#6b7280]">
                                        <?php echo esc_html($pub_date); ?>
                                    </span>
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
                            <?php if ($source_url) : ?>
                                <a
                                    href="<?php echo esc_url($source_url); ?>"
                                    class="inline-flex items-center gap-1 font-montserrat text-[14px] font-semibold text-[#ff5c00] underline underline-offset-2 hover:no-underline"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    Read on <?php echo esc_html($source ?: 'the original outlet'); ?> ↗
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
