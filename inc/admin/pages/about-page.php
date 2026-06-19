<?php
/**
 * Goliath Content Editor — About / Team page admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

function my_theme_admin_about_page_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-about-page') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_about_hero_badge'           => 'text',
        'my_theme_about_hero_h1'              => 'text',
        'my_theme_about_hero_desc'            => 'textarea',

        'my_theme_about_story_h2'             => 'text',
        'my_theme_about_story_p1'             => 'textarea',
        'my_theme_about_story_p2'             => 'textarea',
        'my_theme_about_story_p3'             => 'textarea',
        'my_theme_about_story_p4'             => 'textarea',

        'my_theme_about_mission_h2'           => 'text',
        'my_theme_about_mission_text'         => 'textarea',

        'my_theme_about_leader_h2'            => 'text',
        'my_theme_about_leader_subtitle'      => 'textarea',
        'my_theme_about_leader_name'          => 'text',
        'my_theme_about_leader_role'          => 'text',
        'my_theme_about_leader_qualifications' => 'text',
        'my_theme_about_leader_bio_p1'        => 'textarea',
        'my_theme_about_leader_bio_p2'        => 'textarea',
        'my_theme_about_leader_photo'         => 'image',

        'my_theme_about_team_h2'              => 'text',
        'my_theme_about_team_subtitle'        => 'textarea',
        'my_theme_about_team_members'         => 'repeater_team',

        'my_theme_about_creds_h2'             => 'text',

        'my_theme_about_cta_h2'              => 'text',
        'my_theme_about_cta_desc'            => 'textarea',
        'my_theme_about_cta_primary'         => 'text',
        'my_theme_about_cta_secondary'       => 'text',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_about_page_fields', 10, 2);

function my_theme_admin_render_about_page(): void
{
    my_theme_admin_page_open('About / Team Page', 'goliath-about-page');

    // Hero
    my_theme_admin_section_open('Hero Section', 'Top banner with badge, heading, and introduction. This page supports E-E-A-T signals for SEO.');
    my_theme_admin_text_field('my_theme_about_hero_badge', 'Badge Text', 'WHO WE ARE');
    my_theme_admin_text_field('my_theme_about_hero_h1', 'Heading (H1)', 'About Goliath™');
    my_theme_admin_textarea_field('my_theme_about_hero_desc', 'Description', 'The team behind the UK\'s only permanent pallet racking upright repair system. SEMA-qualified engineers dedicated to ending the cycle of costly racking replacement.', 3);
    my_theme_admin_section_close();

    // Our Story
    my_theme_admin_section_open('Our Story', 'Company background shown in a two-column layout.');
    my_theme_admin_text_field('my_theme_about_story_h2', 'Section Heading', 'Our Story');
    my_theme_admin_textarea_field('my_theme_about_story_p1', 'Paragraph 1 (left)', 'Goliath was founded with a clear mission: to provide warehouse operators with a permanent, cost-effective alternative to repeated racking upright replacement. Our engineered steel repair system was developed to address one of the most persistent problems in warehouse maintenance.', 4);
    my_theme_admin_textarea_field('my_theme_about_story_p2', 'Paragraph 2 (left)', 'Working closely with structural engineers and guided by UK safety standards including BS EN 15512 and BS EN 15635, we created a repair solution that does not just restore uprights to their original strength but reinforces them against future impact.', 4);
    my_theme_admin_textarea_field('my_theme_about_story_p3', 'Paragraph 3 (right)', 'Every member of our installation team holds SEMA-approved racking inspector qualifications. We believe that the people who repair your racking should be qualified to inspect it first, ensuring every repair meets the highest safety standards.', 4);
    my_theme_admin_textarea_field('my_theme_about_story_p4', 'Paragraph 4 (right)', 'Today, Goliath is trusted by leading UK retailers and logistics operators. Our system is being rolled out across hundreds of warehouse sites, protecting the racking infrastructure that businesses depend on every day.', 4);
    my_theme_admin_section_close();

    // Mission
    my_theme_admin_section_open('Mission Statement', 'Centred mission text between the story and leadership sections.');
    my_theme_admin_text_field('my_theme_about_mission_h2', 'Heading', 'Our Mission');
    my_theme_admin_textarea_field('my_theme_about_mission_text', 'Mission Text', 'To end the costly cycle of racking upright replacement by providing permanent, engineered repairs that improve safety, reduce downtime, and lower long-term maintenance costs for every warehouse we serve.', 3);
    my_theme_admin_section_close();

    // Leadership
    my_theme_admin_section_open('Leadership', 'Managing director profile. Name, role, qualifications, and bio are used in Person schema for E-E-A-T.');
    my_theme_admin_text_field('my_theme_about_leader_h2', 'Section Heading', 'Leadership');
    my_theme_admin_textarea_field('my_theme_about_leader_subtitle', 'Section Subtitle', 'Qualified professionals with deep expertise in warehouse racking safety and structural engineering.', 2);
    my_theme_admin_text_field('my_theme_about_leader_name', 'Name', 'Managing Director');
    my_theme_admin_text_field('my_theme_about_leader_role', 'Job Title', 'Founder & Managing Director');
    my_theme_admin_text_field('my_theme_about_leader_qualifications', 'Qualifications', 'SEMA Approved Racking Inspector');
    my_theme_admin_textarea_field('my_theme_about_leader_bio_p1', 'Bio Paragraph 1', 'With extensive experience in warehouse racking safety and structural repair, our managing director identified a fundamental flaw in the traditional approach to racking maintenance: the endless cycle of damage, replacement, and repeat damage.', 4);
    my_theme_admin_textarea_field('my_theme_about_leader_bio_p2', 'Bio Paragraph 2', 'This insight led to the development of the Goliath repair system, engineered to not only restore damaged uprights but to reinforce them against future impact. Every installation is backed by a lifetime warranty because we stand behind the quality of our work.', 4);
    my_theme_admin_image_field('my_theme_about_leader_photo', 'Photo');
    my_theme_admin_section_close();

    // Team Members
    my_theme_admin_section_open('Team Members', 'Add team members below. Each person\'s name, role, and qualifications appear in Person schema for SEO (E-E-A-T signals).');
    my_theme_admin_text_field('my_theme_about_team_h2', 'Section Heading', 'Our Team');
    my_theme_admin_textarea_field('my_theme_about_team_subtitle', 'Section Subtitle', 'SEMA-qualified inspectors and engineers delivering safe, permanent racking repairs across the UK.', 2);

    $team = get_option('my_theme_about_team_members');
    if (! is_array($team) || $team === []) {
        $team = [
            [
                'name'           => 'Company Director',
                'role'           => 'Managing Director',
                'qualifications' => 'SEMA Approved Racking Inspector',
                'bio'            => 'With extensive experience in warehouse racking safety and repair, our managing director founded Goliath with a mission to end the costly cycle of upright replacement.',
                'photo'          => '',
            ],
        ];
    }

    $team = my_theme_admin_repeater_open('my_theme_about_team_members', 'Team Members', [], $team);

    foreach ($team as $i => $member) {
        my_theme_admin_repeater_row('my_theme_about_team_members', $i, [
            'name' => [
                'label' => 'Full Name',
                'type'  => 'text',
                'value' => $member['name'] ?? '',
            ],
            'role' => [
                'label' => 'Job Title / Role',
                'type'  => 'text',
                'value' => $member['role'] ?? '',
            ],
            'qualifications' => [
                'label' => 'Qualifications (e.g. SEMA Approved)',
                'type'  => 'text',
                'value' => $member['qualifications'] ?? '',
            ],
            'bio' => [
                'label' => 'Short Bio',
                'type'  => 'textarea',
                'value' => $member['bio'] ?? '',
            ],
            'photo' => [
                'label' => 'Photo',
                'type'  => 'image',
                'value' => $member['photo'] ?? '',
            ],
        ]);
    }

    my_theme_admin_repeater_close('my_theme_about_team_members', [
        'name'           => ['label' => 'Full Name', 'type' => 'text'],
        'role'           => ['label' => 'Job Title / Role', 'type' => 'text'],
        'qualifications' => ['label' => 'Qualifications', 'type' => 'text'],
        'bio'            => ['label' => 'Short Bio', 'type' => 'textarea'],
        'photo'          => ['label' => 'Photo', 'type' => 'image'],
    ]);

    my_theme_admin_section_close();

    // Credentials
    my_theme_admin_section_open('Credentials Bar', 'Dark section listing certifications. Content is hardcoded from schema data.');
    my_theme_admin_text_field('my_theme_about_creds_h2', 'Section Heading', 'Our Credentials');
    my_theme_admin_section_close();

    // CTA
    my_theme_admin_section_open('Call to Action', 'Orange bottom CTA section.');
    my_theme_admin_text_field('my_theme_about_cta_h2', 'Heading', 'Work with a team you can trust');
    my_theme_admin_textarea_field('my_theme_about_cta_desc', 'Description', 'Our SEMA-qualified team is ready to assess your warehouse racking and provide a permanent repair solution backed by a lifetime warranty.', 3);
    my_theme_admin_text_field('my_theme_about_cta_primary', 'Primary Button Text', 'Get free assessment');
    my_theme_admin_text_field('my_theme_about_cta_secondary', 'Secondary Button Text', 'View case studies');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
