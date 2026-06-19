<?php
/**
 * Block render: goliath/hp-dent-risk
 *
 * @var array $attributes Block attributes.
 */

$eyebrow   = $attributes['eyebrow'] ?? 'Explore the Features';
$heading   = $attributes['heading'] ?? 'It is not just a dent...';
$stat      = $attributes['stat']    ?? 'The Real Cost, Structural collapse risk increases by 60% with each unrepaired impact';
$body      = $attributes['body']    ?? 'You deserve a solution that\'s fast, permanent, and guaranteed. Traditional repairs are temporary patches. Full replacements are expensive and disruptive. There has to be a better way.';
$cta_text  = $attributes['ctaText'] ?? 'Discover the Solution';
$cta_url   = $attributes['ctaUrl']  ?? '#contact';
$image_alt = $attributes['imageAlt'] ?? 'Damaged warehouse upright';

$image = $attributes['image'] ?: my_theme_get_image_url('my_theme_hp_dent_img', get_theme_file_uri('assets/images/Homepage/not-just-dent.webp'));

$cta_arrow = get_theme_file_uri('assets/images/icons/cta-arrow-right.svg');
?>

<section id="dent-risk" class="section-shell py-[10px]">
    <div class="bg-white overflow-hidden">
        <div class="flex flex-col xl:flex-row">
            <div class="shrink-0 w-full xl:w-[640px] h-[340px] xl:h-[427px] overflow-hidden">
                <img src="<?php echo esc_url($image); ?>"
                     alt="<?php echo esc_attr($image_alt); ?>"
                     class="w-full h-full object-cover object-bottom">
            </div>
            <div class="w-full xl:w-[672px] pt-8 xl:pt-[76px] pb-8 xl:pb-[85px] pl-0 xl:pl-[36px] pr-0 xl:pr-[92px]">
                <div class="flex flex-col gap-[12px]">
                    <p class="font-yantramanav font-medium text-[14px] text-noir uppercase tracking-[1.4px] leading-[28px] mb-0"><?php echo esc_html($eyebrow); ?></p>
                    <h2 class="font-montserrat font-bold text-[30px] xl:text-[36px] text-[#ff5c00] leading-[36px] xl:leading-[44px] mb-0"><?php echo esc_html($heading); ?></h2>
                    <p class="font-montserrat font-bold text-[16px] text-noir leading-[23px] max-w-[472px] mb-0"><?php echo esc_html($stat); ?></p>
                    <p class="font-montserrat font-medium text-[16px] text-noir leading-[24px] max-w-[544px] mb-0"><?php echo esc_html($body); ?></p>
                    <a href="<?php echo esc_url($cta_url); ?>" class="btn-primary h-[52px] w-full text-[14px] uppercase sm:w-[247px] mt-2">
                        <?php echo esc_html($cta_text); ?>
                        <img src="<?php echo esc_url($cta_arrow); ?>" alt="" class="w-5 h-5" aria-hidden="true">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
