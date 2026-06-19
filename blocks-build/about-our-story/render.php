<?php
/**
 * Block: goliath/about-our-story
 * About – Our Story — white two-column text section.
 */

$heading = $attributes['heading'] ?? 'Our Story';
$p1      = $attributes['p1']      ?? 'Goliath was founded with a clear mission: to provide warehouse operators with a permanent, cost-effective alternative to repeated racking upright replacement. Our engineered steel repair system was developed to address one of the most persistent problems in warehouse maintenance.';
$p2      = $attributes['p2']      ?? 'Working closely with structural engineers and guided by UK safety standards including BS EN 15512 and BS EN 15635, we created a repair solution that does not just restore uprights to their original strength but reinforces them against future impact.';
$p3      = $attributes['p3']      ?? 'Every member of our installation team holds SEMA-approved racking inspector qualifications. We believe that the people who repair your racking should be qualified to inspect it first, ensuring every repair meets the highest safety standards.';
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
