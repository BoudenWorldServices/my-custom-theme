<?php
/**
 * Block: goliath/about-credentials
 * About – Credentials — dark four-column credentials grid.
 */

$heading     = $attributes['heading'] ?? 'Our Credentials';
$credentials = $attributes['credentials'] ?? [
    [
        'title' => 'Bureau Veritas certified',
        'desc'  => 'Independently tested and verified by Bureau Veritas. Certified not to alter the original racking bay design.',
    ],
    [
        'title' => 'Fully insured',
        'desc'  => 'Installations are fully insured, giving warehouse operators additional peace of mind.',
    ],
    [
        'title' => 'Lifetime warranty',
        'desc'  => 'Every repair is backed by a warranty that lasts a lifetime.',
    ],
    [
        'title' => 'Registered Design',
        'desc'  => 'Goliath is a registered design, protected intellectual property available exclusively through our network.',
    ],
];
$credentials = my_theme_filter_standards_cards(is_array($credentials) ? $credentials : []);
$cred_count  = count($credentials);
$cred_grid   = $cred_count <= 2
    ? 'grid grid-cols-1 gap-6 sm:grid-cols-2'
    : ($cred_count === 3 ? 'grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3' : 'grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4');
?>
<section class="w-full bg-[#020202] py-10 lg:py-[60px]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 sm:px-6 lg:px-[68px]">
        <h2 class="text-center font-montserrat text-[28px] font-bold leading-[40px] text-white lg:text-[36px]">
            <?php echo esc_html($heading); ?>
        </h2>
        <div class="<?php echo esc_attr($cred_grid); ?>">
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
