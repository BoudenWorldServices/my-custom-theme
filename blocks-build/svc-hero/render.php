<?php
$white = esc_html($attributes['headingWhite'] ?? '');
$orange = esc_html($attributes['headingOrange'] ?? '');
$orange_first = !empty($attributes['orangeFirst']);
$desc = esc_html($attributes['description'] ?? '');
$compact = !empty($attributes['compact']);
$py = $compact ? 'lg:py-[96px]' : 'lg:py-[128px]';
?>
<section class="w-full bg-[#020202]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[75px] <?php echo $py; ?>">
        <h1 class="font-montserrat text-[40px] font-bold leading-[44px] text-white lg:text-[60px] lg:leading-[60px]">
            <?php if ($orange_first) : ?>
                <span class="text-[#ff5c00]"><?php echo $orange; ?> </span><span class="text-white"><?php echo $white; ?></span>
            <?php else : ?>
                <span class="text-white"><?php echo $white; ?> </span><span class="text-[#ff5c00]"><?php echo $orange; ?></span>
            <?php endif; ?>
        </h1>
        <?php if ($desc) : ?>
            <p class="mt-6 max-w-[896px] font-roboto text-[18px] leading-[28px] text-[#d1d5dc] lg:text-[20px]"><?php echo $desc; ?></p>
        <?php endif; ?>
    </div>
</section>
