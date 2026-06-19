<?php
/*
Template Name: About Page
*/
get_header();
// If this page has Gutenberg blocks, render the block editor content.
// Otherwise the existing template below is used unchanged.
$_current_page = get_queried_object();
if ($_current_page instanceof WP_Post && has_blocks($_current_page)) {
    setup_postdata($_current_page);
    echo "<main class=\"w-full bg-white overflow-x-hidden\">";
    the_content();
    echo "</main>";
    wp_reset_postdata();
    get_footer();
    return;
}

$assets = [
    'cta_arrow' => get_theme_file_uri('assets/images/icons/cta-arrow-right.svg'),
];

$team_members = get_option('my_theme_about_team_members', []);
if (! is_array($team_members) || $team_members === []) {
    $team_members = [
        [
            'name'           => 'Company Director',
            'role'           => 'Managing Director',
            'qualifications' => 'SEMA Approved Racking Inspector',
            'bio'            => 'With extensive experience in warehouse racking safety and repair, our managing director founded Goliath with a mission to end the costly cycle of upright replacement.',
            'photo'          => '',
        ],
    ];
}

$credentials = [
    ['title' => 'SEMA Approved', 'desc' => 'Qualified racking inspectors registered with the Storage Equipment Manufacturers\' Association'],
    ['title' => 'BS EN 15512', 'desc' => 'Steel static storage systems — Adjustable pallet racking principles for structural design'],
    ['title' => 'BS EN 15635', 'desc' => 'Steel static storage systems — Application and maintenance of storage equipment'],
    ['title' => 'Registered Design', 'desc' => 'Design registration protected — available exclusively through Goliath in the UK and EU'],
];
?>

