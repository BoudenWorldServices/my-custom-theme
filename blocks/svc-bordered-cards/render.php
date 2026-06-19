<?php
$section_h = esc_html($attributes['sectionHeading'] ?? '');
$section_d = esc_html($attributes['sectionDesc'] ?? '');
$c1_h = esc_html($attributes['card1Heading'] ?? '');
$c1_d = esc_html($attributes['card1Desc'] ?? '');
$c2_h = esc_html($attributes['card2Heading'] ?? '');
$c2_d = esc_html($attributes['card2Desc'] ?? '');
?>
<section class="w-full bg-[#f9fafb]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
        <?php if ($section_h) : ?>
            <h2 class="mx-auto max-w-[979px] text-center font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo $section_h; ?></h2>
        <?php endif; ?>
        <?php if ($section_d) : ?>
            <p class="mx-auto mt-10 max-w-[1031px] text-center font-roboto text-[18px] leading-[28px] text-[#364153]"><?php echo $section_d; ?></p>
        <?php endif; ?>
        <div class="mt-10 grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-6">
            <article class="h-full border-2 border-[#ff5c00] bg-white px-[34px] pb-[34px] pt-[34px]">
                <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo $c1_h; ?></h3>
                <p class="mt-4 font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo $c1_d; ?></p>
            </article>
            <article class="h-full border-2 border-[#ff5c00] bg-white px-[34px] pb-[34px] pt-[34px]">
                <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-[#020202]"><?php echo $c2_h; ?></h3>
                <p class="mt-4 font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo $c2_d; ?></p>
            </article>
        </div>
    </div>
</section>
