<?php
/**
 * Case Study – Image Row block — render.php.
 *
 * Attributes:
 *   layout       string  'single' | 'two-column'.
 *   image1Url    string  URL or attachment ID for the first image.
 *   image1Alt    string  Alt text for image 1.
 *   image1Caption string  Optional caption shown below image 1.
 *   image2Url    string  URL or attachment ID for image 2 (only shown in two-column layout).
 *   image2Alt    string  Alt text for image 2.
 *   image2Caption string  Optional caption shown below image 2.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$layout          = (string) ($attributes['layout']        ?? 'single');
$image1_url      = (string) ($attributes['image1Url']     ?? '');
$image1_alt      = (string) ($attributes['image1Alt']     ?? '');
$image1_caption  = (string) ($attributes['image1Caption'] ?? '');
$image2_url      = (string) ($attributes['image2Url']     ?? '');
$image2_alt      = (string) ($attributes['image2Alt']     ?? '');
$image2_caption  = (string) ($attributes['image2Caption'] ?? '');

// Resolve attachment IDs to full URLs.
foreach (['image1_url', 'image2_url'] as $var) {
    if ($$var !== '' && is_numeric($$var) && (int) $$var > 0) {
        $resolved = wp_get_attachment_image_url((int) $$var, 'large');
        $$var = $resolved ?: $$var;
    }
}

if ($image1_url === '' && $image2_url === '') {
    return;
}

$is_two_col = $layout === 'two-column' && $image2_url !== '';
?>
<section class="w-full bg-[#f9fafb]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[60px]">
        <?php if ($is_two_col) : ?>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <?php foreach ([
                    ['url' => $image1_url, 'alt' => $image1_alt, 'caption' => $image1_caption],
                    ['url' => $image2_url, 'alt' => $image2_alt, 'caption' => $image2_caption],
                ] as $img) : ?>
                    <?php if ($img['url'] !== '') : ?>
                        <figure class="m-0">
                            <img
                                src="<?php echo esc_url($img['url']); ?>"
                                alt="<?php echo esc_attr($img['alt']); ?>"
                                class="h-auto w-full object-cover"
                                loading="lazy"
                                decoding="async"
                            >
                            <?php if ($img['caption'] !== '') : ?>
                                <figcaption class="mt-3 font-montserrat text-[14px] font-medium leading-[20px] text-[#666]">
                                    <?php echo esc_html($img['caption']); ?>
                                </figcaption>
                            <?php endif; ?>
                        </figure>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <figure class="m-0">
                <img
                    src="<?php echo esc_url($image1_url); ?>"
                    alt="<?php echo esc_attr($image1_alt); ?>"
                    class="h-auto w-full object-cover"
                    loading="lazy"
                    decoding="async"
                >
                <?php if ($image1_caption !== '') : ?>
                    <figcaption class="mt-3 font-montserrat text-[14px] font-medium leading-[20px] text-[#666]">
                        <?php echo esc_html($image1_caption); ?>
                    </figcaption>
                <?php endif; ?>
            </figure>
        <?php endif; ?>
    </div>
</section>
