<?php
/**
 * Video Content block – heading, intro, bullet list, closing text.
 *
 * @var array $attributes
 */

defined('ABSPATH') || exit;

$heading_black  = esc_html($attributes['headingBlack'] ?? '');
$heading_orange = esc_html($attributes['headingOrange'] ?? '');
$intro_text     = esc_html($attributes['introText'] ?? '');
$bullet_points  = $attributes['bulletPoints'] ?? [];
$closing_text   = esc_html($attributes['closingText'] ?? '');

$check_icon = get_theme_file_uri('assets/images/icons/Icon-1.svg');
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[80px]">
        <div class="max-w-[1211px]">
            <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                <span class="text-[#020202]"><?php echo $heading_black; ?> </span><span class="text-[#ff5c00]"><?php echo $heading_orange; ?></span>
            </h2>
            <?php if ($intro_text) : ?>
            <p class="mt-4 font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                <?php echo $intro_text; ?>
            </p>
            <?php endif; ?>
            <?php if (! empty($bullet_points)) : ?>
            <ul class="mt-4 space-y-3">
                <?php foreach ($bullet_points as $point) : ?>
                <li class="flex items-start gap-3">
                    <img src="<?php echo esc_url($check_icon); ?>" alt="" class="mt-1 size-5 shrink-0" width="20" height="20" aria-hidden="true">
                    <span class="font-montserrat text-[18px] font-normal leading-[28px] text-[#666]"><?php echo esc_html($point); ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php if ($closing_text) : ?>
            <p class="mt-5 font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                <?php echo $closing_text; ?>
            </p>
            <?php endif; ?>
        </div>
    </div>
</section>
