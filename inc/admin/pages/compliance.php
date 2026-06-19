<?php
declare(strict_types=1);
defined('ABSPATH') || exit;

function my_theme_admin_compliance_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-compliance') {
        return $defs;
    }

    return array_merge($defs, [
        // Hero
        'my_theme_comp_hero_badge'            => 'text',
        'my_theme_comp_hero_h1'               => 'text',
        'my_theme_comp_hero_desc'             => 'textarea',
        'my_theme_comp_hero_cta'              => 'text',

        // Regulation Compliant
        'my_theme_comp_reg_h2'                => 'text',
        'my_theme_comp_reg_p1'                => 'textarea',
        'my_theme_comp_reg_p2'                => 'textarea',
        'my_theme_comp_reg_box_h3'            => 'text',
        'my_theme_comp_reg_box_p'             => 'textarea',

        // HSE EN SEMA Standards
        'my_theme_comp_std_h2'                => 'text',
        'my_theme_comp_std_p1'                => 'textarea',
        'my_theme_comp_std_p2'                => 'textarea',
        'my_theme_comp_std_card1_title'        => 'text',
        'my_theme_comp_std_card1_body'         => 'textarea',
        'my_theme_comp_std_card2_title'        => 'text',
        'my_theme_comp_std_card2_body'         => 'textarea',
        'my_theme_comp_std_card3_title'        => 'text',
        'my_theme_comp_std_card3_body'         => 'textarea',
        'my_theme_comp_std_card4_title'        => 'text',
        'my_theme_comp_std_card4_body'         => 'textarea',

        // Image with Warranty Overlay
        'my_theme_comp_warranty_image'        => 'image',
        'my_theme_comp_warranty_h3'           => 'text',
        'my_theme_comp_warranty_item1'        => 'text',
        'my_theme_comp_warranty_item2'        => 'text',
        'my_theme_comp_warranty_item3'        => 'text',
        'my_theme_comp_warranty_item4'        => 'text',

        // Common Compliance Concerns
        'my_theme_comp_concerns_h2'           => 'text',
        'my_theme_comp_concerns_intro'        => 'textarea',
        'my_theme_comp_concern1_h3'           => 'text',
        'my_theme_comp_concern1_p'            => 'textarea',
        'my_theme_comp_concern2_h3'           => 'text',
        'my_theme_comp_concern2_p'            => 'textarea',
        'my_theme_comp_concern3_h3'           => 'text',
        'my_theme_comp_concern3_p'            => 'textarea',

        // Only System Section
        'my_theme_comp_only_left_h2'          => 'text',
        'my_theme_comp_only_left_p1'          => 'textarea',
        'my_theme_comp_only_left_p2'          => 'textarea',
        'my_theme_comp_only_right_h3'         => 'text',
        'my_theme_comp_only_right_p1'         => 'textarea',
        'my_theme_comp_only_right_p2'         => 'textarea',

        // Proven Performance
        'my_theme_comp_proven_h2'             => 'text',
        'my_theme_comp_proven_p1'             => 'textarea',
        'my_theme_comp_proven_p2'             => 'textarea',
        'my_theme_comp_proven_case_h3'        => 'text',
        'my_theme_comp_proven_case_p'         => 'textarea',

        // Compatibility
        'my_theme_comp_compat_h2'             => 'text',
        'my_theme_comp_compat_intro'          => 'textarea',
        'my_theme_comp_compat_items'          => 'text',
        'my_theme_comp_compat_image'          => 'image',
        'my_theme_comp_compat_box_h3'         => 'text',
        'my_theme_comp_compat_box_p'          => 'textarea',
        'my_theme_comp_compat_box_cta'        => 'text',

        // Documentation
        'my_theme_comp_doc_h2'                => 'text',
        'my_theme_comp_doc_subtitle'          => 'text',
        'my_theme_comp_doc_card1_h3'          => 'text',
        'my_theme_comp_doc_card1_sub'         => 'text',
        'my_theme_comp_doc_card2_h3'          => 'text',
        'my_theme_comp_doc_card2_sub'         => 'text',
        'my_theme_comp_doc_card3_h3'          => 'text',
        'my_theme_comp_doc_card3_sub'         => 'text',
        'my_theme_comp_doc_closing'           => 'textarea',

        // Audit Readiness
        'my_theme_comp_audit_h2'              => 'text',
        'my_theme_comp_audit_p1'              => 'textarea',
        'my_theme_comp_audit_p2'              => 'textarea',
        'my_theme_comp_audit_aside_h3'        => 'text',
        'my_theme_comp_audit_aside_p'         => 'textarea',

        // Final CTA
        'my_theme_comp_cta_h2'                => 'text',
        'my_theme_comp_cta_p'                 => 'textarea',
        'my_theme_comp_cta_primary'           => 'text',
        'my_theme_comp_cta_secondary'         => 'text',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_compliance_fields', 10, 2);

function my_theme_admin_render_compliance(): void
{
    my_theme_admin_page_open('Compliance', 'goliath-compliance');

    // Hero
    my_theme_admin_section_open('Hero');
    my_theme_admin_text_field('my_theme_comp_hero_badge', 'Badge text', 'SAFETY & STANDARDS');
    my_theme_admin_text_field('my_theme_comp_hero_h1', 'Heading (H1)', 'Compliance & Safety Standards');
    my_theme_admin_textarea_field('my_theme_comp_hero_desc', 'Description', 'Safety concerning warehouse racking systems is controlled by clear expectations surrounding inspection, maintenance, and structural integrity. Goliath™ supports these requirements directly.');
    my_theme_admin_text_field('my_theme_comp_hero_cta', 'CTA button text', 'Get Certified Solution');
    my_theme_admin_section_close();

    // Regulation Compliant
    my_theme_admin_section_open('Regulation Compliant');
    my_theme_admin_text_field('my_theme_comp_reg_h2', 'Heading (H2)', 'Regulation Compliant');
    my_theme_admin_textarea_field('my_theme_comp_reg_p1', 'Paragraph 1', 'For warehouse owners and operators, compliance is more than just about meeting the laid-out standards. When followed properly, it helps reduce risk, protect people, and ensure that work is carried out without interrupting operations.');
    my_theme_admin_textarea_field('my_theme_comp_reg_p2', 'Paragraph 2', 'Goliath™ supports these requirements directly. Our permanent upright repair solution is tested and certified. Our product aligns with recognised UK and European standards, which address one of the most common causes of non-compliance in warehouses: impact damage to uprights.');
    my_theme_admin_text_field('my_theme_comp_reg_box_h3', 'Black box heading', '100% UK Compliance Guaranteed');
    my_theme_admin_textarea_field('my_theme_comp_reg_box_p', 'Black box paragraph', 'Every GOLIATH™ installation is fully compliant with UK Health & Safety regulations. We provide complete documentation and certification for your records and inspections.');
    my_theme_admin_section_close();

    // HSE EN SEMA Standards
    my_theme_admin_section_open('HSE, EN &amp; SEMA Standards');
    my_theme_admin_text_field('my_theme_comp_std_h2', 'Heading (H2)', 'Built to Align with HSE, EN and SEMA Guidelines');
    my_theme_admin_textarea_field('my_theme_comp_std_p1', 'Paragraph 1', 'Racking systems in the UK are assessed against guidelines from the HSE, EN standards, and industry best practice supported by SEMA.');
    my_theme_admin_textarea_field('my_theme_comp_std_p2', 'Paragraph 2', 'Goliath™ has been tested to comply with these expectations. It reinforces the part of the upright most susceptible to impact, helping maintain structural integrity and reduce the likelihood of damage being flagged during warehouse inspections.');
    my_theme_admin_text_field('my_theme_comp_std_card1_title', 'Card 1 title', 'BS EN 15512:2020 + A1:2022');
    my_theme_admin_textarea_field('my_theme_comp_std_card1_body', 'Card 1 body', 'Regulations for steel storage systems for adjustable pallet racking-principles for structural design');
    my_theme_admin_text_field('my_theme_comp_std_card2_title', 'Card 2 title', 'BS EN 15635:2008');
    my_theme_admin_textarea_field('my_theme_comp_std_card2_body', 'Card 2 body', 'Regulations for steel static storage systems application and maintenance of storage equipment');
    my_theme_admin_text_field('my_theme_comp_std_card3_title', 'Card 3 title', 'SEMA code of practice');
    my_theme_admin_textarea_field('my_theme_comp_std_card3_body', 'Card 3 body', 'for the design of adjustable pallet racking');
    my_theme_admin_text_field('my_theme_comp_std_card4_title', 'Card 4 title', 'SEMA code of practice');
    my_theme_admin_textarea_field('my_theme_comp_std_card4_body', 'Card 4 body', 'for the design and use of racking protection');
    my_theme_admin_section_close();

    // Image with Warranty Overlay
    my_theme_admin_section_open('Warranty Overlay');
    my_theme_admin_image_field('my_theme_comp_warranty_image', 'Section image');
    my_theme_admin_text_field('my_theme_comp_warranty_h3', 'Heading (H3)', 'Warranty Coverage Includes:');
    my_theme_admin_text_field('my_theme_comp_warranty_item1', 'Item 1', 'Overall structure and repair process coverage for life');
    my_theme_admin_text_field('my_theme_comp_warranty_item2', 'Item 2', 'Free replacement or repair if damaged from normal use');
    my_theme_admin_text_field('my_theme_comp_warranty_item3', 'Item 3', 'Free from manufacturing defects guarantee');
    my_theme_admin_text_field('my_theme_comp_warranty_item4', 'Item 4', 'No questions asked warranty claim process');
    my_theme_admin_section_close();

    // Common Compliance Concerns
    my_theme_admin_section_open('Common Compliance Concerns');
    my_theme_admin_text_field('my_theme_comp_concerns_h2', 'Heading (H2)', 'Addressing Common Compliance Concerns');
    my_theme_admin_textarea_field('my_theme_comp_concerns_intro', 'Intro paragraph', 'The most common concern many operators have is whether installing a non-manufacturer product could affect compliance or warranties.');
    my_theme_admin_text_field('my_theme_comp_concern1_h3', 'Card 1 heading', 'System Integration');
    my_theme_admin_textarea_field('my_theme_comp_concern1_p', 'Card 1 paragraph', 'Goliath™ works alongside your existing racking systems without compromising their integrity. It does not change load characteristics or interfere with how your system performs under normal conditions.');
    my_theme_admin_text_field('my_theme_comp_concern2_h3', 'Card 2 heading', 'Impact Protection');
    my_theme_admin_textarea_field('my_theme_comp_concern2_p', 'Card 2 paragraph', 'Instead, it protects the upright from external impact, which is one of the primary causes of structural failure.');
    my_theme_admin_text_field('my_theme_comp_concern3_h3', 'Card 3 heading', 'Breaking the Cycle');
    my_theme_admin_textarea_field('my_theme_comp_concern3_p', 'Card 3 paragraph', "Goliath\u{2122} also challenges the \u{2018}replace-and-repeat\u{2019} model by preventing damage to your uprights. This changes the maintenance cycle, but it does not affect any compliance requirements.");
    my_theme_admin_section_close();

    // Only System Section
    my_theme_admin_section_open('Only System in UK &amp; Europe');
    my_theme_admin_text_field('my_theme_comp_only_left_h2', 'Left column heading (H2)', 'The Only System of Its Kind in the UK and Europe');
    my_theme_admin_textarea_field('my_theme_comp_only_left_p1', 'Left paragraph 1', 'Goliath™ is the only pallet racking repair kit and protection system of its kind available across the UK and Europe.');
    my_theme_admin_textarea_field('my_theme_comp_only_left_p2', 'Left paragraph 2', 'Unlike traditional repair methods, Goliath™ is a permanent solution for the most common racking problems in warehouses. It stops the cycle of damage during facility usage and replacement.');
    my_theme_admin_text_field('my_theme_comp_only_right_h3', 'Right column heading (H3)', 'From a Compliance Perspective');
    my_theme_admin_textarea_field('my_theme_comp_only_right_p1', 'Right paragraph 1', 'Continuous damage causes structural weaknesses, which raises concerns during inspections. A system that prevents that damage, like Goliath™, provides a more stable, consistent outcome.');
    my_theme_admin_textarea_field('my_theme_comp_only_right_p2', 'Right paragraph 2', 'Goliath™ has also been independently tested and verified to perform excellently under real-world impact conditions. This provides additional assurance to our clients that the system is effective and suitable for long-term use in demanding warehouse environments.');
    my_theme_admin_section_close();

    // Proven Performance
    my_theme_admin_section_open('Proven Performance');
    my_theme_admin_text_field('my_theme_comp_proven_h2', 'Heading (H2)', 'Proven Performance Backed by Lifetime Warranty');
    my_theme_admin_textarea_field('my_theme_comp_proven_p1', 'Paragraph 1', 'Goliath™ is supported by a lifetime impact warranty, reflecting our confidence in its durability and long-term performance.');
    my_theme_admin_textarea_field('my_theme_comp_proven_p2', 'Paragraph 2', 'Once installed, it provides continuous protection in the same location without the need to change your uprights regularly. This reduces the frequency of repairs and keeps your uprights in good condition, through inspection cycles.');
    my_theme_admin_text_field('my_theme_comp_proven_case_h3', 'Case study heading', 'Case Study: B&M');
    my_theme_admin_textarea_field('my_theme_comp_proven_case_p', 'Case study paragraph', 'Our client, B&M, reduced racking repair costs by over 30% within the first 12 months of installation. This was achieved by preventing repeat damage to the uprights in their warehouse, which also reduces the likelihood of compliance issues arising from compromised uprights.');
    my_theme_admin_section_close();

    // Compatibility
    my_theme_admin_section_open('Compatibility');
    my_theme_admin_text_field('my_theme_comp_compat_h2', 'Heading (H2)', 'How compatible is GOLIATH™?');
    my_theme_admin_textarea_field('my_theme_comp_compat_intro', 'Intro paragraph', "GOLIATH™ is designed to work with all major pallet racking systems. Here's a list of the top 10 racking companies GOLIATH™ is compatible with:");
    my_theme_admin_text_field('my_theme_comp_compat_items', 'Items (comma-separated)', 'Link 51 XL, Dexion Mk3, Dexion P90, Mecalux, Stow, Apex, Redirack, PSS (all types), Bito, Hi-Lo Premier Rack & Rack Plan');
    my_theme_admin_image_field('my_theme_comp_compat_image', 'Compatibility image');
    my_theme_admin_text_field('my_theme_comp_compat_box_h3', 'Dark box heading', "Don't see your type?");
    my_theme_admin_textarea_field('my_theme_comp_compat_box_p', 'Dark box paragraph', 'No problem. GOLIATH™ can be adapted to work with all pallet racking systems. Contact us to discuss your specific racking configuration.');
    my_theme_admin_text_field('my_theme_comp_compat_box_cta', 'Dark box CTA text', 'Check Compatibility');
    my_theme_admin_section_close();

    // Documentation
    my_theme_admin_section_open('Documentation &amp; Certification');
    my_theme_admin_text_field('my_theme_comp_doc_h2', 'Heading (H2)', 'Transparent Documentation and Certification');
    my_theme_admin_text_field('my_theme_comp_doc_subtitle', 'Subtitle', 'To support compliance requirements, Goliath™ provides access to detailed documentation.');
    my_theme_admin_text_field('my_theme_comp_doc_card1_h3', 'Card 1 heading', 'Compliance Certification');
    my_theme_admin_text_field('my_theme_comp_doc_card1_sub', 'Card 1 subtitle', 'From independent testing');
    my_theme_admin_text_field('my_theme_comp_doc_card2_h3', 'Card 2 heading', 'Technical Specs');
    my_theme_admin_text_field('my_theme_comp_doc_card2_sub', 'Card 2 subtitle', 'Performance data and specifications');
    my_theme_admin_text_field('my_theme_comp_doc_card3_h3', 'Card 3 heading', 'Price Comparison');
    my_theme_admin_text_field('my_theme_comp_doc_card3_sub', 'Card 3 subtitle', 'Insights vs. traditional methods');
    my_theme_admin_textarea_field('my_theme_comp_doc_closing', 'Closing paragraph', "Downloadable PDFs are also available to support internal reviews, safety documentation, and procurement decisions. Our resources make it easier to show due diligence in the process and to explain clearly how Goliath™ contributes to safety and compliance.");
    my_theme_admin_section_close();

    // Audit Readiness
    my_theme_admin_section_open('Audit Readiness');
    my_theme_admin_text_field('my_theme_comp_audit_h2', 'Heading (H2)', 'Supporting Inspection Outcomes and Audit Readiness');
    my_theme_admin_textarea_field('my_theme_comp_audit_p1', 'Paragraph 1', 'Regular inspections are an important part of ensuring compliance. A SEMA racking inspection or internal audit will assess the visible damage, structural condition, and overall system safety.');
    my_theme_admin_textarea_field('my_theme_comp_audit_p2', 'Paragraph 2', 'By reducing impact damage, Goliath™ improves your inspection outcomes. Fewer damaged uprights in your reports mean fewer red or amber risk classifications and little to no need for urgent corrective action.');
    my_theme_admin_text_field('my_theme_comp_audit_aside_h3', 'Aside heading', 'Digital Racking Management');
    my_theme_admin_textarea_field('my_theme_comp_audit_aside_p', 'Aside paragraph', 'When combined with our digital racking management system, Goliath™ operators gain additional visibility through recorded inspection data and reports, proper risk categorisation, and repair documentation.');
    my_theme_admin_section_close();

    // Final CTA
    my_theme_admin_section_open('Final CTA');
    my_theme_admin_text_field('my_theme_comp_cta_h2', 'Heading (H2)', 'Ensure Compliance with Goliath™');
    my_theme_admin_textarea_field('my_theme_comp_cta_p', 'Paragraph', 'Protect your warehouse, reduce risk, and maintain the highest safety standards with our proven upright repair solution.');
    my_theme_admin_text_field('my_theme_comp_cta_primary', 'Primary CTA text', 'Get Free Site Survey');
    my_theme_admin_text_field('my_theme_comp_cta_secondary', 'Secondary CTA text', 'View FAQs');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
