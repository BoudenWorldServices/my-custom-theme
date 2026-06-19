<?php
declare(strict_types=1);
defined('ABSPATH') || exit;

/**
 * Goliath Content Editor – Services admin page.
 *
 * Registers editable fields for the services overview page and all 5 individual
 * service detail pages (Racking Upright Repair, Damage Prevention, Annual
 * Inspections, Installations & CDM, Reconfiguration).
 *
 * @package MyCustomTheme\Admin
 */

function my_theme_admin_services_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-services') {
        return $defs;
    }

    return array_merge($defs, [
        // ─── Services Overview ───────────────────────────────────────
        'my_theme_svc_hero_badge'             => 'text',
        'my_theme_svc_hero_h1'                => 'text',
        'my_theme_svc_hero_desc'              => 'textarea',
        'my_theme_svc_hero_cta1'              => 'text',
        'my_theme_svc_hero_cta2'              => 'text',
        'my_theme_svc_built_h2'               => 'text',
        'my_theme_svc_built_h3'               => 'text',
        'my_theme_svc_built_desc'             => 'textarea',
        'my_theme_svc_before_img'             => 'image',
        'my_theme_svc_after_img'              => 'image',
        'my_theme_svc_feat1_title'            => 'text',
        'my_theme_svc_feat1_desc'             => 'textarea',
        'my_theme_svc_feat2_title'            => 'text',
        'my_theme_svc_feat2_desc'             => 'textarea',
        'my_theme_svc_feat3_title'            => 'text',
        'my_theme_svc_feat3_desc'             => 'textarea',
        'my_theme_svc_feat4_title'            => 'text',
        'my_theme_svc_feat4_desc'             => 'textarea',
        'my_theme_svc_comp_h2'                => 'text',
        'my_theme_svc_comp_desc'              => 'textarea',
        'my_theme_svc_comp_row1_left_title'   => 'text',
        'my_theme_svc_comp_row1_left_desc'    => 'text',
        'my_theme_svc_comp_row1_right_title'  => 'text',
        'my_theme_svc_comp_row1_right_desc'   => 'text',
        'my_theme_svc_comp_row2_left_title'   => 'text',
        'my_theme_svc_comp_row2_left_desc'    => 'text',
        'my_theme_svc_comp_row2_right_title'  => 'text',
        'my_theme_svc_comp_row2_right_desc'   => 'text',
        'my_theme_svc_comp_row3_left_title'   => 'text',
        'my_theme_svc_comp_row3_left_desc'    => 'text',
        'my_theme_svc_comp_row3_right_title'  => 'text',
        'my_theme_svc_comp_row3_right_desc'   => 'text',
        'my_theme_svc_comp_row4_left_title'   => 'text',
        'my_theme_svc_comp_row4_left_desc'    => 'text',
        'my_theme_svc_comp_row4_right_title'  => 'text',
        'my_theme_svc_comp_row4_right_desc'   => 'text',
        'my_theme_svc_comp_banner_h2'         => 'text',
        'my_theme_svc_comp_banner_desc'       => 'text',
        'my_theme_svc_project_h2'             => 'text',
        'my_theme_svc_project_desc'           => 'textarea',
        'my_theme_svc_project1_title'         => 'text',
        'my_theme_svc_project1_desc'          => 'textarea',
        'my_theme_svc_project2_title'         => 'text',
        'my_theme_svc_project2_desc'          => 'textarea',
        'my_theme_svc_project3_title'         => 'text',
        'my_theme_svc_project3_desc'          => 'textarea',
        'my_theme_svc_project4_title'         => 'text',
        'my_theme_svc_project4_desc'          => 'textarea',
        'my_theme_svc_project_cta'            => 'text',
        'my_theme_svc_project_img'            => 'image',
        'my_theme_svc_reg_h2'                 => 'text',
        'my_theme_svc_reg_desc'               => 'textarea',
        'my_theme_svc_reg_item1'              => 'text',
        'my_theme_svc_reg_item2'              => 'text',
        'my_theme_svc_reg_item3'              => 'text',
        'my_theme_svc_reg_item4'              => 'text',
        'my_theme_svc_reg_cert_h3'            => 'text',
        'my_theme_svc_reg_cert_line1'         => 'text',
        'my_theme_svc_reg_cert_line2'         => 'text',
        'my_theme_svc_reg_cert_banner'        => 'text',
        'my_theme_svc_gallery_h2'             => 'text',
        'my_theme_svc_gallery_img1'           => 'image',
        'my_theme_svc_gallery_img2'           => 'image',
        'my_theme_svc_gallery_img3'           => 'image',
        'my_theme_svc_gallery_img4'           => 'image',
        'my_theme_svc_gallery_img5'           => 'image',
        'my_theme_svc_gallery_cta'            => 'text',
        'my_theme_svc_final_h2'               => 'text',
        'my_theme_svc_final_desc'             => 'textarea',
        'my_theme_svc_final_cta'              => 'text',

        // ─── Racking Upright Repair ──────────────────────────────────
        'my_theme_svc_upright_hero_h1'           => 'text',
        'my_theme_svc_upright_hero_desc'         => 'textarea',
        'my_theme_svc_upright_what_h2'           => 'text',
        'my_theme_svc_upright_what_p1'           => 'textarea',
        'my_theme_svc_upright_what_highlight'    => 'text',
        'my_theme_svc_upright_what_p2'           => 'textarea',
        'my_theme_svc_upright_what_cta'          => 'text',
        'my_theme_svc_upright_how_h2'            => 'text',
        'my_theme_svc_upright_how_p1'            => 'textarea',
        'my_theme_svc_upright_how_p2'            => 'textarea',
        'my_theme_svc_upright_how_h3'            => 'text',
        'my_theme_svc_upright_how_compat1'       => 'text',
        'my_theme_svc_upright_how_compat2'       => 'text',
        'my_theme_svc_upright_how_compat3'       => 'text',
        'my_theme_svc_upright_how_compat4'       => 'text',
        'my_theme_svc_upright_how_callout'       => 'textarea',
        'my_theme_svc_upright_cost_h2'           => 'text',
        'my_theme_svc_upright_cost_p1'           => 'textarea',
        'my_theme_svc_upright_cost_highlight'    => 'text',
        'my_theme_svc_upright_cost_p2'           => 'textarea',
        'my_theme_svc_upright_cost_item1'        => 'text',
        'my_theme_svc_upright_cost_item2'        => 'text',
        'my_theme_svc_upright_cost_item3'        => 'text',
        'my_theme_svc_upright_cost_item4'        => 'text',
        'my_theme_svc_upright_cost_p3'           => 'textarea',
        'my_theme_svc_upright_hero_img'          => 'image',
        'my_theme_svc_upright_proven_h2'         => 'text',
        'my_theme_svc_upright_proven_p1'         => 'textarea',
        'my_theme_svc_upright_proven_p2'         => 'text',
        'my_theme_svc_upright_proven_p3'         => 'text',
        'my_theme_svc_upright_case_h3'           => 'text',
        'my_theme_svc_upright_case_desc'         => 'textarea',
        'my_theme_svc_upright_dur_h2'            => 'text',
        'my_theme_svc_upright_dur_p1'            => 'text',
        'my_theme_svc_upright_dur_bold'          => 'text',
        'my_theme_svc_upright_dur_p2'            => 'textarea',
        'my_theme_svc_upright_sus_h2'            => 'text',
        'my_theme_svc_upright_sus_p1'            => 'textarea',
        'my_theme_svc_upright_sus_bold'          => 'text',
        'my_theme_svc_upright_sus_p2'            => 'text',
        'my_theme_svc_upright_sus_p3'            => 'text',
        'my_theme_svc_upright_cta_h2'            => 'text',
        'my_theme_svc_upright_cta_desc'          => 'textarea',
        'my_theme_svc_upright_cta_btn1'          => 'text',
        'my_theme_svc_upright_cta_btn2'          => 'text',

        // ─── Damage Prevention ───────────────────────────────────────
        'my_theme_svc_prevention_hero_h1'           => 'text',
        'my_theme_svc_prevention_hero_desc'         => 'textarea',
        'my_theme_svc_prevention_split_h2'          => 'text',
        'my_theme_svc_prevention_split_desc'        => 'text',
        'my_theme_svc_prevention_split_img'         => 'image',
        'my_theme_svc_prevention_costly_h2'         => 'text',
        'my_theme_svc_prevention_costly_p1'         => 'textarea',
        'my_theme_svc_prevention_costly_p2'         => 'textarea',
        'my_theme_svc_prevention_card1_title'       => 'text',
        'my_theme_svc_prevention_card1_desc'        => 'text',
        'my_theme_svc_prevention_card2_title'       => 'text',
        'my_theme_svc_prevention_card2_desc'        => 'text',
        'my_theme_svc_prevention_card3_title'       => 'text',
        'my_theme_svc_prevention_card3_desc'        => 'text',
        'my_theme_svc_prevention_card4_title'       => 'text',
        'my_theme_svc_prevention_card4_desc'        => 'text',
        'my_theme_svc_prevention_dark_p1'           => 'textarea',
        'my_theme_svc_prevention_dark_highlight'    => 'text',
        'my_theme_svc_prevention_after_p'           => 'textarea',
        'my_theme_svc_prevention_case_h3'           => 'text',
        'my_theme_svc_prevention_case_desc'         => 'textarea',
        'my_theme_svc_prevention_case_cta'          => 'text',
        'my_theme_svc_prevention_savings_h2'        => 'text',
        'my_theme_svc_prevention_savings_p1'        => 'textarea',
        'my_theme_svc_prevention_savings_p2'        => 'textarea',
        'my_theme_svc_prevention_savings_p3'        => 'text',
        'my_theme_svc_prevention_savings_item1'     => 'text',
        'my_theme_svc_prevention_savings_item2'     => 'text',
        'my_theme_svc_prevention_savings_item3'     => 'text',
        'my_theme_svc_prevention_savings_item4'     => 'text',
        'my_theme_svc_prevention_savings_highlight' => 'text',
        'my_theme_svc_prevention_savings_banner'    => 'text',
        'my_theme_svc_prevention_savings_cta'       => 'text',
        'my_theme_svc_prevention_suitable_h2'       => 'text',
        'my_theme_svc_prevention_suitable_desc'     => 'textarea',
        'my_theme_svc_prevention_existing_h3'       => 'text',
        'my_theme_svc_prevention_existing_desc'     => 'textarea',
        'my_theme_svc_prevention_new_h3'            => 'text',
        'my_theme_svc_prevention_new_desc'          => 'textarea',
        'my_theme_svc_prevention_sema_h2'           => 'text',
        'my_theme_svc_prevention_sema_p1'           => 'textarea',
        'my_theme_svc_prevention_sema_p2'           => 'textarea',
        'my_theme_svc_prevention_sema_img'          => 'image',
        'my_theme_svc_prevention_risk_h3'           => 'text',
        'my_theme_svc_prevention_risk_bold'         => 'text',
        'my_theme_svc_prevention_risk_p1'           => 'textarea',
        'my_theme_svc_prevention_risk_item1'        => 'text',
        'my_theme_svc_prevention_risk_item2'        => 'text',
        'my_theme_svc_prevention_risk_item3'        => 'text',
        'my_theme_svc_prevention_risk_item4'        => 'text',
        'my_theme_svc_prevention_risk_p2'           => 'textarea',
        'my_theme_svc_prevention_stop_h2'           => 'text',
        'my_theme_svc_prevention_stop_desc'         => 'textarea',
        'my_theme_svc_prevention_cta_btn1'          => 'text',
        'my_theme_svc_prevention_cta_btn2'          => 'text',

        // ─── Annual Inspections ──────────────────────────────────────
        'my_theme_svc_inspections_hero_h1'           => 'text',
        'my_theme_svc_inspections_hero_desc'         => 'textarea',
        'my_theme_svc_inspections_intro'             => 'textarea',
        'my_theme_svc_inspections_covers_h2'         => 'text',
        'my_theme_svc_inspections_covers_item1'      => 'text',
        'my_theme_svc_inspections_covers_item2'      => 'text',
        'my_theme_svc_inspections_covers_item3'      => 'text',
        'my_theme_svc_inspections_covers_item4'      => 'text',
        'my_theme_svc_inspections_callout'           => 'textarea',
        'my_theme_svc_inspections_img1'              => 'image',
        'my_theme_svc_inspections_img2'              => 'image',
        'my_theme_svc_inspections_smarter_h2'        => 'text',
        'my_theme_svc_inspections_smarter_p1'        => 'textarea',
        'my_theme_svc_inspections_smarter_p2'        => 'text',
        'my_theme_svc_inspections_reduce_h2'         => 'text',
        'my_theme_svc_inspections_reduce_p1'         => 'textarea',
        'my_theme_svc_inspections_reduce_p2'         => 'textarea',
        'my_theme_svc_inspections_banner'            => 'textarea',
        'my_theme_svc_inspections_final_h2'          => 'text',
        'my_theme_svc_inspections_final_desc'        => 'textarea',
        'my_theme_svc_inspections_cta_btn1'          => 'text',
        'my_theme_svc_inspections_cta_btn2'          => 'text',

        // ─── Installations & CDM ─────────────────────────────────────
        'my_theme_svc_cdm_hero_h1'              => 'text',
        'my_theme_svc_cdm_hero_desc'            => 'textarea',
        'my_theme_svc_cdm_intro'                => 'textarea',
        'my_theme_svc_cdm_img_left'             => 'image',
        'my_theme_svc_cdm_img_right'            => 'image',
        'my_theme_svc_cdm_build_h2'             => 'text',
        'my_theme_svc_cdm_build_p1'             => 'textarea',
        'my_theme_svc_cdm_build_p2'             => 'textarea',
        'my_theme_svc_cdm_build_h3'             => 'text',
        'my_theme_svc_cdm_build_item1'          => 'text',
        'my_theme_svc_cdm_build_item2'          => 'text',
        'my_theme_svc_cdm_build_item3'          => 'text',
        'my_theme_svc_cdm_build_item4'          => 'text',
        'my_theme_svc_cdm_compliance_h2'        => 'text',
        'my_theme_svc_cdm_compliance_desc'      => 'textarea',
        'my_theme_svc_cdm_compliance_h3'        => 'text',
        'my_theme_svc_cdm_compliance_item1'     => 'text',
        'my_theme_svc_cdm_compliance_item2'     => 'text',
        'my_theme_svc_cdm_compliance_item3'     => 'text',
        'my_theme_svc_cdm_compliance_item4'     => 'text',
        'my_theme_svc_cdm_protect_h2'           => 'text',
        'my_theme_svc_cdm_protect_desc'         => 'textarea',
        'my_theme_svc_cdm_protect_cta'          => 'text',
        'my_theme_svc_cdm_protect_callout_h2'   => 'text',
        'my_theme_svc_cdm_protect_callout_desc' => 'text',
        'my_theme_svc_cdm_final_h2'             => 'text',
        'my_theme_svc_cdm_final_desc'           => 'textarea',
        'my_theme_svc_cdm_final_cta'            => 'text',

        // ─── Reconfiguration ─────────────────────────────────────────
        'my_theme_svc_reconfig_hero_h1'            => 'text',
        'my_theme_svc_reconfig_hero_desc'          => 'textarea',
        'my_theme_svc_reconfig_intro'              => 'textarea',
        'my_theme_svc_reconfig_flex_h2'            => 'text',
        'my_theme_svc_reconfig_flex_p1'            => 'textarea',
        'my_theme_svc_reconfig_flex_bold'          => 'text',
        'my_theme_svc_reconfig_flex_p2'            => 'textarea',
        'my_theme_svc_reconfig_safety_h2'          => 'text',
        'my_theme_svc_reconfig_safety_p1'          => 'textarea',
        'my_theme_svc_reconfig_safety_p2'          => 'text',
        'my_theme_svc_reconfig_safety_p3'          => 'textarea',
        'my_theme_svc_reconfig_banner'             => 'textarea',
        'my_theme_svc_reconfig_img_left'           => 'image',
        'my_theme_svc_reconfig_img_right'          => 'image',
        'my_theme_svc_reconfig_integrate_h2'       => 'text',
        'my_theme_svc_reconfig_integrate_desc'     => 'textarea',
        'my_theme_svc_reconfig_integrate_callout'  => 'textarea',
        'my_theme_svc_reconfig_adapt_h2'           => 'text',
        'my_theme_svc_reconfig_adapt_desc'         => 'textarea',
        'my_theme_svc_reconfig_adapt_card1_title'  => 'text',
        'my_theme_svc_reconfig_adapt_card1_desc'   => 'text',
        'my_theme_svc_reconfig_adapt_card2_title'  => 'text',
        'my_theme_svc_reconfig_adapt_card2_desc'   => 'text',
        'my_theme_svc_reconfig_adapt_card3_title'  => 'text',
        'my_theme_svc_reconfig_adapt_card3_desc'   => 'text',
        'my_theme_svc_reconfig_final_h2'           => 'text',
        'my_theme_svc_reconfig_final_desc'         => 'textarea',
        'my_theme_svc_reconfig_cta_btn1'           => 'text',
        'my_theme_svc_reconfig_cta_btn2'           => 'text',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_services_fields', 10, 2);

function my_theme_admin_render_services(): void
{
    my_theme_admin_page_open('Services', 'goliath-services');

    // ═══════════════════════════════════════════════════════════════════
    // SERVICES OVERVIEW PAGE
    // ═══════════════════════════════════════════════════════════════════

    my_theme_admin_section_open('Services Overview — Hero', 'Main services landing page hero section.');
    my_theme_admin_text_field('my_theme_svc_hero_badge', 'Badge Text', 'PROACTIVE PROTECTION');
    my_theme_admin_text_field('my_theme_svc_hero_h1', 'H1 Heading', 'Service Portfolio');
    my_theme_admin_textarea_field('my_theme_svc_hero_desc', 'Description', 'Building a new warehouse or installing new racking? Start with GOLIATH™ protection from day one. Prevent damage before it happens and eliminate future repair costs entirely.', 3);
    my_theme_admin_text_field('my_theme_svc_hero_cta1', 'Primary CTA Text', 'Get Project Quote');
    my_theme_admin_text_field('my_theme_svc_hero_cta2', 'Secondary CTA Text', 'Learn More');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Services Overview — Built to Last', 'Heavy duty / built to last feature section.');
    my_theme_admin_text_field('my_theme_svc_built_h2', 'H2 Heading', 'Heavy Duty.');
    my_theme_admin_text_field('my_theme_svc_built_h3', 'H3 Heading (orange)', 'Built to Last.');
    my_theme_admin_textarea_field('my_theme_svc_built_desc', 'Description', 'Installing GOLIATH™ on new racking projects provides unmatched protection and long-term value for your warehouse infrastructure.', 3);
    my_theme_admin_image_field('my_theme_svc_before_img', 'Before Image', get_theme_file_uri('assets/images/Services/before.webp'));
    my_theme_admin_image_field('my_theme_svc_after_img', 'After Image', get_theme_file_uri('assets/images/Services/after.webp'));
    my_theme_admin_text_field('my_theme_svc_feat1_title', 'Feature 1 Title', 'Protection from Day One');
    my_theme_admin_textarea_field('my_theme_svc_feat1_desc', 'Feature 1 Description', 'Install GOLIATH™ on new racking to prevent damage before it happens. Proactive protection saves money and ensures safety from the start.', 2);
    my_theme_admin_text_field('my_theme_svc_feat2_title', 'Feature 2 Title', 'Faster Installation');
    my_theme_admin_textarea_field('my_theme_svc_feat2_desc', 'Feature 2 Description', 'Installing GOLIATH™ during initial setup is even quicker than retrofitting. Integrate protection seamlessly into your new warehouse project.', 2);
    my_theme_admin_text_field('my_theme_svc_feat3_title', 'Feature 3 Title', 'Lifetime Warranty');
    my_theme_admin_textarea_field('my_theme_svc_feat3_desc', 'Feature 3 Description', 'Your new racking comes with permanent protection. Never worry about upright damage again with our comprehensive lifetime warranty.', 2);
    my_theme_admin_text_field('my_theme_svc_feat4_title', 'Feature 4 Title', 'Lower Total Cost');
    my_theme_admin_textarea_field('my_theme_svc_feat4_desc', 'Feature 4 Description', 'Avoid future repair costs entirely. Installing GOLIATH™ upfront is the most cost-effective approach for long-term warehouse operations.', 2);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Services Overview — Installation Comparison', 'Before/after comparison table rows.');
    my_theme_admin_text_field('my_theme_svc_comp_h2', 'Section H2', 'New Installation Comparison');
    my_theme_admin_textarea_field('my_theme_svc_comp_desc', 'Section Description', 'See how GOLIATH™-protected racking compares to standard new installations over the lifetime of your warehouse.', 2);
    my_theme_admin_text_field('my_theme_svc_comp_row1_left_title', 'Row 1 Left Title', 'Standard new racking upright');
    my_theme_admin_text_field('my_theme_svc_comp_row1_left_desc', 'Row 1 Left Desc', 'Vulnerable to impact damage from day one');
    my_theme_admin_text_field('my_theme_svc_comp_row1_right_title', 'Row 1 Right Title', 'New racking with GOLIATH™');
    my_theme_admin_text_field('my_theme_svc_comp_row1_right_desc', 'Row 1 Right Desc', 'Protected against all impact damage permanently');
    my_theme_admin_text_field('my_theme_svc_comp_row2_left_title', 'Row 2 Left Title', '£675+ per replacement when damaged');
    my_theme_admin_text_field('my_theme_svc_comp_row2_left_desc', 'Row 2 Left Desc', 'Recurring expense with each incident');
    my_theme_admin_text_field('my_theme_svc_comp_row2_right_title', 'Row 2 Right Title', '£0 future repair costs');
    my_theme_admin_text_field('my_theme_svc_comp_row2_right_desc', 'Row 2 Right Desc', 'One-time investment with lifetime protection');
    my_theme_admin_text_field('my_theme_svc_comp_row3_left_title', 'Row 3 Left Title', '2-4 hours downtime per replacement');
    my_theme_admin_text_field('my_theme_svc_comp_row3_left_desc', 'Row 3 Left Desc', 'Repeated disruptions to operations');
    my_theme_admin_text_field('my_theme_svc_comp_row3_right_title', 'Row 3 Right Title', 'Zero downtime after installation');
    my_theme_admin_text_field('my_theme_svc_comp_row3_right_desc', 'Row 3 Right Desc', 'Uninterrupted warehouse productivity');
    my_theme_admin_text_field('my_theme_svc_comp_row4_left_title', 'Row 4 Left Title', 'No warranty against impact damage');
    my_theme_admin_text_field('my_theme_svc_comp_row4_left_desc', 'Row 4 Left Desc', 'Full financial risk on your business');
    my_theme_admin_text_field('my_theme_svc_comp_row4_right_title', 'Row 4 Right Title', 'Lifetime impact warranty included');
    my_theme_admin_text_field('my_theme_svc_comp_row4_right_desc', 'Row 4 Right Desc', 'Complete protection with no-questions-asked coverage');
    my_theme_admin_text_field('my_theme_svc_comp_banner_h2', 'Banner Heading', 'Smart Investment = Long-Term Savings');
    my_theme_admin_text_field('my_theme_svc_comp_banner_desc', 'Banner Description', 'Protect your new warehouse infrastructure from day one and eliminate future repair costs');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Services Overview — Every Project', 'Perfect for every project section.');
    my_theme_admin_text_field('my_theme_svc_project_h2', 'Section H2', 'Perfect for Every Project');
    my_theme_admin_textarea_field('my_theme_svc_project_desc', 'Description', 'Whether you\'re building from scratch, expanding operations, or upgrading your storage systems, GOLIATH™ provides the protection your investment deserves.', 3);
    my_theme_admin_text_field('my_theme_svc_project1_title', 'Project 1 Title', 'New Warehouse Builds');
    my_theme_admin_textarea_field('my_theme_svc_project1_desc', 'Project 1 Description', 'Complete warehouse construction projects with GOLIATH™ protection integrated from the ground up.', 2);
    my_theme_admin_text_field('my_theme_svc_project2_title', 'Project 2 Title', 'Warehouse Expansions');
    my_theme_admin_textarea_field('my_theme_svc_project2_desc', 'Project 2 Description', 'Expanding your facility? Protect new racking installations while maintaining consistency with existing systems.', 2);
    my_theme_admin_text_field('my_theme_svc_project3_title', 'Project 3 Title', 'Racking System Upgrades');
    my_theme_admin_textarea_field('my_theme_svc_project3_desc', 'Project 3 Description', 'Upgrading your storage system? Add GOLIATH™ to ensure your investment is protected for decades.', 2);
    my_theme_admin_text_field('my_theme_svc_project4_title', 'Project 4 Title', 'High-Traffic Zones');
    my_theme_admin_textarea_field('my_theme_svc_project4_desc', 'Project 4 Description', 'Identify high-risk areas and install proactive protection where forklift traffic is heaviest.', 2);
    my_theme_admin_text_field('my_theme_svc_project_cta', 'CTA Button Text', 'watch the video');
    my_theme_admin_image_field('my_theme_svc_project_img', 'Section Image', get_theme_file_uri('assets/images/Services/foreveryproject.webp'));
    my_theme_admin_section_close();

    my_theme_admin_section_open('Services Overview — UK Regulation', 'UK regulation compliant section.');
    my_theme_admin_text_field('my_theme_svc_reg_h2', 'H2 Heading', 'UK Regulation Compliant');
    my_theme_admin_textarea_field('my_theme_svc_reg_desc', 'Description', 'GOLIATH™ meets all UK and EU safety standards for new installations. Your project will pass inspections with complete compliance documentation.', 3);
    my_theme_admin_text_field('my_theme_svc_reg_item1', 'Compliance Item 1', 'BS EN 15512:2020 + A1:2022 compliant');
    my_theme_admin_text_field('my_theme_svc_reg_item2', 'Compliance Item 2', 'BS EN 15635:2008 certified');
    my_theme_admin_text_field('my_theme_svc_reg_item3', 'Compliance Item 3', 'SEMA codes of practice adherence');
    my_theme_admin_text_field('my_theme_svc_reg_item4', 'Compliance Item 4', 'Full compliance documentation provided');
    my_theme_admin_text_field('my_theme_svc_reg_cert_h3', 'Certification Box H3', 'Certified Protection');
    my_theme_admin_text_field('my_theme_svc_reg_cert_line1', 'Registration Line 1', 'UK Registered Design No. 6410620');
    my_theme_admin_text_field('my_theme_svc_reg_cert_line2', 'Registration Line 2', 'EU Design Registration No. DM/244641');
    my_theme_admin_text_field('my_theme_svc_reg_cert_banner', 'Certification Banner Text', 'Lifetime Warranty Included');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Services Overview — Gallery', 'Simple solution gallery section.');
    my_theme_admin_text_field('my_theme_svc_gallery_h2', 'Section H2', 'Simple Solution, Peace of Mind,');
    my_theme_admin_image_field('my_theme_svc_gallery_img1', 'Gallery Image 1', get_theme_file_uri('assets/images/Services/solution1.webp'));
    my_theme_admin_image_field('my_theme_svc_gallery_img2', 'Gallery Image 2', get_theme_file_uri('assets/images/Services/solution2.webp'));
    my_theme_admin_image_field('my_theme_svc_gallery_img3', 'Gallery Image 3', get_theme_file_uri('assets/images/Services/solution3.webp'));
    my_theme_admin_image_field('my_theme_svc_gallery_img4', 'Gallery Image 4 (wide)', get_theme_file_uri('assets/images/Services/solution5.webp'));
    my_theme_admin_image_field('my_theme_svc_gallery_img5', 'Gallery Image 5 (tall)', get_theme_file_uri('assets/images/Services/solution4.webp'));
    my_theme_admin_text_field('my_theme_svc_gallery_cta', 'Gallery CTA Text', 'View more');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Services Overview — Final CTA', 'Bottom call to action section.');
    my_theme_admin_text_field('my_theme_svc_final_h2', 'H2 Heading', 'Interested in GOLIATH™?');
    my_theme_admin_textarea_field('my_theme_svc_final_desc', 'Description', 'Planning a new warehouse project? Get a tailored quote for Goliath™ protection. Our team will work with your specifications to provide clear pricing and a realistic timeline.', 3);
    my_theme_admin_text_field('my_theme_svc_final_cta', 'CTA Button Text', 'Get Your Project Quote');
    my_theme_admin_section_close();

    // ═══════════════════════════════════════════════════════════════════
    // RACKING UPRIGHT REPAIR
    // ═══════════════════════════════════════════════════════════════════

    my_theme_admin_section_open('Upright Repair — Hero', 'Racking upright repair page hero.');
    my_theme_admin_text_field('my_theme_svc_upright_hero_h1', 'H1 Heading', 'Racking Upright Repair');
    my_theme_admin_textarea_field('my_theme_svc_upright_hero_desc', 'Hero Description', 'Racking uprights damaged in warehouses are one of the most common issues worldwide. Traditional repair methods are ineffective because they cost more, increase downtime, and have a higher risk of repeat damage.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Upright Repair — What is Goliath', 'What is Goliath section.');
    my_theme_admin_text_field('my_theme_svc_upright_what_h2', 'H2 Heading', 'What is Goliath™?');
    my_theme_admin_textarea_field('my_theme_svc_upright_what_p1', 'First Paragraph', 'Damaged racking uprights are one of the most common issues in warehouses worldwide. This is because repeated impacts affect the structural integrity, reduce load capacity, and create ongoing safety risks for warehouses. Traditional repair methods are ineffective because they cost more, increase downtime, and have a higher risk of repeat damage.', 4);
    my_theme_admin_text_field('my_theme_svc_upright_what_highlight', 'Highlighted Text (orange)', 'Goliath™ takes a different approach to ensuring safety.');
    my_theme_admin_textarea_field('my_theme_svc_upright_what_p2', 'Second Paragraph', 'Our solution is a permanent reinforcement system that protects uprights at their most vulnerable point. This eliminates recurring damage, reduces long-term spending, and keeps your operation running without interruption.', 3);
    my_theme_admin_text_field('my_theme_svc_upright_what_cta', 'CTA Button Text', 'Discover the Solution');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Upright Repair — How It Works', 'How Goliath works section.');
    my_theme_admin_text_field('my_theme_svc_upright_how_h2', 'H2 Heading', 'How Goliath™ Works');
    my_theme_admin_textarea_field('my_theme_svc_upright_how_p1', 'Paragraph 1', 'Goliath™ is an engineered heavy-duty steel upright repair and protection system built for strength and long-term support.', 2);
    my_theme_admin_textarea_field('my_theme_svc_upright_how_p2', 'Paragraph 2', 'Once Goliath™ is installed, it absorbs the force from repeated impacts that damage the racking itself. This prevents the need to replace uprights and reduces the risk of structural failure.', 3);
    my_theme_admin_text_field('my_theme_svc_upright_how_h3', 'Compatible With H3', 'Compatible with:');
    my_theme_admin_text_field('my_theme_svc_upright_how_compat1', 'Compatibility Item 1', 'Adjustable pallet racking (APR)');
    my_theme_admin_text_field('my_theme_svc_upright_how_compat2', 'Compatibility Item 2', 'Wide aisle racking');
    my_theme_admin_text_field('my_theme_svc_upright_how_compat3', 'Compatibility Item 3', 'Narrow aisle racking');
    my_theme_admin_text_field('my_theme_svc_upright_how_compat4', 'Compatibility Item 4', 'High-bay warehouse systems');
    my_theme_admin_textarea_field('my_theme_svc_upright_how_callout', 'Orange Callout Text', 'Goliath™ is not a temporary fix or a patch repair. It is a long-term structural solution built to outperform traditional repair methods.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Upright Repair — Cost Saving', 'Lifetime cost-saving section.');
    my_theme_admin_text_field('my_theme_svc_upright_cost_h2', 'H2 Heading', 'A Lifetime Cost-Saving Solution');
    my_theme_admin_textarea_field('my_theme_svc_upright_cost_p1', 'First Paragraph', 'Many warehouses in the UK treat damage to uprights as an ongoing maintenance cost. Repairs are carried out regularly as issues arise, which leads to continuous spending for the same problem.', 3);
    my_theme_admin_text_field('my_theme_svc_upright_cost_highlight', 'Highlighted Text (orange)', 'Goliath™ proposes a lasting change.');
    my_theme_admin_textarea_field('my_theme_svc_upright_cost_p2', 'Second Paragraph', 'With our permanent protection system, you stop the cycle of damage and repair. This leads to long-term savings in areas like:', 2);
    my_theme_admin_text_field('my_theme_svc_upright_cost_item1', 'Saving Item 1', 'Replacement uprights');
    my_theme_admin_text_field('my_theme_svc_upright_cost_item2', 'Saving Item 2', 'Labour and installation costs');
    my_theme_admin_text_field('my_theme_svc_upright_cost_item3', 'Saving Item 3', 'Operational downtime');
    my_theme_admin_text_field('my_theme_svc_upright_cost_item4', 'Saving Item 4', 'Safety compliance risks');
    my_theme_admin_textarea_field('my_theme_svc_upright_cost_p3', 'Closing Paragraph', 'Goliath™ is a onetime structural investment that delivers clear financial benefits from the moment its installed. In high-traffic environments, these savings are even more significant.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Upright Repair — Hero Image', 'Full-width hero image.');
    my_theme_admin_image_field('my_theme_svc_upright_hero_img', 'Full-Width Image', get_theme_file_uri('assets/images/Services/services-RackingUpright/case-study1.webp'));
    my_theme_admin_section_close();

    my_theme_admin_section_open('Upright Repair — Proven Results', 'Case study results section.');
    my_theme_admin_text_field('my_theme_svc_upright_proven_h2', 'H2 Heading', 'Proven Results in High-Impact Environments');
    my_theme_admin_textarea_field('my_theme_svc_upright_proven_p1', 'Paragraph 1', 'Goliath™ has been proven in real warehouse conditions where impact damage is frequent and costly.', 2);
    my_theme_admin_text_field('my_theme_svc_upright_proven_p2', 'Paragraph 2', 'This is a typical result in operations where forklift movement and tight aisles increase the chances of bumping into uprights.');
    my_theme_admin_text_field('my_theme_svc_upright_proven_p3', 'Paragraph 3', 'Instead of reacting to damage, Goliath™ protects your structure.');
    my_theme_admin_text_field('my_theme_svc_upright_case_h3', 'Case Study H3', 'Case Study: B&M');
    my_theme_admin_textarea_field('my_theme_svc_upright_case_desc', 'Case Study Description', 'Our client, B&M, saw a reduction of over 30% in repair costs within the first 12 months of installing Goliath™. This was achieved by eliminating repeat damage to uprights in high-risk areas. Cost-conscious operators can imagine how much this equates to across a 5 or 10-year period.', 4);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Upright Repair — Durability & Sustainability', 'Built for durability and sustainability articles.');
    my_theme_admin_text_field('my_theme_svc_upright_dur_h2', 'Durability H2', 'Built for Durability and Backed by Warranty');
    my_theme_admin_text_field('my_theme_svc_upright_dur_p1', 'Durability Paragraph 1', 'Goliath™ is engineered from high-strength steel to withstand repeated impacts in demanding environments.');
    my_theme_admin_text_field('my_theme_svc_upright_dur_bold', 'Durability Bold Text', 'Comprehensive Lifetime Impact Warranty');
    my_theme_admin_textarea_field('my_theme_svc_upright_dur_p2', 'Warranty Quote', '"If Goliath™ becomes damaged from normal use, we will replace or repair it for free - no questions asked."', 2);
    my_theme_admin_text_field('my_theme_svc_upright_sus_h2', 'Sustainability H2', 'A More Sustainable Approach to Racking Repairs');
    my_theme_admin_textarea_field('my_theme_svc_upright_sus_p1', 'Sustainability Paragraph 1', 'Sustainability is a key priority for warehouse operations. When you constantly replace damaged uprights, it leads to unnecessary steel usage, increased waste, and higher environmental impact.', 3);
    my_theme_admin_text_field('my_theme_svc_upright_sus_bold', 'Sustainability Bold', 'Goliath™ is the more sustainable alternative.');
    my_theme_admin_text_field('my_theme_svc_upright_sus_p2', 'Sustainability Paragraph 2', 'The principle is simple: install once and stop the cycle of damage.');
    my_theme_admin_text_field('my_theme_svc_upright_sus_p3', 'Sustainability Paragraph 3', 'This not only reduces waste but also aligns with broader sustainability goals across logistics and distribution operations.');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Upright Repair — Final CTA', 'Bottom call to action.');
    my_theme_admin_text_field('my_theme_svc_upright_cta_h2', 'H2 Heading', 'Choose Strength and Support with Goliath™');
    my_theme_admin_textarea_field('my_theme_svc_upright_cta_desc', 'Description', 'If your warehouse is dealing with repeated upright damage, the question is not whether to repair again. It is how to stop the damage from happening. Goliath™ is the answer.', 3);
    my_theme_admin_text_field('my_theme_svc_upright_cta_btn1', 'Primary CTA Text', 'Get Free Site Survey');
    my_theme_admin_text_field('my_theme_svc_upright_cta_btn2', 'Secondary CTA Text', 'View Case Studies');
    my_theme_admin_section_close();

    // ═══════════════════════════════════════════════════════════════════
    // DAMAGE PREVENTION
    // ═══════════════════════════════════════════════════════════════════

    my_theme_admin_section_open('Damage Prevention — Hero', 'Damage prevention page hero section.');
    my_theme_admin_text_field('my_theme_svc_prevention_hero_h1', 'H1 Heading', 'Damage Prevention');
    my_theme_admin_textarea_field('my_theme_svc_prevention_hero_desc', 'Hero Description', 'Whenever racking damage happens, it is often overlooked until it becomes a problem big enough to affect operations. Most impact-related issues can be avoided entirely if you have the right type of protection in place.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Damage Prevention — Split Section', 'Image and callout split section.');
    my_theme_admin_text_field('my_theme_svc_prevention_split_h2', 'Callout Heading', 'Goliath™ is the upright repair that stops any damage before it happens.');
    my_theme_admin_text_field('my_theme_svc_prevention_split_desc', 'Callout Description', 'It reinforces the most exposed section of the upright, delivering reliable protection against forklift and pallet truck impacts.');
    my_theme_admin_image_field('my_theme_svc_prevention_split_img', 'Split Image', get_theme_file_uri('assets/images/Services/damage/dent.webp'));
    my_theme_admin_section_close();

    my_theme_admin_section_open('Damage Prevention — Costly Section', 'Prevent damage before it becomes costly.');
    my_theme_admin_text_field('my_theme_svc_prevention_costly_h2', 'H2 Heading', 'Prevent Pallet Racking Damage Before It Becomes Costly');
    my_theme_admin_textarea_field('my_theme_svc_prevention_costly_p1', 'Paragraph 1', 'Many warehouse supervisors search for racking repairs in the UK after significant damage has already occurred. Every one of these reactive incidents carries direct repair costs and a wider operational impact.', 3);
    my_theme_admin_textarea_field('my_theme_svc_prevention_costly_p2', 'Paragraph 2', 'It is critical to ensure your upright is protected against forklift impacts because even minor collisions can lead to:', 2);
    my_theme_admin_text_field('my_theme_svc_prevention_card1_title', 'Risk Card 1 Title', 'Complete aisle closures');
    my_theme_admin_text_field('my_theme_svc_prevention_card1_desc', 'Risk Card 1 Description', 'Restricted access affecting operations');
    my_theme_admin_text_field('my_theme_svc_prevention_card2_title', 'Risk Card 2 Title', 'Unplanned maintenance');
    my_theme_admin_text_field('my_theme_svc_prevention_card2_desc', 'Risk Card 2 Description', 'Unplanned maintenance and inspections');
    my_theme_admin_text_field('my_theme_svc_prevention_card3_title', 'Risk Card 3 Title', 'Picking delays');
    my_theme_admin_text_field('my_theme_svc_prevention_card3_desc', 'Risk Card 3 Description', 'Delays in picking and fulfilment');
    my_theme_admin_text_field('my_theme_svc_prevention_card4_title', 'Risk Card 4 Title', 'Racking collapse risk');
    my_theme_admin_text_field('my_theme_svc_prevention_card4_desc', 'Risk Card 4 Description', 'Putting staff at serious risk of injury');
    my_theme_admin_textarea_field('my_theme_svc_prevention_dark_p1', 'Dark Box Paragraph', 'The direct effect of this is warehouse downtime, one of the most expensive hidden costs in logistics. When racking is damaged, your operations slow down or stop while repairs are carried out.', 3);
    my_theme_admin_text_field('my_theme_svc_prevention_dark_highlight', 'Dark Box Highlight', 'Goliath™ breaks this cycle by acting as a permanent pallet rack protection system.');
    my_theme_admin_textarea_field('my_theme_svc_prevention_after_p', 'After Dark Box Paragraph', 'It prevents impacts and keeps your warehouse running without disruption. This is the best pallet racking repair kit alternative that eliminates repeat damage completely.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Damage Prevention — Case Study', 'B&M case study banner.');
    my_theme_admin_text_field('my_theme_svc_prevention_case_h3', 'Case Study H3', 'Case Study: B&M');
    my_theme_admin_textarea_field('my_theme_svc_prevention_case_desc', 'Case Study Description', 'The financial impact is also clear. Our client, B&M, reduced repair costs by over 30% within the first 12 months of installing Goliath™. That reduction came from preventing repeat damage to their uprights, not simply fixing it faster.', 4);
    my_theme_admin_text_field('my_theme_svc_prevention_case_cta', 'Case Study CTA', 'Full Case Study');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Damage Prevention — Long-Term Savings', 'Lifetime warranty savings section.');
    my_theme_admin_text_field('my_theme_svc_prevention_savings_h2', 'H2 Heading', 'Long-Term Savings with Lifetime Impact Warranty');
    my_theme_admin_textarea_field('my_theme_svc_prevention_savings_p1', 'Paragraph 1', 'Goliath™ is a onetime investment that replaces the ongoing cycle of carrying out racking repairs, on which operations rely.', 2);
    my_theme_admin_textarea_field('my_theme_svc_prevention_savings_p2', 'Paragraph 2', 'With our lifetime impact warranty, we provide continuous protection to our clients without repeat costs in the same location.', 2);
    my_theme_admin_text_field('my_theme_svc_prevention_savings_p3', 'Paragraph 3', 'You can save across:');
    my_theme_admin_text_field('my_theme_svc_prevention_savings_item1', 'Saving Item 1', 'Replacing uprights');
    my_theme_admin_text_field('my_theme_svc_prevention_savings_item2', 'Saving Item 2', 'Downtime and lost productivity');
    my_theme_admin_text_field('my_theme_svc_prevention_savings_item3', 'Saving Item 3', 'Labour and installation');
    my_theme_admin_text_field('my_theme_svc_prevention_savings_item4', 'Saving Item 4', 'Repeated inspection-triggered repairs');
    my_theme_admin_text_field('my_theme_svc_prevention_savings_highlight', 'Highlight Text (orange)', 'Over time, preventing pallet racking damage has more value than managing the problem when it arises.');
    my_theme_admin_text_field('my_theme_svc_prevention_savings_banner', 'Stats Banner', '100% Client Satisfaction • Save 70% • 30min Installation • Lifetime Warranty');
    my_theme_admin_text_field('my_theme_svc_prevention_savings_cta', 'CTA Button Text', 'Get Similar Results');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Damage Prevention — Suitable For', 'New and existing installations section.');
    my_theme_admin_text_field('my_theme_svc_prevention_suitable_h2', 'H2 Heading', 'Suitable for New and Existing Racking Installations');
    my_theme_admin_textarea_field('my_theme_svc_prevention_suitable_desc', 'Description', 'If you\'re thinking about installing Goliath™, note that it can be integrated into both existing systems and new warehouse projects.', 2);
    my_theme_admin_text_field('my_theme_svc_prevention_existing_h3', 'Existing Sites H3', 'Existing Sites');
    my_theme_admin_textarea_field('my_theme_svc_prevention_existing_desc', 'Existing Sites Description', 'For sites in operation, it provides instant racking upright protection in areas with high-impact.', 2);
    my_theme_admin_text_field('my_theme_svc_prevention_new_h3', 'New Installations H3', 'New Installations');
    my_theme_admin_textarea_field('my_theme_svc_prevention_new_desc', 'New Installations Description', 'For new installations, it can serve as part of your original warehouse design as a complete pallet racking damage prevention strategy. This ensures protection is in place before any damage occurs.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Damage Prevention — SEMA Compliance', 'SEMA racking inspection section.');
    my_theme_admin_text_field('my_theme_svc_prevention_sema_h2', 'H2 Heading', 'Support SEMA Racking Inspection and Compliance');
    my_theme_admin_textarea_field('my_theme_svc_prevention_sema_p1', 'Paragraph 1', 'Safety compliance is important in warehouse operations. An annual SEMA racking inspection is crucial for identifying risks and maintaining safe load conditions.', 3);
    my_theme_admin_textarea_field('my_theme_svc_prevention_sema_p2', 'Paragraph 2', 'Damaged uprights are one of the most common issues identified during inspections. By installing Goliath™, you reduce the likelihood of damage being flagged at all. This supports ongoing compliance while reducing the need for corrective action between inspections.', 4);
    my_theme_admin_image_field('my_theme_svc_prevention_sema_img', 'Section Image', get_theme_file_uri('assets/images/Services/damage/support.webp'));
    my_theme_admin_section_close();

    my_theme_admin_section_open('Damage Prevention — Risk Management', 'Smarter racking management section.');
    my_theme_admin_text_field('my_theme_svc_prevention_risk_h3', 'H3 Heading', 'Smarter Racking Management and Risk Visibility');
    my_theme_admin_text_field('my_theme_svc_prevention_risk_bold', 'Bold Intro', 'Effective pallet racking damage prevention also requires visibility across your warehouse.');
    my_theme_admin_textarea_field('my_theme_svc_prevention_risk_p1', 'Description', 'Goliath™ supports a digital system that manages and monitors your racking. This includes:', 2);
    my_theme_admin_text_field('my_theme_svc_prevention_risk_item1', 'List Item 1', 'Warehouse mapping');
    my_theme_admin_text_field('my_theme_svc_prevention_risk_item2', 'List Item 2', 'Risk categorisation');
    my_theme_admin_text_field('my_theme_svc_prevention_risk_item3', 'List Item 3', 'Digitally recorded racking upright repair history');
    my_theme_admin_text_field('my_theme_svc_prevention_risk_item4', 'List Item 4', 'Signed documentation for audits and compliance');
    my_theme_admin_textarea_field('my_theme_svc_prevention_risk_p2', 'Closing Paragraph', 'This structured approach supports both internal safety processes and external inspection requirements.', 2);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Damage Prevention — Final CTA', 'Stop damage before it starts.');
    my_theme_admin_text_field('my_theme_svc_prevention_stop_h2', 'H2 Heading', 'Stop Damage Before It Starts');
    my_theme_admin_textarea_field('my_theme_svc_prevention_stop_desc', 'Description', 'There\'s no need to search for a pallet racking repair kit or racking upright repair. Goliath™ addresses repeated impact damage before the worst happens. Our superior upright repair solution allows you to prevent pallet racking damage rather than respond to it. This results in fewer repairs, reduced downtime, and a safer, more efficient warehouse operation.', 5);
    my_theme_admin_text_field('my_theme_svc_prevention_cta_btn1', 'Primary CTA Text', 'Get Free Site Survey');
    my_theme_admin_text_field('my_theme_svc_prevention_cta_btn2', 'Secondary CTA Text', 'Annual Inspections');
    my_theme_admin_section_close();

    // ═══════════════════════════════════════════════════════════════════
    // ANNUAL INSPECTIONS
    // ═══════════════════════════════════════════════════════════════════

    my_theme_admin_section_open('Annual Inspections — Hero', 'Annual inspections page hero.');
    my_theme_admin_text_field('my_theme_svc_inspections_hero_h1', 'H1 Heading', 'Annual Inspections');
    my_theme_admin_textarea_field('my_theme_svc_inspections_hero_desc', 'Hero Description', 'Regular racking inspections are important for ensuring safety is maintained, structures are compliant, and operations are efficient. In many busy warehouse environments, minor damage can worsen if it is not identified and managed early.', 4);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Annual Inspections — Introduction', 'Introductory content and inspection coverage.');
    my_theme_admin_textarea_field('my_theme_svc_inspections_intro', 'Introduction Paragraph', 'Annual inspections are a structured way for warehouse owners and operators to assess the condition of pallet racking systems. These inspections identify damage, monitor wear and tear, and ensure that your storage systems meet the required safety standards, including SEMA racking inspection guidelines.', 4);
    my_theme_admin_text_field('my_theme_svc_inspections_covers_h2', 'Covers H2', 'A typical inspection covers:');
    my_theme_admin_text_field('my_theme_svc_inspections_covers_item1', 'Covers Item 1', 'The condition of your uprights and any impact damage');
    my_theme_admin_text_field('my_theme_svc_inspections_covers_item2', 'Covers Item 2', 'Beam integrity and load performance');
    my_theme_admin_text_field('my_theme_svc_inspections_covers_item3', 'Covers Item 3', 'Stability of the base plates and floor fixings');
    my_theme_admin_text_field('my_theme_svc_inspections_covers_item4', 'Covers Item 4', 'Pallet alignment and overall structural stability');
    my_theme_admin_textarea_field('my_theme_svc_inspections_callout', 'Orange Callout Text', 'The goal is simple. When risks are identified early, it prevents them from becoming costly problems.', 2);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Annual Inspections — Images', 'Inspection photo gallery.');
    my_theme_admin_image_field('my_theme_svc_inspections_img1', 'Inspection Image 1', get_theme_file_uri('assets/images/Services/inspection/inspection1.webp'));
    my_theme_admin_image_field('my_theme_svc_inspections_img2', 'Inspection Image 2', get_theme_file_uri('assets/images/Services/inspection/inspection2.webp'));
    my_theme_admin_section_close();

    my_theme_admin_section_open('Annual Inspections — Smarter & Reduce', 'Smarter inspection management and reduce risk.');
    my_theme_admin_text_field('my_theme_svc_inspections_smarter_h2', 'Smarter H2', 'Smarter Inspection Management');
    my_theme_admin_textarea_field('my_theme_svc_inspections_smarter_p1', 'Smarter Paragraph 1', 'Warehouse inspections are more effective when they are supported by clear data. Our digital racking management system helps to track the condition of your warehouse more effectively.', 3);
    my_theme_admin_text_field('my_theme_svc_inspections_smarter_p2', 'Smarter Paragraph 2', 'It creates a clear audit trail and helps prioritise repairs based on risk level.');
    my_theme_admin_text_field('my_theme_svc_inspections_reduce_h2', 'Reduce Risk H2', 'Reduce Risk with Goliath™');
    my_theme_admin_textarea_field('my_theme_svc_inspections_reduce_p1', 'Reduce Paragraph 1', 'Inspections only identify the issues in your warehouse, but prevention reduces how often they occur.', 2);
    my_theme_admin_textarea_field('my_theme_svc_inspections_reduce_p2', 'Reduce Paragraph 2', 'Installing a highly durable pallet rack protection system like Goliath™ helps minimise damage between inspection cycles.', 2);
    my_theme_admin_textarea_field('my_theme_svc_inspections_banner', 'Orange Banner Text', 'By combining annual inspections with long-term racking upright protection, your warehouse becomes a more controlled, lower-risk environment.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Annual Inspections — Final CTA', 'Choose Goliath for fewer disruptions.');
    my_theme_admin_text_field('my_theme_svc_inspections_final_h2', 'H2 Heading', 'Choose Goliath™ for Fewer Disruptions');
    my_theme_admin_textarea_field('my_theme_svc_inspections_final_desc', 'Description', 'Improved compliance, and a safer warehouse that stays working for longer.', 2);
    my_theme_admin_text_field('my_theme_svc_inspections_cta_btn1', 'Primary CTA Text', 'Get Free Site Survey');
    my_theme_admin_text_field('my_theme_svc_inspections_cta_btn2', 'Secondary CTA Text', 'View Compliance Info');
    my_theme_admin_section_close();

    // ═══════════════════════════════════════════════════════════════════
    // INSTALLATIONS & CDM
    // ═══════════════════════════════════════════════════════════════════

    my_theme_admin_section_open('Installations & CDM — Hero', 'Installations page hero section.');
    my_theme_admin_text_field('my_theme_svc_cdm_hero_h1', 'H1 Heading', 'Racking Installations & CDM');
    my_theme_admin_textarea_field('my_theme_svc_cdm_hero_desc', 'Hero Description', 'Racking installations like Goliath™ is a way to prevent future damage whenever you install new uprights in your warehouse. Instead of waiting for issues to arise, you can build protection into the system from day one.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Installations & CDM — Introduction', 'Introductory content and images.');
    my_theme_admin_textarea_field('my_theme_svc_cdm_intro', 'Introduction Paragraph', 'Goliath™ can be installed as part of any new pallet racking installation. When this is done, it provides immediate racking upright protection in high-impact areas. This ensures your system is protected even before operations begin. This reduces the risk of damage to your structure and prevents any ongoing repair costs.', 4);
    my_theme_admin_image_field('my_theme_svc_cdm_img_left', 'Left Image', get_theme_file_uri('assets/images/Services/installation/install1.webp'));
    my_theme_admin_image_field('my_theme_svc_cdm_img_right', 'Right Image', get_theme_file_uri('assets/images/Services/installation/install2.webp'));
    my_theme_admin_section_close();

    my_theme_admin_section_open('Installations & CDM — Build Protection', 'Build protection from day one section.');
    my_theme_admin_text_field('my_theme_svc_cdm_build_h2', 'H2 Heading', 'Build Protection into Your Project from Day One');
    my_theme_admin_textarea_field('my_theme_svc_cdm_build_p1', 'Paragraph 1', 'By integrating Goliath™, our pallet rack protection system, during installation, you eliminate the need to repair your racking upright later.', 2);
    my_theme_admin_textarea_field('my_theme_svc_cdm_build_p2', 'Paragraph 2', 'Approaching protection this way supports a long-term pallet racking damage prevention strategy from the start.', 2);
    my_theme_admin_text_field('my_theme_svc_cdm_build_h3', 'Suitable For H3', 'Goliath™ is suitable for:');
    my_theme_admin_text_field('my_theme_svc_cdm_build_item1', 'Suitable Item 1', 'New warehouse developments');
    my_theme_admin_text_field('my_theme_svc_cdm_build_item2', 'Suitable Item 2', 'Full racking fit-outs');
    my_theme_admin_text_field('my_theme_svc_cdm_build_item3', 'Suitable Item 3', 'Expansion of existing facilities');
    my_theme_admin_text_field('my_theme_svc_cdm_build_item4', 'Suitable Item 4', 'Racking relocation and reconfiguration');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Installations & CDM — CDM Compliance', 'Full CDM management section.');
    my_theme_admin_text_field('my_theme_svc_cdm_compliance_h2', 'H2 Heading', 'Full CDM Management and Compliance');
    my_theme_admin_textarea_field('my_theme_svc_cdm_compliance_desc', 'Description', 'All our installation work is carried out in line with CDM regulations to ensure safety, coordination, and compliance throughout the project.', 2);
    my_theme_admin_text_field('my_theme_svc_cdm_compliance_h3', 'This Includes H3', 'This includes:');
    my_theme_admin_text_field('my_theme_svc_cdm_compliance_item1', 'CDM Item 1', 'Planning and risk assessment');
    my_theme_admin_text_field('my_theme_svc_cdm_compliance_item2', 'CDM Item 2', 'Coordination with contractors and teams');
    my_theme_admin_text_field('my_theme_svc_cdm_compliance_item3', 'CDM Item 3', 'Safe installation processes');
    my_theme_admin_text_field('my_theme_svc_cdm_compliance_item4', 'CDM Item 4', 'Project oversight from start to completion');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Installations & CDM — Protect Investment', 'Protect your investment section.');
    my_theme_admin_text_field('my_theme_svc_cdm_protect_h2', 'H2 Heading', 'Protect Your Investment from the Start');
    my_theme_admin_textarea_field('my_theme_svc_cdm_protect_desc', 'Description', 'Installing a new racking system is a significant investment. Installing Goliath™ during the initial setup ensures that your investment is protected from day one.', 3);
    my_theme_admin_text_field('my_theme_svc_cdm_protect_cta', 'CTA Button Text', 'Get Free Site Survey');
    my_theme_admin_text_field('my_theme_svc_cdm_protect_callout_h2', 'Callout Heading', 'Instead of planning for future repairs, Goliath™ prevents damage entirely.');
    my_theme_admin_text_field('my_theme_svc_cdm_protect_callout_desc', 'Callout Description', 'This results in a safer, more efficient warehouse with lower long-term costs.');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Installations & CDM — Final CTA', 'Bottom call to action section.');
    my_theme_admin_text_field('my_theme_svc_cdm_final_h2', 'H2 Heading', 'Start Your Installation with Goliath™ Protection');
    my_theme_admin_textarea_field('my_theme_svc_cdm_final_desc', 'Description', 'Build damage prevention into your warehouse from the very beginning and save on future repair costs.', 2);
    my_theme_admin_text_field('my_theme_svc_cdm_final_cta', 'CTA Button Text', 'How It Works');
    my_theme_admin_section_close();

    // ═══════════════════════════════════════════════════════════════════
    // RECONFIGURATION
    // ═══════════════════════════════════════════════════════════════════

    my_theme_admin_section_open('Reconfiguration — Hero', 'Reconfiguration page hero section.');
    my_theme_admin_text_field('my_theme_svc_reconfig_hero_h1', 'H1 Heading', 'Racking Reconfiguration Services');
    my_theme_admin_textarea_field('my_theme_svc_reconfig_hero_desc', 'Hero Description', 'Your warehouse operations can change. You may grow, have new product lines, and demand may shift in ways that require adjustments to your existing racking layout.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Reconfiguration — Introduction', 'Intro and two-column articles.');
    my_theme_admin_textarea_field('my_theme_svc_reconfig_intro', 'Introduction Paragraph', 'Our racking reconfiguration services allow you to change your existing storage system without fully replacing it. Our process minimises disruption and maintains operation.', 3);
    my_theme_admin_text_field('my_theme_svc_reconfig_flex_h2', 'Flexible H2', 'Flexible Racking Relocation and Redesign');
    my_theme_admin_textarea_field('my_theme_svc_reconfig_flex_p1', 'Flexible Paragraph 1', 'With our racking skates, there is no need to dismantle your racking system. We can move unloaded racking with ease, reducing downtime.', 2);
    my_theme_admin_text_field('my_theme_svc_reconfig_flex_bold', 'Flexible Bold Text', 'What would normally take weeks, depending on the size of your warehouse, can be done in days or hours.');
    my_theme_admin_textarea_field('my_theme_svc_reconfig_flex_p2', 'Flexible Paragraph 2', 'Every project is planned carefully to ensure that reconfiguration is carried out safely and efficiently, with little to no downtime.', 2);
    my_theme_admin_text_field('my_theme_svc_reconfig_safety_h2', 'Safety H2', 'Maintain Safety During Change');
    my_theme_admin_textarea_field('my_theme_svc_reconfig_safety_p1', 'Safety Paragraph 1', 'When reconfiguring or moving racking, it is important to maintain the structural integrity of your warehouse. With our team, all work is carried out safely, according to regulations.', 3);
    my_theme_admin_text_field('my_theme_svc_reconfig_safety_p2', 'Safety Paragraph 2', 'This ensures your system meets required standards once reinstalled.');
    my_theme_admin_textarea_field('my_theme_svc_reconfig_safety_p3', 'Safety Paragraph 3', 'This is also an ideal time to assess any damage in your racking and identify areas that may need reinforcement or repair.', 2);
    my_theme_admin_textarea_field('my_theme_svc_reconfig_banner', 'Orange Banner Text', 'By combining annual inspections with long-term racking upright protection, your warehouse becomes a more controlled, lower-risk environment.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Reconfiguration — Images', 'Photo gallery.');
    my_theme_admin_image_field('my_theme_svc_reconfig_img_left', 'Left Image', get_theme_file_uri('assets/images/Services/Reconfiguration/config1.webp'));
    my_theme_admin_image_field('my_theme_svc_reconfig_img_right', 'Right Image', get_theme_file_uri('assets/images/Services/Reconfiguration/config2.webp'));
    my_theme_admin_section_close();

    my_theme_admin_section_open('Reconfiguration — Integrate Prevention', 'Integrate damage prevention section.');
    my_theme_admin_text_field('my_theme_svc_reconfig_integrate_h2', 'H2 Heading', 'Integrate Damage Prevention During Reconfiguration');
    my_theme_admin_textarea_field('my_theme_svc_reconfig_integrate_desc', 'Description', 'When changing warehouse racking, there\'s an opportunity to improve long-term performance. High-risk areas can be identified and strengthened with our pallet rack protection system, Goliath™, during the reconfiguration process.', 3);
    my_theme_admin_textarea_field('my_theme_svc_reconfig_integrate_callout', 'Orange Callout', 'Installing Goliath™ on the weak areas provides racking upright protection, which reduces the risk of future impact damage on the same areas when operations resume.', 3);
    my_theme_admin_section_close();

    my_theme_admin_section_open('Reconfiguration — Adapt', 'Adapt without starting over section.');
    my_theme_admin_text_field('my_theme_svc_reconfig_adapt_h2', 'H2 Heading', 'Adapt Without Starting Over');
    my_theme_admin_textarea_field('my_theme_svc_reconfig_adapt_desc', 'Description', 'Reconfiguration is a way to learn more about your existing infrastructure. By combining our relocation services with Goliath™, you can improve your warehouse efficiency, reduce risk, and extend the lifespan of your racking system without the cost of a full replacement.', 4);
    my_theme_admin_text_field('my_theme_svc_reconfig_adapt_card1_title', 'Card 1 Title', 'Improve Efficiency');
    my_theme_admin_text_field('my_theme_svc_reconfig_adapt_card1_desc', 'Card 1 Description', 'Optimize your warehouse layout for better operations');
    my_theme_admin_text_field('my_theme_svc_reconfig_adapt_card2_title', 'Card 2 Title', 'Reduce Risk');
    my_theme_admin_text_field('my_theme_svc_reconfig_adapt_card2_desc', 'Card 2 Description', 'Identify and strengthen vulnerable areas');
    my_theme_admin_text_field('my_theme_svc_reconfig_adapt_card3_title', 'Card 3 Title', 'Extend Lifespan');
    my_theme_admin_text_field('my_theme_svc_reconfig_adapt_card3_desc', 'Card 3 Description', 'Protect your racking investment for the long term');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Reconfiguration — Final CTA', 'Reconfigure with confidence.');
    my_theme_admin_text_field('my_theme_svc_reconfig_final_h2', 'H2 Heading', 'Reconfigure with Confidence');
    my_theme_admin_textarea_field('my_theme_svc_reconfig_final_desc', 'Description', 'Transform your warehouse layout while protecting your investment with Goliath™ damage prevention.', 2);
    my_theme_admin_text_field('my_theme_svc_reconfig_cta_btn1', 'Primary CTA Text', 'Get Free Site Survey');
    my_theme_admin_text_field('my_theme_svc_reconfig_cta_btn2', 'Secondary CTA Text', 'Upright Repair');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
