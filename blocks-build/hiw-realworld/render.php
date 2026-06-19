<?php
/**
 * Render: goliath/hiw-realworld
 *
 * @var array $attributes
 */

$realworld_h2        = $attributes['realworldH2'] ?? 'Installed in Real-World Environments';
$realworld_intro     = $attributes['realworldIntro'] ?? 'Goliath™ is fitted directly onto existing racking and is installed at ground-level impact zones.';
$realworld_list_intro = $attributes['realworldListIntro'] ?? 'You\'ll see it in places like:';
$realworld_items     = $attributes['realworldItems'] ?? ['Distribution centres', 'Logistics operations', 'Retail warehouses', 'Manufacturing facilities', 'Cold stores', 'Document storage warehouses'];
$realworld_closing   = $attributes['realworldClosing'] ?? 'Once it is installed, it becomes a part of the upright that provides continuous protection without affecting daily operations.';

$compliance_h2      = $attributes['complianceH2'] ?? 'Built to Support Compliance';
$compliance_intro   = $attributes['complianceIntro'] ?? 'Goliath™ aligns with recognised UK standards:';
$compliance_items   = $attributes['complianceItems'] ?? ['BS EN 15512', 'BS EN 15635', 'SEMA guidelines'];
$compliance_closing = $attributes['complianceClosing'] ?? 'By reinforcing damaged uprights, our permanent upright repair helps maintain structural integrity and supports ongoing inspection requirements.';
?>
<section class="w-full bg-white">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-10 px-5 py-10 lg:flex-row lg:items-center lg:justify-center lg:gap-[100px] lg:px-[68px] lg:py-[55px]">
        <div class="flex w-full flex-col gap-[28px] lg:h-[432px] lg:w-[538px] lg:shrink-0">
            <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html( $realworld_h2 ); ?>
            </h2>
            <div class="max-w-[525px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                <p><?php echo esc_html( $realworld_intro ); ?></p>
                <p class="mt-2"><?php echo esc_html( $realworld_list_intro ); ?></p>
                <ul class="mt-1 list-none">
                    <?php foreach ( $realworld_items as $item ) : ?>
                        <li><span aria-hidden="true">+</span> <?php echo esc_html( $item ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <p class="mt-2"><?php echo esc_html( $realworld_closing ); ?></p>
            </div>
        </div>
        <div class="flex w-full flex-col gap-[28px] lg:h-[432px] lg:w-[538px] lg:shrink-0">
            <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html( $compliance_h2 ); ?>
            </h2>
            <div class="max-w-[525px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                <p><?php echo esc_html( $compliance_intro ); ?></p>
                <ul class="mt-1 list-none">
                    <?php foreach ( $compliance_items as $item ) : ?>
                        <li><span aria-hidden="true">+</span> <?php echo esc_html( $item ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <p class="mt-2"><?php echo esc_html( $compliance_closing ); ?></p>
            </div>
        </div>
    </div>
</section>
