<?php
/**
 * Block: goliath/about-our-story
 * About – Our Story — white two-column text section.
 */

$heading = $attributes['heading'] ?? 'Our Story';
$p1      = $attributes['p1']      ?? 'Goliath was founded with a clear mission: to provide warehouse operators with a permanent, cost-effective alternative to repeated racking upright replacement. Our engineered steel repair system was developed to address one of the most persistent problems in warehouse maintenance.';
$p2      = $attributes['p2']      ?? 'Working closely with structural engineers, we created a repair solution that does not just restore uprights to their original strength but reinforces them against future impact. Goliath™ is independently tested and verified by Bureau Veritas and certified not to alter the original racking bay design.';
$p3      = $attributes['p3']      ?? 'Our installation team brings extensive warehouse racking experience to every job. We believe the people who repair your racking should understand how it is used, so every repair is carried out to a high safety standard.';
if (function_exists('my_theme_sanitize_restricted_claims_string')) {
    $p2 = my_theme_sanitize_restricted_claims_string((string) $p2);
    $p3 = my_theme_sanitize_restricted_claims_string((string) $p3);
}
if (stripos((string) $p2, 'BS EN') !== false || stripos((string) $p2, '15512') !== false || stripos((string) $p2, 'Bureau Veritas') === false) {
    $p2 = 'Working closely with structural engineers, we created a repair solution that does not just restore uprights to their original strength but reinforces them against future impact. Goliath™ is independently tested and verified by Bureau Veritas and certified not to alter the original racking bay design.';
}
if (stripos((string) $p3, 'inspect') !== false || stripos((string) $p3, 'should be understand') !== false) {
    $p3 = 'Our installation team brings extensive warehouse racking experience to every job. We believe the people who repair your racking should understand how it is used, so every repair is carried out to a high safety standard.';
}
$p4      = $attributes['p4']      ?? 'Today, Goliath is trusted by leading UK retailers and logistics operators. Our system is being rolled out across hundreds of warehouse sites, protecting the racking infrastructure that businesses depend on every day.';
?>
<section class="w-full bg-white py-10 lg:py-[80px]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 sm:px-6 lg:gap-[48px] lg:px-[68px]">
        <div class="max-w-[900px]">
            <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html($heading); ?>
            </h2>
        </div>
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-[60px]">
            <div class="space-y-5 font-roboto text-[18px] font-normal leading-[28px] text-[#4a5565]">
                <p><?php echo esc_html($p1); ?></p>
                <p><?php echo esc_html($p2); ?></p>
            </div>
            <div class="space-y-5 font-roboto text-[18px] font-normal leading-[28px] text-[#4a5565]">
                <p><?php echo esc_html($p3); ?></p>
                <p><?php echo esc_html($p4); ?></p>
            </div>
        </div>
    </div>
</section>
