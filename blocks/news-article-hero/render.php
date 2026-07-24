<?php
/**
 * News Article Hero block — render.php.
 *
 * Renders the hero for a single news article page.
 * Pulls post title, featured image, and meta (source, source URL,
 * publication date, excerpt) from the current post.
 *
 * Attributes:
 *   externalLinkText string  Label for the external link button.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$post_id          = get_the_ID();
$title            = get_the_title($post_id);
$thumb_url        = get_the_post_thumbnail_url($post_id, 'full');
$source           = get_post_meta($post_id, '_news_source', true);
$source_url       = get_post_meta($post_id, '_news_source_url', true);
$pub_date         = get_post_meta($post_id, '_news_publication_date', true);
$excerpt          = get_the_excerpt($post_id);
$ext_link_text    = esc_html($attributes['externalLinkText'] ?? 'Read the original article');
$arrow            = get_theme_file_uri('assets/images/icons/cta-arrow-right.svg');
?>
<section class="relative w-full hero-gradient-bg">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-10 pb-12 sm:px-6 lg:px-[68px] lg:pt-[60px] lg:pb-[60px]">

        <?php if ($source || $pub_date) : ?>
            <div class="mb-5 flex flex-wrap items-center gap-3">
                <?php if ($source) : ?>
                    <span class="font-montserrat text-[13px] font-semibold uppercase tracking-[1px] text-[#ff5c00]">
                        <?php echo esc_html($source); ?>
                    </span>
                <?php endif; ?>
                <?php if ($source && $pub_date) : ?>
                    <span class="text-white/30" aria-hidden="true">|</span>
                <?php endif; ?>
                <?php if ($pub_date) : ?>
                    <span class="font-roboto text-[13px] text-white/60">
                        <?php echo esc_html($pub_date); ?>
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <h1 class="font-montserrat text-[28px] font-bold leading-[36px] text-white sm:text-[36px] sm:leading-[44px] lg:text-[46px] lg:leading-[56px] max-w-[900px]">
            <?php echo esc_html($title); ?>
        </h1>

    </div>
</section>

<?php if ($thumb_url || $excerpt) : ?>
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[60px]">
            <div class="flex flex-col gap-10 lg:flex-row lg:gap-12 lg:items-start">

                <?php if ($thumb_url) : ?>
                    <div class="w-full lg:w-[560px] lg:shrink-0">
                        <img
                            src="<?php echo esc_url($thumb_url); ?>"
                            alt="<?php echo esc_attr($title); ?>"
                            class="w-full h-auto object-cover"
                            loading="eager"
                            decoding="async"
                        >
                    </div>
                <?php endif; ?>

                <div class="w-full">
                    <?php if ($excerpt) : ?>
                        <p class="font-roboto text-[17px] font-normal leading-[28px] text-[#364153] lg:text-[18px] lg:leading-[30px]">
                            <?php echo esc_html($excerpt); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($source_url) : ?>
                        <a
                            href="<?php echo esc_url($source_url); ?>"
                            class="mt-8 inline-flex items-center gap-3 bg-[#020202] px-[38px] py-[18px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a]"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <span><?php echo $ext_link_text; ?></span>
                            <img src="<?php echo esc_url($arrow); ?>" alt="" class="size-5">
                        </a>
                        <?php if ($source) : ?>
                            <p class="mt-3 font-roboto text-[13px] text-[#6b7280]">
                                Opens on <?php echo esc_html($source); ?> in a new tab
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>
<?php endif; ?>
