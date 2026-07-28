<?php
/**
 * News Article Hero block — render.php.
 *
 * Renders the hero for a single news article page.
 * Pulls post title, featured image, and meta (press links,
 * publication date, excerpt) from the current post.
 *
 * Press links are stored as JSON in _news_press_links (array of
 * {name, url} objects). Falls back to the legacy _news_source /
 * _news_source_url single-link fields for backward compatibility.
 *
 * Attributes:
 *   externalLinkText string  Label for the primary external link button.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$post_id       = get_the_ID();
$title         = get_the_title($post_id);
$pub_date      = get_post_meta($post_id, '_news_publication_date', true);
$excerpt       = get_the_excerpt($post_id);
$ext_link_text = esc_html($attributes['externalLinkText'] ?? 'Read the original article');
$arrow         = get_theme_file_uri('assets/images/icons/cta-arrow-right.svg');

// ── Image column size ─────────────────────────────────────────────────────────
$img_size_key = $attributes['imageColumnSize'] ?? 'medium';
$img_sizes    = [
    'small'  => ['wp' => 'medium', 'col' => 'lg:w-[220px]', 'h' => 'h-[180px] lg:h-[200px]'],
    'medium' => ['wp' => 'large',  'col' => 'lg:w-[320px]', 'h' => 'h-[220px] lg:h-[240px]'],
    'large'  => ['wp' => 'large',  'col' => 'lg:w-[460px]', 'h' => 'h-[260px] lg:h-[300px]'],
];
$img_cfg   = $img_sizes[$img_size_key] ?? $img_sizes['medium'];
$thumb_url = get_the_post_thumbnail_url($post_id, $img_cfg['wp']);

// ── Resolve press links ───────────────────────────────────────────────────────
$raw_links = get_post_meta($post_id, '_news_press_links', true);
$links     = [];

if ($raw_links !== '') {
    $decoded = json_decode($raw_links, true);
    if (is_array($decoded)) {
        $links = array_values(array_filter($decoded, static function (array $l): bool {
            return ! empty($l['url']);
        }));
    }
}

// Fall back to the legacy single-link fields.
if (empty($links)) {
    $legacy_name = (string) get_post_meta($post_id, '_news_source', true);
    $legacy_url  = (string) get_post_meta($post_id, '_news_source_url', true);
    if ($legacy_url !== '') {
        $links = [['name' => $legacy_name, 'url' => $legacy_url]];
    }
}

$primary_link   = $links[0]   ?? null;
$secondary_links = array_slice($links, 1);

// The outlet label shown in the title bar uses the primary link name if available.
$source_label = $primary_link['name'] ?? '';
?>
<section class="relative w-full hero-gradient-bg">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-10 pb-12 sm:px-6 lg:px-[68px] lg:pt-[60px] lg:pb-[60px]">

        <?php if ($source_label || $pub_date) : ?>
            <div class="mb-5 flex flex-wrap items-center gap-3">
                <?php if ($source_label) : ?>
                    <span class="font-montserrat text-[13px] font-semibold uppercase tracking-[1px] text-[#ff5c00]">
                        <?php echo esc_html($source_label); ?>
                    </span>
                <?php endif; ?>
                <?php if ($source_label && $pub_date) : ?>
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

<?php if ($thumb_url || $excerpt || $primary_link) : ?>
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-12">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:gap-10">

                <?php if ($thumb_url) : ?>
                    <div class="w-full lg:shrink-0 <?php echo esc_attr($img_cfg['col']); ?>">
                        <img
                            src="<?php echo esc_url($thumb_url); ?>"
                            alt="<?php echo esc_attr($title); ?>"
                            class="w-full object-cover <?php echo esc_attr($img_cfg['h']); ?>"
                            loading="eager"
                            decoding="async"
                        >
                    </div>
                <?php endif; ?>

                <div class="w-full lg:flex-1">

                    <?php if ($excerpt) : ?>
                        <p class="font-roboto text-[17px] font-normal leading-[28px] text-[#364153] lg:text-[18px] lg:leading-[30px]">
                            <?php echo esc_html($excerpt); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($primary_link) : ?>
                        <a
                            href="<?php echo esc_url($primary_link['url']); ?>"
                            class="mt-8 inline-flex items-center gap-3 bg-[#020202] px-[38px] py-[18px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a]"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <span><?php echo $ext_link_text; ?></span>
                            <img src="<?php echo esc_url($arrow); ?>" alt="" class="size-5">
                        </a>
                        <?php if ($primary_link['name']) : ?>
                            <p class="mt-3 font-roboto text-[13px] text-[#6b7280]">
                                Opens on <?php echo esc_html($primary_link['name']); ?> in a new tab
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (! empty($secondary_links)) : ?>
                        <div class="mt-8 border-t border-[#e5e7eb] pt-6">
                            <p class="mb-3 font-montserrat text-[12px] font-semibold uppercase tracking-[1px] text-[#6b7280]">
                                Also covered in
                            </p>
                            <ul class="flex flex-col gap-2">
                                <?php foreach ($secondary_links as $link) : ?>
                                    <li>
                                        <a
                                            href="<?php echo esc_url($link['url']); ?>"
                                            class="inline-flex items-center font-montserrat text-[14px] font-semibold text-[#ff5c00] underline underline-offset-2 hover:no-underline"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            <?php if (! empty($link['name'])) : ?>
                                                Read on <?php echo esc_html($link['name']); ?>
                                            <?php else : ?>
                                                Read article
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </section>
<?php endif; ?>
