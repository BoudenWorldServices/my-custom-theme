<?php
/**
 * Block: goliath/about-credentials
 * About – Credentials — dark four-column credentials grid.
 */

$heading     = $attributes['heading'] ?? 'Our Credentials';
$credentials = $attributes['credentials'] ?? [
    [
        'title' => 'SEMA Approved',
        'desc'  => 'Our repair system is approved by the Storage Equipment Manufacturers\' Association, the UK\'s leading authority on storage systems.',
    ],
    [
        'title' => 'BS EN 15512',
        'desc'  => 'Goliath meets the structural design requirements for adjustable pallet racking systems as defined by this European standard.',
    ],
    [
        'title' => 'BS EN 15635',
        'desc'  => 'Our solution aligns with the application and maintenance requirements for steel static storage systems.',
    ],
    [
        'title' => 'Registered Design',
        'desc'  => 'Goliath is a registered design, protected intellectual property available exclusively through our network.',
    ],
];
?>
<section class="w-full bg-[#020202] py-10 lg:py-[60px]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 sm:px-6 lg:px-[68px]">
        <h2 class="text-center font-montserrat text-[28px] font-bold leading-[40px] text-white lg:text-[36px]">
            <?php echo esc_html($heading); ?>
        </h2>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($credentials as $cred) : ?>
                <div class="flex flex-col gap-3 border-l-2 border-[#ff5c00] pl-5">
                    <h3 class="font-montserrat text-[18px] font-bold leading-[26px] text-white">
                        <?php echo esc_html($cred['title'] ?? ''); ?>
                    </h3>
                    <p class="font-roboto text-[14px] font-normal leading-[22px] text-white/70">
                        <?php echo esc_html($cred['desc'] ?? ''); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
