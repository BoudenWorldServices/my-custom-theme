<?php
/**
 * Block: goliath/about-leadership
 * About – Leadership — photo and bio layout.
 * When the `photo` attribute is non-empty it takes priority over the theme option / fallback.
 */

$heading               = $attributes['heading']              ?? 'Leadership';
$subtitle              = $attributes['subtitle']             ?? 'Qualified professionals with deep expertise in warehouse racking safety and structural engineering.';
$leader_name           = $attributes['leaderName']           ?? 'Managing Director';
$leader_role           = $attributes['leaderRole']           ?? 'Founder & Managing Director';
$leader_qualifications = $attributes['leaderQualifications'] ?? 'SEMA Approved Racking Inspector';
$bio_p1                = $attributes['bioP1']                ?? 'With extensive experience in warehouse racking safety and structural repair, our managing director identified a fundamental flaw in the traditional approach to racking maintenance: the endless cycle of damage, replacement, and repeat damage.';
$bio_p2                = $attributes['bioP2']                ?? 'This insight led to the development of the Goliath repair system, engineered to not only restore damaged uprights but to reinforce them against future impact. Every installation is backed by a lifetime warranty because we stand behind the quality of our work.';

if (! empty($attributes['photo'])) {
    $leader_photo = esc_url($attributes['photo']);
} else {
    $leader_photo = esc_url(my_theme_get_image_url('my_theme_about_leader_photo', get_theme_file_uri('assets/images/icons/Goliath_logo_fullcolor.svg')));
}
?>
<section class="w-full bg-white py-10 lg:py-[80px]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 sm:px-6 lg:gap-[48px] lg:px-[68px]">
        <div class="text-center">
            <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html($heading); ?>
            </h2>
            <p class="mt-3 font-roboto text-[18px] font-normal leading-[28px] text-[#4a5565]">
                <?php echo esc_html($subtitle); ?>
            </p>
        </div>

        <div class="flex flex-col items-center gap-8 lg:flex-row lg:items-start lg:gap-[60px]">
            <div class="w-full max-w-[320px] shrink-0">
                <div class="aspect-[3/4] w-full overflow-hidden bg-[#f3f4f6]">
                    <img
                        src="<?php echo $leader_photo; ?>"
                        alt="<?php echo esc_attr($leader_name); ?>"
                        class="h-full w-full object-cover"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
            <div class="flex flex-1 flex-col gap-4">
                <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-[#020202] lg:text-[28px]">
                    <?php echo esc_html($leader_name); ?>
                </h3>
                <p class="font-montserrat text-[16px] font-semibold leading-[24px] text-[#ff5c00]">
                    <?php echo esc_html($leader_role); ?>
                </p>
                <p class="font-roboto text-[14px] font-medium leading-[22px] text-[#364153]">
                    <?php echo esc_html($leader_qualifications); ?>
                </p>
                <div class="space-y-4 font-roboto text-[18px] font-normal leading-[28px] text-[#4a5565]">
                    <p><?php echo esc_html($bio_p1); ?></p>
                    <p><?php echo esc_html($bio_p2); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
