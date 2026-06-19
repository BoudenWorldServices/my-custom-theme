<?php
/**
 * Goliath Content Editor — Homepage admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

function my_theme_admin_homepage_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-content') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_hp_hero_h1'                 => 'text',
        'my_theme_hp_hero_tagline_1'          => 'text',
        'my_theme_hp_hero_tagline_2'          => 'text',
        'my_theme_hp_hero_cta_text'           => 'text',
        'my_theme_hp_hero_cta_url'            => 'text',
        'my_theme_hp_hero_secondary_cta_text' => 'text',

        'my_theme_hp_process_heading'         => 'text',
        'my_theme_hp_process_subheading'      => 'text',
        'my_theme_hp_process_accent'          => 'text',
        'my_theme_hp_process_body_1'          => 'textarea',
        'my_theme_hp_process_body_2'          => 'textarea',
        'my_theme_hp_process_steps'           => 'repeater_generic',

        'my_theme_hp_preview_eyebrow'         => 'text',
        'my_theme_hp_preview_heading'         => 'text',
        'my_theme_hp_preview_col1'            => 'html',
        'my_theme_hp_preview_col2'            => 'html',

        'my_theme_hp_solution_eyebrow'        => 'text',
        'my_theme_hp_solution_badge'          => 'text',
        'my_theme_hp_solution_heading'        => 'text',
        'my_theme_hp_solution_intro'          => 'textarea',
        'my_theme_hp_solution_benefits'       => 'repeater_generic',
        'my_theme_hp_promise_title'           => 'text',
        'my_theme_hp_promise_quote'           => 'textarea',

        'my_theme_hp_advantages_eyebrow'      => 'text',
        'my_theme_hp_advantages_heading'      => 'text',
        'my_theme_hp_advantages_intro'        => 'textarea',

        'my_theme_hp_casestudy_eyebrow'       => 'text',
        'my_theme_hp_casestudy_heading'       => 'textarea',
        'my_theme_hp_casestudy_body'          => 'textarea',

        'my_theme_hp_kpi_eyebrow'             => 'text',
        'my_theme_hp_kpi_heading'             => 'text',
        'my_theme_hp_kpi_subheading'          => 'text',

        'my_theme_hp_expert_headline'         => 'textarea',
        'my_theme_hp_expert_badge'            => 'text',
        'my_theme_hp_expert_cta_1_text'       => 'text',
        'my_theme_hp_expert_cta_2_text'       => 'text',

        'my_theme_hp_performance_heading'     => 'text',
        'my_theme_hp_performance_intro'       => 'textarea',
        'my_theme_hp_performance_bullets'     => 'textarea',
        'my_theme_hp_performance_closing'     => 'textarea',

        'my_theme_hp_dent_eyebrow'            => 'text',
        'my_theme_hp_dent_heading'            => 'text',
        'my_theme_hp_dent_stat'               => 'text',
        'my_theme_hp_dent_body'               => 'textarea',
        'my_theme_hp_dent_cta_text'           => 'text',

        'my_theme_hp_contact_heading_1'       => 'text',
        'my_theme_hp_contact_heading_2'       => 'text',
        'my_theme_hp_contact_intro'           => 'textarea',
        'my_theme_hp_contact_location_label'  => 'text',
        'my_theme_hp_contact_submit_text'     => 'text',
        'my_theme_hp_contact_privacy_note'    => 'text',

        'my_theme_hp_timer_eyebrow'           => 'text',
        'my_theme_hp_timer_heading'           => 'textarea',
        'my_theme_hp_timer_compat'            => 'text',

        'my_theme_hp_hero_slide1'             => 'image',
        'my_theme_hp_hero_slide2'             => 'image',
        'my_theme_hp_hero_slide3'             => 'image',
        'my_theme_hp_hero_video1'             => 'text',
        'my_theme_hp_hero_video2'             => 'text',
        'my_theme_hp_hero_video3'             => 'text',
        'my_theme_hp_timer_video'             => 'text',
        'my_theme_hp_review_img1'             => 'image',
        'my_theme_hp_review_img2'             => 'image',
        'my_theme_hp_review_img3'             => 'image',
        'my_theme_hp_solution_img'            => 'image',
        'my_theme_hp_casestudy_img1'          => 'image',
        'my_theme_hp_casestudy_img2'          => 'image',
        'my_theme_hp_casestudy_img3'          => 'image',
        'my_theme_hp_dent_img'                => 'image',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_homepage_fields', 10, 2);

function my_theme_admin_render_homepage(): void
{
    my_theme_admin_page_open('Homepage', 'goliath-content');

    // Hero — Text
    my_theme_admin_section_open('Hero Section — Text', 'Main heading, taglines and call-to-action buttons.');
    my_theme_admin_text_field('my_theme_hp_hero_h1', 'Main Heading (H1)', 'Safe, Instant Repair for Damaged Uprights');
    my_theme_admin_text_field('my_theme_hp_hero_tagline_1', 'Tagline Line 1', 'Minimal Downtime, Maximum Safety');
    my_theme_admin_text_field('my_theme_hp_hero_tagline_2', 'Tagline Line 2', 'Lifetime Warranty');
    my_theme_admin_text_field('my_theme_hp_hero_cta_text', 'Primary CTA Text', 'Get Your Free Assessment');
    my_theme_admin_text_field('my_theme_hp_hero_cta_url', 'Primary CTA URL', '/contact/');
    my_theme_admin_text_field('my_theme_hp_hero_secondary_cta_text', 'Secondary CTA Text', 'View more');
    my_theme_admin_section_close();

    // Hero — Carousel Images (3 slides)
    my_theme_admin_section_open('Hero Carousel — Images', 'The three photo slides shown in the hero carousel.');
    my_theme_admin_image_field('my_theme_hp_hero_slide1', 'Carousel Photo 1', get_theme_file_uri('assets/images/Homepage/carousel-image1.webp'));
    my_theme_admin_image_field('my_theme_hp_hero_slide2', 'Carousel Photo 2', get_theme_file_uri('assets/images/Homepage/carousel-image2.webp'));
    my_theme_admin_image_field('my_theme_hp_hero_slide3', 'Carousel Photo 3', get_theme_file_uri('assets/images/Homepage/not-just-dent.webp'));
    my_theme_admin_section_close();

    // Hero — Carousel Videos (3 videos)
    my_theme_admin_section_open('Hero Carousel — Videos', 'The three videos shown in the hero carousel. Upload MP4 files via the media library.');
    my_theme_admin_video_field('my_theme_hp_hero_video1', 'Carousel Video 1 (explanation)', get_theme_file_uri('assets/videos/explanation-video.mp4'));
    my_theme_admin_video_field('my_theme_hp_hero_video2', 'Carousel Video 2', get_theme_file_uri('assets/videos/carousel-video1.mp4'));
    my_theme_admin_video_field('my_theme_hp_hero_video3', 'Carousel Video 3', get_theme_file_uri('assets/videos/carousel-video2.mp4'));
    my_theme_admin_section_close();

    // Timer Install Video
    my_theme_admin_section_open('Timer Install Video', 'The background video in the "30-minute install" banner section.');
    my_theme_admin_video_field('my_theme_hp_timer_video', 'Timer Install Video', get_theme_file_uri('assets/videos/Timer-install-video.mp4'));
    my_theme_admin_section_close();

    // Installation process
    my_theme_admin_section_open('Installation Process');
    my_theme_admin_text_field('my_theme_hp_process_heading', 'Section Heading', 'Installation process');
    my_theme_admin_text_field('my_theme_hp_process_subheading', 'Subheading', 'Fast, Easy, Guaranteed');
    my_theme_admin_text_field('my_theme_hp_process_accent', 'Accent Line', 'Unique solution to end the repetitive cycle of upright damage.');
    my_theme_admin_textarea_field('my_theme_hp_process_body_1', 'Body Paragraph 1', 'From assessment to installation to lifetime protection – we handle everything so you can focus on your business.');
    my_theme_admin_textarea_field('my_theme_hp_process_body_2', 'Body Paragraph 2', 'Our team can install GOLIATH™ in your warehouse in as little as 30 minutes.');

    $process_steps = get_option('my_theme_hp_process_steps');
    if (! is_array($process_steps) || empty($process_steps)) {
        $process_steps = [
            ['title' => 'Identify Damaged Upright', 'description' => 'Comprehensive evaluation of your racking system. Our expert team identifies all areas of concern and provides detailed recommendations.'],
            ['title' => 'Apply Fast, Permanent Repair', 'description' => 'Installation takes just 30 minutes per upright. Minimal disruption to your operations – get back to work quickly.'],
            ['title' => 'Lifetime Warranty Activated', 'description' => 'Your repair is covered forever. If any impact damage occurs, we replace the affected parts at no cost to you.'],
            ['title' => 'Peace of Mind Guaranteed', 'description' => 'Rest easy knowing your racking is safe, compliant, and protected. Focus on running your business, not worrying about safety.'],
        ];
    }

    $process_steps = my_theme_admin_repeater_open('my_theme_hp_process_steps', 'Process Steps', [], $process_steps);
    foreach ($process_steps as $i => $step) {
        my_theme_admin_repeater_row('my_theme_hp_process_steps', $i, [
            'title'       => ['label' => 'Step Title', 'type' => 'text', 'value' => $step['title'] ?? ''],
            'description' => ['label' => 'Step Description', 'type' => 'textarea', 'value' => $step['description'] ?? ''],
        ]);
    }
    my_theme_admin_repeater_close('my_theme_hp_process_steps', [
        'title'       => ['label' => 'Step Title', 'type' => 'text'],
        'description' => ['label' => 'Step Description', 'type' => 'textarea'],
    ]);
    my_theme_admin_section_close();

    // Preview section
    my_theme_admin_section_open('Preview Process Section');
    my_theme_admin_text_field('my_theme_hp_preview_eyebrow', 'Eyebrow', 'Preview Process');
    my_theme_admin_text_field('my_theme_hp_preview_heading', 'Heading', 'Racking upright repair built to last');
    my_theme_admin_wysiwyg_field('my_theme_hp_preview_col1', 'Left Column Content', '<p><strong style="color:#ff5c00;">Racking upright repair built to last</strong></p><p>Goliath™ is a permanent racking upright repair that stops repeat damage and keeps your warehouse operating safely.</p><p>Installed in minutes. Built to withstand impact.</p><p><strong style="color:#ff5c00;">Why Goliath™? (Money saving proposition)</strong></p><p>When warehouse racking damage happens, you know it is not a one-off issue. It is a cycle of hit, repair, and replacement happening continuously.</p>');
    my_theme_admin_wysiwyg_field('my_theme_hp_preview_col2', 'Right Column Content', '<p><strong style="color:#ff5c00;">Goliath is the Solution</strong></p><p>Our permanent racking upright repair system is a durable setup that is engineered to meet UK safety standards.</p><p>That means:</p><p>Never replace an upright again</p><p>Lower maintenance costs</p><p>Reduced operational disruption</p><p>Long lifespan for racking systems</p><p>Goliath™ doesn\'t offer a short-term fix. Ours is a long-term cost-saving solution.</p>');
    my_theme_admin_image_field('my_theme_hp_review_img1', 'Review Image 1', get_theme_file_uri('assets/images/Homepage/review-1.webp'));
    my_theme_admin_image_field('my_theme_hp_review_img2', 'Review Image 2', get_theme_file_uri('assets/images/Homepage/review-2.webp'));
    my_theme_admin_image_field('my_theme_hp_review_img3', 'Review Image 3', get_theme_file_uri('assets/images/Homepage/review-3.webp'));
    my_theme_admin_section_close();

    // Solution / peace of mind
    my_theme_admin_section_open('Solution / Peace of Mind');
    my_theme_admin_text_field('my_theme_hp_solution_eyebrow', 'Eyebrow', 'INSTALL ONCE,');
    my_theme_admin_text_field('my_theme_hp_solution_badge', 'Badge', 'Forever Protected');
    my_theme_admin_text_field('my_theme_hp_solution_heading', 'Heading', 'Protect for lifetime');
    my_theme_admin_textarea_field('my_theme_hp_solution_intro', 'Intro Paragraph', 'Every warehouse is a high-pressure environment. Tight deadlines, high traffic, and continuous forklift movement increase the risk of damage to warehouse racks.');
    my_theme_admin_image_field('my_theme_hp_solution_img', 'Main Image', get_theme_file_uri('assets/images/Homepage/installonce.webp'));
    my_theme_admin_text_field('my_theme_hp_promise_title', 'Promise Title', 'Goliath Promise');
    my_theme_admin_textarea_field('my_theme_hp_promise_quote', 'Promise Quote', '"We offer more than repairs. We deliver confidence, safety, and the certainty that your warehouse is protected for life."');

    $benefits = get_option('my_theme_hp_solution_benefits');
    if (! is_array($benefits) || empty($benefits)) {
        $benefits = [
            ['title' => 'Cost Savings That Add Up', 'description' => 'Install Goliath™ once and save thousands on your maintenance budgets and ongoing repairs. One of our clients, B&M, noted a reduction in their repair and maintenance costs.'],
            ['title' => 'Sustainability', 'description' => 'Traditional upright repairs mean more steel is used during continuous replacement. With Goliath, you fix it once.'],
            ['title' => 'Health & safety improvements', 'description' => "In areas where the upright takes the most damage, Goliath™'s engineered structure reduces the risk of damage significantly."],
            ['title' => 'Designed for durability', 'description' => 'Goliath™ is engineered for impact resistance in high-traffic warehouse environments.'],
        ];
    }

    $benefits = my_theme_admin_repeater_open('my_theme_hp_solution_benefits', 'Benefits', [], $benefits);
    foreach ($benefits as $i => $b) {
        my_theme_admin_repeater_row('my_theme_hp_solution_benefits', $i, [
            'title'       => ['label' => 'Title', 'type' => 'text', 'value' => $b['title'] ?? ''],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'value' => $b['description'] ?? ''],
        ]);
    }
    my_theme_admin_repeater_close('my_theme_hp_solution_benefits', [
        'title'       => ['label' => 'Title', 'type' => 'text'],
        'description' => ['label' => 'Description', 'type' => 'textarea'],
    ]);
    my_theme_admin_section_close();

    // 6 Advantages
    my_theme_admin_section_open('6 Reasons, 6 Advantages');
    my_theme_admin_text_field('my_theme_hp_advantages_eyebrow', 'Eyebrow', 'The Goliath Difference');
    my_theme_admin_text_field('my_theme_hp_advantages_heading', 'Heading', '6 Reasons, 6 Advantages');
    my_theme_admin_textarea_field('my_theme_hp_advantages_intro', 'Intro', "Your customers aren't buying a \"product\" – they're buying risk reduction and peace of mind.\nWe don't sell products. We serve you with a solid, durable solution to your problems backed by lifetime guarantees.");
    my_theme_admin_section_close();

    // Timer install banner
    my_theme_admin_section_open('Timer Install Banner');
    my_theme_admin_text_field('my_theme_hp_timer_eyebrow', 'Eyebrow', 'Never replace a racking upright again');
    my_theme_admin_textarea_field('my_theme_hp_timer_heading', 'Heading', 'Installed in less than 30 minutes, covered for life');
    my_theme_admin_text_field('my_theme_hp_timer_compat', 'Compatibility Line', 'Compatible with all UK and EU racking systems');
    my_theme_admin_section_close();

    // Case study
    my_theme_admin_section_open('Featured Case Study');
    my_theme_admin_text_field('my_theme_hp_casestudy_eyebrow', 'Eyebrow', 'Featured Case Study');
    my_theme_admin_textarea_field('my_theme_hp_casestudy_heading', 'Heading', 'UK leading retailer saved 70% on repairs in the first 12 months vs traditional replacement');
    my_theme_admin_textarea_field('my_theme_hp_casestudy_body', 'Body', 'As a result, Goliath is now being rolled out across all of their sites and is even being installed as standard for all new fit-out projects.');
    my_theme_admin_image_field('my_theme_hp_casestudy_img1', 'Case Study Image 1', get_theme_file_uri('assets/images/Homepage/case-study1.webp'));
    my_theme_admin_image_field('my_theme_hp_casestudy_img2', 'Case Study Image 2', get_theme_file_uri('assets/images/Homepage/case-study2.webp'));
    my_theme_admin_image_field('my_theme_hp_casestudy_img3', 'Case Study Image 3', get_theme_file_uri('assets/images/Homepage/case-study3.webp'));
    my_theme_admin_section_close();

    // KPIs
    my_theme_admin_section_open('KPI Section');
    my_theme_admin_text_field('my_theme_hp_kpi_eyebrow', 'Eyebrow', 'Proven Results');
    my_theme_admin_text_field('my_theme_hp_kpi_heading', 'Heading', 'Real Results, Real ROI');
    my_theme_admin_text_field('my_theme_hp_kpi_subheading', 'Subheading', 'Leading UK businesses trust Goliath to protect their warehouse infrastructure');
    my_theme_admin_section_close();

    // Expert CTA
    my_theme_admin_section_open('Expert Assessment CTA');
    my_theme_admin_textarea_field('my_theme_hp_expert_headline', 'Headline', 'Our SEMA qualified inspectors will assess your warehouse and demonstrate how Goliath can help you');
    my_theme_admin_text_field('my_theme_hp_expert_badge', 'Badge', 'Free Audit');
    my_theme_admin_text_field('my_theme_hp_expert_cta_1_text', 'CTA Button 1', 'Interested in GOLIATH™?');
    my_theme_admin_text_field('my_theme_hp_expert_cta_2_text', 'CTA Button 2', 'Book My Free Site Survey');
    my_theme_admin_section_close();

    // Performance
    my_theme_admin_section_open('Performance Section');
    my_theme_admin_text_field('my_theme_hp_performance_heading', 'Heading', 'Performance you can trust');
    my_theme_admin_textarea_field('my_theme_hp_performance_intro', 'Intro', 'Reliability is one of the most important factors that govern warehouse safety, efficiency, and profitability. With Goliath, you can expect:');
    my_theme_admin_textarea_field('my_theme_hp_performance_bullets', 'Bullet Points (one per line)', "+ Consistent protection against forklift impact across your warehouse\n+ Reduced repairs and replacements of uprights\n+ Improved structural integrity of racking systems\n+ Long-term cost savings across your operations");
    my_theme_admin_textarea_field('my_theme_hp_performance_closing', 'Closing Text', "From large distribution centres to growing logistics operations, Goliath™ is trusted by businesses who want to reduce downtime, improve safety, and ensure proper racking maintenance.\nGoliath™ is supported by a lifetime impact warranty, helping you rest in comfort that your investment is protected.");
    my_theme_admin_section_close();

    // Dent risk
    my_theme_admin_section_open('"It Is Not Just a Dent" Section');
    my_theme_admin_text_field('my_theme_hp_dent_eyebrow', 'Eyebrow', 'Explore the Features');
    my_theme_admin_text_field('my_theme_hp_dent_heading', 'Heading', 'It is not just a dent...');
    my_theme_admin_text_field('my_theme_hp_dent_stat', 'Stat Line', 'The Real Cost , Structural collapse risk increases by 60% with each unrepaired impact');
    my_theme_admin_textarea_field('my_theme_hp_dent_body', 'Body', "You deserve a solution that's fast, permanent, and guaranteed. Traditional repairs are temporary patches. Full replacements are expensive and disruptive. There has to be a better way.");
    my_theme_admin_text_field('my_theme_hp_dent_cta_text', 'CTA Text', 'Discover the Solution');
    my_theme_admin_image_field('my_theme_hp_dent_img', 'Dent Section Image', get_theme_file_uri('assets/images/Homepage/not-just-dent.webp'));
    my_theme_admin_section_close();

    // Contact form section
    my_theme_admin_section_open('Contact Form Section');
    my_theme_admin_text_field('my_theme_hp_contact_heading_1', 'Heading Line 1', 'Get Your Free');
    my_theme_admin_text_field('my_theme_hp_contact_heading_2', 'Heading Line 2', 'Consultation');
    my_theme_admin_textarea_field('my_theme_hp_contact_intro', 'Intro Text', 'Lifetime warranty, 30-minute installation, minimal downtime. Find out how Goliath can reduce your racking repair costs.');
    my_theme_admin_text_field('my_theme_hp_contact_location_label', 'Location Value', 'Serving UK & EU');
    my_theme_admin_text_field('my_theme_hp_contact_submit_text', 'Submit Button Text', 'Request Free Assessment');
    my_theme_admin_text_field('my_theme_hp_contact_privacy_note', 'Privacy Note', 'Your information is confidential and secure.');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
