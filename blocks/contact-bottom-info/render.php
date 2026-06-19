<?php
/**
 * Render callback for goliath/contact-bottom-info.
 *
 * Team photo on the left; description paragraph + 4 benefit items (with tick icons) on the right.
 *
 * @package MyCustomTheme
 */

$photo            = $attributes['photo']            ?? '';
$description      = $attributes['description']      ?? '';
$benefit1_title   = $attributes['benefit1Title']    ?? 'Free Site Survey';
$benefit1_sub     = $attributes['benefit1Subtitle'] ?? 'Complete damage assessment and risk mapping';
$benefit2_title   = $attributes['benefit2Title']    ?? 'Detailed Quote';
$benefit2_sub     = $attributes['benefit2Subtitle'] ?? 'Transparent pricing with no hidden costs';
$benefit3_title   = $attributes['benefit3Title']    ?? 'Expert Recommendations';
$benefit3_sub     = $attributes['benefit3Subtitle'] ?? 'Tailored solutions for your specific needs';
$benefit4_title   = $attributes['benefit4Title']    ?? 'Fast Response';
$benefit4_sub     = $attributes['benefit4Subtitle'] ?? 'Emergency installations within 48 hours';

if ( $photo === '' ) {
    $photo = my_theme_get_image_url( 'my_theme_cp_bottom_image', get_theme_file_uri( 'assets/images/contact/experts.webp' ) );
}

$tick_icon = get_theme_file_uri( 'assets/images/icons/Icon-1.svg' );

$benefits = [
    [ $benefit1_title, $benefit1_sub ],
    [ $benefit2_title, $benefit2_sub ],
    [ $benefit3_title, $benefit3_sub ],
    [ $benefit4_title, $benefit4_sub ],
];
?>
<section class="w-full bg-[#fafafa]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:gap-[60px] lg:px-[68px] lg:pt-[80px] lg:pb-[56px]">
        <div class="w-full overflow-hidden bg-[#d9d9d9] lg:h-[438px] lg:w-[609px] lg:shrink-0">
            <img src="<?php echo esc_url( $photo ); ?>" alt="Goliath team on site for a warehouse racking assessment" class="h-full w-full object-cover" loading="lazy" decoding="async">
        </div>
        <div class="w-full lg:w-[619px]">
            <p class="font-roboto text-[16px] font-normal leading-[26px] text-[#364153]">
                <?php echo esc_html( $description ); ?>
            </p>
            <ul class="mt-10 space-y-6">
                <?php foreach ( $benefits as $benefit ) : ?>
                    <li class="flex items-start gap-4">
                        <img src="<?php echo esc_url( $tick_icon ); ?>" alt="" class="mt-0.5 size-8 shrink-0 object-contain" width="32" height="32" aria-hidden="true">
                        <div>
                            <p class="font-montserrat text-[18px] font-semibold leading-[27px] text-[#020202]"><?php echo esc_html( $benefit[0] ); ?></p>
                            <p class="font-roboto text-[16px] leading-[24px] text-[#4a5565]"><?php echo esc_html( $benefit[1] ); ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
