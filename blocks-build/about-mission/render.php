<?php
/**
 * Block: goliath/about-mission
 * About – Our Mission — grey centred section with heading and mission statement.
 */

$heading = $attributes['heading'] ?? 'Our Mission';
$text    = $attributes['text']    ?? 'To end the costly cycle of racking upright replacement by providing permanent, engineered repairs that improve safety, reduce downtime, and lower long-term maintenance costs for every warehouse we serve.';
?>
<section class="w-full bg-[#f9fafb] py-10 lg:py-[60px]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-6 px-5 text-center sm:px-6 lg:px-[68px]">
        <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
            <?php echo esc_html($heading); ?>
        </h2>
        <p class="max-w-[800px] font-roboto text-[20px] font-normal leading-[32px] text-[#4a5565]">
            <?php echo esc_html($text); ?>
        </p>
    </div>
</section>
