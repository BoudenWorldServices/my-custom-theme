<?php
/**
 * Block: goliath/wg-future-costs
 * Why Goliath – Future Costs — grey band section with icon, heading, paragraphs, and bullet list.
 */

$heading = $attributes['heading'] ?? 'The Right Way to Save Future Costs';
$p1      = $attributes['p1']      ?? 'Choosing to replace uprights every time they are damaged is the most expensive solution.';
$p2      = $attributes['p2']      ?? 'This is because every replacement involves:';
$bullets = $attributes['bullets'] ?? ['New materials', 'Labour and installation costs', 'Disruptions to warehouse operations', 'Loss of storage capacity under certain conditions'];
$p3      = $attributes['p3']      ?? 'Goliath™ reduces that recurring expense by strengthening the uprights and preventing repeat damage in the same location. By doing this, there is a reduced need for future repairs.';
$p4      = $attributes['p4']      ?? 'That means lower maintenance costs, fewer repair runs, and better budget control.';
?>
<section class="w-full bg-[#f9fafb]" aria-labelledby="future-costs-heading">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[112px]">
        <div class="flex w-full max-w-[808px] flex-col items-start gap-5 text-left lg:gap-6">
            <img
                src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-zig.svg')); ?>"
                alt=""
                class="size-12 shrink-0 sm:size-14 [transform:scaleY(-1)]"
                width="56"
                height="56"
                aria-hidden="true"
            >
            <h2 id="future-costs-heading" class="font-montserrat text-[28px] font-bold leading-[36px] text-[#020202] sm:leading-[40px] lg:text-[36px] lg:leading-[44px]">
                <?php echo esc_html($heading); ?>
            </h2>
            <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                <?php echo esc_html($p1); ?>
            </p>
            <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                <?php echo esc_html($p2); ?>
            </p>
            <ul class="flex w-full flex-col gap-3 lg:gap-4">
                <?php foreach ($bullets as $item) : ?>
                    <li class="flex w-full items-start gap-3">
                        <img
                            src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/why-goliath-bullet-dark.svg')); ?>"
                            alt=""
                            class="mt-0.5 size-6 shrink-0"
                            width="24"
                            height="24"
                            aria-hidden="true"
                        >
                        <span class="font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($item); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                <?php echo esc_html($p3); ?>
            </p>
            <p class="w-full font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                <?php echo esc_html($p4); ?>
            </p>
        </div>
    </div>
</section>
