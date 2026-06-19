<?php
/**
 * Goliath Content — Migrate to Blocks admin page.
 *
 * Provides a one-click migration tool that reads each page's wp_options data
 * from the Goliath Content admin and writes it into post_content as serialised
 * Gutenberg block markup. After migration the Gutenberg editor shows real,
 * editable blocks for each page.
 *
 * Also handles Case Study migration: reads the library from wp_options and
 * creates a 'case-study' CPT post for each entry with block markup + card meta.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/* ------------------------------------------------------------------ */
/*  Helpers                                                            */
/* ------------------------------------------------------------------ */

/**
 * Serialise a single self-closing block.
 *
 * @param string               $name  Full block name e.g. 'goliath/hero-section'.
 * @param array<string, mixed> $attrs Block attributes.
 */
function my_theme_block(string $name, array $attrs = []): string
{
    $json = wp_json_encode($attrs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($attrs) {
        return "<!-- wp:{$name} {$json} /-->\n";
    }
    return "<!-- wp:{$name} /-->\n";
}

/**
 * Return a wp_options string, falling back to $default.
 */
function my_theme_opt(string $key, string $default = ''): string
{
    $val = get_option($key, $default);
    return is_string($val) ? $val : $default;
}

/**
 * Write block markup into a page's post_content.
 *
 * @param string $slug        WP page slug.
 * @param string $markup      Serialised block markup.
 * @return array{success: bool, message: string}
 */
function my_theme_migrate_page(string $slug, string $markup): array
{
    $page = get_page_by_path($slug, OBJECT, 'page');
    if (! $page) {
        return ['success' => false, 'message' => "No WordPress page found with slug \"{$slug}\"."];
    }

    global $wpdb;
    $result = $wpdb->update(
        $wpdb->posts,
        ['post_content' => $markup],
        ['ID' => $page->ID],
        ['%s'],
        ['%d']
    );

    if ($result === false) {
        return ['success' => false, 'message' => 'Database update failed: ' . $wpdb->last_error];
    }

    clean_post_cache($page->ID);

    return ['success' => true, 'message' => "Page \"{$page->post_title}\" migrated successfully (ID {$page->ID})."];
}

/* ================================================================== */
/*  Per-page block markup generators                                   */
/* ================================================================== */

/** Homepage → block markup */
function my_theme_migrate_markup_homepage(): string
{
    $m = '';

    // Section 1: Hero with carousel
    $hero_slide1 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_hero_slide1', get_theme_file_uri('assets/images/Homepage/hero-goliath.webp')) : get_theme_file_uri('assets/images/Homepage/hero-goliath.webp');
    $hero_slide2 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_hero_slide2', get_theme_file_uri('assets/images/Homepage/hero-installation.webp')) : get_theme_file_uri('assets/images/Homepage/hero-installation.webp');
    $hero_slide3 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_hero_slide3', get_theme_file_uri('assets/images/Homepage/hero-damage.webp')) : get_theme_file_uri('assets/images/Homepage/hero-damage.webp');
    $m .= my_theme_block('goliath/hp-hero', [
        'slide1' => $hero_slide1,
        'slide2' => $hero_slide2,
        'slide3' => $hero_slide3,
        'heading'          => my_theme_opt('my_theme_hp_hero_h1', 'Safe, Instant Repair for Damaged Uprights'),
        'tagline1'         => my_theme_opt('my_theme_hp_hero_tagline_1', 'Minimal Downtime, Maximum Safety'),
        'tagline2'         => my_theme_opt('my_theme_hp_hero_tagline_2', 'Lifetime Warranty'),
        'ctaText'          => my_theme_opt('my_theme_hp_hero_cta_text', 'Get Your Free Assessment'),
        'ctaUrl'           => my_theme_opt('my_theme_hp_hero_cta_url', '/contact/'),
        'secondaryCtaText' => my_theme_opt('my_theme_hp_hero_secondary_cta_text', 'View more'),
        'secondaryCtaUrl'  => my_theme_opt('my_theme_hp_hero_secondary_cta_url', '#solution'),
        'stat1Label'       => my_theme_opt('my_theme_hp_hero_stat1_label', 'Installation'),
        'stat1Value'       => my_theme_opt('my_theme_hp_hero_stat1_value', '30 Minutes'),
        'stat2Label'       => my_theme_opt('my_theme_hp_hero_stat2_label', 'Warranty'),
        'stat2Value'       => my_theme_opt('my_theme_hp_hero_stat2_value', 'Lifetime'),
        'stat3Label'       => my_theme_opt('my_theme_hp_hero_stat3_label', 'UK Compliance'),
        'stat3Value'       => my_theme_opt('my_theme_hp_hero_stat3_value', '100%'),
    ]);

    // Section 2: Installation process (4 steps)
    $steps_raw = get_option('my_theme_hp_process_steps');
    $steps = is_array($steps_raw) ? $steps_raw : [
        ['title' => 'Identify Damaged Upright', 'description' => 'Comprehensive evaluation of your racking system. Our expert team identifies all areas of concern and provides detailed recommendations.'],
        ['title' => 'Apply Fast, Permanent Repair', 'description' => 'Installation takes just 30 minutes per upright. Minimal disruption to your operations.'],
        ['title' => 'Lifetime Warranty Activated', 'description' => 'Your repair is covered forever. If any impact damage occurs, we replace the affected parts at no cost.'],
        ['title' => 'Peace of Mind Guaranteed', 'description' => 'Rest easy knowing your racking is safe, compliant, and protected.'],
    ];
    $m .= my_theme_block('goliath/hp-process', [
        'heading'    => my_theme_opt('my_theme_hp_process_heading', 'Installation process'),
        'subheading' => my_theme_opt('my_theme_hp_process_subheading', 'Fast, Easy, Guaranteed'),
        'accent'     => my_theme_opt('my_theme_hp_process_accent', 'Unique solution to end the repetitive cycle of upright damage.'),
        'body1'      => my_theme_opt('my_theme_hp_process_body_1', 'From assessment to installation to lifetime protection – we handle everything so you can focus on your business.'),
        'body2'      => my_theme_opt('my_theme_hp_process_body_2', 'Our team can install GOLIATH™ in your warehouse in as little as 30 minutes.'),
        'steps'      => array_map(function ($s) {
            return ['title' => $s['title'] ?? '', 'description' => $s['description'] ?? ($s['desc'] ?? '')];
        }, $steps),
    ]);

    // Section 3: Preview / photo collage
    $preview_img1 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_review_img1', get_theme_file_uri('assets/images/Homepage/review-1.webp')) : get_theme_file_uri('assets/images/Homepage/review-1.webp');
    $preview_img2 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_review_img2', get_theme_file_uri('assets/images/Homepage/review-2.webp')) : get_theme_file_uri('assets/images/Homepage/review-2.webp');
    $preview_img3 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_review_img3', get_theme_file_uri('assets/images/Homepage/review-3.webp')) : get_theme_file_uri('assets/images/Homepage/review-3.webp');
    $m .= my_theme_block('goliath/hp-preview', [
        'eyebrow' => my_theme_opt('my_theme_hp_preview_eyebrow', 'Preview Process'),
        'heading' => my_theme_opt('my_theme_hp_preview_heading', 'Racking upright repair built to last'),
        'img1' => $preview_img1,
        'img2' => $preview_img2,
        'img3' => $preview_img3,
        'subheading' => my_theme_opt('my_theme_hp_preview_subheading', 'Racking upright repair built to last'),
        'bodyIntro'  => my_theme_opt('my_theme_hp_preview_body_intro', 'Goliath™ is a permanent racking upright repair that stops repeat damage and keeps your warehouse operating safely.'),
        'bodyInstalled' => my_theme_opt('my_theme_hp_preview_body_installed', 'Installed in minutes. Built to withstand impact.'),
        'leftH3' => my_theme_opt('my_theme_hp_preview_left_h3', 'Why Goliath™? (Money saving proposition)'),
        'leftP'  => my_theme_opt('my_theme_hp_preview_left_p', 'When warehouse racking damage happens, you know it is not a one-off issue. It is a cycle of hit, repair, and replacement happening continuously. Every incident carries its own cost and risk.'),
        'rightH3' => my_theme_opt('my_theme_hp_preview_right_h3', 'Goliath is the Solution'),
        'rightP'  => my_theme_opt('my_theme_hp_preview_right_p', 'Our permanent racking upright repair system is a durable setup that is engineered to meet UK safety standards. Once installed, it absorbs continuous impacts and prevents future damage. We\'re the smart solution to repeated upright replacement.'),
        'rightTransition' => my_theme_opt('my_theme_hp_preview_right_transition', 'That means:'),
        'bullet1' => my_theme_opt('my_theme_hp_preview_bullet_1', 'Never replace an upright again'),
        'bullet2' => my_theme_opt('my_theme_hp_preview_bullet_2', 'Lower maintenance costs'),
        'bullet3' => my_theme_opt('my_theme_hp_preview_bullet_3', 'Reduced operational disruption'),
        'bullet4' => my_theme_opt('my_theme_hp_preview_bullet_4', 'Long lifespan for racking systems'),
        'rightOutro' => my_theme_opt('my_theme_hp_preview_right_outro', 'Goliath™ doesn\'t offer a short-term fix. Ours is a long-term cost-saving solution for warehouse racking damage.'),
    ]);

    // Section 4: Solution / peace of mind
    $solution_img = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_solution_img', get_theme_file_uri('assets/images/Homepage/installonce.webp')) : get_theme_file_uri('assets/images/Homepage/installonce.webp');
    $m .= my_theme_block('goliath/hp-solution', [
        'mainImage'    => $solution_img,
        'eyebrow'      => my_theme_opt('my_theme_hp_solution_eyebrow', 'INSTALL ONCE,'),
        'badge'        => my_theme_opt('my_theme_hp_solution_badge', 'Forever Protected'),
        'heading'      => my_theme_opt('my_theme_hp_solution_heading', 'Protect for lifetime'),
        'intro'        => my_theme_opt('my_theme_hp_solution_intro', 'Every warehouse is a high-pressure environment. Tight deadlines, high traffic, and continuous forklift movement increase the risk of damage to warehouse racks.'),
        'promiseTitle' => my_theme_opt('my_theme_hp_promise_title', 'Goliath Promise'),
        'promiseQuote' => my_theme_opt('my_theme_hp_promise_quote', '"We offer more than repairs. We deliver confidence, safety, and the certainty that your warehouse is protected for life."'),
    ]);

    // Section 5: 6 Advantages + dark CTA bar
    $m .= my_theme_block('goliath/hp-advantages', [
        'eyebrow' => my_theme_opt('my_theme_hp_advantages_eyebrow', 'The Goliath Difference'),
        'heading' => my_theme_opt('my_theme_hp_advantages_heading', '6 Reasons, 6 Advantages'),
        'intro1'  => my_theme_opt('my_theme_hp_advantages_intro1', 'Your customers aren\'t buying a "product" – they\'re buying risk reduction and peace of mind.'),
        'intro2'  => my_theme_opt('my_theme_hp_advantages_intro2', 'We don\'t sell products. We serve you with a solid, durable solution to your problems backed by lifetime guarantees and unwavering reassurance.'),
        'barText' => my_theme_opt('my_theme_hp_advantages_bar_text', '100% Client Satisfaction • Save 70% • 30min Installation • Lifetime Warranty'),
        'cta1Text' => my_theme_opt('my_theme_hp_advantages_cta1_text', 'View case studies'),
        'cta1Url'  => my_theme_opt('my_theme_hp_advantages_cta1_url', '/case-studies/'),
        'cta2Text' => my_theme_opt('my_theme_hp_advantages_cta2_text', 'Get Similar Results'),
        'cta2Url'  => my_theme_opt('my_theme_hp_advantages_cta2_url', '#contact'),
    ]);

    // Section 6: Timer/video split banner
    $m .= my_theme_block('goliath/hp-timer-video', [
        'eyebrow' => my_theme_opt('my_theme_hp_timer_eyebrow', 'Never replace a racking upright again'),
        'heading' => my_theme_opt('my_theme_hp_timer_heading', 'Installed in less than 30 minutes, covered for life'),
        'compat'  => my_theme_opt('my_theme_hp_timer_compat', 'Compatible with all UK and EU racking systems'),
    ]);

    // Section 7: Case study + KPI + expert block
    $cs_img1 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_casestudy_img1', get_theme_file_uri('assets/images/Homepage/case-study1.webp')) : get_theme_file_uri('assets/images/Homepage/case-study1.webp');
    $cs_img2 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_casestudy_img2', get_theme_file_uri('assets/images/Homepage/case-study2.webp')) : get_theme_file_uri('assets/images/Homepage/case-study2.webp');
    $cs_img3 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_casestudy_img3', get_theme_file_uri('assets/images/Homepage/case-study3.webp')) : get_theme_file_uri('assets/images/Homepage/case-study3.webp');
    $m .= my_theme_block('goliath/hp-case-study', [
        'caseImg1'           => $cs_img1,
        'caseImg2'           => $cs_img2,
        'caseImg3'           => $cs_img3,
        'eyebrow'            => my_theme_opt('my_theme_hp_casestudy_eyebrow', 'Featured Case Study'),
        'heading'            => my_theme_opt('my_theme_hp_casestudy_heading', 'UK leading retailer saved 70% on repairs in the first 12 months vs traditional replacement'),
        'body'               => my_theme_opt('my_theme_hp_casestudy_body', 'As a result, Goliath is now being rolled out across all of their sites and is even being installed as standard for all new fit-out projects.'),
        'expertBadge'        => my_theme_opt('my_theme_hp_expert_badge', 'Free Audit'),
        'expertHeadline'     => my_theme_opt('my_theme_hp_expert_headline', 'Our SEMA qualified inspectors will assess your warehouse and demonstrate how Goliath can help you'),
        'expertCta1Text'     => my_theme_opt('my_theme_hp_expert_cta_1_text', 'Interested in GOLIATH™?'),
        'expertCta2Text'     => my_theme_opt('my_theme_hp_expert_cta_2_text', 'Book My Free Site Survey'),
        'expertCta1Url'      => my_theme_opt('my_theme_hp_expert_cta_1_url', '#contact'),
        'expertCta2Url'      => my_theme_opt('my_theme_hp_expert_cta_2_url', '#contact'),
        'kpi1Value'          => my_theme_opt('my_theme_hp_kpi1_value', '100%'),
        'kpi1Label'          => my_theme_opt('my_theme_hp_kpi1_label', 'CLIENT SATISFACTION'),
        'kpi2Value'          => my_theme_opt('my_theme_hp_kpi2_value', '70%'),
        'kpi2Label'          => my_theme_opt('my_theme_hp_kpi2_label', 'AVERAGE COST SAVINGS'),
        'kpi3Value'          => my_theme_opt('my_theme_hp_kpi3_value', '85%'),
        'kpi3Label'          => my_theme_opt('my_theme_hp_kpi3_label', 'REDUCTION IN DOWNTIME'),
        'viewCaseStudiesText' => my_theme_opt('my_theme_hp_view_case_studies_text', 'View Case Studies'),
        'viewCaseStudiesUrl'  => my_theme_opt('my_theme_hp_view_case_studies_url', '/case-studies/'),
        'kpiEyebrow'         => my_theme_opt('my_theme_hp_kpi_eyebrow', 'Proven Results'),
        'kpiHeading'         => my_theme_opt('my_theme_hp_kpi_heading', 'Real Results, Real ROI'),
        'kpiSubheading'      => my_theme_opt('my_theme_hp_kpi_subheading', 'Leading UK businesses trust Goliath to protect their warehouse infrastructure'),
    ]);

    // Section 8: "Is it just a dent?"
    $dent_img = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_hp_dent_img', get_theme_file_uri('assets/images/Homepage/not-just-dent.webp')) : get_theme_file_uri('assets/images/Homepage/not-just-dent.webp');
    $m .= my_theme_block('goliath/hp-dent-risk', [
        'image'    => $dent_img,
        'eyebrow'  => my_theme_opt('my_theme_hp_dent_eyebrow', 'Explore the Features'),
        'heading'  => my_theme_opt('my_theme_hp_dent_heading', 'It is not just a dent...'),
        'stat'     => my_theme_opt('my_theme_hp_dent_stat', 'The Real Cost, Structural collapse risk increases by 60% with each unrepaired impact'),
        'body'     => my_theme_opt('my_theme_hp_dent_body', 'You deserve a solution that\'s fast, permanent, and guaranteed. Traditional repairs are temporary patches. Full replacements are expensive and disruptive. There has to be a better way.'),
        'ctaText'  => my_theme_opt('my_theme_hp_dent_cta_text', 'Discover the Solution'),
        'ctaUrl'   => my_theme_opt('my_theme_hp_dent_cta_url', '#contact'),
        'imageAlt' => my_theme_opt('my_theme_hp_dent_image_alt', 'Damaged warehouse upright'),
    ]);

    // Section 9: Contact / consultation form
    $m .= my_theme_block('goliath/hp-contact-form', [
        'heading1'     => my_theme_opt('my_theme_hp_contact_heading_1', 'Get Your Free'),
        'heading2'     => my_theme_opt('my_theme_hp_contact_heading_2', 'Consultation'),
        'intro'        => my_theme_opt('my_theme_hp_contact_intro', 'Lifetime warranty, 30-minute installation, minimal downtime. Find out how Goliath can reduce your racking repair costs.'),
        'submitText'   => my_theme_opt('my_theme_hp_contact_submit_text', 'Request Free Assessment'),
        'privacyNote'  => my_theme_opt('my_theme_hp_contact_privacy_note', 'Your information is confidential and secure.'),
        'trustBarText' => my_theme_opt('my_theme_hp_contact_trust_bar', '100% Client Satisfaction • Save 70% • 30min Installation • Lifetime Warranty'),
        'whyH3'        => my_theme_opt('my_theme_hp_contact_why_h3', 'Why Request an Assessment?'),
        'whyReasons'   => ['Free, no-obligation evaluation', 'Response within 1 working day', 'Transparent, honest pricing', 'Expert safety advice'],
    ]);

    return $m;
}

/** Why Goliath → block markup */
function my_theme_migrate_markup_why_goliath(): string
{
    $m = '';

    // Hero
    $m .= my_theme_block('goliath/hero-section', [
        'badge'            => my_theme_opt('my_theme_wg_hero_badge', 'THE GOLIATH DIFFERENCE'),
        'heading'          => 'Why',
        'headingHighlight' => 'GOLIATH™',
        'description'      => my_theme_opt('my_theme_wg_hero_desc', 'Damage to racking happens frequently in busy warehouse environments. The actual problem is not just the damage, but how the damage is handled. The chosen repair method keeps warehouse owners or operators in a cycle of replace and repair, resulting in repeat costs and lower profitability.'),
        'ctaText'          => my_theme_opt('my_theme_wg_hero_cta', 'View case studies'),
        'ctaUrl'           => '/case-studies/',
        'minHeight'        => 'medium',
    ]);

    // Vs Standard Repair
    $wg_img1 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_wg_vs_img1', get_theme_file_uri('assets/images/whyGoliath/solution.webp')) : get_theme_file_uri('assets/images/whyGoliath/solution.webp');
    $wg_img2 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_wg_vs_img2', get_theme_file_uri('assets/images/Homepage/review-3.webp')) : get_theme_file_uri('assets/images/Homepage/review-3.webp');
    $wg_img3 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_wg_vs_img3', get_theme_file_uri('assets/images/Homepage/review-1.webp')) : get_theme_file_uri('assets/images/Homepage/review-1.webp');
    $m .= my_theme_block('goliath/wg-vs-standard', [
        'img1' => $wg_img1,
        'img2' => $wg_img2,
        'img3' => $wg_img3,
        'heading'  => my_theme_opt('my_theme_wg_vs_h2', 'Goliath™ vs. Standard Repair'),
        'tradH3'   => my_theme_opt('my_theme_wg_vs_trad_h3', 'Traditional Repair'),
        'tradP'    => my_theme_opt('my_theme_wg_vs_trad_p', "Traditional pallet racking repair's sole focus is on replacing damaged uprights. This means uprights have to be damaged first before being repaired. The biggest problem with standard repair is that it doesn't prevent the same issue from happening again."),
        'tradBold' => my_theme_opt('my_theme_wg_vs_trad_bold', 'This means uprights are replaced and eventually damaged again.'),
        'golH3'    => my_theme_opt('my_theme_wg_vs_gol_h3', 'Goliath™ is Different'),
        'golP'     => my_theme_opt('my_theme_wg_vs_gol_p', 'Instead of repeatedly replacing the upright with the standard system, the upright is replaced with our high-strength steel repair system. Goliath™ is built to brace for impact, ensuring the structure is stronger and more resilient to handle high-traffic environments more effectively.'),
        'golBold'  => my_theme_opt('my_theme_wg_vs_gol_bold', 'While standard repair methods are reactive, Goliath™ is a permanent upgrade for future circumstances.'),
    ]);

    // Future Costs
    $m .= my_theme_block('goliath/wg-future-costs', [
        'heading' => my_theme_opt('my_theme_wg_fc_h2', 'The Right Way to Save Future Costs'),
        'p1'      => my_theme_opt('my_theme_wg_fc_p1', 'Choosing to replace uprights every time they are damaged is the most expensive solution.'),
        'p2'      => my_theme_opt('my_theme_wg_fc_p2', 'This is because every replacement involves:'),
        'p3'      => my_theme_opt('my_theme_wg_fc_p3', 'Goliath™ reduces that recurring expense by strengthening the uprights and preventing repeat damage in the same location. By doing this, there is a reduced need for future repairs.'),
        'p4'      => my_theme_opt('my_theme_wg_fc_p4', 'That means lower maintenance costs, fewer repair runs, and better budget control.'),
    ]);

    // Repair vs Replace
    $m .= my_theme_block('goliath/wg-repair-replace', [
        'heading'  => my_theme_opt('my_theme_wg_rr_h2', 'Repair with Goliath™ vs. Replace the Upright'),
        'subtitle' => my_theme_opt('my_theme_wg_rr_subtitle', 'Why repair with Goliath™ vs. replace upright?'),
        'p1'       => my_theme_opt('my_theme_wg_rr_p1', 'Replacing an upright restores it to an original, damage-free product. But it does not reduce or improve its resistance to impact. It merely restarts the process.'),
        'p2'       => my_theme_opt('my_theme_wg_rr_p2', 'Goliath™ is built for high-traffic warehouse environments where impact is unavoidable.'),
        'p3'       => my_theme_opt('my_theme_wg_rr_p3', 'With Goliath™, the focus shifts from reactive maintenance to proactive support, which reduces downtime and cuts costs.'),
        'quote'    => my_theme_opt('my_theme_wg_rr_quote', 'Instead of resetting the problem, which replacement does, Goliath™ solves it.'),
    ]);

    // Compatible Systems
    $m .= my_theme_block('goliath/wg-compatible-systems', [
        'heading' => my_theme_opt('my_theme_wg_cs_h2', 'Compatible with All Major Racking Systems'),
        'p1'      => my_theme_opt('my_theme_wg_cs_p1', 'Warehouses are built differently, and so are racking systems.'),
        'p2'      => my_theme_opt('my_theme_wg_cs_p2', 'Goliath™ retrofits to all major pallet racking systems used in the UK, making it a flexible solution for different industries and layouts. This allows you to upgrade your existing racks without having to replace the entire structure.'),
        'bold'    => my_theme_opt('my_theme_wg_cs_bold', 'Goliath™ is suitable for:'),
    ]);

    // End the Repair Cycle
    $m .= my_theme_block('goliath/wg-end-repair-cycle', [
        'heading' => my_theme_opt('my_theme_wg_erc_h2', 'End the Repair Cycle'),
        'p1'      => my_theme_opt('my_theme_wg_erc_p1', 'The cost of the repair cycle is not determined by the first repair. It is measured by the cost of every repair after the first.'),
        'p2'      => my_theme_opt('my_theme_wg_erc_p2', 'Goliath™ was built to break the cycle.'),
        'p3'      => my_theme_opt('my_theme_wg_erc_p3', 'With our permanent upright repair solution:'),
        'callout' => my_theme_opt('my_theme_wg_erc_callout', "Once installed, Goliath™ continues to protect your racking forever, and we're confident that if it were to be damaged by usual FLT damage, we will replace it for free."),
    ]);

    // Sustainability
    $sus_img = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_wg_sus_img', get_theme_file_uri('assets/images/whyGoliath/solution.webp')) : get_theme_file_uri('assets/images/whyGoliath/solution.webp');
    $m .= my_theme_block('goliath/wg-sustainability', [
        'image'   => $sus_img,
        'heading' => my_theme_opt('my_theme_wg_sus_h2', 'Supporting Sustainability, One Upright at a Time'),
        'p1'      => my_theme_opt('my_theme_wg_sus_p1', 'The waste of steel, material, and labour costs when replacing uprights is a major problem in warehousing.'),
        'p2'      => my_theme_opt('my_theme_wg_sus_p2', "By replacing your racking, Goliath™ lowers the amount of steel required to achieve the same result. This means you'll never have to repair the upright again, eliminating steel waste from the most high-traffic areas of your warehouse."),
        'p3'      => my_theme_opt('my_theme_wg_sus_p3', 'This ensures a more sustainable warehouse operation and helps businesses reduce their environmental footprint.'),
        'tagline' => my_theme_opt('my_theme_wg_sus_tagline', 'Choose Goliath™. Choose Support.'),
    ]);

    // Dual CTA
    $m .= my_theme_block('goliath/wg-dual-cta', [
        'heading'       => my_theme_opt('my_theme_wg_cta_h2', 'Ready to Break the Repair Cycle?'),
        'para1'         => my_theme_opt('my_theme_wg_cta_desc', 'Discover how Goliath™ can save your warehouse thousands in recurring repair costs while improving safety and compliance.'),
        'para2'         => '',
        'primaryText'   => my_theme_opt('my_theme_wg_cta_primary', 'Get Free Site Survey'),
        'primaryUrl'    => '/contact/',
        'secondaryText' => my_theme_opt('my_theme_wg_cta_secondary', 'View Case Studies'),
        'secondaryUrl'  => '/case-studies/',
    ]);

    return $m;
}

/** How It Works → block markup */
function my_theme_migrate_markup_how_it_works(): string
{
    $m = '';

    // Hero
    $m .= my_theme_block('goliath/hero-section', [
        'badge'       => my_theme_opt('my_theme_hiw_hero_badge', 'GOLIATH SOLUTION'),
        'heading'     => my_theme_opt('my_theme_hiw_hero_h1', 'How it works'),
        'description' => my_theme_opt('my_theme_hiw_hero_paragraph', 'Installing a Goliath™ upright in your warehouse can be done in 30 minutes.'),
        'ctaText'     => my_theme_opt('my_theme_hiw_hero_cta', 'Get Free Assessment'),
        'ctaUrl'      => '/contact/',
        'minHeight'   => 'medium',
    ]);

    // Stats bar
    $m .= my_theme_block('goliath/hiw-stats-bar', [
        'stat1Value' => my_theme_opt('my_theme_hiw_stat1_value', '30 Minutes'),
        'stat1Label' => my_theme_opt('my_theme_hiw_stat1_label', 'Installation'),
        'stat2Value' => my_theme_opt('my_theme_hiw_stat2_value', 'Lifetime'),
        'stat2Label' => my_theme_opt('my_theme_hiw_stat2_label', 'Warranty'),
        'stat3Value' => my_theme_opt('my_theme_hiw_stat3_value', '100%'),
        'stat3Label' => my_theme_opt('my_theme_hiw_stat3_label', 'UK Compliance'),
        'stat4Value' => my_theme_opt('my_theme_hiw_stat4_value', 'Minimal'),
        'stat4Label' => my_theme_opt('my_theme_hiw_stat4_label', 'Downtime'),
    ]);

    // Installation process (video + 5 steps)
    $m .= my_theme_block('goliath/hiw-installation', [
        'heading'    => my_theme_opt('my_theme_hiw_install_h2', 'Installation process'),
        'videoText'  => my_theme_opt('my_theme_hiw_install_video_text', 'Installation Video'),
        'step1Title' => my_theme_opt('my_theme_hiw_step1_title', 'Precision Cutting'),
        'step1Desc'  => my_theme_opt('my_theme_hiw_step1_desc', "We use a specially designed cutting jig that's bolted to the existing damaged upright. This allows us to get a factory cut to the upright. The damaged section is cut out using a handheld bandsaw with a cutting jig that allows us to make a perfect cut every time. The damaged upright is removed. We use a prop system to hold the empty racking in place."),
        'step2Title' => my_theme_opt('my_theme_hiw_step2_title', 'Fitting Goliath™'),
        'step2Desc'  => my_theme_opt('my_theme_hiw_step2_desc', 'Goliath™ is fitted into place and all nuts and bolts are loosely fitted, which connects the upright and repair kit together.'),
        'step3Title' => my_theme_opt('my_theme_hiw_step3_title', 'Securing the Structure'),
        'step3Desc'  => my_theme_opt('my_theme_hiw_step3_desc', 'Bracing is bolted to Goliath™, and the prop is lowered, allowing all nuts and bolts to be tightened.'),
        'step4Title' => my_theme_opt('my_theme_hiw_step4_title', 'Floor Fixing'),
        'step4Desc'  => my_theme_opt('my_theme_hiw_step4_desc', 'Goliath™ is fixed down using two no. M16 double helix floor bolts, designed to work with Goliath™ to offer extra strength.'),
        'step5Title' => my_theme_opt('my_theme_hiw_step5_title', 'Installation Complete'),
        'step5Desc'  => my_theme_opt('my_theme_hiw_step5_desc', 'Installation is complete. You can resume your warehouse operations, knowing that any previously damaged racking has been repaired.'),
    ]);

    // Fix the Problem + Lifetime Warranty (two-column)
    $m .= my_theme_block('goliath/hiw-fix-warranty', [
        'fixH2Line1'    => my_theme_opt('my_theme_hiw_fix_h2_line1', 'Fix the Problem'),
        'fixH2Line2'    => my_theme_opt('my_theme_hiw_fix_h2_line2', 'Without Stopping Your Business'),
        'fixP'          => my_theme_opt('my_theme_hiw_fix_paragraph', 'With Goliath™, you can fix the problem without stopping your business. No downtime or delays.'),
        'warrantyH2Line1' => my_theme_opt('my_theme_hiw_warranty_h2_line1', 'Our Lifetime'),
        'warrantyH2Line2' => my_theme_opt('my_theme_hiw_warranty_h2_line2', 'Impact Warranty'),
        'warrantyP1'    => my_theme_opt('my_theme_hiw_warranty_para1', 'Lifetime impact warranty: if your racking upright is damaged under normal warehouse conditions, we repair or replace it, no questions asked.'),
        'warrantyP2'    => my_theme_opt('my_theme_hiw_warranty_para2', 'Our product is a long-term solution that removes the risk of paying for repairs continuously.'),
    ]);

    // UK Standards (4-card grid)
    $m .= my_theme_block('goliath/hiw-uk-standards', [
        'heading'    => my_theme_opt('my_theme_hiw_standards_h2', 'Designed to Meet UK Standards'),
        'intro1'     => my_theme_opt('my_theme_hiw_standards_intro1', "Goliath™ is developed to meet the UK's racking regulations and industry best practices. This ensures every repair supports both safety and compliance."),
        'intro2'     => my_theme_opt('my_theme_hiw_standards_intro2', 'It aligns with key standards, including:'),
        'card1Title' => my_theme_opt('my_theme_hiw_standards_card1_title', 'BS EN 15512:2020 + A1:2022'),
        'card1Body'  => my_theme_opt('my_theme_hiw_standards_card1_body', 'Regulations for steel storage systems for adjustable pallet racking-principles for structural design'),
        'card2Title' => my_theme_opt('my_theme_hiw_standards_card2_title', 'BS EN 15635:2008'),
        'card2Body'  => my_theme_opt('my_theme_hiw_standards_card2_body', 'Regulations for steel static storage systems application and maintenance of storage equipment'),
        'card3Title' => my_theme_opt('my_theme_hiw_standards_card3_title', 'SEMA code of practice'),
        'card3Body'  => my_theme_opt('my_theme_hiw_standards_card3_body', 'for the design of adjustable pallet racking'),
        'card4Title' => my_theme_opt('my_theme_hiw_standards_card4_title', 'SEMA code of practice'),
        'card4Body'  => my_theme_opt('my_theme_hiw_standards_card4_body', 'for the design and use of racking protection'),
        'closing'    => my_theme_opt('my_theme_hiw_standards_closing', "We're proud that Goliath™ is reinforced in a way that supports ongoing safety, reduces risk, and meets the expectations of UK regulatory bodies. Our upright repair solution was built according to UK H&S specifications, making it a trusted solution for warehouses in the UK."),
    ]);

    // Crash test video band
    $m .= my_theme_block('goliath/hiw-crash-video', [
        'headline' => my_theme_opt('my_theme_hiw_crash_headline', 'Install once stop damage for good.'),
    ]);

    // Image gallery
    $gallery_img1 = function_exists('my_theme_get_image_url')
        ? my_theme_get_image_url('my_theme_hiw_gallery_img1', get_theme_file_uri('assets/images/howITworks/process1.webp'))
        : get_theme_file_uri('assets/images/howITworks/process1.webp');
    $gallery_img2 = function_exists('my_theme_get_image_url')
        ? my_theme_get_image_url('my_theme_hiw_gallery_img2', get_theme_file_uri('assets/images/howITworks/process2.webp'))
        : get_theme_file_uri('assets/images/howITworks/process2.webp');
    $gallery_img3 = function_exists('my_theme_get_image_url')
        ? my_theme_get_image_url('my_theme_hiw_gallery_img3', get_theme_file_uri('assets/images/howITworks/process3.webp'))
        : get_theme_file_uri('assets/images/howITworks/process3.webp');
    $m .= my_theme_block('goliath/hiw-image-gallery', [
        'img1'    => $gallery_img1,
        'img1Alt' => 'Initial stage of upright repair',
        'img2'    => $gallery_img2,
        'img2Alt' => 'Mid-stage Goliath installation on damaged upright',
        'img3'    => $gallery_img3,
        'img3Alt' => 'Completed Goliath repair in warehouse environment',
    ]);

    // Fast, On-Site Repair
    $m .= my_theme_block('goliath/hiw-fast-repair', [
        'heading' => my_theme_opt('my_theme_hiw_repair_h2', 'Fast, On-Site Repair with Minimal Disruption'),
        'para1'   => my_theme_opt('my_theme_hiw_repair_para1', 'Racking damage needs to be addressed quickly. This is because unaddressed upright damage puts lives in danger. But replacing your racking should not be the reason to shut down your operation.'),
        'para2'   => my_theme_opt('my_theme_hiw_repair_para2', 'Goliath™ is fast and efficient. Installation within live warehouse environments is done without removing and replacing the existing full uprights. Only the damaged section is cut out and replaced with our high-strength steel repair. This reinforces the structure without major disruption.'),
        'para3'   => my_theme_opt('my_theme_hiw_repair_para3', 'Installation takes as little as 30 minutes per upright, allowing work to be completed while your warehouse continues to operate. This means minimal downtime and much higher safety standards whenever Goliath™ is installed.'),
        'boxH3'   => my_theme_opt('my_theme_hiw_repair_box_h3', '30 Minutes Installation'),
        'boxPara' => my_theme_opt('my_theme_hiw_repair_box_para', 'Installation takes as little as 30 minutes per upright, allowing work to be completed while your warehouse continues to operate. This means minimal downtime and much higher safety standards whenever Goliath™ is installed.'),
    ]);

    // Our Installation Process (detailed narrative + quote)
    $m .= my_theme_block('goliath/hiw-our-process', [
        'heading' => my_theme_opt('my_theme_hiw_ourprocess_h2', 'Our Installation Process'),
        'para1'   => my_theme_opt('my_theme_hiw_ourprocess_para1', 'The process starts by highlighting the damaged area of the upright. Instead of removing the entire upright when replacing, we only remove the affected area. This limits the area of focus.'),
        'para2'   => my_theme_opt('my_theme_hiw_ourprocess_para2', 'Goliath™ is fitted in place of the damaged steel by securing it directly to the existing upright, forming a reinforced structure that restores load integrity and improves resistance to future impact.'),
        'para3'   => my_theme_opt('my_theme_hiw_ourprocess_para3', 'Bracing is bolted to Goliath™, and the prop is lowered, allowing all nuts and bolts to be tightened. Goliath™ is fixed down using two no. M16 double helix floor bolts, designed to work with Goliath™ to offer extra strength.'),
        'para4'   => my_theme_opt('my_theme_hiw_ourprocess_para4', 'Installation is complete. You can resume your warehouse operations safely, knowing that any previously damaged racking has been repaired.'),
        'quote'   => my_theme_opt('my_theme_hiw_ourprocess_quote', 'Installation is complete. You can resume your warehouse operations safely, knowing that any previously damaged racking has been repaired.'),
    ]);

    // Strength Where It Matters Most
    $m .= my_theme_block('goliath/hiw-strength', [
        'heading' => my_theme_opt('my_theme_hiw_strength_h2', 'Strength Where It Matters Most'),
        'para1'   => my_theme_opt('my_theme_hiw_strength_para1', 'Goliath™ focuses on the area most likely to be impacted by forklifts.'),
        'para2'   => my_theme_opt('my_theme_hiw_strength_para2', 'Once it is installed, the reinforced section becomes stronger than the original structure. It absorbs repeated impacts from movement and forklifts and prevents the same damage from happening again in that location.'),
        'box'     => my_theme_opt('my_theme_hiw_strength_box', 'With Goliath™, you never have to pay for an upright replacement in the same area again. This is because Goliath™ is covered by a lifetime impact warranty; the only one of its kind in the UK or Europe.'),
        'tagline' => my_theme_opt('my_theme_hiw_strength_tagline', 'This turns a reactive repair into a structural upgrade.'),
    ]);

    // Installed in Real-World Environments + Built to Support Compliance
    $m .= my_theme_block('goliath/hiw-realworld', [
        'realworldH2'        => my_theme_opt('my_theme_hiw_realworld_h2', 'Installed in Real-World Environments'),
        'realworldIntro'     => my_theme_opt('my_theme_hiw_realworld_intro', 'Goliath™ is fitted directly onto existing racking and is installed at ground-level impact zones.'),
        'realworldListIntro' => my_theme_opt('my_theme_hiw_realworld_list_intro', 'You\'ll see it in places like:'),
        'realworldItems'     => ['Distribution centres', 'Logistics operations', 'Retail warehouses', 'Manufacturing facilities', 'Cold stores', 'Document storage warehouses'],
        'realworldClosing'   => my_theme_opt('my_theme_hiw_realworld_closing', 'Once it is installed, it becomes a part of the upright that provides continuous protection without affecting daily operations.'),
        'complianceH2'       => my_theme_opt('my_theme_hiw_compliance_h2', 'Built to Support Compliance'),
        'complianceIntro'    => my_theme_opt('my_theme_hiw_compliance_intro', 'Goliath™ aligns with recognised UK standards:'),
        'complianceItems'    => ['BS EN 15512', 'BS EN 15635', 'SEMA guidelines'],
        'complianceClosing'  => my_theme_opt('my_theme_hiw_compliance_closing', 'By reinforcing damaged uprights, our permanent upright repair helps maintain structural integrity and supports ongoing inspection requirements.'),
    ]);

    // A Smarter Way to Handle Racking Damage — dual CTA
    $m .= my_theme_block('goliath/wg-dual-cta', [
        'heading'       => my_theme_opt('my_theme_hiw_cta_h2', 'A Smarter Way to Handle Racking Damage'),
        'para1'         => my_theme_opt('my_theme_hiw_cta_para1', 'Instead of repeatedly repairing or replacing uprights, Goliath™ changes how damage is managed. It allows you to fix the issue quickly, strengthen the structure, and reduce the likelihood of recurrence without slowing your operation down.'),
        'para2'         => my_theme_opt('my_theme_hiw_cta_para2', 'There is no other system in the UK that offers the same assurance of reduced repairs, minimal downtime during installation, and cost-saving advantage that results in higher profitability for your warehouse like Goliath™.'),
        'primaryText'   => my_theme_opt('my_theme_hiw_cta_primary', 'Get Free Site Survey'),
        'primaryUrl'    => '/contact/',
        'secondaryText' => my_theme_opt('my_theme_hiw_cta_secondary', 'View Compliance Info'),
        'secondaryUrl'  => '/compliance/',
    ]);

    return $m;
}

/** Services → block markup */
function my_theme_migrate_markup_services(): string
{
    $m = '';

    $m .= my_theme_block('goliath/hero-section', [
        'badge'       => my_theme_opt('my_theme_svc_hero_badge', 'PROACTIVE PROTECTION'),
        'heading'     => 'Service',
        'headingHighlight' => 'Portfolio',
        'description' => my_theme_opt('my_theme_svc_hero_desc', 'Building a new warehouse or installing new racking? Start with GOLIATH™ protection from day one.'),
        'ctaText'     => my_theme_opt('my_theme_svc_hero_cta1', 'Get Project Quote'),
        'ctaUrl'      => '/contact/',
        'minHeight'   => 'medium',
    ]);

    $m .= my_theme_block('goliath/svc-heavy-duty', [
        'heading'    => my_theme_opt('my_theme_svc_built_h2', 'Heavy Duty.'),
        'h3'         => my_theme_opt('my_theme_svc_built_h3', 'Built to Last.'),
        'description'=> my_theme_opt('my_theme_svc_built_desc', 'Installing GOLIATH™ on new racking projects provides unmatched protection and long-term value for your warehouse infrastructure.'),
        'feat1Title' => my_theme_opt('my_theme_svc_feat1_title', 'Protection from Day One'),
        'feat1Desc'  => my_theme_opt('my_theme_svc_feat1_desc', 'Install GOLIATH™ on new racking to prevent damage before it happens. Proactive protection saves money and ensures safety from the start.'),
        'feat2Title' => my_theme_opt('my_theme_svc_feat2_title', 'Faster Installation'),
        'feat2Desc'  => my_theme_opt('my_theme_svc_feat2_desc', 'Installing GOLIATH™ during initial setup is even quicker than retrofitting. Integrate protection seamlessly into your new warehouse project.'),
        'feat3Title' => my_theme_opt('my_theme_svc_feat3_title', 'Lifetime Warranty'),
        'feat3Desc'  => my_theme_opt('my_theme_svc_feat3_desc', 'Your new racking comes with permanent protection. Never worry about upright damage again with our comprehensive lifetime warranty.'),
        'feat4Title' => my_theme_opt('my_theme_svc_feat4_title', 'Lower Total Cost'),
        'feat4Desc'  => my_theme_opt('my_theme_svc_feat4_desc', 'Avoid future repair costs entirely. Installing GOLIATH™ upfront is the most cost-effective approach for long-term warehouse operations.'),
    ]);

    $m .= my_theme_block('goliath/svc-comparison', [
        'heading'        => 'New Installation Comparison',
        'description'    => my_theme_opt('my_theme_svc_comp_desc', 'See how GOLIATH™-protected racking compares to standard new installations over the lifetime of your warehouse.'),
        'bannerHeading'  => my_theme_opt('my_theme_svc_comp_banner_h2', 'Smart Investment = Long-Term Savings'),
        'bannerDesc'     => my_theme_opt('my_theme_svc_comp_banner_desc', 'Protect your new warehouse infrastructure from day one and eliminate future repair costs'),
        'row1LeftTitle'  => my_theme_opt('my_theme_svc_comp_row1_left_title', 'Standard new racking upright'),
        'row1LeftDesc'   => my_theme_opt('my_theme_svc_comp_row1_left_desc', 'Vulnerable to impact damage from day one'),
        'row1RightTitle' => my_theme_opt('my_theme_svc_comp_row1_right_title', 'New racking with GOLIATH™'),
        'row1RightDesc'  => my_theme_opt('my_theme_svc_comp_row1_right_desc', 'Protected against all impact damage permanently'),
        'row2LeftTitle'  => my_theme_opt('my_theme_svc_comp_row2_left_title', '£675+ per replacement when damaged'),
        'row2LeftDesc'   => my_theme_opt('my_theme_svc_comp_row2_left_desc', 'Recurring expense with each incident'),
        'row2RightTitle' => my_theme_opt('my_theme_svc_comp_row2_right_title', '£0 future repair costs'),
        'row2RightDesc'  => my_theme_opt('my_theme_svc_comp_row2_right_desc', 'One-time investment with lifetime protection'),
        'row3LeftTitle'  => my_theme_opt('my_theme_svc_comp_row3_left_title', '2-4 hours downtime per replacement'),
        'row3LeftDesc'   => my_theme_opt('my_theme_svc_comp_row3_left_desc', 'Repeated disruptions to operations'),
        'row3RightTitle' => my_theme_opt('my_theme_svc_comp_row3_right_title', 'Zero downtime after installation'),
        'row3RightDesc'  => my_theme_opt('my_theme_svc_comp_row3_right_desc', 'Uninterrupted warehouse productivity'),
        'row4LeftTitle'  => my_theme_opt('my_theme_svc_comp_row4_left_title', 'No warranty against impact damage'),
        'row4LeftDesc'   => my_theme_opt('my_theme_svc_comp_row4_left_desc', 'Full financial risk on your business'),
        'row4RightTitle' => my_theme_opt('my_theme_svc_comp_row4_right_title', 'Lifetime impact warranty included'),
        'row4RightDesc'  => my_theme_opt('my_theme_svc_comp_row4_right_desc', 'Complete protection with no-questions-asked coverage'),
    ]);

    $m .= my_theme_block('goliath/svc-projects', [
        'description' => my_theme_opt('my_theme_svc_project_desc', "Whether you're building from scratch, expanding operations, or upgrading your storage systems, GOLIATH™ provides the protection your investment deserves."),
        'proj1Title'  => my_theme_opt('my_theme_svc_project1_title', 'New Warehouse Builds'),
        'proj1Desc'   => my_theme_opt('my_theme_svc_project1_desc', 'Complete warehouse construction projects with GOLIATH™ protection integrated from the ground up.'),
        'proj2Title'  => my_theme_opt('my_theme_svc_project2_title', 'Warehouse Expansions'),
        'proj2Desc'   => my_theme_opt('my_theme_svc_project2_desc', 'Expanding your facility? Protect new racking installations while maintaining consistency with existing systems.'),
        'proj3Title'  => my_theme_opt('my_theme_svc_project3_title', 'Racking System Upgrades'),
        'proj3Desc'   => my_theme_opt('my_theme_svc_project3_desc', 'Upgrading your storage system? Add GOLIATH™ to ensure your investment is protected for decades.'),
        'proj4Title'  => my_theme_opt('my_theme_svc_project4_title', 'High-Traffic Zones'),
        'proj4Desc'   => my_theme_opt('my_theme_svc_project4_desc', 'Identify high-risk areas and install proactive protection where forklift traffic is heaviest.'),
        'ctaText'     => my_theme_opt('my_theme_svc_project_cta', 'Watch the video'),
    ]);

    $m .= my_theme_block('goliath/svc-regulation', [
        'description' => my_theme_opt('my_theme_svc_reg_desc', 'GOLIATH™ meets all UK and EU safety standards for new installations. Your project will pass inspections with complete compliance documentation.'),
        'item1'       => my_theme_opt('my_theme_svc_reg_item1', 'BS EN 15512:2020 + A1:2022 compliant'),
        'item2'       => my_theme_opt('my_theme_svc_reg_item2', 'BS EN 15635:2008 certified'),
        'item3'       => my_theme_opt('my_theme_svc_reg_item3', 'SEMA codes of practice adherence'),
        'item4'       => my_theme_opt('my_theme_svc_reg_item4', 'Full compliance documentation provided'),
        'certH3'      => my_theme_opt('my_theme_svc_reg_cert_h3', 'Certified Protection'),
        'certLine1'   => my_theme_opt('my_theme_svc_reg_cert_line1', 'UK Registered Design No. 6410620'),
        'certLine2'   => my_theme_opt('my_theme_svc_reg_cert_line2', 'EU Design Registration No. DM/244641'),
        'certBanner'  => my_theme_opt('my_theme_svc_reg_cert_banner', 'Lifetime Warranty Included'),
    ]);

    $m .= my_theme_block('goliath/svc-gallery', [
        'heading' => 'Simple Solution, Peace of Mind,',
        'ctaText' => my_theme_opt('my_theme_svc_gallery_cta', 'View more'),
    ]);

    $m .= my_theme_block('goliath/svc-final-cta', [
        'description' => my_theme_opt('my_theme_svc_final_desc', 'Planning a new warehouse project? Get a tailored quote for Goliath™ protection. Our team will work with your specifications to provide clear pricing and a realistic timeline.'),
        'btnText'     => my_theme_opt('my_theme_svc_final_cta', 'Get Your Project Quote'),
        'btnUrl'      => '/contact/',
    ]);

    return $m;
}

/** Racking Upright Repair service → block markup */
function my_theme_migrate_markup_racking_upright_repair(): string
{
    $m = '';
    $hero_img = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_svc_upright_hero_img', get_theme_file_uri('assets/images/Services/services-RackingUpright/case-study1.webp')) : get_theme_file_uri('assets/images/Services/services-RackingUpright/case-study1.webp');

    $m .= my_theme_block('goliath/svc-hero', [
        'headingWhite' => 'Racking',
        'headingOrange' => 'Upright Repair',
        'compact' => true,
        'description' => my_theme_opt('my_theme_svc_upright_hero_desc', 'Racking uprights damaged in warehouses are one of the most common issues worldwide. Traditional repair methods are ineffective because they cost more, increase downtime, and have a higher risk of repeat damage.'),
    ]);

    $m .= my_theme_block('goliath/svc-text-block', [
        'bgColor' => 'white',
        'align' => 'center',
        'heading' => my_theme_opt('my_theme_svc_upright_what_h2', 'What is Goliath™?'),
        'paragraphs' => [
            my_theme_opt('my_theme_svc_upright_what_p1', 'Damaged racking uprights are one of the most common issues in warehouses worldwide. This is because repeated impacts affect the structural integrity, reduce load capacity, and create ongoing safety risks for warehouses. Traditional repair methods are ineffective because they cost more, increase downtime, and have a higher risk of repeat damage.'),
            my_theme_opt('my_theme_svc_upright_what_p2', 'Our solution is a permanent reinforcement system that protects uprights at their most vulnerable point. This eliminates recurring damage, reduces long-term spending, and keeps your operation running without interruption.'),
        ],
        'highlight' => my_theme_opt('my_theme_svc_upright_what_highlight', 'Goliath™ takes a different approach to ensuring safety.'),
        'highlightPosition' => 'after-first',
        'ctaText' => my_theme_opt('my_theme_svc_upright_what_cta', 'Discover the Solution'),
        'ctaUrl' => '/contact/',
    ]);

    $m .= my_theme_block('goliath/svc-split-panel', [
        'bgColor' => 'grey',
        'heading' => my_theme_opt('my_theme_svc_upright_how_h2', 'How Goliath™ Works'),
        'paragraphs' => [
            my_theme_opt('my_theme_svc_upright_how_p1', 'Goliath™ is an engineered heavy-duty steel upright repair and protection system built for strength and long-term support.'),
            my_theme_opt('my_theme_svc_upright_how_p2', 'Once Goliath™ is installed, it absorbs the force from repeated impacts that damage the racking itself. This prevents the need to replace uprights and reduces the risk of structural failure.'),
        ],
        'subHeading' => my_theme_opt('my_theme_svc_upright_how_h3', 'Compatible with:'),
        'tickItems' => [
            my_theme_opt('my_theme_svc_upright_how_compat1', 'Adjustable pallet racking (APR)'),
            my_theme_opt('my_theme_svc_upright_how_compat2', 'Wide aisle racking'),
            my_theme_opt('my_theme_svc_upright_how_compat3', 'Narrow aisle racking'),
            my_theme_opt('my_theme_svc_upright_how_compat4', 'High-bay warehouse systems'),
        ],
        'calloutText' => my_theme_opt('my_theme_svc_upright_how_callout', 'Goliath™ is not a temporary fix or a patch repair. It is a long-term structural solution built to outperform traditional repair methods.'),
    ]);

    $m .= my_theme_block('goliath/svc-text-block', [
        'bgColor' => 'grey',
        'align' => 'left',
        'icon' => get_theme_file_uri('assets/images/icons/why-goliath-zig.svg'),
        'heading' => my_theme_opt('my_theme_svc_upright_cost_h2', 'A Lifetime Cost-Saving Solution'),
        'paragraphs' => [
            my_theme_opt('my_theme_svc_upright_cost_p1', 'Many warehouses in the UK treat damage to uprights as an ongoing maintenance cost. Repairs are carried out regularly as issues arise, which leads to continuous spending for the same problem.'),
            my_theme_opt('my_theme_svc_upright_cost_p2', 'With our permanent protection system, you stop the cycle of damage and repair. This leads to long-term savings in areas like:'),
        ],
        'highlight' => my_theme_opt('my_theme_svc_upright_cost_highlight', 'Goliath™ proposes a lasting change.'),
        'highlightPosition' => 'after-first',
        'tickItems' => [
            my_theme_opt('my_theme_svc_upright_cost_item1', 'Replacement uprights'),
            my_theme_opt('my_theme_svc_upright_cost_item2', 'Labour and installation costs'),
            my_theme_opt('my_theme_svc_upright_cost_item3', 'Operational downtime'),
            my_theme_opt('my_theme_svc_upright_cost_item4', 'Safety compliance risks'),
        ],
        'afterListText' => my_theme_opt('my_theme_svc_upright_cost_p3', 'Goliath™ is a onetime structural investment that delivers clear financial benefits from the moment its installed. In high-traffic environments, these savings are even more significant.'),
    ]);

    $m .= my_theme_block('goliath/svc-fullwidth-image', [
        'image' => $hero_img,
        'imageAlt' => 'Warehouse technicians installing a racking upright repair solution',
    ]);

    $m .= my_theme_block('goliath/svc-dark-section', [
        'heading' => my_theme_opt('my_theme_svc_upright_proven_h2', 'Proven Results in High-Impact Environments'),
        'paragraphs' => [
            my_theme_opt('my_theme_svc_upright_proven_p1', 'Goliath™ has been proven in real warehouse conditions where impact damage is frequent and costly.'),
            my_theme_opt('my_theme_svc_upright_proven_p2', 'This is a typical result in operations where forklift movement and tight aisles increase the chances of bumping into uprights.'),
            my_theme_opt('my_theme_svc_upright_proven_p3', 'Instead of reacting to damage, Goliath™ protects your structure.'),
        ],
        'calloutHeading' => my_theme_opt('my_theme_svc_upright_case_h3', 'Case Study: B&M'),
        'calloutDesc' => my_theme_opt('my_theme_svc_upright_case_desc', 'Our client, B&M, saw a reduction of over 30% in repair costs within the first 12 months of installing Goliath™. This was achieved by eliminating repeat damage to uprights in high-risk areas. Cost-conscious operators can imagine how much this equates to across a 5 or 10-year period.'),
    ]);

    $m .= my_theme_block('goliath/svc-two-articles', [
        'article1Icon' => get_theme_file_uri('assets/images/icons/badge.svg'),
        'article1Heading' => my_theme_opt('my_theme_svc_upright_dur_h2', 'Built for Durability and Backed by Warranty'),
        'article1Paragraphs' => [
            my_theme_opt('my_theme_svc_upright_dur_p1', 'Goliath™ is engineered from high-strength steel to withstand repeated impacts in demanding environments.'),
            my_theme_opt('my_theme_svc_upright_dur_p2', '"If Goliath™ becomes damaged from normal use, we will replace or repair it for free - no questions asked."'),
        ],
        'article1Bold' => my_theme_opt('my_theme_svc_upright_dur_bold', 'Comprehensive Lifetime Impact Warranty'),
        'article2Icon' => get_theme_file_uri('assets/images/icons/svc-shield-outline.svg'),
        'article2Heading' => my_theme_opt('my_theme_svc_upright_sus_h2', 'A More Sustainable Approach to Racking Repairs'),
        'article2Paragraphs' => [
            my_theme_opt('my_theme_svc_upright_sus_p1', 'Sustainability is a key priority for warehouse operations. When you constantly replace damaged uprights, it leads to unnecessary steel usage, increased waste, and higher environmental impact.'),
            my_theme_opt('my_theme_svc_upright_sus_p2', 'The principle is simple: install once and stop the cycle of damage.'),
            my_theme_opt('my_theme_svc_upright_sus_p3', 'This not only reduces waste but also aligns with broader sustainability goals across logistics and distribution operations.'),
        ],
        'article2Bold' => my_theme_opt('my_theme_svc_upright_sus_bold', 'Goliath™ is the more sustainable alternative.'),
    ]);

    $m .= my_theme_block('goliath/wg-dual-cta', [
        'heading' => my_theme_opt('my_theme_svc_upright_cta_h2', 'Choose Strength and Support with Goliath™'),
        'para1' => my_theme_opt('my_theme_svc_upright_cta_desc', 'If your warehouse is dealing with repeated upright damage, the question is not whether to repair again. It is how to stop the damage from happening. Goliath™ is the answer.'),
        'para2' => '',
        'primaryText' => my_theme_opt('my_theme_svc_upright_cta_btn1', 'Get Free Site Survey'),
        'primaryUrl' => '/contact/',
        'secondaryText' => my_theme_opt('my_theme_svc_upright_cta_btn2', 'View Case Studies'),
        'secondaryUrl' => '/case-studies/',
    ]);

    return $m;
}

/** Damage Prevention service → block markup */
function my_theme_migrate_markup_damage_prevention(): string
{
    $m = '';
    $split_img = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_svc_prevention_split_img', get_theme_file_uri('assets/images/Services/damage/dent.webp')) : get_theme_file_uri('assets/images/Services/damage/dent.webp');
    $sema_img = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_svc_prevention_sema_img', get_theme_file_uri('assets/images/Services/damage/support.webp')) : get_theme_file_uri('assets/images/Services/damage/support.webp');

    $m .= my_theme_block('goliath/svc-hero', [
        'headingWhite' => 'Damage',
        'headingOrange' => 'Prevention',
        'description' => my_theme_opt('my_theme_svc_prevention_hero_desc', 'Whenever racking damage happens, it is often overlooked until it becomes a problem big enough to affect operations. Most impact-related issues can be avoided entirely if you have the right type of protection in place.'),
    ]);

    $m .= my_theme_block('goliath/svc-split-panel', [
        'bgColor' => 'light-grey',
        'calloutText' => my_theme_opt('my_theme_svc_prevention_split_h2', 'Goliath™ is the upright repair that stops any damage before it happens.'),
        'calloutDesc' => my_theme_opt('my_theme_svc_prevention_split_desc', 'It reinforces the most exposed section of the upright, delivering reliable protection against forklift and pallet truck impacts.'),
        'image' => $split_img,
        'imageAlt' => 'Damaged racking upright beside a Goliath-protected upright',
        'imagePosition' => 'left',
    ]);

    $m .= my_theme_block('goliath/svc-cards-grid', [
        'heading' => my_theme_opt('my_theme_svc_prevention_costly_h2', 'Prevent Pallet Racking Damage Before It Becomes Costly'),
        'introParagraphs' => [
            my_theme_opt('my_theme_svc_prevention_costly_p1', 'Many warehouse supervisors search for racking repairs in the UK after significant damage has already occurred. Every one of these reactive incidents carries direct repair costs and a wider operational impact.'),
            my_theme_opt('my_theme_svc_prevention_costly_p2', 'It is critical to ensure your upright is protected against forklift impacts because even minor collisions can lead to:'),
        ],
        'columns' => 4,
        'cards' => [
            ['title' => my_theme_opt('my_theme_svc_prevention_card1_title', 'Complete aisle closures'), 'desc' => my_theme_opt('my_theme_svc_prevention_card1_desc', 'Restricted access affecting operations')],
            ['title' => my_theme_opt('my_theme_svc_prevention_card2_title', 'Unplanned maintenance'), 'desc' => my_theme_opt('my_theme_svc_prevention_card2_desc', 'Unplanned maintenance and inspections')],
            ['title' => my_theme_opt('my_theme_svc_prevention_card3_title', 'Picking delays'), 'desc' => my_theme_opt('my_theme_svc_prevention_card3_desc', 'Delays in picking and fulfilment')],
            ['title' => my_theme_opt('my_theme_svc_prevention_card4_title', 'Racking collapse risk'), 'desc' => my_theme_opt('my_theme_svc_prevention_card4_desc', 'Putting staff at serious risk of injury')],
        ],
        'darkCallout' => my_theme_opt('my_theme_svc_prevention_dark_p1', 'The direct effect of this is warehouse downtime, one of the most expensive hidden costs in logistics. When racking is damaged, your operations slow down or stop while repairs are carried out.'),
        'darkCalloutHighlight' => my_theme_opt('my_theme_svc_prevention_dark_highlight', 'Goliath™ breaks this cycle by acting as a permanent pallet rack protection system.'),
        'afterText' => my_theme_opt('my_theme_svc_prevention_after_p', 'It prevents impacts and keeps your warehouse running without disruption. This is the best pallet racking repair kit alternative that eliminates repeat damage completely.'),
    ]);

    $m .= my_theme_block('goliath/svc-case-banner', [
        'heading' => my_theme_opt('my_theme_svc_prevention_case_h3', 'Case Study: B&M'),
        'description' => my_theme_opt('my_theme_svc_prevention_case_desc', 'The financial impact is also clear. Our client, B&M, reduced repair costs by over 30% within the first 12 months of installing Goliath™. That reduction came from preventing repeat damage to their uprights, not simply fixing it faster.'),
        'ctaText' => my_theme_opt('my_theme_svc_prevention_case_cta', 'Full Case Study'),
        'ctaUrl' => '/case-studies/bm-racking-damage/',
    ]);

    $m .= my_theme_block('goliath/svc-text-block', [
        'bgColor' => 'white',
        'align' => 'left',
        'icon' => get_theme_file_uri('assets/images/icons/why-goliath-zig.svg'),
        'heading' => my_theme_opt('my_theme_svc_prevention_savings_h2', 'Long-Term Savings with Lifetime Impact Warranty'),
        'paragraphs' => [
            my_theme_opt('my_theme_svc_prevention_savings_p1', 'Goliath™ is a onetime investment that replaces the ongoing cycle of carrying out racking repairs, on which operations rely.'),
            my_theme_opt('my_theme_svc_prevention_savings_p2', 'With our lifetime impact warranty, we provide continuous protection to our clients without repeat costs in the same location.'),
            my_theme_opt('my_theme_svc_prevention_savings_p3', 'You can save across:'),
        ],
        'tickItems' => [
            my_theme_opt('my_theme_svc_prevention_savings_item1', 'Replacing uprights'),
            my_theme_opt('my_theme_svc_prevention_savings_item2', 'Downtime and lost productivity'),
            my_theme_opt('my_theme_svc_prevention_savings_item3', 'Labour and installation'),
            my_theme_opt('my_theme_svc_prevention_savings_item4', 'Repeated inspection-triggered repairs'),
        ],
        'highlight' => my_theme_opt('my_theme_svc_prevention_savings_highlight', 'Over time, preventing pallet racking damage has more value than managing the problem when it arises.'),
        'highlightPosition' => 'after-list',
        'statsBanner' => my_theme_opt('my_theme_svc_prevention_savings_banner', '100% Client Satisfaction • Save 70% • 30min Installation • Lifetime Warranty'),
        'statsBannerCtaText' => my_theme_opt('my_theme_svc_prevention_savings_cta', 'Get Similar Results'),
        'statsBannerCtaUrl' => '/contact/',
    ]);

    $m .= my_theme_block('goliath/svc-bordered-cards', [
        'sectionHeading' => my_theme_opt('my_theme_svc_prevention_suitable_h2', 'Suitable for New and Existing Racking Installations'),
        'sectionDesc' => my_theme_opt('my_theme_svc_prevention_suitable_desc', "If you're thinking about installing Goliath™, note that it can be integrated into both existing systems and new warehouse projects."),
        'card1Heading' => my_theme_opt('my_theme_svc_prevention_existing_h3', 'Existing Sites'),
        'card1Desc' => my_theme_opt('my_theme_svc_prevention_existing_desc', 'For sites in operation, it provides instant racking upright protection in areas with high-impact.'),
        'card2Heading' => my_theme_opt('my_theme_svc_prevention_new_h3', 'New Installations'),
        'card2Desc' => my_theme_opt('my_theme_svc_prevention_new_desc', 'For new installations, it can serve as part of your original warehouse design as a complete pallet racking damage prevention strategy. This ensures protection is in place before any damage occurs.'),
    ]);

    $m .= my_theme_block('goliath/svc-split-panel', [
        'bgColor' => 'white',
        'heading' => my_theme_opt('my_theme_svc_prevention_sema_h2', 'Support SEMA Racking Inspection and Compliance'),
        'paragraphs' => [
            my_theme_opt('my_theme_svc_prevention_sema_p1', 'Safety compliance is important in warehouse operations. An annual SEMA racking inspection is crucial for identifying risks and maintaining safe load conditions.'),
            my_theme_opt('my_theme_svc_prevention_sema_p2', 'Damaged uprights are one of the most common issues identified during inspections. By installing Goliath™, you reduce the likelihood of damage being flagged at all. This supports ongoing compliance while reducing the need for corrective action between inspections.'),
        ],
        'image' => $sema_img,
        'imageAlt' => 'Warehouse operative inspecting racking with tablet',
        'imagePosition' => 'right',
    ]);

    $m .= my_theme_block('goliath/svc-dark-section', [
        'calloutPosition' => 'left',
        'calloutIcon' => get_theme_file_uri('assets/images/icons/svc-shield-on-orange.svg'),
        'calloutHeading' => my_theme_opt('my_theme_svc_prevention_risk_h3', 'Smarter Racking Management and Risk Visibility'),
        'boldText' => my_theme_opt('my_theme_svc_prevention_risk_bold', 'Effective pallet racking damage prevention also requires visibility across your warehouse.'),
        'paragraphs' => [my_theme_opt('my_theme_svc_prevention_risk_p1', 'Goliath™ supports a digital system that manages and monitors your racking. This includes:')],
        'tickItems' => [
            my_theme_opt('my_theme_svc_prevention_risk_item1', 'Warehouse mapping'),
            my_theme_opt('my_theme_svc_prevention_risk_item2', 'Risk categorisation'),
            my_theme_opt('my_theme_svc_prevention_risk_item3', 'Digitally recorded racking upright repair history'),
            my_theme_opt('my_theme_svc_prevention_risk_item4', 'Signed documentation for audits and compliance'),
        ],
        'afterListText' => my_theme_opt('my_theme_svc_prevention_risk_p2', 'This structured approach supports both internal safety processes and external inspection requirements.'),
    ]);

    $m .= my_theme_block('goliath/wg-dual-cta', [
        'heading' => my_theme_opt('my_theme_svc_prevention_stop_h2', 'Stop Damage Before It Starts'),
        'para1' => my_theme_opt('my_theme_svc_prevention_stop_desc', "There's no need to search for a pallet racking repair kit or racking upright repair. Goliath™ addresses repeated impact damage before the worst happens."),
        'para2' => '',
        'primaryText' => my_theme_opt('my_theme_svc_prevention_cta_btn1', 'Get Free Site Survey'),
        'primaryUrl' => '/contact/',
        'secondaryText' => my_theme_opt('my_theme_svc_prevention_cta_btn2', 'Annual Inspections'),
        'secondaryUrl' => '/services/annual-inspections/',
    ]);

    return $m;
}

/** Annual Inspections service → block markup */
function my_theme_migrate_markup_annual_inspections(): string
{
    $m = '';
    $img1 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_svc_inspections_img1', get_theme_file_uri('assets/images/Services/inspection/inspection1.webp')) : get_theme_file_uri('assets/images/Services/inspection/inspection1.webp');
    $img2 = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_svc_inspections_img2', get_theme_file_uri('assets/images/Services/inspection/inspection2.webp')) : get_theme_file_uri('assets/images/Services/inspection/inspection2.webp');

    $m .= my_theme_block('goliath/svc-hero', [
        'headingWhite' => 'Annual',
        'headingOrange' => 'Inspections',
        'description' => my_theme_opt('my_theme_svc_inspections_hero_desc', 'Regular racking inspections are important for ensuring safety is maintained, structures are compliant, and operations are efficient. In many busy warehouse environments, minor damage can worsen if it is not identified and managed early.'),
    ]);

    $m .= my_theme_block('goliath/svc-split-panel', [
        'variant' => 'two-cards',
        'bgColor' => 'white',
        'introText' => my_theme_opt('my_theme_svc_inspections_intro', 'Annual inspections are a structured way for warehouse owners and operators to assess the condition of pallet racking systems. These inspections identify damage, monitor wear and tear, and ensure that your storage systems meet the required safety standards, including SEMA racking inspection guidelines.'),
        'heading' => my_theme_opt('my_theme_svc_inspections_covers_h2', 'A typical inspection covers:'),
        'tickItems' => [
            my_theme_opt('my_theme_svc_inspections_covers_item1', 'The condition of your uprights and any impact damage'),
            my_theme_opt('my_theme_svc_inspections_covers_item2', 'Beam integrity and load performance'),
            my_theme_opt('my_theme_svc_inspections_covers_item3', 'Stability of the base plates and floor fixings'),
            my_theme_opt('my_theme_svc_inspections_covers_item4', 'Pallet alignment and overall structural stability'),
        ],
        'calloutText' => my_theme_opt('my_theme_svc_inspections_callout', 'The goal is simple. When risks are identified early, it prevents them from becoming costly problems.'),
    ]);

    $m .= my_theme_block('goliath/svc-image-pair', [
        'image1' => $img1,
        'image1Alt' => 'SEMA inspection recording in warehouse aisle',
        'image2' => $img2,
        'image2Alt' => 'Technician performing annual racking inspection',
    ]);

    $m .= my_theme_block('goliath/svc-two-articles', [
        'article1Icon' => get_theme_file_uri('assets/images/icons/svc-speed-icon.svg'),
        'article1Heading' => my_theme_opt('my_theme_svc_inspections_smarter_h2', 'Smarter Inspection Management'),
        'article1Paragraphs' => [
            my_theme_opt('my_theme_svc_inspections_smarter_p1', 'Warehouse inspections are more effective when they are supported by clear data. Our digital racking management system helps to track the condition of your warehouse more effectively.'),
            my_theme_opt('my_theme_svc_inspections_smarter_p2', 'It creates a clear audit trail and helps prioritise repairs based on risk level.'),
        ],
        'article2Icon' => get_theme_file_uri('assets/images/icons/svc-reduce-risk-warning.svg'),
        'article2Heading' => my_theme_opt('my_theme_svc_inspections_reduce_h2', 'Reduce Risk with Goliath™'),
        'article2Paragraphs' => [
            my_theme_opt('my_theme_svc_inspections_reduce_p1', 'Inspections only identify the issues in your warehouse, but prevention reduces how often they occur.'),
            my_theme_opt('my_theme_svc_inspections_reduce_p2', 'Installing a highly durable pallet rack protection system like Goliath™ helps minimise damage between inspection cycles.'),
        ],
        'bannerText' => my_theme_opt('my_theme_svc_inspections_banner', 'By combining annual inspections with long-term racking upright protection, your warehouse becomes a more controlled, lower-risk environment.'),
    ]);

    $m .= my_theme_block('goliath/wg-dual-cta', [
        'heading' => my_theme_opt('my_theme_svc_inspections_final_h2', 'Choose Goliath™ for Fewer Disruptions'),
        'para1' => my_theme_opt('my_theme_svc_inspections_final_desc', 'Improved compliance, and a safer warehouse that stays working for longer.'),
        'para2' => '',
        'primaryText' => my_theme_opt('my_theme_svc_inspections_cta_btn1', 'Get Free Site Survey'),
        'primaryUrl' => '/contact/',
        'secondaryText' => my_theme_opt('my_theme_svc_inspections_cta_btn2', 'View Compliance Info'),
        'secondaryUrl' => '/compliance/',
    ]);

    return $m;
}

/** Installations & CDM service → block markup */
function my_theme_migrate_markup_installations_cdm(): string
{
    $m = '';
    $img_left = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_svc_cdm_img_left', get_theme_file_uri('assets/images/Services/installation/install1.webp')) : get_theme_file_uri('assets/images/Services/installation/install1.webp');
    $img_right = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_svc_cdm_img_right', get_theme_file_uri('assets/images/Services/installation/install2.webp')) : get_theme_file_uri('assets/images/Services/installation/install2.webp');

    $m .= my_theme_block('goliath/svc-hero', [
        'headingWhite' => 'Installations & CDM',
        'headingOrange' => 'Racking',
        'orangeFirst' => true,
        'description' => my_theme_opt('my_theme_svc_cdm_hero_desc', 'Racking installations like Goliath™ is a way to prevent future damage whenever you install new uprights in your warehouse. Instead of waiting for issues to arise, you can build protection into the system from day one.'),
    ]);

    $m .= my_theme_block('goliath/svc-image-pair', [
        'image1' => $img_left,
        'image1Alt' => 'Goliath upright protection installed in warehouse',
        'image2' => $img_right,
        'image2Alt' => 'Racking installation with Goliath system',
        'introText' => my_theme_opt('my_theme_svc_cdm_intro', 'Goliath™ can be installed as part of any new pallet racking installation. When this is done, it provides immediate racking upright protection in high-impact areas. This ensures your system is protected even before operations begin. This reduces the risk of damage to your structure and prevents any ongoing repair costs.'),
    ]);

    $m .= my_theme_block('goliath/svc-two-articles', [
        'article1Heading' => my_theme_opt('my_theme_svc_cdm_build_h2', 'Build Protection into Your Project from Day One'),
        'article1Paragraphs' => [
            my_theme_opt('my_theme_svc_cdm_build_p1', 'By integrating Goliath™, our pallet rack protection system, during installation, you eliminate the need to repair your racking upright later.'),
            my_theme_opt('my_theme_svc_cdm_build_p2', 'Approaching protection this way supports a long-term pallet racking damage prevention strategy from the start.'),
        ],
        'article1SubHeading' => my_theme_opt('my_theme_svc_cdm_build_h3', 'Goliath™ is suitable for:'),
        'article1Items' => [
            my_theme_opt('my_theme_svc_cdm_build_item1', 'New warehouse developments'),
            my_theme_opt('my_theme_svc_cdm_build_item2', 'Full racking fit-outs'),
            my_theme_opt('my_theme_svc_cdm_build_item3', 'Expansion of existing facilities'),
            my_theme_opt('my_theme_svc_cdm_build_item4', 'Racking relocation and reconfiguration'),
        ],
        'article2Heading' => my_theme_opt('my_theme_svc_cdm_compliance_h2', 'Full CDM Management and Compliance'),
        'article2Paragraphs' => [my_theme_opt('my_theme_svc_cdm_compliance_desc', 'All our installation work is carried out in line with CDM regulations to ensure safety, coordination, and compliance throughout the project.')],
        'article2SubHeading' => my_theme_opt('my_theme_svc_cdm_compliance_h3', 'This includes:'),
        'article2Items' => [
            my_theme_opt('my_theme_svc_cdm_compliance_item1', 'Planning and risk assessment'),
            my_theme_opt('my_theme_svc_cdm_compliance_item2', 'Coordination with contractors and teams'),
            my_theme_opt('my_theme_svc_cdm_compliance_item3', 'Safe installation processes'),
            my_theme_opt('my_theme_svc_cdm_compliance_item4', 'Project oversight from start to completion'),
        ],
    ]);

    $m .= my_theme_block('goliath/svc-split-panel', [
        'bgColor' => 'grey',
        'heading' => my_theme_opt('my_theme_svc_cdm_protect_h2', 'Protect Your Investment from the Start'),
        'paragraphs' => [my_theme_opt('my_theme_svc_cdm_protect_desc', 'Installing a new racking system is a significant investment. Installing Goliath™ during the initial setup ensures that your investment is protected from day one.')],
        'ctaText' => my_theme_opt('my_theme_svc_cdm_protect_cta', 'Get Free Site Survey'),
        'ctaUrl' => '/contact/',
        'calloutText' => my_theme_opt('my_theme_svc_cdm_protect_callout_h2', 'Instead of planning for future repairs, Goliath™ prevents damage entirely.'),
        'calloutDesc' => my_theme_opt('my_theme_svc_cdm_protect_callout_desc', 'This results in a safer, more efficient warehouse with lower long-term costs.'),
    ]);

    $m .= my_theme_block('goliath/wg-dual-cta', [
        'heading' => my_theme_opt('my_theme_svc_cdm_final_h2', 'Start Your Installation with Goliath™ Protection'),
        'para1' => my_theme_opt('my_theme_svc_cdm_final_desc', 'Build damage prevention into your warehouse from the very beginning and save on future repair costs.'),
        'para2' => '',
        'primaryText' => my_theme_opt('my_theme_svc_cdm_protect_cta', 'Get Free Site Survey'),
        'primaryUrl' => '/contact/',
        'secondaryText' => my_theme_opt('my_theme_svc_cdm_final_cta', 'How It Works'),
        'secondaryUrl' => '/how-it-works/',
    ]);

    return $m;
}

/** Reconfiguration service → block markup */
function my_theme_migrate_markup_reconfiguration(): string
{
    $m = '';
    $img_left = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_svc_reconfig_img_left', get_theme_file_uri('assets/images/Services/Reconfiguration/config1.webp')) : get_theme_file_uri('assets/images/Services/Reconfiguration/config1.webp');
    $img_right = function_exists('my_theme_get_image_url') ? my_theme_get_image_url('my_theme_svc_reconfig_img_right', get_theme_file_uri('assets/images/Services/Reconfiguration/config2.webp')) : get_theme_file_uri('assets/images/Services/Reconfiguration/config2.webp');

    $m .= my_theme_block('goliath/svc-hero', [
        'headingWhite' => 'Reconfiguration Services',
        'headingOrange' => 'Racking',
        'orangeFirst' => true,
        'description' => my_theme_opt('my_theme_svc_reconfig_hero_desc', 'Your warehouse operations can change. You may grow, have new product lines, and demand may shift in ways that require adjustments to your existing racking layout.'),
    ]);

    $m .= my_theme_block('goliath/svc-two-articles', [
        'article1Icon' => get_theme_file_uri('assets/images/icons/svc-speed-icon.svg'),
        'article1Heading' => my_theme_opt('my_theme_svc_reconfig_flex_h2', 'Flexible Racking Relocation and Redesign'),
        'article1Paragraphs' => [
            my_theme_opt('my_theme_svc_reconfig_flex_p1', 'With our racking skates, there is no need to dismantle your racking system. We can move unloaded racking with ease, reducing downtime.'),
            my_theme_opt('my_theme_svc_reconfig_flex_p2', 'Every project is planned carefully to ensure that reconfiguration is carried out safely and efficiently, with little to no downtime.'),
        ],
        'article1Bold' => my_theme_opt('my_theme_svc_reconfig_flex_bold', 'What would normally take weeks, depending on the size of your warehouse, can be done in days or hours.'),
        'article2Icon' => get_theme_file_uri('assets/images/icons/svc-shield-outline.svg'),
        'article2Heading' => my_theme_opt('my_theme_svc_reconfig_safety_h2', 'Maintain Safety During Change'),
        'article2Paragraphs' => [
            my_theme_opt('my_theme_svc_reconfig_safety_p1', 'When reconfiguring or moving racking, it is important to maintain the structural integrity of your warehouse. With our team, all work is carried out safely, according to regulations.'),
            my_theme_opt('my_theme_svc_reconfig_safety_p2', 'This ensures your system meets required standards once reinstalled.'),
            my_theme_opt('my_theme_svc_reconfig_safety_p3', 'This is also an ideal time to assess any damage in your racking and identify areas that may need reinforcement or repair.'),
        ],
        'bannerText' => my_theme_opt('my_theme_svc_reconfig_banner', 'By combining annual inspections with long-term racking upright protection, your warehouse becomes a more controlled, lower-risk environment.'),
    ]);

    $m .= my_theme_block('goliath/svc-image-pair', [
        'image1' => $img_left,
        'image1Alt' => 'Warehouse aisle after racking reconfiguration',
        'image2' => $img_right,
        'image2Alt' => 'Reconfigured warehouse rack upright with reinforcement',
        'introText' => my_theme_opt('my_theme_svc_reconfig_intro', 'Our racking reconfiguration services allow you to change your existing storage system without fully replacing it. Our process minimises disruption and maintains operation.'),
    ]);

    $m .= my_theme_block('goliath/svc-dark-section', [
        'heading' => my_theme_opt('my_theme_svc_reconfig_integrate_h2', 'Integrate Damage Prevention During Reconfiguration'),
        'headingSize' => '36',
        'paragraphSpacing' => '8',
        'paragraphs' => [my_theme_opt('my_theme_svc_reconfig_integrate_desc', "When changing warehouse racking, there's an opportunity to improve long-term performance. High-risk areas can be identified and strengthened with our pallet rack protection system, Goliath™, during the reconfiguration process.")],
        'calloutPosition' => 'right',
        'calloutHeight' => '225',
        'calloutTextSize' => '20',
        'calloutDesc' => my_theme_opt('my_theme_svc_reconfig_integrate_callout', 'Installing Goliath™ on the weak areas provides racking upright protection, which reduces the risk of future impact damage on the same areas when operations resume.'),
    ]);

    $m .= my_theme_block('goliath/svc-cards-grid', [
        'heading' => my_theme_opt('my_theme_svc_reconfig_adapt_h2', 'Adapt Without Starting Over'),
        'introParagraphs' => [my_theme_opt('my_theme_svc_reconfig_adapt_desc', 'Reconfiguration is a way to learn more about your existing infrastructure. By combining our relocation services with Goliath™, you can improve your warehouse efficiency, reduce risk, and extend the lifespan of your racking system without the cost of a full replacement.')],
        'columns' => 3,
        'cardIcon' => 'tick',
        'introSpacing' => '8',
        'gridSpacing' => '8',
        'containerPadding' => 'equal',
        'cards' => [
            ['title' => my_theme_opt('my_theme_svc_reconfig_adapt_card1_title', 'Improve Efficiency'), 'desc' => my_theme_opt('my_theme_svc_reconfig_adapt_card1_desc', 'Optimize your warehouse layout for better operations')],
            ['title' => my_theme_opt('my_theme_svc_reconfig_adapt_card2_title', 'Reduce Risk'), 'desc' => my_theme_opt('my_theme_svc_reconfig_adapt_card2_desc', 'Identify and strengthen vulnerable areas')],
            ['title' => my_theme_opt('my_theme_svc_reconfig_adapt_card3_title', 'Extend Lifespan'), 'desc' => my_theme_opt('my_theme_svc_reconfig_adapt_card3_desc', 'Protect your racking investment for the long term')],
        ],
    ]);

    $m .= my_theme_block('goliath/wg-dual-cta', [
        'heading' => my_theme_opt('my_theme_svc_reconfig_final_h2', 'Reconfigure with Confidence'),
        'para1' => my_theme_opt('my_theme_svc_reconfig_final_desc', 'Transform your warehouse layout while protecting your investment with Goliath™ damage prevention.'),
        'para2' => '',
        'primaryText' => my_theme_opt('my_theme_svc_reconfig_cta_btn1', 'Get Free Site Survey'),
        'primaryUrl' => '/contact/',
        'secondaryText' => my_theme_opt('my_theme_svc_reconfig_cta_btn2', 'Upright Repair'),
        'secondaryUrl' => '/services/racking-upright-repair/',
    ]);

    return $m;
}

/** Compliance → block markup */
function my_theme_migrate_markup_compliance(): string
{
    $m = '';

    // Hero
    $comp_h1       = my_theme_opt('my_theme_comp_hero_h1', 'Compliance & Safety Standards');
    $comp_h1_parts = explode(' ', $comp_h1, 2);
    $m .= my_theme_block('goliath/hero-section', [
        'badge'            => my_theme_opt('my_theme_comp_hero_badge', 'SAFETY & STANDARDS'),
        'heading'          => $comp_h1_parts[0] ?? $comp_h1,
        'headingHighlight' => $comp_h1_parts[1] ?? '',
        'description'      => my_theme_opt('my_theme_comp_hero_desc', 'Safety concerning warehouse racking systems is controlled by clear expectations surrounding inspection, maintenance, and structural integrity. Goliath™ supports these requirements directly.'),
        'ctaText'          => my_theme_opt('my_theme_comp_hero_cta', 'Get Certified Solution'),
        'ctaUrl'           => '/contact/',
        'minHeight'        => 'medium',
    ]);

    // Regulation compliant + guarantee box
    $m .= my_theme_block('goliath/comp-regulation', [
        'heading' => my_theme_opt('my_theme_comp_reg_h2', 'Regulation Compliant'),
        'p1'      => my_theme_opt('my_theme_comp_reg_p1', 'For warehouse owners and operators, compliance is more than just about meeting the laid-out standards. When followed properly, it helps reduce risk, protect people, and ensure that work is carried out without interrupting operations.'),
        'p2'      => my_theme_opt('my_theme_comp_reg_p2', 'Goliath™ supports these requirements directly. Our permanent upright repair solution is tested and certified. Our product aligns with recognised UK and European standards, which address one of the most common causes of non-compliance in warehouses: impact damage to uprights.'),
        'boxH3'   => my_theme_opt('my_theme_comp_reg_box_h3', '100% UK Compliance Guaranteed'),
        'boxP'    => my_theme_opt('my_theme_comp_reg_box_p', 'Every GOLIATH™ installation is fully compliant with UK Health & Safety regulations. We provide complete documentation and certification for your records and inspections.'),
    ]);

    // HSE / EN / SEMA standards (4 cards)
    $m .= my_theme_block('goliath/comp-standards', [
        'heading'    => my_theme_opt('my_theme_comp_std_h2', 'Built to Align with HSE, EN and SEMA Guidelines'),
        'p1'         => my_theme_opt('my_theme_comp_std_p1', 'Racking systems in the UK are assessed against guidelines from the HSE, EN standards, and industry best practice supported by SEMA.'),
        'p2'         => my_theme_opt('my_theme_comp_std_p2', 'Goliath™ has been tested to comply with these expectations. It reinforces the part of the upright most susceptible to impact, helping maintain structural integrity and reduce the likelihood of damage being flagged during warehouse inspections.'),
        'card1Title' => my_theme_opt('my_theme_comp_std_card1_title', 'BS EN 15512:2020 + A1:2022'),
        'card1Body'  => my_theme_opt('my_theme_comp_std_card1_body', 'Regulations for steel storage systems for adjustable pallet racking-principles for structural design'),
        'card2Title' => my_theme_opt('my_theme_comp_std_card2_title', 'BS EN 15635:2008'),
        'card2Body'  => my_theme_opt('my_theme_comp_std_card2_body', 'Regulations for steel static storage systems application and maintenance of storage equipment'),
        'card3Title' => my_theme_opt('my_theme_comp_std_card3_title', 'SEMA code of practice'),
        'card3Body'  => my_theme_opt('my_theme_comp_std_card3_body', 'for the design of adjustable pallet racking'),
        'card4Title' => my_theme_opt('my_theme_comp_std_card4_title', 'SEMA code of practice'),
        'card4Body'  => my_theme_opt('my_theme_comp_std_card4_body', 'for the design and use of racking protection'),
    ]);

    // Image with warranty overlay
    $m .= my_theme_block('goliath/comp-warranty-overlay', [
        'h3'    => my_theme_opt('my_theme_comp_warranty_h3', 'Warranty Coverage Includes:'),
        'item1' => my_theme_opt('my_theme_comp_warranty_item1', 'Overall structure and repair process coverage for life'),
        'item2' => my_theme_opt('my_theme_comp_warranty_item2', 'Free replacement or repair if damaged from normal use'),
        'item3' => my_theme_opt('my_theme_comp_warranty_item3', 'Free from manufacturing defects guarantee'),
        'item4' => my_theme_opt('my_theme_comp_warranty_item4', 'No questions asked warranty claim process'),
    ]);

    // Common concerns (3-column grid)
    $m .= my_theme_block('goliath/comp-concerns', [
        'heading' => my_theme_opt('my_theme_comp_concerns_h2', 'Addressing Common Compliance Concerns'),
        'intro'   => my_theme_opt('my_theme_comp_concerns_intro', 'The most common concern many operators have is whether installing a non-manufacturer product could affect compliance or warranties.'),
        'c1H3'    => my_theme_opt('my_theme_comp_concern1_h3', 'System Integration'),
        'c1P'     => my_theme_opt('my_theme_comp_concern1_p', "Goliath™ works alongside your existing racking systems without compromising their integrity. It does not change load characteristics or interfere with how your system performs under normal conditions."),
        'c2H3'    => my_theme_opt('my_theme_comp_concern2_h3', 'Impact Protection'),
        'c2P'     => my_theme_opt('my_theme_comp_concern2_p', 'Instead, it protects the upright from external impact, which is one of the primary causes of structural failure.'),
        'c3H3'    => my_theme_opt('my_theme_comp_concern3_h3', 'Breaking the Cycle'),
        'c3P'     => my_theme_opt('my_theme_comp_concern3_p', "Goliath™ also challenges the 'replace-and-repeat' model by preventing damage to your uprights. This changes the maintenance cycle, but it does not affect any compliance requirements."),
    ]);

    // Only system (orange bg, two-column)
    $m .= my_theme_block('goliath/comp-only-system', [
        'leftH2'  => my_theme_opt('my_theme_comp_only_left_h2', 'The Only System of Its Kind in the UK and Europe'),
        'leftP1'  => my_theme_opt('my_theme_comp_only_left_p1', 'Goliath™ is the only pallet racking repair kit and protection system of its kind available across the UK and Europe.'),
        'leftP2'  => my_theme_opt('my_theme_comp_only_left_p2', 'Unlike traditional repair methods, Goliath™ is a permanent solution for the most common racking problems in warehouses. It stops the cycle of damage during facility usage and replacement.'),
        'rightH3' => my_theme_opt('my_theme_comp_only_right_h3', 'From a Compliance Perspective'),
        'rightP1' => my_theme_opt('my_theme_comp_only_right_p1', 'Continuous damage causes structural weaknesses, which raises concerns during inspections. A system that prevents that damage, like Goliath™, provides a more stable, consistent outcome.'),
        'rightP2' => my_theme_opt('my_theme_comp_only_right_p2', 'Goliath™ has also been independently tested and verified to perform excellently under real-world impact conditions. This provides additional assurance to our clients that the system is effective and suitable for long-term use in demanding warehouse environments.'),
    ]);

    // Proven performance + case study
    $m .= my_theme_block('goliath/comp-proven', [
        'heading'  => my_theme_opt('my_theme_comp_proven_h2', 'Proven Performance Backed by Lifetime Warranty'),
        'p1'       => my_theme_opt('my_theme_comp_proven_p1', 'Goliath™ is supported by a lifetime impact warranty, reflecting our confidence in its durability and long-term performance.'),
        'p2'       => my_theme_opt('my_theme_comp_proven_p2', 'Once installed, it provides continuous protection in the same location without the need to change your uprights regularly. This reduces the frequency of repairs and keeps your uprights in good condition, through inspection cycles.'),
        'caseH3'   => my_theme_opt('my_theme_comp_proven_case_h3', 'Case Study: B&M'),
        'caseP'    => my_theme_opt('my_theme_comp_proven_case_p', 'Our client, B&M, reduced racking repair costs by over 30% within the first 12 months of installation. This was achieved by preventing repeat damage to the uprights in their warehouse, which also reduces the likelihood of compliance issues arising from compromised uprights.'),
    ]);

    // Compatibility section
    $m .= my_theme_block('goliath/comp-compatibility', [
        'heading' => my_theme_opt('my_theme_comp_compat_h2', 'How compatible is GOLIATH™?'),
        'intro'   => my_theme_opt('my_theme_comp_compat_intro', "GOLIATH™ is designed to work with all major pallet racking systems. Here's a list of the top 10 racking companies GOLIATH™ is compatible with:"),
        'items'   => my_theme_opt('my_theme_comp_compat_items', 'Link 51 XL, Dexion Mk3, Dexion P90, Mecalux, Stow, Apex, Redirack, PSS (all types), Bito, Hi-Lo Premier Rack & Rack Plan'),
        'boxH3'   => my_theme_opt('my_theme_comp_compat_box_h3', "Don't see your type?"),
        'boxP'    => my_theme_opt('my_theme_comp_compat_box_p', 'No problem. GOLIATH™ can be adapted to work with all pallet racking systems. Contact us to discuss your specific racking configuration.'),
        'boxCta'  => my_theme_opt('my_theme_comp_compat_box_cta', 'Check Compatibility'),
    ]);

    // Documentation (dark bg, 3 cards)
    $m .= my_theme_block('goliath/comp-documentation', [
        'heading'   => my_theme_opt('my_theme_comp_doc_h2', 'Transparent Documentation and Certification'),
        'subtitle'  => my_theme_opt('my_theme_comp_doc_subtitle', 'To support compliance requirements, Goliath™ provides access to detailed documentation.'),
        'card1H3'   => my_theme_opt('my_theme_comp_doc_card1_h3', 'Compliance Certification'),
        'card1Sub'  => my_theme_opt('my_theme_comp_doc_card1_sub', 'From independent testing'),
        'card2H3'   => my_theme_opt('my_theme_comp_doc_card2_h3', 'Technical Specs'),
        'card2Sub'  => my_theme_opt('my_theme_comp_doc_card2_sub', 'Performance data and specifications'),
        'card3H3'   => my_theme_opt('my_theme_comp_doc_card3_h3', 'Price Comparison'),
        'card3Sub'  => my_theme_opt('my_theme_comp_doc_card3_sub', 'Insights vs. traditional methods'),
        'closing'   => my_theme_opt('my_theme_comp_doc_closing', 'Downloadable PDFs are also available to support internal reviews, safety documentation, and procurement decisions. Our resources make it easier to show due diligence in the process and to explain clearly how Goliath™ contributes to safety and compliance.'),
    ]);

    // Audit readiness (with aside panel)
    $m .= my_theme_block('goliath/comp-audit', [
        'heading'  => my_theme_opt('my_theme_comp_audit_h2', 'Supporting Inspection Outcomes and Audit Readiness'),
        'p1'       => my_theme_opt('my_theme_comp_audit_p1', 'Regular inspections are an important part of ensuring compliance. A SEMA racking inspection or internal audit will assess the visible damage, structural condition, and overall system safety.'),
        'p2'       => my_theme_opt('my_theme_comp_audit_p2', 'By reducing impact damage, Goliath™ improves your inspection outcomes. Fewer damaged uprights in your reports mean fewer red or amber risk classifications and little to no need for urgent corrective action.'),
        'asideH3'  => my_theme_opt('my_theme_comp_audit_aside_h3', 'Digital Racking Management'),
        'asideP'   => my_theme_opt('my_theme_comp_audit_aside_p', 'When combined with our digital racking management system, Goliath™ operators gain additional visibility through recorded inspection data and reports, proper risk categorisation, and repair documentation.'),
    ]);

    // Final CTA (orange bg)
    $m .= my_theme_block('goliath/wg-dual-cta', [
        'heading'       => my_theme_opt('my_theme_comp_cta_h2', 'Ensure Compliance with Goliath™'),
        'para1'         => my_theme_opt('my_theme_comp_cta_p', 'Protect your warehouse, reduce risk, and maintain the highest safety standards with our proven upright repair solution.'),
        'para2'         => '',
        'primaryText'   => my_theme_opt('my_theme_comp_cta_primary', 'Get Free Site Survey'),
        'primaryUrl'    => '/contact/',
        'secondaryText' => my_theme_opt('my_theme_comp_cta_secondary', 'View FAQs'),
        'secondaryUrl'  => '/faq/',
    ]);

    return $m;
}

/** FAQ → block markup */
function my_theme_migrate_markup_faq(): string
{
    $m = '';

    // Section 1: Hero
    $faqp_h1       = my_theme_opt('my_theme_faqp_hero_h1', 'Frequently Asked Questions');
    $faqp_h1_parts = explode(' ', $faqp_h1, 2);
    $m .= my_theme_block('goliath/hero-section', [
        'heading'          => $faqp_h1_parts[0] ?? $faqp_h1,
        'headingHighlight' => $faqp_h1_parts[1] ?? '',
        'description'      => my_theme_opt('my_theme_faqp_hero_desc', 'Everything you need to know about Goliath Pallet Racking Repair Ltd, from installation and costs to safety compliance and warranty coverage.'),
        'minHeight'        => 'medium',
    ]);

    // Section 2: FAQ accordion (uses global FAQ items from wp_options)
    $faq_items = [];
    if (function_exists('my_theme_get_faq_items')) {
        foreach (my_theme_get_faq_items() as $item) {
            $faq_items[] = [
                'question' => $item['question'] ?? '',
                'answer'   => implode("\n\n", $item['paragraphs'] ?? []),
            ];
        }
    }
    $m .= my_theme_block('goliath/faq-accordion', [
        'items' => $faq_items,
    ]);

    // Section 3: Resources grid (faithful to 3-card layout)
    $m .= my_theme_block('goliath/faq-resources', [
        'heading'    => my_theme_opt('my_theme_faqp_resources_h2', 'Explore More Resources'),
        'card1Title' => my_theme_opt('my_theme_faqp_res1_title', 'How It Works'),
        'card1Desc'  => my_theme_opt('my_theme_faqp_res1_desc', 'Learn about our 30-minute installation process'),
        'card1Url'   => '/how-it-works/',
        'card2Title' => my_theme_opt('my_theme_faqp_res2_title', 'Compliance'),
        'card2Desc'  => my_theme_opt('my_theme_faqp_res2_desc', 'Understand how Goliath™ meets UK safety standards'),
        'card2Url'   => '/compliance/',
        'card3Title' => my_theme_opt('my_theme_faqp_res3_title', 'Case Studies'),
        'card3Desc'  => my_theme_opt('my_theme_faqp_res3_desc', 'See real-world results from B&M and others'),
        'card3Url'   => '/case-studies/',
    ]);

    // Section 4: Bottom CTA (orange band with image + text)
    $m .= my_theme_block('goliath/faq-bottom-cta', [
        'heading'    => my_theme_opt('my_theme_faqp_cta_h3', 'Still Have Questions?'),
        'body'       => my_theme_opt('my_theme_faqp_cta_body', 'Our team of experts is ready to answer any questions you have about Goliath™ and how it can benefit your warehouse operations.'),
        'buttonText' => my_theme_opt('my_theme_faqp_cta_btn', 'Contact us'),
        'buttonUrl'  => '/contact/',
    ]);

    return $m;
}

/** About → block markup */
function my_theme_migrate_markup_about(): string
{
    $m = '';

    // Hero
    $m .= my_theme_block('goliath/hero-section', [
        'badge'       => my_theme_opt('my_theme_about_hero_badge', 'WHO WE ARE'),
        'heading'     => my_theme_opt('my_theme_about_hero_h1', 'About Goliath™'),
        'description' => my_theme_opt('my_theme_about_hero_desc', "The team behind the UK's only permanent pallet racking upright repair system. SEMA-qualified engineers dedicated to ending the cycle of costly racking replacement."),
        'minHeight'   => 'medium',
    ]);

    // Our Story (4 paragraphs)
    $m .= my_theme_block('goliath/about-our-story', [
        'heading' => my_theme_opt('my_theme_about_story_h2', 'Our Story'),
        'p1'      => my_theme_opt('my_theme_about_story_p1', 'Goliath was founded with a clear mission: to provide warehouse operators with a permanent, cost-effective alternative to repeated racking upright replacement. Our engineered steel repair system was developed to address one of the most persistent problems in warehouse maintenance.'),
        'p2'      => my_theme_opt('my_theme_about_story_p2', 'Working closely with structural engineers and guided by UK safety standards including BS EN 15512 and BS EN 15635, we created a repair solution that does not just restore uprights to their original strength but reinforces them against future impact.'),
        'p3'      => my_theme_opt('my_theme_about_story_p3', 'Every member of our installation team holds SEMA-approved racking inspector qualifications. We believe that the people who repair your racking should be qualified to inspect it first, ensuring every repair meets the highest safety standards.'),
        'p4'      => my_theme_opt('my_theme_about_story_p4', 'Today, Goliath is trusted by leading UK retailers and logistics operators. Our system is being rolled out across hundreds of warehouse sites, protecting the racking infrastructure that businesses depend on every day.'),
    ]);

    // Mission (grey bg)
    $m .= my_theme_block('goliath/about-mission', [
        'heading' => my_theme_opt('my_theme_about_mission_h2', 'Our Mission'),
        'text'    => my_theme_opt('my_theme_about_mission_text', 'To end the costly cycle of racking upright replacement by providing permanent, engineered repairs that improve safety, reduce downtime, and lower long-term maintenance costs for every warehouse we serve.'),
    ]);

    // Leadership (with photo)
    $m .= my_theme_block('goliath/about-leadership', [
        'heading'              => my_theme_opt('my_theme_about_leader_h2', 'Leadership'),
        'subtitle'             => my_theme_opt('my_theme_about_leader_subtitle', 'Qualified professionals with deep expertise in warehouse racking safety and structural engineering.'),
        'leaderName'           => my_theme_opt('my_theme_about_leader_name', 'Managing Director'),
        'leaderRole'           => my_theme_opt('my_theme_about_leader_role', 'Founder & Managing Director'),
        'leaderQualifications' => my_theme_opt('my_theme_about_leader_qualifications', 'SEMA Approved Racking Inspector'),
        'bioP1'                => my_theme_opt('my_theme_about_leader_bio_p1', 'With extensive experience in warehouse racking safety and structural repair, our managing director identified a fundamental flaw in the traditional approach to racking maintenance: the endless cycle of damage, replacement, and repeat damage.'),
        'bioP2'                => my_theme_opt('my_theme_about_leader_bio_p2', 'This insight led to the development of the Goliath repair system, engineered to not only restore damaged uprights but to reinforce them against future impact. Every installation is backed by a lifetime warranty because we stand behind the quality of our work.'),
    ]);

    // Team (grey bg, repeater)
    $team_members_raw = get_option('my_theme_about_team_members', []);
    $team_members = is_array($team_members_raw) ? $team_members_raw : [];
    $m .= my_theme_block('goliath/about-team', [
        'heading'  => my_theme_opt('my_theme_about_team_h2', 'Our Team'),
        'subtitle' => my_theme_opt('my_theme_about_team_subtitle', 'SEMA-qualified inspectors and engineers delivering safe, permanent racking repairs across the UK.'),
        'members'  => $team_members,
    ]);

    // Credentials (dark bg)
    $m .= my_theme_block('goliath/about-credentials', [
        'heading' => my_theme_opt('my_theme_about_creds_h2', 'Our Credentials'),
    ]);

    // Final CTA (orange bg, dual buttons)
    $m .= my_theme_block('goliath/wg-dual-cta', [
        'heading'       => my_theme_opt('my_theme_about_cta_h2', 'Work with a team you can trust'),
        'para1'         => my_theme_opt('my_theme_about_cta_desc', 'Our SEMA-qualified team is ready to assess your warehouse racking and provide a permanent repair solution backed by a lifetime warranty.'),
        'para2'         => '',
        'primaryText'   => my_theme_opt('my_theme_about_cta_primary', 'Get free assessment'),
        'primaryUrl'    => '/contact/',
        'secondaryText' => my_theme_opt('my_theme_about_cta_secondary', 'View case studies'),
        'secondaryUrl'  => '/case-studies/',
    ]);

    return $m;
}

/** Contact → block markup */
function my_theme_migrate_markup_contact(): string
{
    $m = '';

    // Section 1: Hero
    $cp_h1       = my_theme_opt('my_theme_cp_hero_h1', 'Get in Touch');
    $cp_h1_parts = explode(' ', $cp_h1, 2);
    $m .= my_theme_block('goliath/hero-section', [
        'heading'          => $cp_h1_parts[0] ?? $cp_h1,
        'headingHighlight' => $cp_h1_parts[1] ?? '',
        'description'      => my_theme_opt('my_theme_cp_hero_desc', 'Request a free warehouse racking assessment from our SEMA-qualified team. We respond within one working day and provide transparent, no-obligation pricing.'),
        'minHeight'        => 'medium',
    ]);

    // Section 2: Contact quick cards (faithful to original 3-card grid)
    $m .= my_theme_block('goliath/contact-cards', [
        'phoneSubtitle' => my_theme_opt('my_theme_cp_phone_subtitle', 'Mon–Fri, 8am–6pm GMT'),
        'emailSubtitle' => my_theme_opt('my_theme_cp_email_subtitle', 'We respond within 1 working day'),
    ]);

    // Section 3: Contact form section with sidebar
    $m .= my_theme_block('goliath/contact-form', [
        'formHeading'  => my_theme_opt('my_theme_cp_form_h2', 'Request a Free Warehouse Assessment'),
        'sidebarLine1' => my_theme_opt('my_theme_cp_sidebar_large1', 'Get Your Free'),
        'sidebarLine2' => my_theme_opt('my_theme_cp_sidebar_large2', 'Consultation'),
        'sidebarBody'  => my_theme_opt('my_theme_cp_sidebar_body', 'Lifetime warranty, 30-minute installation, minimal downtime. Find out how Goliath can reduce your racking repair costs.'),
        'whyHeading'   => my_theme_opt('my_theme_cp_sidebar_why_heading', 'Why Request an Assessment?'),
        'bullet1'      => my_theme_opt('my_theme_cp_sidebar_bullet1', 'Free, no-obligation evaluation'),
        'bullet2'      => my_theme_opt('my_theme_cp_sidebar_bullet2', 'Response within 1 working day'),
        'bullet3'      => my_theme_opt('my_theme_cp_sidebar_bullet3', 'Transparent, honest pricing'),
        'bullet4'      => my_theme_opt('my_theme_cp_sidebar_bullet4', 'Expert safety advice'),
    ]);

    // Section 4: Contact bottom info (photo + description + benefits)
    $m .= my_theme_block('goliath/contact-bottom-info', [
        'description'      => my_theme_opt('my_theme_cp_bottom_desc', 'Our expert team will visit your facility, assess your racking condition, identify damage and risk areas, and provide a detailed quote with no obligation. Most assessments are completed within 48 hours of booking.'),
        'benefit1Title'    => my_theme_opt('my_theme_cp_benefit1_title', 'Free Site Survey'),
        'benefit1Subtitle' => my_theme_opt('my_theme_cp_benefit1_subtitle', 'Complete damage assessment and risk mapping'),
        'benefit2Title'    => my_theme_opt('my_theme_cp_benefit2_title', 'Detailed Quote'),
        'benefit2Subtitle' => my_theme_opt('my_theme_cp_benefit2_subtitle', 'Transparent pricing with no hidden costs'),
        'benefit3Title'    => my_theme_opt('my_theme_cp_benefit3_title', 'Expert Recommendations'),
        'benefit3Subtitle' => my_theme_opt('my_theme_cp_benefit3_subtitle', 'Tailored solutions for your specific needs'),
        'benefit4Title'    => my_theme_opt('my_theme_cp_benefit4_title', 'Fast Response'),
        'benefit4Subtitle' => my_theme_opt('my_theme_cp_benefit4_subtitle', 'Emergency installations within 48 hours'),
    ]);

    return $m;
}

/** Videos → block markup */
function my_theme_migrate_markup_videos(): string
{
    $m = '';

    $m .= my_theme_block('goliath/hero-section', [
        'badge'       => my_theme_opt('my_theme_vp_hero_badge', 'Featured Video'),
        'heading'     => my_theme_opt('my_theme_vp_hero_h1', 'Rack Safety & Installation Videos'),
        'description' => my_theme_opt('my_theme_vp_hero_desc', 'Watch Goliath™ in action and learn everything you need to know about warehouse racking safety, compliance, and cost-effective repair solutions.'),
        'minHeight'   => 'medium',
    ]);

    $m .= my_theme_block('goliath/videos-grid', [
        'installHeading'  => my_theme_opt('my_theme_vp_install_heading', 'Installation & Product Demos'),
        'installSubtitle' => my_theme_opt('my_theme_vp_install_subtitle', 'Watch how Goliath™ is installed and see the product in action'),
        'safetyHeading'   => my_theme_opt('my_theme_vp_safety_heading', 'Safety & Compliance'),
        'safetySubtitle'  => my_theme_opt('my_theme_vp_safety_subtitle', 'Understanding warehouse racking safety regulations and best practices'),
    ]);

    $m .= my_theme_block('goliath/videos-copy', [
        'leftHeading'  => my_theme_opt('my_theme_vp_copy_left_h2', 'Goliath™ Rack Repair & Safety Videos'),
        'leftP1'       => my_theme_opt('my_theme_vp_copy_left_p1', 'Pallet racking damage is a constant issue in busy warehouses, but the real problem is how it is managed over time. Goliath™ is designed to break the cycle of repeated damage, costly replacements, and downtime.'),
        'leftP2'       => my_theme_opt('my_theme_vp_copy_left_p2', 'Our video series shows how Goliath™ repairs and reinforces uprights differently from traditional methods, delivering a permanent solution that improves safety, reduces downtime, and lowers long-term maintenance costs.'),
        'rightHeading' => my_theme_opt('my_theme_vp_copy_right_h2', 'Learn How Goliath™ Breaks the Repair Cycle'),
        'rightP1'      => my_theme_opt('my_theme_vp_copy_right_p1', 'Traditional pallet racking repair replaces damaged uprights after impact, restoring the rack but not preventing future damage.'),
        'rightP2'      => my_theme_opt('my_theme_vp_copy_right_p2', 'The Goliath™ video series shows how our high-strength steel repair system reinforces the impact zone, turning repeated repairs into a permanent structural upgrade.'),
    ]);

    $m .= my_theme_block('goliath/videos-dark-bar', [
        'text' => my_theme_opt('my_theme_vp_black_cta_text', 'Ready to see Goliath™ in your warehouse?'),
        'btn1' => my_theme_opt('my_theme_vp_black_cta_btn1', 'Book a free on-site demonstration'),
        'btn2' => my_theme_opt('my_theme_vp_black_cta_btn2', 'Schedule live demo'),
    ]);

    $m .= my_theme_block('goliath/videos-orange-cta', [
        'heading' => my_theme_opt('my_theme_vp_orange_h2', 'Ready to see Goliath™ in your warehouse?'),
        'body'    => my_theme_opt('my_theme_vp_orange_desc', 'Book a free on-site demonstration and see first-hand how Goliath™ can improve your racking maintenance.'),
        'btnText' => my_theme_opt('my_theme_vp_orange_btn', 'Schedule live demo'),
    ]);

    return $m;
}

/** Privacy Policy → block markup */
function my_theme_migrate_markup_privacy_policy(): string
{
    $m = '';

    $m .= my_theme_block('goliath/hero-section', [
        'heading'          => 'Privacy',
        'headingHighlight' => 'Policy',
        'description'      => 'How Goliath Pallet Racking Repair Ltd collects, uses, and protects your information.',
        'minHeight'        => 'small',
    ]);

    $privacy_content = '<p>Goliath Pallet Racking Repair Ltd is the sole owner of the information collected on www.goliathrepair.co.uk. Goliath Pallet Racking Repair Ltd collects information from our users at several different points on our website.</p>'
        . '<p>Other than for specific purposes as agreed with the user such as fulfilling an online order, the information that is collected through this site is used for marketing or analysis purposes only.</p>'
        . '<div class="space-y-4"><h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Analysis</h2>'
        . '<p>Information gathered through this website will be held in a database at our office and be used periodically to assess the success of the website and the actions required from the levels of traffic generated.</p>'
        . '<p>When you request a page from the site\'s web server, the server automatically collects some information about your system, including your IP address. Goliath Pallet Racking Repair Ltd collects the minimum information necessary to ensure our service works. We do not currently provide or share your information with other third parties.</p></div>'
        . '<div class="space-y-4"><h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Enquiry Form</h2>'
        . '<p>We ask for information from the user on our enquiry form. Information gathered through this form will be held in a database at our offices and be used periodically to assist in the various marketing activities of Goliath Pallet Racking Repair Ltd.</p>'
        . '<p>We do not currently provide or share your information with other third parties.</p></div>'
        . '<div class="space-y-4"><h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Legal Disclaimer</h2>'
        . '<p>Though we make every effort to preserve user privacy, we may need to disclose personal information when required by law wherein we have a good-faith belief that such action is necessary to comply with a current judicial proceeding, a court order or legal process served on our website.</p></div>'
        . '<div class="space-y-4"><h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Business Transitions</h2>'
        . '<p>In the event Goliath Pallet Racking Repair Ltd goes through a business transition, such as a merger, being acquired by another company, or selling a portion of its assets, users\' personal information will, in most instances, be part of the assets transferred.</p></div>'
        . '<div class="space-y-4"><h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Links</h2>'
        . '<p>This website contains links to other sites. Please be aware that we are not responsible for the privacy practices of such other sites.</p></div>'
        . '<div class="space-y-4"><h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Changes to this Statement</h2>'
        . '<p>Goliath Pallet Racking Repair Ltd will occasionally update this Privacy Statement to reflect company and customer feedback.</p></div>'
        . '<div class="space-y-4"><h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">Unsubscribing</h2>'
        . '<p>We shall remove you from our database of site users and stop sending you information upon request.</p></div>';

    $m .= my_theme_block('goliath/legal-content', [
        'content' => $privacy_content,
    ]);

    return $m;
}

/** Terms of Service → block markup */
function my_theme_migrate_markup_terms_of_service(): string
{
    $m = '';

    $m .= my_theme_block('goliath/hero-section', [
        'heading'          => 'Terms and',
        'headingHighlight' => 'Conditions',
        'description'      => 'Terms governing your use of the Goliath Pallet Racking Repair Ltd website.',
        'minHeight'        => 'small',
    ]);

    $terms_content = '<p>If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our Privacy Policy and our Cookie Policy govern Goliath Pallet Racking Repair Ltd\'s relationship with you in relation to this website.</p>'
        . '<p>If you disagree with any part of these terms and conditions, please do not use our website.</p>'
        . '<p>The term Goliath Pallet Racking Repair Ltd or &lsquo;us&rsquo; or &lsquo;we&rsquo; refers to the owner of the website whose contact details can be found on our contact page. The term &lsquo;you&rsquo; refers to the user or viewer of our website.</p>'
        . '<div class="space-y-4"><h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00]">The use of this website is subject to the following terms of use</h2>'
        . '<ul class="space-y-4 list-disc pl-6">'
        . '<li>The content of the pages of this website is for your general information and use only. It is subject to change without notice.</li>'
        . '<li>This website uses cookies and may not function correctly without them. By using our website and agreeing to these terms and conditions you are consenting to our use of cookies in accordance with our cookie policy.</li>'
        . '<li>Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.</li>'
        . '<li>Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose.</li>'
        . '<li>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice.</li>'
        . '<li>All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.</li>'
        . '<li>From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s).</li>'
        . '<li>Your use of this website and any dispute arising out of such use of the website is subject to the laws of England, Northern Ireland, Scotland and Wales.</li>'
        . '<li>Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.</li>'
        . '</ul></div>';

    $m .= my_theme_block('goliath/legal-content', [
        'content' => $terms_content,
    ]);

    return $m;
}

/* ================================================================== */
/*  Case Study CPT migration                                           */
/* ================================================================== */

/**
 * Generate Gutenberg block markup for a case study using the dedicated cs-* blocks.
 *
 * Uses goliath/cs-hero, goliath/cs-problem, goliath/cs-solution,
 * goliath/cs-results, and goliath/cs-testimonial-cta — each of which
 * faithfully renders the matching section from page-case-study-detail.php.
 *
 * @param string               $slug Slug used for the CPT post_name.
 * @param array<string, mixed> $cs   Case study data from the library.
 */
function my_theme_migrate_case_study_markup(string $slug, array $cs): string
{
    $m = '';

    // ── Hero ──────────────────────────────────────────────────────────
    $m .= my_theme_block('goliath/cs-hero', [
        'client' => $cs['client'] ?? '',
        'intro'  => $cs['hero_intro'] ?? '',
    ]);

    // ── Problem & Tried ───────────────────────────────────────────────
    $m .= my_theme_block('goliath/cs-problem', [
        'title'          => $cs['title'] ?? '',
        'problemText'    => $cs['problem_text'] ?? '',
        'problemCallout' => $cs['problem_callout'] ?? '',
        'triedText'      => $cs['tried_text'] ?? '',
        'triedCallout'   => $cs['tried_callout'] ?? '',
    ]);

    // ── Solution ──────────────────────────────────────────────────────
    $m .= my_theme_block('goliath/cs-solution', [
        'video'           => $cs['video'] ?? '',
        'solutionText'    => $cs['solution_text'] ?? '',
        'solutionCallout' => $cs['solution_callout'] ?? '',
    ]);

    // ── Results ───────────────────────────────────────────────────────
    // Resolve the results image to a URL (supports attachment IDs and direct URLs).
    $default_image = get_theme_file_uri('assets/images/caseStudy/B&M.webp');
    $results_image_raw = $cs['results_image'] ?? '';
    $results_image = function_exists('my_theme_resolve_case_study_image')
        ? my_theme_resolve_case_study_image($results_image_raw, $default_image)
        : ($results_image_raw ?: $default_image);

    $m .= my_theme_block('goliath/cs-results', [
        'resultsImage' => $results_image,
        'resultsIntro' => $cs['results_intro'] ?? '',
        'result1Title' => $cs['result1_title'] ?? '',
        'result1Text'  => $cs['result1_text'] ?? '',
        'result2Title' => $cs['result2_title'] ?? '',
        'result2Text'  => $cs['result2_text'] ?? '',
        'result3Title' => $cs['result3_title'] ?? '',
        'result3Text'  => $cs['result3_text'] ?? '',
        'result4Title' => $cs['result4_title'] ?? '',
        'result4Text'  => $cs['result4_text'] ?? '',
        'warrantyText' => $cs['warranty_text'] ?? '',
    ]);

    // ── Testimonial / CTA ─────────────────────────────────────────────
    $m .= my_theme_block('goliath/cs-testimonial-cta', [
        'client'      => $cs['client'] ?? '',
        'quote'       => $cs['testimonial_quote'] ?? '',
        'attribution' => $cs['testimonial_attr'] ?? '',
        'ctaText'     => 'Get Similar Results',
        'ctaUrl'      => '/contact/',
    ]);

    return $m;
}

/**
 * Migrate all case studies from wp_options library to CPT posts.
 *
 * @return array<string, array{success: bool, message: string}>
 */
function my_theme_migrate_case_studies(): array
{
    if (!function_exists('my_theme_get_case_study_library')) {
        return ['error' => ['success' => false, 'message' => 'Case study library function not found.']];
    }

    $library = my_theme_get_case_study_library();
    $results = [];

    foreach ($library as $slug => $cs) {
        // Check if CPT post already exists with this slug.
        $existing = get_page_by_path($slug, OBJECT, 'case-study');
        if ($existing) {
            $results[$slug] = ['success' => false, 'message' => "Case study \"{$slug}\" already exists (ID {$existing->ID}) - skipped."];
            continue;
        }

        $markup = my_theme_migrate_case_study_markup($slug, $cs);

        $post_id = wp_insert_post([
            'post_type'    => 'case-study',
            'post_title'   => $cs['title'] ?? $slug,
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_content' => $markup,
            'post_excerpt' => $cs['seo_desc'] ?? '',
            'menu_order'   => 0,
        ], true);

        if (is_wp_error($post_id)) {
            $results[$slug] = ['success' => false, 'message' => $post_id->get_error_message()];
            continue;
        }

        // Derive first-paragraph summaries for the listing-page card.
        $problem_paras  = array_filter(array_map('trim', explode("\n\n", $cs['problem_text'] ?? '')));
        $solution_paras = array_filter(array_map('trim', explode("\n\n", $cs['solution_text'] ?? '')));
        $challenge_summary = reset($problem_paras)  ?: ($cs['challenge'] ?? '');
        $solution_summary  = reset($solution_paras) ?: ($cs['solution'] ?? '');

        // Resolve card image (mirrors my_theme_resolve_case_study_image).
        $default_card_image = get_theme_file_uri('assets/images/caseStudy/B&M.webp');
        $card_image = function_exists('my_theme_resolve_case_study_image')
            ? my_theme_resolve_case_study_image($cs['image'] ?? '', $default_card_image)
            : ($cs['image'] ?? $default_card_image);

        // Store card meta for the listing page.
        $meta_map = [
            '_cs_client'         => $cs['client'] ?? '',
            '_cs_challenge'      => $challenge_summary,
            '_cs_solution'       => $solution_summary,
            '_cs_image'          => $card_image,
            '_cs_metric_1_value' => $cs['metric1_value'] ?? '',
            '_cs_metric_1_label' => $cs['metric1_label'] ?? '',
            '_cs_metric_2_value' => $cs['metric2_value'] ?? '',
            '_cs_metric_2_label' => $cs['metric2_label'] ?? '',
            '_cs_metric_3_value' => $cs['metric3_value'] ?? '',
            '_cs_metric_3_label' => $cs['metric3_label'] ?? '',
            '_cs_seo_title'      => $cs['seo_title'] ?? '',
            '_cs_seo_desc'       => $cs['seo_desc'] ?? '',
        ];

        foreach ($meta_map as $meta_key => $meta_value) {
            if ($meta_value !== '') {
                update_post_meta($post_id, $meta_key, $meta_value);
            }
        }

        $title = $cs['title'] ?? $slug;
        $results[$slug] = ['success' => true, 'message' => "Case study \"{$title}\" migrated as CPT post (ID {$post_id})."];
    }

    return $results;
}

/* ================================================================== */
/*  AJAX handler for per-page migration                                */
/* ================================================================== */

add_action('admin_post_goliath_migrate_page', function (): void {
    if (!current_user_can('manage_options')) {
        wp_die('Insufficient permissions.');
    }

    $nonce = isset($_POST['_wpnonce']) ? sanitize_text_field(wp_unslash((string) $_POST['_wpnonce'])) : '';
    if (!wp_verify_nonce($nonce, 'goliath_migrate')) {
        wp_die('Security check failed.');
    }

    $page_key = isset($_POST['page_key']) ? sanitize_key(wp_unslash((string) $_POST['page_key'])) : '';

    $generators = my_theme_migrate_generators();

    if ($page_key === 'case-studies-cpt') {
        $results = my_theme_migrate_case_studies();
        $all_ok  = !empty($results) && !in_array(false, array_column($results, 'success'), true);
        $msg     = implode('; ', array_column($results, 'message'));
        set_transient('goliath_migrate_notice', ['type' => $all_ok ? 'success' : 'warning', 'msg' => $msg], 30);
        wp_safe_redirect(admin_url('admin.php?page=goliath-migrate-to-blocks'));
        exit;
    }

    if (!isset($generators[$page_key])) {
        wp_die('Unknown page key.');
    }

    $markup = call_user_func($generators[$page_key]['generator']);
    $result = my_theme_migrate_page($generators[$page_key]['slug'], $markup);
    set_transient('goliath_migrate_notice', ['type' => $result['success'] ? 'success' : 'error', 'msg' => $result['message']], 30);
    wp_safe_redirect(admin_url('admin.php?page=goliath-migrate-to-blocks'));
    exit;
});

/**
 * All available page migration generators.
 *
 * @return array<string, array{label: string, slug: string, generator: callable}>
 */
function my_theme_migrate_generators(): array
{
    return [
        'homepage'                => ['label' => 'Homepage',                    'slug' => 'home',                   'generator' => 'my_theme_migrate_markup_homepage'],
        'why-goliath'             => ['label' => 'Why Goliath',                 'slug' => 'why-goliath',            'generator' => 'my_theme_migrate_markup_why_goliath'],
        'how-it-works'            => ['label' => 'How It Works',                'slug' => 'how-it-works',           'generator' => 'my_theme_migrate_markup_how_it_works'],
        'services'                => ['label' => 'Services',                    'slug' => 'services',               'generator' => 'my_theme_migrate_markup_services'],
        'racking-upright-repair'  => ['label' => 'Racking Upright Repair',      'slug' => 'services/racking-upright-repair', 'generator' => 'my_theme_migrate_markup_racking_upright_repair'],
        'damage-prevention'       => ['label' => 'Damage Prevention',           'slug' => 'services/damage-prevention',      'generator' => 'my_theme_migrate_markup_damage_prevention'],
        'annual-inspections'      => ['label' => 'Annual Inspections',          'slug' => 'services/annual-inspections',     'generator' => 'my_theme_migrate_markup_annual_inspections'],
        'installations-cdm'       => ['label' => 'Installations & CDM',         'slug' => 'services/installations-cdm',      'generator' => 'my_theme_migrate_markup_installations_cdm'],
        'reconfiguration'         => ['label' => 'Reconfiguration',             'slug' => 'services/reconfiguration',        'generator' => 'my_theme_migrate_markup_reconfiguration'],
        'compliance'              => ['label' => 'Compliance',                  'slug' => 'compliance',             'generator' => 'my_theme_migrate_markup_compliance'],
        'faq'                     => ['label' => 'FAQ',                         'slug' => 'faq',                    'generator' => 'my_theme_migrate_markup_faq'],
        'about'                   => ['label' => 'About',                       'slug' => 'about',                  'generator' => 'my_theme_migrate_markup_about'],
        'contact'                 => ['label' => 'Contact',                     'slug' => 'contact',                'generator' => 'my_theme_migrate_markup_contact'],
        'videos'                  => ['label' => 'Videos',                      'slug' => 'videos',                 'generator' => 'my_theme_migrate_markup_videos'],
        'privacy-policy'          => ['label' => 'Privacy Policy',              'slug' => 'privacy-policy',         'generator' => 'my_theme_migrate_markup_privacy_policy'],
        'terms-of-service'        => ['label' => 'Terms of Service',            'slug' => 'terms-of-service',       'generator' => 'my_theme_migrate_markup_terms_of_service'],
    ];
}

/* ================================================================== */
/*  Admin page renderer                                                */
/* ================================================================== */

/** Render the Migrate to Blocks admin page. */
function my_theme_migrate_render_page(): void
{
    if (!current_user_can('manage_options')) {
        return;
    }

    $notice = get_transient('goliath_migrate_notice');
    delete_transient('goliath_migrate_notice');

    $generators = my_theme_migrate_generators();

    // Check which pages have already been migrated (have block content).
    $migrated = [];
    foreach ($generators as $key => $def) {
        $page = get_page_by_path($def['slug'], OBJECT, 'page');
        if ($page && has_blocks($page->post_content)) {
            $migrated[$key] = true;
        }
    }

    // Case study CPT status.
    $cpt_count = (int) wp_count_posts('case-study')->publish;
    $lib_count = function_exists('my_theme_get_case_study_library') ? count(my_theme_get_case_study_library()) : 0;
    ?>
    <div class="wrap">
        <h1>Migrate to Blocks</h1>
        <p>
            This tool reads each page's content from the Goliath Content admin options and writes it into the
            Gutenberg block editor as editable blocks. Migration is <strong>one-directional and irreversible</strong>
            — after migration you edit pages using the block editor, not the Goliath Content admin panels.
        </p>
        <p><strong>Recommendation:</strong> Migrate one page at a time and verify the result in the editor before continuing.</p>

        <?php if ($notice) : ?>
            <div class="notice notice-<?php echo esc_attr($notice['type']); ?> is-dismissible">
                <p><?php echo esc_html($notice['msg']); ?></p>
            </div>
        <?php endif; ?>

        <!-- Case Studies CPT migration -->
        <h2 style="margin-top:2em;">Case Studies (Custom Post Type)</h2>
        <p>
            Migrates all case studies from the wp_options library to individual CPT posts editable in Gutenberg.<br>
            <?php if ($cpt_count > 0) : ?>
                <strong style="color:#2271b1;"><?php echo esc_html($cpt_count); ?> CPT post(s) already exist.</strong>
                <?php if ($cpt_count >= $lib_count) : ?>
                    All case studies have been migrated.
                <?php else : ?>
                    <?php echo esc_html($lib_count - $cpt_count); ?> remaining.
                <?php endif; ?>
            <?php else : ?>
                <strong><?php echo esc_html($lib_count); ?> case study/studies in the library ready to migrate.</strong>
            <?php endif; ?>
        </p>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <?php wp_nonce_field('goliath_migrate'); ?>
            <input type="hidden" name="action" value="goliath_migrate_page">
            <input type="hidden" name="page_key" value="case-studies-cpt">
            <button type="submit" class="button button-primary"
                <?php echo ($cpt_count >= $lib_count && $lib_count > 0) ? 'disabled' : ''; ?>>
                Migrate Case Studies to CPT
            </button>
        </form>

        <!-- Page migrations -->
        <h2 style="margin-top:2em;">Pages</h2>
        <p>Each row below is one WordPress page. Click <em>Migrate</em> to generate block markup from the current
        Goliath Content options and save it as the page content.</p>

        <table class="widefat fixed striped" style="max-width:900px;">
            <thead>
                <tr>
                    <th style="width:200px;">Page</th>
                    <th>Slug</th>
                    <th style="width:120px;">Status</th>
                    <th style="width:160px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($generators as $key => $def) : ?>
                    <?php $done = isset($migrated[$key]); ?>
                    <tr>
                        <td><strong><?php echo esc_html($def['label']); ?></strong></td>
                        <td><code>/<?php echo esc_html($def['slug']); ?>/</code></td>
                        <td>
                            <?php if ($done) : ?>
                                <span style="color:#00a32a;">&#x2713; Migrated</span>
                            <?php else : ?>
                                <span style="color:#72777c;">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="display:inline;">
                                <?php wp_nonce_field('goliath_migrate'); ?>
                                <input type="hidden" name="action" value="goliath_migrate_page">
                                <input type="hidden" name="page_key" value="<?php echo esc_attr($key); ?>">
                                <button type="submit" class="button <?php echo $done ? 'button-secondary' : 'button-primary'; ?>">
                                    <?php echo $done ? 'Re-migrate' : 'Migrate'; ?>
                                </button>
                            </form>
                            <?php
                            $page_obj = get_page_by_path($def['slug'], OBJECT, 'page');
                            if ($page_obj && $done) :
                            ?>
                                <a href="<?php echo esc_url(get_edit_post_link($page_obj->ID)); ?>" class="button" target="_blank" style="margin-left:4px;">
                                    Edit in Gutenberg
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 style="margin-top:2em;">What happens after migration</h2>
        <ul style="list-style:disc;margin-left:2em;">
            <li>The page's <code>post_content</code> is populated with Gutenberg block markup.</li>
            <li>The block editor will show all sections as real, editable blocks.</li>
            <li>The front-end switches to rendering <code>the_content()</code> (blocks) instead of the legacy PHP template.</li>
            <li>The Goliath Content admin panel entry for that page is no longer needed (but still works as a reference).</li>
        </ul>
    </div>
    <?php
}