<main class="w-full bg-white overflow-x-hidden">

    <!-- Hero -->
    <section class="relative w-full h-auto lg:h-[400px] hero-gradient-bg">
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-4 lg:h-[223px] lg:justify-between lg:gap-0">
                <p class="font-montserrat text-[16px] font-medium leading-[24px] tracking-[0.07px] text-[#ff5c00]">
                    <?php echo esc_html(get_option('my_theme_about_hero_badge', 'WHO WE ARE')); ?>
                </p>
                <h1 class="font-montserrat text-[28px] font-bold leading-[36px] text-white sm:text-[36px] sm:leading-[44px] md:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <?php echo esc_html(get_option('my_theme_about_hero_h1', 'About Goliath™')); ?>
                </h1>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    <?php echo esc_html(get_option('my_theme_about_hero_desc', 'The team behind the UK\'s only permanent pallet racking upright repair system. SEMA-qualified engineers dedicated to ending the cycle of costly racking replacement.')); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section class="w-full bg-white py-10 lg:py-[80px]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 sm:px-6 lg:gap-[48px] lg:px-[68px]">
            <div class="max-w-[900px]">
                <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_about_story_h2', 'Our Story')); ?>
                </h2>
            </div>
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-[60px]">
                <div class="space-y-5 font-roboto text-[18px] font-normal leading-[28px] text-[#4a5565]">
                    <p><?php echo esc_html(get_option('my_theme_about_story_p1', 'Goliath was founded with a clear mission: to provide warehouse operators with a permanent, cost-effective alternative to repeated racking upright replacement. Our engineered steel repair system was developed to address one of the most persistent problems in warehouse maintenance.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_about_story_p2', 'Working closely with structural engineers and guided by UK safety standards including BS EN 15512 and BS EN 15635, we created a repair solution that does not just restore uprights to their original strength but reinforces them against future impact.')); ?></p>
                </div>
                <div class="space-y-5 font-roboto text-[18px] font-normal leading-[28px] text-[#4a5565]">
                    <p><?php echo esc_html(get_option('my_theme_about_story_p3', 'Every member of our installation team holds SEMA-approved racking inspector qualifications. We believe that the people who repair your racking should be qualified to inspect it first, ensuring every repair meets the highest safety standards.')); ?></p>
                    <p><?php echo esc_html(get_option('my_theme_about_story_p4', 'Today, Goliath is trusted by leading UK retailers and logistics operators. Our system is being rolled out across hundreds of warehouse sites, protecting the racking infrastructure that businesses depend on every day.')); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission -->
    <section class="w-full bg-[#f9fafb] py-10 lg:py-[60px]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-6 px-5 text-center sm:px-6 lg:px-[68px]">
            <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html(get_option('my_theme_about_mission_h2', 'Our Mission')); ?>
            </h2>
            <p class="max-w-[800px] font-roboto text-[20px] font-normal leading-[32px] text-[#4a5565]">
                <?php echo esc_html(get_option('my_theme_about_mission_text', 'To end the costly cycle of racking upright replacement by providing permanent, engineered repairs that improve safety, reduce downtime, and lower long-term maintenance costs for every warehouse we serve.')); ?>
            </p>
        </div>
    </section>

    <!-- Leadership -->
    <section class="w-full bg-white py-10 lg:py-[80px]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 sm:px-6 lg:gap-[48px] lg:px-[68px]">
            <div class="text-center">
                <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_about_leader_h2', 'Leadership')); ?>
                </h2>
                <p class="mt-3 font-roboto text-[18px] font-normal leading-[28px] text-[#4a5565]">
                    <?php echo esc_html(get_option('my_theme_about_leader_subtitle', 'Qualified professionals with deep expertise in warehouse racking safety and structural engineering.')); ?>
                </p>
            </div>

            <div class="flex flex-col items-center gap-8 lg:flex-row lg:items-start lg:gap-[60px]">
                <?php
                $leader_photo = my_theme_get_image_url('my_theme_about_leader_photo', get_theme_file_uri('assets/images/icons/Goliath_logo_fullcolor.svg'));
                ?>
                <div class="w-full max-w-[320px] shrink-0">
                    <div class="aspect-[3/4] w-full overflow-hidden bg-[#f3f4f6]">
                        <img
                            src="<?php echo esc_url($leader_photo); ?>"
                            alt="<?php echo esc_attr(get_option('my_theme_about_leader_name', 'Managing Director')); ?>"
                            class="h-full w-full object-cover"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-4">
                    <h3 class="font-montserrat text-[24px] font-bold leading-[32px] text-[#020202] lg:text-[28px]">
                        <?php echo esc_html(get_option('my_theme_about_leader_name', 'Managing Director')); ?>
                    </h3>
                    <p class="font-montserrat text-[16px] font-semibold leading-[24px] text-[#ff5c00]">
                        <?php echo esc_html(get_option('my_theme_about_leader_role', 'Founder & Managing Director')); ?>
                    </p>
                    <p class="font-roboto text-[14px] font-medium leading-[22px] text-[#364153]">
                        <?php echo esc_html(get_option('my_theme_about_leader_qualifications', 'SEMA Approved Racking Inspector')); ?>
                    </p>
                    <div class="space-y-4 font-roboto text-[18px] font-normal leading-[28px] text-[#4a5565]">
                        <p><?php echo esc_html(get_option('my_theme_about_leader_bio_p1', 'With extensive experience in warehouse racking safety and structural repair, our managing director identified a fundamental flaw in the traditional approach to racking maintenance: the endless cycle of damage, replacement, and repeat damage.')); ?></p>
                        <p><?php echo esc_html(get_option('my_theme_about_leader_bio_p2', 'This insight led to the development of the Goliath repair system, engineered to not only restore damaged uprights but to reinforce them against future impact. Every installation is backed by a lifetime warranty because we stand behind the quality of our work.')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->
    <?php if (count($team_members) > 0) : ?>
    <section class="w-full bg-[#f9fafb] py-10 lg:py-[80px]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 sm:px-6 lg:gap-[48px] lg:px-[68px]">
            <div class="text-center">
                <h2 class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                    <?php echo esc_html(get_option('my_theme_about_team_h2', 'Our Team')); ?>
                </h2>
                <p class="mt-3 font-roboto text-[18px] font-normal leading-[28px] text-[#4a5565]">
                    <?php echo esc_html(get_option('my_theme_about_team_subtitle', 'SEMA-qualified inspectors and engineers delivering safe, permanent racking repairs across the UK.')); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($team_members as $member) :
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
    <?php endif; ?>

    <!-- Credentials -->
    <section class="w-full bg-[#020202] py-10 lg:py-[60px]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 sm:px-6 lg:px-[68px]">
            <h2 class="text-center font-montserrat text-[28px] font-bold leading-[40px] text-white lg:text-[36px]">
                <?php echo esc_html(get_option('my_theme_about_creds_h2', 'Our Credentials')); ?>
            </h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($credentials as $cred) : ?>
                    <div class="flex flex-col gap-3 border-l-2 border-[#ff5c00] pl-5">
                        <h3 class="font-montserrat text-[18px] font-bold leading-[26px] text-white">
                            <?php echo esc_html($cred['title']); ?>
                        </h3>
                        <p class="font-roboto text-[14px] font-normal leading-[22px] text-white/70">
                            <?php echo esc_html($cred['desc']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="w-full bg-[#ff5c00] py-14 lg:py-[80px]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-8 px-5 text-center sm:px-6 lg:px-[267px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-white lg:text-[42px] lg:leading-[52px]">
                <?php echo esc_html(get_option('my_theme_about_cta_h2', 'Work with a team you can trust')); ?>
            </h2>
            <p class="max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-white">
                <?php echo esc_html(get_option('my_theme_about_cta_desc', 'Our SEMA-qualified team is ready to assess your warehouse racking and provide a permanent repair solution backed by a lifetime warranty.')); ?>
            </p>
            <div class="flex flex-col gap-4 sm:flex-row sm:gap-[16px]">
                <a
                    href="<?php echo esc_url(home_url('/contact/')); ?>"
                    class="inline-flex h-[60px] items-center bg-[#020202] px-[32px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-[#1a1a1a]"
                >
                    <span><?php echo esc_html(get_option('my_theme_about_cta_primary', 'Get free assessment')); ?></span>
                    <img src="<?php echo esc_url($assets['cta_arrow']); ?>" alt="" class="ml-3 size-5 shrink-0" width="20" height="20" aria-hidden="true">
                </a>
                <a
                    href="<?php echo esc_url(home_url('/case-studies/')); ?>"
                    class="inline-flex h-[60px] items-center border-2 border-white px-[32px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:bg-white/10"
                >
                    <?php echo esc_html(get_option('my_theme_about_cta_secondary', 'View case studies')); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
