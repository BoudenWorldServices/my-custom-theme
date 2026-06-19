<?php
/**
 * Block render: goliath/hp-preview
 *
 * @var array $attributes Block attributes.
 */

$eyebrow        = $attributes['eyebrow'] ?? 'Preview Process';
$heading         = $attributes['heading'] ?? 'Racking upright repair built to last';
$subheading      = $attributes['subheading'] ?? 'Racking upright repair built to last';
$bodyIntro       = $attributes['bodyIntro'] ?? 'Goliath™ is a permanent racking upright repair that stops repeat damage and keeps your warehouse operating safely.';
$bodyInstalled   = $attributes['bodyInstalled'] ?? 'Installed in minutes. Built to withstand impact.';
$leftH3          = $attributes['leftH3'] ?? 'Why Goliath™? (Money saving proposition)';
$leftP           = $attributes['leftP'] ?? 'When warehouse racking damage happens, you know it is not a one-off issue. It is a cycle of hit, repair, and replacement happening continuously. Every incident carries its own cost and risk.';
$rightH3         = $attributes['rightH3'] ?? 'Goliath is the Solution';
$rightP          = $attributes['rightP'] ?? 'Our permanent racking upright repair system is a durable setup that is engineered to meet UK safety standards. Once installed, it absorbs continuous impacts and prevents future damage. We\'re the smart solution to repeated upright replacement.';
$rightTransition = $attributes['rightTransition'] ?? 'That means:';
$bullet1         = $attributes['bullet1'] ?? 'Never replace an upright again';
$bullet2         = $attributes['bullet2'] ?? 'Lower maintenance costs';
$bullet3         = $attributes['bullet3'] ?? 'Reduced operational disruption';
$bullet4         = $attributes['bullet4'] ?? 'Long lifespan for racking systems';
$rightOutro      = $attributes['rightOutro'] ?? 'Goliath™ doesn\'t offer a short-term fix. Ours is a long-term cost-saving solution for warehouse racking damage.';

$img1 = $attributes['img1'] ?: my_theme_get_image_url('my_theme_hp_review_img1', get_theme_file_uri('assets/images/Homepage/review-1.webp'));
$img2 = $attributes['img2'] ?: my_theme_get_image_url('my_theme_hp_review_img2', get_theme_file_uri('assets/images/Homepage/review-2.webp'));
$img3 = $attributes['img3'] ?: my_theme_get_image_url('my_theme_hp_review_img3', get_theme_file_uri('assets/images/Homepage/review-3.webp'));
?>

<section id="preview" class="relative left-1/2 right-1/2 w-[100dvw] max-w-[100dvw] -ml-[50dvw] -mr-[50dvw] bg-[#f9fafb]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[50px]">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-[307px_307px_1fr] lg:gap-[24px]">
            <img src="<?php echo esc_url($img1); ?>" alt="Repaired upright close-up" class="h-[360px] w-full object-cover" loading="lazy" decoding="async">
            <img src="<?php echo esc_url($img2); ?>" alt="Engineer installing repair" class="h-[359px] w-full object-cover" loading="lazy" decoding="async">
            <img src="<?php echo esc_url($img3); ?>" alt="Installed racking upright in warehouse aisle" class="h-[359px] w-full object-cover" loading="lazy" decoding="async">
        </div>

        <div class="mt-6">
            <p class="font-montserrat text-[20px] font-medium uppercase leading-[44px] text-[#020202]"><?php echo esc_html($eyebrow); ?></p>
            <h2 class="font-montserrat text-[36px] font-bold leading-[44px] text-[#12192d]"><?php echo esc_html($heading); ?></h2>
        </div>

        <div class="mt-5 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-5">
            <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                <p class="mb-1 font-montserrat text-[20px] font-bold uppercase leading-[44px] text-[#ff5c00]"><?php echo esc_html($subheading); ?></p>
                <p><?php echo esc_html($bodyIntro); ?></p>
                <p><?php echo esc_html($bodyInstalled); ?></p>
                <div class="h-4"></div>
                <h3 class="mb-1 font-montserrat text-[20px] font-bold uppercase leading-[44px] text-[#ff5c00]"><?php echo esc_html($leftH3); ?></h3>
                <p><?php echo esc_html($leftP); ?></p>
            </div>

            <div class="font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                <h3 class="mb-1 font-montserrat text-[20px] font-bold uppercase leading-[44px] text-[#ff5c00]"><?php echo esc_html($rightH3); ?></h3>
                <p><?php echo esc_html($rightP); ?></p>
                <p><?php echo esc_html($rightTransition); ?></p>
                <p><?php echo esc_html($bullet1); ?></p>
                <p><?php echo esc_html($bullet2); ?></p>
                <p><?php echo esc_html($bullet3); ?></p>
                <p><?php echo esc_html($bullet4); ?></p>
                <p><?php echo esc_html($rightOutro); ?></p>
            </div>
        </div>
    </div>
</section>
