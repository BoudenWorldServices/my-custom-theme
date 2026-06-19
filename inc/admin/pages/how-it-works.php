<?php
/**
 * Goliath Content Editor — How It Works admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

function my_theme_admin_how_it_works_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-how-it-works') {
        return $defs;
    }

    return array_merge($defs, [
        // Hero
        'my_theme_hiw_hero_badge'           => 'text',
        'my_theme_hiw_hero_h1'              => 'text',
        'my_theme_hiw_hero_paragraph'       => 'textarea',
        'my_theme_hiw_hero_cta'             => 'text',

        // Stats bar
        'my_theme_hiw_stat1_label'          => 'text',
        'my_theme_hiw_stat1_value'          => 'text',
        'my_theme_hiw_stat2_label'          => 'text',
        'my_theme_hiw_stat2_value'          => 'text',
        'my_theme_hiw_stat3_label'          => 'text',
        'my_theme_hiw_stat3_value'          => 'text',
        'my_theme_hiw_stat4_label'          => 'text',
        'my_theme_hiw_stat4_value'          => 'text',

        // Installation process
        'my_theme_hiw_install_h2'           => 'text',
        'my_theme_hiw_step1_title'          => 'text',
        'my_theme_hiw_step1_desc'           => 'textarea',
        'my_theme_hiw_step2_title'          => 'text',
        'my_theme_hiw_step2_desc'           => 'textarea',
        'my_theme_hiw_step3_title'          => 'text',
        'my_theme_hiw_step3_desc'           => 'textarea',
        'my_theme_hiw_step4_title'          => 'text',
        'my_theme_hiw_step4_desc'           => 'textarea',
        'my_theme_hiw_step5_title'          => 'text',
        'my_theme_hiw_step5_desc'           => 'textarea',
        'my_theme_hiw_install_video_text'   => 'text',
        'my_theme_hiw_install_img1'         => 'image',
        'my_theme_hiw_install_img2'         => 'image',
        'my_theme_hiw_install_img3'         => 'image',

        // Fix the Problem / Lifetime Warranty
        'my_theme_hiw_fix_h2_line1'         => 'text',
        'my_theme_hiw_fix_h2_line2'         => 'text',
        'my_theme_hiw_fix_paragraph'        => 'textarea',
        'my_theme_hiw_warranty_h2_line1'    => 'text',
        'my_theme_hiw_warranty_h2_line2'    => 'text',
        'my_theme_hiw_warranty_para1'       => 'textarea',
        'my_theme_hiw_warranty_para2'       => 'textarea',

        // UK Standards
        'my_theme_hiw_standards_h2'         => 'text',
        'my_theme_hiw_standards_intro1'     => 'textarea',
        'my_theme_hiw_standards_intro2'     => 'text',
        'my_theme_hiw_standards_card1_title' => 'text',
        'my_theme_hiw_standards_card1_body' => 'textarea',
        'my_theme_hiw_standards_card2_title' => 'text',
        'my_theme_hiw_standards_card2_body' => 'textarea',
        'my_theme_hiw_standards_card3_title' => 'text',
        'my_theme_hiw_standards_card3_body' => 'textarea',
        'my_theme_hiw_standards_card4_title' => 'text',
        'my_theme_hiw_standards_card4_body' => 'textarea',
        'my_theme_hiw_standards_closing'    => 'textarea',

        // Crash Test Video Band
        'my_theme_hiw_crash_headline'       => 'text',

        // Image Gallery
        'my_theme_hiw_gallery_img1'         => 'image',
        'my_theme_hiw_gallery_img2'         => 'image',
        'my_theme_hiw_gallery_img3'         => 'image',

        // Fast On-Site Repair
        'my_theme_hiw_repair_h2'            => 'text',
        'my_theme_hiw_repair_para1'         => 'textarea',
        'my_theme_hiw_repair_para2'         => 'textarea',
        'my_theme_hiw_repair_para3'         => 'textarea',
        'my_theme_hiw_repair_box_h3'        => 'text',
        'my_theme_hiw_repair_box_para'      => 'textarea',

        // Our Installation Process
        'my_theme_hiw_ourprocess_h2'        => 'text',
        'my_theme_hiw_ourprocess_para1'     => 'textarea',
        'my_theme_hiw_ourprocess_para2'     => 'textarea',
        'my_theme_hiw_ourprocess_para3'     => 'textarea',
        'my_theme_hiw_ourprocess_para4'     => 'textarea',
        'my_theme_hiw_ourprocess_quote'     => 'textarea',

        // Strength Where It Matters Most
        'my_theme_hiw_strength_h2'          => 'text',
        'my_theme_hiw_strength_para1'       => 'textarea',
        'my_theme_hiw_strength_para2'       => 'textarea',
        'my_theme_hiw_strength_box'         => 'textarea',
        'my_theme_hiw_strength_tagline'     => 'text',

        // Installed in Real-World / Built to Support Compliance
        'my_theme_hiw_realworld_h2'         => 'text',
        'my_theme_hiw_compliance_h2'        => 'text',

        // CTA section
        'my_theme_hiw_cta_h2'              => 'text',
        'my_theme_hiw_cta_para1'           => 'textarea',
        'my_theme_hiw_cta_para2'           => 'textarea',
        'my_theme_hiw_cta_primary'         => 'text',
        'my_theme_hiw_cta_secondary'       => 'text',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_how_it_works_fields', 10, 2);

function my_theme_admin_render_how_it_works(): void
{
    my_theme_admin_page_open('How It Works', 'goliath-how-it-works');

    // Hero
    my_theme_admin_section_open('Hero Section', 'Top banner with badge, heading, intro and CTA.');
    my_theme_admin_text_field('my_theme_hiw_hero_badge', 'Badge Text', 'GOLIATH SOLUTION');
    my_theme_admin_text_field('my_theme_hiw_hero_h1', 'Main Heading (H1)', 'How it works');
    my_theme_admin_textarea_field('my_theme_hiw_hero_paragraph', 'Hero Paragraph', 'Installing a Goliath™ upright in your warehouse can be done in 30 minutes.', 2);
    my_theme_admin_text_field('my_theme_hiw_hero_cta', 'CTA Button Text', 'Get Free Assessment');
    my_theme_admin_section_close();

    // Stats bar
    my_theme_admin_section_open('Stats Bar', 'Four key statistics displayed below the hero.');
    my_theme_admin_text_field('my_theme_hiw_stat1_label', 'Stat 1 Label', 'Installation');
    my_theme_admin_text_field('my_theme_hiw_stat1_value', 'Stat 1 Value', '30 Minutes');
    my_theme_admin_text_field('my_theme_hiw_stat2_label', 'Stat 2 Label', 'Warranty');
    my_theme_admin_text_field('my_theme_hiw_stat2_value', 'Stat 2 Value', 'Lifetime');
    my_theme_admin_text_field('my_theme_hiw_stat3_label', 'Stat 3 Label', 'UK Compliance');
    my_theme_admin_text_field('my_theme_hiw_stat3_value', 'Stat 3 Value', '100%');
    my_theme_admin_text_field('my_theme_hiw_stat4_label', 'Stat 4 Label', 'Downtime');
    my_theme_admin_text_field('my_theme_hiw_stat4_value', 'Stat 4 Value', 'Minimal');
    my_theme_admin_section_close();

    // Installation Process
    my_theme_admin_section_open('Installation Process', 'Five-step process with video and images.');
    my_theme_admin_text_field('my_theme_hiw_install_h2', 'Section Heading', 'Installation process');
    my_theme_admin_text_field('my_theme_hiw_step1_title', 'Step 1 Title', 'Precision Cutting');
    my_theme_admin_textarea_field('my_theme_hiw_step1_desc', 'Step 1 Description', 'We use a specially designed cutting jig that\'s bolted to the existing damaged upright. This allows us to get a factory cut to the upright. The damaged section is cut out using a handheld bandsaw with a cutting jig that allows us to make a perfect cut every time. The damaged upright is removed. We use a prop system to hold the empty racking in place.', 3);
    my_theme_admin_text_field('my_theme_hiw_step2_title', 'Step 2 Title', 'Fitting Goliath™');
    my_theme_admin_textarea_field('my_theme_hiw_step2_desc', 'Step 2 Description', 'Goliath™ is fitted into place and all nuts and bolts are loosely fitted, which connects the upright and repair kit together.', 2);
    my_theme_admin_text_field('my_theme_hiw_step3_title', 'Step 3 Title', 'Securing the Structure');
    my_theme_admin_textarea_field('my_theme_hiw_step3_desc', 'Step 3 Description', 'Bracing is bolted to Goliath™, and the prop is lowered, allowing all nuts and bolts to be tightened.', 2);
    my_theme_admin_text_field('my_theme_hiw_step4_title', 'Step 4 Title', 'Floor Fixing');
    my_theme_admin_textarea_field('my_theme_hiw_step4_desc', 'Step 4 Description', 'Goliath™ is fixed down using two no. M16 double helix floor bolts, designed to work with Goliath™ to offer extra strength.', 2);
    my_theme_admin_text_field('my_theme_hiw_step5_title', 'Step 5 Title', 'Installation Complete');
    my_theme_admin_textarea_field('my_theme_hiw_step5_desc', 'Step 5 Description', 'Installation is complete. You can resume your warehouse operations, knowing that any previously damaged racking has been repaired.', 2);
    my_theme_admin_text_field('my_theme_hiw_install_video_text', 'Video Link Text', 'Installation Video');
    my_theme_admin_image_field('my_theme_hiw_install_img1', 'Process Image 1', get_theme_file_uri('assets/images/howITworks/process1.webp'));
    my_theme_admin_image_field('my_theme_hiw_install_img2', 'Process Image 2', get_theme_file_uri('assets/images/howITworks/process2.webp'));
    my_theme_admin_image_field('my_theme_hiw_install_img3', 'Process Image 3', get_theme_file_uri('assets/images/howITworks/process3.webp'));
    my_theme_admin_section_close();

    // Fix the Problem / Lifetime Warranty
    my_theme_admin_section_open('Fix the Problem / Lifetime Warranty', 'Two-column section with value propositions.');
    my_theme_admin_text_field('my_theme_hiw_fix_h2_line1', 'Fix H2 Line 1 (orange)', 'Fix the Problem');
    my_theme_admin_text_field('my_theme_hiw_fix_h2_line2', 'Fix H2 Line 2 (black)', 'Without Stopping Your Business');
    my_theme_admin_textarea_field('my_theme_hiw_fix_paragraph', 'Fix Paragraph', 'With Goliath™, you can fix the problem without stopping your business. No downtime or delays.', 2);
    my_theme_admin_text_field('my_theme_hiw_warranty_h2_line1', 'Warranty H2 Line 1 (orange)', 'Our Lifetime');
    my_theme_admin_text_field('my_theme_hiw_warranty_h2_line2', 'Warranty H2 Line 2 (black)', 'Impact Warranty');
    my_theme_admin_textarea_field('my_theme_hiw_warranty_para1', 'Warranty Paragraph 1', 'Lifetime impact warranty: if your racking upright is damaged under normal warehouse conditions, we repair or replace it, no questions asked.', 2);
    my_theme_admin_textarea_field('my_theme_hiw_warranty_para2', 'Warranty Paragraph 2', 'Our product is a long-term solution that removes the risk of paying for repairs continuously.', 2);
    my_theme_admin_section_close();

    // UK Standards
    my_theme_admin_section_open('Designed to Meet UK Standards', 'Standards compliance section with four cards.');
    my_theme_admin_text_field('my_theme_hiw_standards_h2', 'Section Heading', 'Designed to Meet UK Standards');
    my_theme_admin_textarea_field('my_theme_hiw_standards_intro1', 'Intro Paragraph 1', 'Goliath™ is developed to meet the UK\'s racking regulations and industry best practices. This ensures every repair supports both safety and compliance.', 2);
    my_theme_admin_text_field('my_theme_hiw_standards_intro2', 'Intro Paragraph 2', 'It aligns with key standards, including:');
    my_theme_admin_text_field('my_theme_hiw_standards_card1_title', 'Card 1 Title', 'BS EN 15512:2020 + A1:2022');
    my_theme_admin_textarea_field('my_theme_hiw_standards_card1_body', 'Card 1 Body', 'Regulations for steel storage systems for adjustable pallet racking-principles for structural design', 2);
    my_theme_admin_text_field('my_theme_hiw_standards_card2_title', 'Card 2 Title', 'BS EN 15635:2008');
    my_theme_admin_textarea_field('my_theme_hiw_standards_card2_body', 'Card 2 Body', 'Regulations for steel static storage systems application and maintenance of storage equipment', 2);
    my_theme_admin_text_field('my_theme_hiw_standards_card3_title', 'Card 3 Title', 'SEMA code of practice');
    my_theme_admin_textarea_field('my_theme_hiw_standards_card3_body', 'Card 3 Body', 'for the design of adjustable pallet racking', 2);
    my_theme_admin_text_field('my_theme_hiw_standards_card4_title', 'Card 4 Title', 'SEMA code of practice');
    my_theme_admin_textarea_field('my_theme_hiw_standards_card4_body', 'Card 4 Body', 'for the design and use of racking protection', 2);
    my_theme_admin_textarea_field('my_theme_hiw_standards_closing', 'Closing Paragraph', 'We\'re proud that Goliath™ is reinforced in a way that supports ongoing safety, reduces risk, and meets the expectations of UK regulatory bodies. Our upright repair solution was built according to UK H&S specifications, making it a trusted solution for warehouses in the UK.', 3);
    my_theme_admin_section_close();

    // Crash Test Video Band
    my_theme_admin_section_open('Crash Test Video Band', 'Orange headline beside video.');
    my_theme_admin_text_field('my_theme_hiw_crash_headline', 'Headline', 'Install once stop damage for good.');
    my_theme_admin_section_close();

    // Image Gallery
    my_theme_admin_section_open('Image Gallery', 'Three process images.');
    my_theme_admin_image_field('my_theme_hiw_gallery_img1', 'Gallery Image 1', get_theme_file_uri('assets/images/howITworks/process1.webp'));
    my_theme_admin_image_field('my_theme_hiw_gallery_img2', 'Gallery Image 2', get_theme_file_uri('assets/images/howITworks/process2.webp'));
    my_theme_admin_image_field('my_theme_hiw_gallery_img3', 'Gallery Image 3', get_theme_file_uri('assets/images/howITworks/process3.webp'));
    my_theme_admin_section_close();

    // Fast On-Site Repair
    my_theme_admin_section_open('Fast, On-Site Repair', 'Repair benefits with orange callout box.');
    my_theme_admin_text_field('my_theme_hiw_repair_h2', 'Section Heading', 'Fast, On-Site Repair with Minimal Disruption');
    my_theme_admin_textarea_field('my_theme_hiw_repair_para1', 'Paragraph 1', 'Racking damage needs to be addressed quickly. This is because unaddressed upright damage puts lives in danger. But replacing your racking should not be the reason to shut down your operation.', 3);
    my_theme_admin_textarea_field('my_theme_hiw_repair_para2', 'Paragraph 2', 'Goliath™ is fast and efficient. Installation within live warehouse environments is done without removing and replacing the existing full uprights. Only the damaged section is cut out and replaced with our high-strength steel repair. This reinforces the structure without major disruption.', 3);
    my_theme_admin_textarea_field('my_theme_hiw_repair_para3', 'Paragraph 3', 'Installation takes as little as 30 minutes per upright, allowing work to be completed while your warehouse continues to operate. This means minimal downtime and much higher safety standards whenever Goliath™ is installed.', 3);
    my_theme_admin_text_field('my_theme_hiw_repair_box_h3', 'Orange Box Heading', '30 Minutes Installation');
    my_theme_admin_textarea_field('my_theme_hiw_repair_box_para', 'Orange Box Paragraph', 'Installation takes as little as 30 minutes per upright, allowing work to be completed while your warehouse continues to operate. This means minimal downtime and much higher safety standards whenever Goliath™ is installed.', 3);
    my_theme_admin_section_close();

    // Our Installation Process
    my_theme_admin_section_open('Our Installation Process', 'Detailed process description with black quote box.');
    my_theme_admin_text_field('my_theme_hiw_ourprocess_h2', 'Section Heading', 'Our Installation Process');
    my_theme_admin_textarea_field('my_theme_hiw_ourprocess_para1', 'Paragraph 1', 'The process starts by highlighting the damaged area of the upright. Instead of removing the entire upright when replacing, we only remove the affected area. This limits the area of focus.', 3);
    my_theme_admin_textarea_field('my_theme_hiw_ourprocess_para2', 'Paragraph 2', 'Goliath™ is fitted in place of the damaged steel by securing it directly to the existing upright, forming a reinforced structure that restores load integrity and improves resistance to future impact.', 3);
    my_theme_admin_textarea_field('my_theme_hiw_ourprocess_para3', 'Paragraph 3', 'Bracing is bolted to Goliath™, and the prop is lowered, allowing all nuts and bolts to be tightened. Goliath™ is fixed down using two no. M16 double helix floor bolts, designed to work with Goliath™ to offer extra strength.', 3);
    my_theme_admin_textarea_field('my_theme_hiw_ourprocess_para4', 'Paragraph 4', 'Installation is complete. You can resume your warehouse operations safely, knowing that any previously damaged racking has been repaired.', 2);
    my_theme_admin_textarea_field('my_theme_hiw_ourprocess_quote', 'Black Box Quote', 'Installation is complete. You can resume your warehouse operations safely, knowing that any previously damaged racking has been repaired.', 3);
    my_theme_admin_section_close();

    // Strength Where It Matters Most
    my_theme_admin_section_open('Strength Where It Matters Most', 'Dark section with orange box and tagline.');
    my_theme_admin_text_field('my_theme_hiw_strength_h2', 'Section Heading', 'Strength Where It Matters Most');
    my_theme_admin_textarea_field('my_theme_hiw_strength_para1', 'Paragraph 1', 'Goliath™ focuses on the area most likely to be impacted by forklifts.', 2);
    my_theme_admin_textarea_field('my_theme_hiw_strength_para2', 'Paragraph 2', 'Once it is installed, the reinforced section becomes stronger than the original structure. It absorbs repeated impacts from movement and forklifts and prevents the same damage from happening again in that location.', 3);
    my_theme_admin_textarea_field('my_theme_hiw_strength_box', 'Orange Box Text', 'With Goliath™, you never have to pay for an upright replacement in the same area again. This is because Goliath™ is covered by a lifetime impact warranty; the only one of its kind in the UK or Europe.', 3);
    my_theme_admin_text_field('my_theme_hiw_strength_tagline', 'Tagline', 'This turns a reactive repair into a structural upgrade.');
    my_theme_admin_section_close();

    // Installed in Real-World / Built to Support Compliance
    my_theme_admin_section_open('Installed in Real-World / Compliance', 'Two-column section headings.');
    my_theme_admin_text_field('my_theme_hiw_realworld_h2', 'Real-World Heading', 'Installed in Real-World Environments');
    my_theme_admin_text_field('my_theme_hiw_compliance_h2', 'Compliance Heading', 'Built to Support Compliance');
    my_theme_admin_section_close();

    // CTA Section
    my_theme_admin_section_open('A Smarter Way CTA', 'Final call-to-action section.');
    my_theme_admin_text_field('my_theme_hiw_cta_h2', 'Section Heading', 'A Smarter Way to Handle Racking Damage');
    my_theme_admin_textarea_field('my_theme_hiw_cta_para1', 'Paragraph 1', 'Instead of repeatedly repairing or replacing uprights, Goliath™ changes how damage is managed. It allows you to fix the issue quickly, strengthen the structure, and reduce the likelihood of recurrence without slowing your operation down.', 3);
    my_theme_admin_textarea_field('my_theme_hiw_cta_para2', 'Paragraph 2', 'There is no other system in the UK that offers the same assurance of reduced repairs, minimal downtime during installation, and cost-saving advantage that results in higher profitability for your warehouse like Goliath™.', 3);
    my_theme_admin_text_field('my_theme_hiw_cta_primary', 'Primary CTA Text', 'Get Free Site Survey');
    my_theme_admin_text_field('my_theme_hiw_cta_secondary', 'Secondary CTA Text', 'View Compliance Info');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
