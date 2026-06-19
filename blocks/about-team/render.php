<?php
/**
 * Block: goliath/about-team
 * About – Our Team — three-column team member card grid.
 * Falls back to the my_theme_about_team_members option when the members attribute is empty.
 */

$heading  = $attributes['heading']  ?? 'Our Team';
$subtitle = $attributes['subtitle'] ?? 'SEMA-qualified inspectors and engineers delivering safe, permanent racking repairs across the UK.';

$members = $attributes['members'] ?? [];

if (! is_array($members) || $members === []) {
    $members = get_option('my_theme_about_team_members', []);
}

if (! is_array($members) || $members === []) {
    $members = [
        [
            'name'  => 'Company Director',
            'role'  => 'Managing Director',
            'photo' => '',
        ],
    ];
}

if (empty($members)) {
    return;
}
?>
<section class="w-full bg-[#f9fafb] py-10 lg:py-[80px]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 sm:px-6 lg:gap-[48px] lg:px-[68px]">
        <div class="text-center">
            <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html($heading); ?>
            </h2>
            <p class="mt-3 font-roboto text-[18px] font-normal leading-[28px] text-[#4a5565]">
                <?php echo esc_html($subtitle); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($members as $member) :
                $photo_url = '';
                $photo_val = $member['photo'] ?? '';
                if (is_numeric($photo_val) && (int) $photo_val > 0) {
                    $photo_url = wp_get_attachment_image_url((int) $photo_val, 'medium') ?: '';
                } elseif (is_string($photo_val) && $photo_val !== '') {
                    $photo_url = $photo_val;
                }
            ?>
                <div class="flex flex-col bg-white p-6">
                    <?php if ($photo_url !== '') : ?>
                        <div class="mb-4 aspect-square w-full overflow-hidden bg-[#f3f4f6]">
                            <img
                                src="<?php echo esc_url($photo_url); ?>"
                                alt="<?php echo esc_attr($member['name'] ?? ''); ?>"
                                class="h-full w-full object-cover"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    <?php else : ?>
                        <div class="mb-4 flex aspect-square w-full items-center justify-center bg-[#f3f4f6]">
                            <span class="dashicons dashicons-businessperson text-[60px] text-[#d1d5db]"></span>
                        </div>
                    <?php endif; ?>
                    <h3 class="font-montserrat text-[20px] font-bold leading-[28px] text-[#020202]">
                        <?php echo esc_html($member['name'] ?? 'Team Member'); ?>
                    </h3>
                    <p class="mt-1 font-montserrat text-[14px] font-semibold leading-[22px] text-[#ff5c00]">
                        <?php echo esc_html($member['role'] ?? ''); ?>
                    </p>
                    <?php if (! empty($member['qualifications'])) : ?>
                        <p class="mt-1 font-roboto text-[13px] font-medium leading-[20px] text-[#364153]">
                            <?php echo esc_html($member['qualifications']); ?>
                        </p>
                    <?php endif; ?>
                    <?php if (! empty($member['bio'])) : ?>
                        <p class="mt-3 font-roboto text-[15px] font-normal leading-[24px] text-[#4a5565]">
                            <?php echo esc_html($member['bio']); ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
