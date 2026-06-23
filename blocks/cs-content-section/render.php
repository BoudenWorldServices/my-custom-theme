<?php
/**
 * Case Study – Content Section block — render.php.
 *
 * Attributes:
 *   heading       string  Orange section heading (H2). Leave blank to omit.
 *   body          string  Body paragraphs, split on \n\n.
 *   callout       string  Optional orange callout bar text.
 *   imageUrl      string  Optional image URL or attachment ID.
 *   imageAlt      string  Alt text for the image.
 *   imagePosition string  'none' | 'left' | 'right'. Controls two-column layout.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$heading        = (string) ($attributes['heading']       ?? '');
$body           = (string) ($attributes['body']          ?? '');
$callout        = (string) ($attributes['callout']       ?? '');
$image_url      = (string) ($attributes['imageUrl']      ?? '');
$image_alt      = (string) ($attributes['imageAlt']      ?? '');
$image_position = (string) ($attributes['imagePosition'] ?? 'none');

// Resolve attachment IDs to URLs.
if ($image_url !== '' && is_numeric($image_url) && (int) $image_url > 0) {
    $resolved  = wp_get_attachment_image_url((int) $image_url, 'large');
    $image_url = $resolved ?: $image_url;
}

$has_image  = $image_url !== '' && $image_position !== 'none';
$has_body   = $body !== '';
$has_callout = $callout !== '';

if ($heading === '' && ! $has_body && ! $has_callout && ! $has_image) {
    return;
}

$section_arrow = get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg');
$body_paras    = $has_body ? array_filter(array_map('trim', explode("\n\n", $body))) : [];
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[70px]">
        <?php if ($has_image) : ?>
            <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:gap-[60px] <?php echo $image_position === 'left' ? 'lg:flex-row-reverse' : ''; ?>">
                <div class="w-full lg:flex-1">
                    <img
                        src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                        class="h-auto w-full object-cover"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="w-full lg:flex-1">
                    <?php if ($heading !== '') : ?>
                        <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">
                            <?php echo esc_html($heading); ?>
                        </h2>
                    <?php endif; ?>
                    <?php foreach ($body_paras as $para) : ?>
                        <p class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#666]">
                            <?php echo nl2br(esc_html($para)); ?>
                        </p>
                    <?php endforeach; ?>
                    <?php if ($has_callout) : ?>
                        <div class="mt-6 flex flex-col gap-3 bg-[#ff6b2c] px-[24px] py-[18px] sm:flex-row sm:items-center sm:justify-between lg:px-[39px]">
                            <p class="font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white">
                                <?php echo nl2br(esc_html($callout)); ?>
                            </p>
                            <img src="<?php echo esc_url($section_arrow); ?>" alt="" class="size-5 shrink-0 sm:ml-4">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="max-w-3xl">
                <?php if ($heading !== '') : ?>
                    <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">
                        <?php echo esc_html($heading); ?>
                    </h2>
                <?php endif; ?>
                <?php foreach ($body_paras as $para) : ?>
                    <p class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#666]">
                        <?php echo nl2br(esc_html($para)); ?>
                    </p>
                <?php endforeach; ?>
                <?php if ($has_callout) : ?>
                    <div class="mt-6 flex flex-col gap-3 bg-[#ff6b2c] px-[24px] py-[18px] sm:flex-row sm:items-center sm:justify-between lg:w-[631px] lg:px-[39px]">
                        <p class="font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white">
                            <?php echo nl2br(esc_html($callout)); ?>
                        </p>
                        <img src="<?php echo esc_url($section_arrow); ?>" alt="" class="size-5 shrink-0 sm:ml-4">
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
