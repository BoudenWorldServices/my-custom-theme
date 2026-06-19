<?php
declare(strict_types=1);
defined('ABSPATH') || exit;

function my_theme_admin_why_goliath_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-why-goliath') {
        return $defs;
    }

    return array_merge($defs, [
        /* Hero */
        'my_theme_wg_hero_badge'       => 'text',
        'my_theme_wg_hero_h1'          => 'text',
        'my_theme_wg_hero_desc'        => 'textarea',
        'my_theme_wg_hero_cta'         => 'text',

        /* VS Standard */
        'my_theme_wg_vs_h2'            => 'text',
        'my_theme_wg_vs_trad_h3'       => 'text',
        'my_theme_wg_vs_trad_p'        => 'textarea',
        'my_theme_wg_vs_trad_bold'     => 'text',
        'my_theme_wg_vs_gol_h3'        => 'text',
        'my_theme_wg_vs_gol_p'         => 'textarea',
        'my_theme_wg_vs_gol_bold'      => 'text',
        'my_theme_wg_vs_img1'          => 'image',
        'my_theme_wg_vs_img2'          => 'image',
        'my_theme_wg_vs_img3'          => 'image',

        /* Future Costs */
        'my_theme_wg_fc_h2'            => 'text',
        'my_theme_wg_fc_p1'            => 'textarea',
        'my_theme_wg_fc_p2'            => 'text',
        'my_theme_wg_fc_p3'            => 'textarea',
        'my_theme_wg_fc_p4'            => 'text',

        /* Repair vs Replace */
        'my_theme_wg_rr_h2'            => 'text',
        'my_theme_wg_rr_subtitle'      => 'text',
        'my_theme_wg_rr_p1'            => 'textarea',
        'my_theme_wg_rr_p2'            => 'text',
        'my_theme_wg_rr_p3'            => 'textarea',
        'my_theme_wg_rr_quote'         => 'textarea',

        /* Compatible Systems */
        'my_theme_wg_cs_h2'            => 'text',
        'my_theme_wg_cs_p1'            => 'text',
        'my_theme_wg_cs_p2'            => 'textarea',
        'my_theme_wg_cs_bold'          => 'text',

        /* End the Repair Cycle */
        'my_theme_wg_erc_h2'           => 'text',
        'my_theme_wg_erc_p1'           => 'textarea',
        'my_theme_wg_erc_p2'           => 'text',
        'my_theme_wg_erc_p3'           => 'text',
        'my_theme_wg_erc_callout'      => 'textarea',

        /* Sustainability */
        'my_theme_wg_sus_h2'           => 'text',
        'my_theme_wg_sus_p1'           => 'text',
        'my_theme_wg_sus_p2'           => 'textarea',
        'my_theme_wg_sus_p3'           => 'textarea',
        'my_theme_wg_sus_tagline'      => 'text',
        'my_theme_wg_sus_img'          => 'image',

        /* CTA */
        'my_theme_wg_cta_h2'           => 'text',
        'my_theme_wg_cta_desc'         => 'textarea',
        'my_theme_wg_cta_primary'      => 'text',
        'my_theme_wg_cta_secondary'    => 'text',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_why_goliath_fields', 10, 2);

function my_theme_admin_render_why_goliath(): void
{
    my_theme_admin_page_open('Why Goliath', 'goliath-why-goliath');

    /* ── Hero ──────────────────────────────────────────────── */
    my_theme_admin_section_open('Hero Section', 'Top banner with badge, heading, intro and CTA.');
    my_theme_admin_text_field('my_theme_wg_hero_badge', 'Badge Text', 'THE GOLIATH DIFFERENCE');
    my_theme_admin_text_field('my_theme_wg_hero_h1', 'Heading (H1)', 'Why GOLIATH™');
    my_theme_admin_textarea_field('my_theme_wg_hero_desc', 'Paragraph', 'Damage to racking happens frequently in busy warehouse environments. The actual problem is not just the damage, but how the damage is handled. The chosen repair method keeps warehouse owners or operators in a cycle of replace and repair, resulting in repeat costs and lower profitability.', 4);
    my_theme_admin_text_field('my_theme_wg_hero_cta', 'CTA Button Text', 'View case studies');
    my_theme_admin_section_close();

    /* ── VS Standard ──────────────────────────────────────── */
    my_theme_admin_section_open('Goliath vs. Standard Repair', 'Comparison of traditional repair and Goliath approach.');
    my_theme_admin_text_field('my_theme_wg_vs_h2', 'Section Heading (H2)', 'Goliath™ vs. Standard Repair');
    my_theme_admin_text_field('my_theme_wg_vs_trad_h3', 'Traditional Repair Heading (H3)', 'Traditional Repair');
    my_theme_admin_textarea_field('my_theme_wg_vs_trad_p', 'Traditional Repair Paragraph', 'Traditional pallet racking repair\'s sole focus is on replacing damaged uprights. This means uprights have to be damaged first before being repaired. The biggest problem with standard repair is that it doesn\'t prevent the same issue from happening again.', 4);
    my_theme_admin_text_field('my_theme_wg_vs_trad_bold', 'Traditional Repair Bold Text', 'This means uprights are replaced and eventually damaged again.');
    my_theme_admin_text_field('my_theme_wg_vs_gol_h3', 'Goliath Different Heading (H3)', 'Goliath™ is Different');
    my_theme_admin_textarea_field('my_theme_wg_vs_gol_p', 'Goliath Different Paragraph', 'Instead of repeatedly replacing the upright with the standard system, the upright is replaced with our high-strength steel repair system. Goliath™ is built to brace for impact, ensuring the structure is stronger and more resilient to handle high-traffic environments more effectively.', 4);
    my_theme_admin_text_field('my_theme_wg_vs_gol_bold', 'Goliath Different Bold Text', 'While standard repair methods are reactive, Goliath™ is a permanent upgrade for future circumstances.');
    my_theme_admin_image_field('my_theme_wg_vs_img1', 'Gallery Image 1', get_theme_file_uri('assets/images/whyGoliath/solution.webp'));
    my_theme_admin_image_field('my_theme_wg_vs_img2', 'Gallery Image 2', get_theme_file_uri('assets/images/Homepage/review-3.webp'));
    my_theme_admin_image_field('my_theme_wg_vs_img3', 'Gallery Image 3', get_theme_file_uri('assets/images/Homepage/review-1.webp'));
    my_theme_admin_section_close();

    /* ── Future Costs ─────────────────────────────────────── */
    my_theme_admin_section_open('The Right Way to Save Future Costs', 'Cost savings messaging and bullet-point list.');
    my_theme_admin_text_field('my_theme_wg_fc_h2', 'Section Heading (H2)', 'The Right Way to Save Future Costs');
    my_theme_admin_textarea_field('my_theme_wg_fc_p1', 'Paragraph 1', 'Choosing to replace uprights every time they are damaged is the most expensive solution.', 2);
    my_theme_admin_text_field('my_theme_wg_fc_p2', 'Paragraph 2', 'This is because every replacement involves:');
    my_theme_admin_textarea_field('my_theme_wg_fc_p3', 'Paragraph 3', 'Goliath™ reduces that recurring expense by strengthening the uprights and preventing repeat damage in the same location. By doing this, there is a reduced need for future repairs.', 3);
    my_theme_admin_text_field('my_theme_wg_fc_p4', 'Closing Paragraph', 'That means lower maintenance costs, fewer repair runs, and better budget control.');
    my_theme_admin_section_close();

    /* ── Repair vs Replace ────────────────────────────────── */
    my_theme_admin_section_open('Repair with Goliath vs. Replace', 'Dark section with orange quote box.');
    my_theme_admin_text_field('my_theme_wg_rr_h2', 'Section Heading (H2)', 'Repair with Goliath™ vs. Replace the Upright');
    my_theme_admin_text_field('my_theme_wg_rr_subtitle', 'Subtitle', 'Why repair with Goliath™ vs. replace upright?');
    my_theme_admin_textarea_field('my_theme_wg_rr_p1', 'Paragraph 1', 'Replacing an upright restores it to an original, damage-free product. But it does not reduce or improve its resistance to impact. It merely restarts the process.', 3);
    my_theme_admin_text_field('my_theme_wg_rr_p2', 'Paragraph 2', 'Goliath™ is built for high-traffic warehouse environments where impact is unavoidable.');
    my_theme_admin_textarea_field('my_theme_wg_rr_p3', 'Paragraph 3', 'With Goliath™, the focus shifts from reactive maintenance to proactive support, which reduces downtime and cuts costs.', 3);
    my_theme_admin_textarea_field('my_theme_wg_rr_quote', 'Orange Box Quote', 'Instead of resetting the problem, which replacement does, Goliath™ solves it.', 2);
    my_theme_admin_section_close();

    /* ── Compatible Systems ───────────────────────────────── */
    my_theme_admin_section_open('Compatible with All Major Racking Systems', 'Racking compatibility messaging.');
    my_theme_admin_text_field('my_theme_wg_cs_h2', 'Section Heading (H2)', 'Compatible with All Major Racking Systems');
    my_theme_admin_text_field('my_theme_wg_cs_p1', 'Paragraph 1', 'Warehouses are built differently, and so are racking systems.');
    my_theme_admin_textarea_field('my_theme_wg_cs_p2', 'Paragraph 2', 'Goliath™ retrofits to all major pallet racking systems used in the UK, making it a flexible solution for different industries and layouts. This allows you to upgrade your existing racks without having to replace the entire structure.', 4);
    my_theme_admin_text_field('my_theme_wg_cs_bold', 'Bold Text', 'Goliath™ is suitable for:');
    my_theme_admin_section_close();

    /* ── End the Repair Cycle ─────────────────────────────── */
    my_theme_admin_section_open('End the Repair Cycle', 'Repair cycle messaging with orange callout.');
    my_theme_admin_text_field('my_theme_wg_erc_h2', 'Section Heading (H2)', 'End the Repair Cycle');
    my_theme_admin_textarea_field('my_theme_wg_erc_p1', 'Paragraph 1', 'The cost of the repair cycle is not determined by the first repair. It is measured by the cost of every repair after the first.', 3);
    my_theme_admin_text_field('my_theme_wg_erc_p2', 'Bold Paragraph', 'Goliath™ was built to break the cycle.');
    my_theme_admin_text_field('my_theme_wg_erc_p3', 'Sub-paragraph', 'With our permanent upright repair solution:');
    my_theme_admin_textarea_field('my_theme_wg_erc_callout', 'Orange Callout', 'Once installed, Goliath™ continues to protect your racking forever, and we\'re confident that if it were to be damaged by usual FLT damage, we will replace it for free.', 3);
    my_theme_admin_section_close();

    /* ── Sustainability ───────────────────────────────────── */
    my_theme_admin_section_open('Supporting Sustainability', 'Environmental messaging and sustainability image.');
    my_theme_admin_text_field('my_theme_wg_sus_h2', 'Section Heading (H2)', 'Supporting Sustainability, One Upright at a Time');
    my_theme_admin_text_field('my_theme_wg_sus_p1', 'Paragraph 1', 'The waste of steel, material, and labour costs when replacing uprights is a major problem in warehousing.');
    my_theme_admin_textarea_field('my_theme_wg_sus_p2', 'Paragraph 2', 'By replacing your racking, Goliath™ lowers the amount of steel required to achieve the same result. This means you\'ll never have to repair the upright again, eliminating steel waste from the most high-traffic areas of your warehouse.', 4);
    my_theme_admin_textarea_field('my_theme_wg_sus_p3', 'Paragraph 3', 'This ensures a more sustainable warehouse operation and helps businesses reduce their environmental footprint.', 2);
    my_theme_admin_text_field('my_theme_wg_sus_tagline', 'Bold Tagline', 'Choose Goliath™. Choose Support.');
    my_theme_admin_image_field('my_theme_wg_sus_img', 'Sustainability Image', get_theme_file_uri('assets/images/whyGoliath/solution.webp'));
    my_theme_admin_section_close();

    /* ── CTA ──────────────────────────────────────────────── */
    my_theme_admin_section_open('Call to Action', 'Bottom CTA banner with two buttons.');
    my_theme_admin_text_field('my_theme_wg_cta_h2', 'Section Heading (H2)', 'Ready to Break the Repair Cycle?');
    my_theme_admin_textarea_field('my_theme_wg_cta_desc', 'Paragraph', 'Discover how Goliath™ can save your warehouse thousands in recurring repair costs while improving safety and compliance.', 2);
    my_theme_admin_text_field('my_theme_wg_cta_primary', 'Primary CTA Text', 'Get Free Site Survey');
    my_theme_admin_text_field('my_theme_wg_cta_secondary', 'Secondary CTA Text', 'View Case Studies');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
