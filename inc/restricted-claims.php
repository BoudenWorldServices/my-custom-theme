<?php
/**
 * Strip SEMA, HSE-approval, EN “meets” claims, and inspection advertising.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * True when a URL points at the annual inspections service.
 */
function my_theme_is_inspections_url(string $url): bool
{
    return (bool) preg_match('#(?:^|/)services/annual-inspections/?$#i', strtok($url, '?'));
}

/**
 * Drop inspection links from header/footer repeater arrays.
 *
 * @param list<mixed> $links
 * @return list<mixed>
 */
function my_theme_filter_out_inspection_links(array $links): array
{
    $filtered = [];
    foreach ($links as $link) {
        if (is_array($link)) {
            $url   = (string) ($link['url'] ?? '');
            $label = (string) ($link['label'] ?? '');
            if (my_theme_is_inspections_url($url) || stripos($label, 'Annual Inspection') !== false) {
                continue;
            }
            $filtered[] = $link;
            continue;
        }
        if (is_string($link) && my_theme_is_inspections_url($link)) {
            continue;
        }
        $filtered[] = $link;
    }

    return $filtered;
}

/**
 * Replace restricted marketing claims in a string.
 */
function my_theme_sanitize_restricted_claims_string(string $text): string
{
    if ($text === '') {
        return $text;
    }

    $replacements = [
        'SEMA Approved Racking Inspector' => 'Experienced racking specialist',
        'SEMA-approved racking inspector qualifications' => 'extensive warehouse racking experience',
        'SEMA-approved racking inspector' => 'experienced racking specialist',
        'SEMA-approved' => 'independently verified',
        'SEMA Approved' => 'Bureau Veritas certified',
        'SEMA-qualified inspectors' => 'experts',
        'SEMA-qualified engineers' => 'experts',
        'SEMA-qualified technicians' => 'experts',
        'SEMA-qualified team' => 'experts',
        'SEMA-qualified inspector' => 'expert',
        'SEMA-qualified' => 'experienced',
        'Our SEMA qualified inspectors' => 'Our experts',
        'SEMA qualified inspectors' => 'experts',
        'SEMA qualified' => 'experienced',
        'Our experienced engineers' => 'Our experts',
        'experienced engineers' => 'experts',
        'experienced engineer' => 'expert',
        'Experienced engineers' => 'Experts',
        '"expertFeature1Title":"Qualified"' => '"expertFeature1Title":"Experienced"',
        '"expertFeature1Sub":"inspectors"' => '"expertFeature1Sub":"experts"',
        'Are your engineers SEMA qualified?' => 'Are your experts experienced?',
        'Are your engineers experienced?' => 'Are your experts experienced?',
        'All of our engineers hold SEMA qualifications' => 'Our experts are experienced racking specialists',
        'Our engineers are experienced racking specialists' => 'Our experts are experienced racking specialists',
        'Every member of our team holds SEMA qualifications' => 'Our team are experienced racking specialists',
        'SEMA qualifications' => 'professional qualifications',
        'SEMA-aligned' => 'engineered',
        'SEMA aligned' => 'engineered',
        'including SEMA racking inspection guidelines' => '',
        'An annual SEMA racking inspection is crucial' => 'Regular warehouse safety checks are important',
        'A SEMA racking inspection or internal audit' => 'An internal audit',
        'Support SEMA Racking Inspection and Compliance' => 'Support Warehouse Safety and Damage Prevention',
        'SEMA racking inspection standards' => 'warehouse racking safety',
        'SEMA racking inspection' => 'warehouse racking safety checks',
        'SEMA Design Codes' => 'independent testing',
        'SEMA design codes' => 'independent testing',
        'SEMA Codes of Practice' => 'independent testing',
        'SEMA codes of practice adherence' => 'Fully insured, with a lifetime warranty',
        'SEMA codes of practice' => 'independent verification',
        'SEMA code of practice' => 'independent verification',
        'SEMA Code of Practice' => 'independent verification',
        'SEMA guidelines' => 'independent testing',
        'SEMA Guidelines' => 'independent testing',
        'meets SEMA Design Codes' => 'is independently tested',
        'meets SEMA design codes' => 'is independently tested',
        'meets SEMA Guidelines' => 'is independently tested',
        'meets SEMA guidelines' => 'is independently tested',
        'meets SEMA Codes of Practice' => 'is independently tested',
        'meets SEMA codes of practice' => 'is independently tested',
        'meets EN Design Codes' => 'is independently tested',
        'meets EN design codes' => 'is independently tested',
        'meets EN Guidelines' => 'is independently tested',
        'meets EN guidelines' => 'is independently tested',
        'meets EN Codes of Practice' => 'is independently tested',
        'meets EN codes of practice' => 'is independently tested',
        'EN Design Codes' => 'independent testing',
        'EN design codes' => 'independent testing',
        'EN Guidelines' => 'independent testing',
        'EN guidelines' => 'independent testing',
        'EN Codes of Practice' => 'independent testing',
        'EN codes of practice' => 'independent testing',
        'SEMA best practice' => 'industry best practice',
        'HSE, EN and SEMA' => 'independent testing',
        'HSE, EN & SEMA' => 'independent testing',
        'HSE approved and certified' => 'Independently tested and verified by Bureau Veritas',
        'HSE approved' => 'independently verified',
        'HSE certified' => 'independently verified',
        'SARI Rules & Regulations' => 'warehouse safety requirements',
        'SARI rules' => 'warehouse safety requirements',
        'Full SEMA compliance documentation' => 'Full installation documentation',
        'Built to Align with HSE, EN and SEMA Guidelines' => 'Independently Tested and Verified',
        'BS EN 15512:2020 + A1:2022 compliant' => 'Independently tested and verified by Bureau Veritas',
        'BS EN 15635:2008 certified' => 'Certified not to alter the original racking bay design',
        'meets the SEMA Code of Practice for the Design of Adjustable Pallet Racking' => 'is certified not to alter the original racking bay design',
        'and Industry Codes of Practice' => '',
        ' | Industry Codes of Practice' => '',
        'Accreditation: BS EN 15512:2020 + A1:2022 | BS EN 15635:2008' => 'Independently tested and verified by Bureau Veritas',
        'independently accredited to BS EN 15512:2020 + A1:2022, BS EN 15635:2008,' => 'independently tested and verified by Bureau Veritas,',
        'Independently accredited to BS EN 15512:2020 + A1:2022, BS EN 15635:2008,' => 'Independently tested and verified by Bureau Veritas.',
        'and guided by UK safety standards including BS EN 15512 and BS EN 15635, ' => ', ',
        'including BS EN 15512 and BS EN 15635' => '',
        'BS EN 15512 and BS EN 15635' => 'independent testing',
        'should be qualified to inspect it first, ensuring every repair meets the highest safety standards.' => 'should understand how it is used, so every repair is carried out to a high safety standard.',
        'qualified to inspect it first, ensuring every repair meets the highest safety standards.' => 'understand how it is used, so every repair is carried out to a high safety standard.',
        'should be understand' => 'should understand',
        'experts and engineers delivering' => 'Experts delivering',
        'Experts and engineers delivering' => 'Experts delivering',
        'Storage Equipment Manufacturers\' Association (SEMA)' => 'independent testing bodies',
        'Storage Equipment Manufacturers’ Association (SEMA)' => 'independent testing bodies',
        'Add your LinkedIn page, Companies House listing, SEMA directory page,' => 'Add your LinkedIn page, Companies House listing,',
        '/services/annual-inspections/' => '/services/racking-upright-repair/',
        'during inspections' => 'during routine warehouse checks',
        'inspection requirements' => 'warehouse safety requirements',
        'inspection cycles' => 'regular maintenance cycles',
        'compliance inspection' => 'warehouse safety checks',
    ];

    $updated = str_replace(array_keys($replacements), array_values($replacements), $text);

    $updated = preg_replace('/\bSEMA\b/i', '', $updated) ?? $updated;
    $updated = preg_replace('/\bSARI\b/i', '', $updated) ?? $updated;
    $updated = preg_replace('/[ \t]{2,}/', ' ', $updated) ?? $updated;
    $updated = preg_replace('/ +\./', '.', $updated) ?? $updated;
    $updated = preg_replace('/ +,/', ',', $updated) ?? $updated;

    return $updated;
}

/**
 * True when a standards card is a leftover “independent verification” duplicate.
 */
function my_theme_is_dropped_verification_card(string $title): bool
{
    $normalised = strtolower(trim($title));

    return $normalised === 'independent verification'
        || $normalised === 'independently verified';
}

/**
 * Drop empty or duplicate verification cards from a standards grid.
 *
 * @param list<array{title?: string, body?: string, desc?: string}> $cards
 * @return list<array{title?: string, body?: string, desc?: string}>
 */
function my_theme_filter_standards_cards(array $cards): array
{
    $filtered = [];
    foreach ($cards as $card) {
        if (! is_array($card)) {
            continue;
        }
        $title = trim((string) ($card['title'] ?? ''));
        $body  = trim((string) ($card['body'] ?? $card['desc'] ?? ''));
        if ($title === '' && $body === '') {
            continue;
        }
        if (my_theme_is_dropped_verification_card($title)) {
            continue;
        }
        $filtered[] = $card;
    }

    return array_values($filtered);
}

/**
 * Grid classes so remaining standards cards stretch across the row.
 */
function my_theme_standards_cards_grid_class(int $count): string
{
    if ($count <= 1) {
        return 'grid grid-cols-1 gap-4 lg:gap-5';
    }
    if ($count === 2) {
        return 'grid grid-cols-1 gap-4 sm:grid-cols-2 lg:gap-5';
    }
    if ($count === 3) {
        return 'grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 lg:gap-5';
    }

    return 'grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5';
}

/**
 * Recursively sanitise strings in nested arrays/objects.
 *
 * @param mixed $value
 * @return mixed
 */
function my_theme_sanitize_restricted_claims($value)
{
    if (is_string($value)) {
        return my_theme_sanitize_restricted_claims_string($value);
    }
    if (is_array($value)) {
        foreach ($value as $key => $item) {
            $value[$key] = my_theme_sanitize_restricted_claims($item);
        }
    }

    return $value;
}

/**
 * Remove inspection advertising blocks from Gutenberg markup.
 */
function my_theme_strip_inspection_blocks_from_content(string $content): string
{
    $patterns = [
        '/<!-- wp:goliath\/comp-audit\b.*?-->.*?<!-- \/wp:goliath\/comp-audit -->/s',
        '/<!-- wp:goliath\/comp-audit\b.*?\/-->/s',
        '/<!-- wp:goliath\/svc-split-panel\b[^>]*(?:SEMA|Racking Inspection and Compliance).*?\/-->/s',
        '/<!-- wp:goliath\/svc-split-panel\b[^>]*(?:SEMA|Racking Inspection and Compliance).*?-->.*?<!-- \/wp:goliath\/svc-split-panel -->/s',
    ];
    foreach ($patterns as $pattern) {
        $content = preg_replace($pattern, '', $content) ?? $content;
    }

    return $content;
}

/**
 * One-time rewrite of stored options and post content.
 */
function my_theme_apply_restricted_copy_scrub(): void
{
    if (get_option('my_theme_restricted_claims_scrub') === '1.4') {
        return;
    }

    global $wpdb;
    $option_names = $wpdb->get_col(
        "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE 'my_theme_%'"
    );
    if (is_array($option_names)) {
        foreach ($option_names as $name) {
            if ($name === 'my_theme_restricted_claims_scrub') {
                continue;
            }
            $current = get_option($name);
            $updated = my_theme_sanitize_restricted_claims($current);
            if ($name === 'my_theme_footer_service_links' && is_array($updated)) {
                $updated = my_theme_filter_out_inspection_links($updated);
            }
            if ($updated !== $current) {
                update_option($name, $updated);
            }
        }
    }

    $explicit = [
        'my_theme_hp_expert_headline' => 'Our experts will assess your warehouse and demonstrate how Goliath can help you',
        'my_theme_comp_std_h2' => 'Independently Tested and Verified',
        'my_theme_comp_std_p1' => 'Goliath™ has been independently tested and verified by Bureau Veritas. It is certified not to alter the original racking bay design.',
        'my_theme_comp_std_p2' => 'Every installation is fully insured and backed by a warranty that lasts a lifetime.',
        'my_theme_comp_std_card1_title' => 'Bureau Veritas certified',
        'my_theme_comp_std_card1_body' => 'Independently tested and verified by Bureau Veritas.',
        'my_theme_comp_std_card2_title' => 'Original bay design protected',
        'my_theme_comp_std_card2_body' => 'Certified not to alter the original racking bay design.',
        'my_theme_comp_std_card3_title' => 'Fully insured',
        'my_theme_comp_std_card3_body' => 'Installations are fully insured for warehouse operations.',
        'my_theme_comp_std_card4_title' => 'Lifetime warranty',
        'my_theme_comp_std_card4_body' => 'Every repair is backed by a warranty that lasts a lifetime.',
        'my_theme_comp_hero_desc' => 'Warehouse racking safety depends on strong structural integrity and reliable long-term performance. Goliath™ supports both by reinforcing damaged uprights with a permanent repair.',
        'my_theme_hiw_standards_h2' => 'Independently Tested and Verified',
        'my_theme_hiw_standards_intro1' => 'Goliath™ is independently tested and verified by Bureau Veritas. It is certified not to alter the original racking bay design.',
        'my_theme_hiw_standards_intro2' => 'What that means for your warehouse:',
        'my_theme_hiw_standards_card1_title' => 'Bureau Veritas certified',
        'my_theme_hiw_standards_card1_body' => 'Independently tested and verified by Bureau Veritas.',
        'my_theme_hiw_standards_card2_title' => 'Original bay design protected',
        'my_theme_hiw_standards_card2_body' => 'Certified not to alter the original racking bay design.',
        'my_theme_hiw_standards_card3_title' => 'Fully insured',
        'my_theme_hiw_standards_card3_body' => 'Installations are fully insured for warehouse operations.',
        'my_theme_hiw_standards_card4_title' => 'Lifetime warranty',
        'my_theme_hiw_standards_card4_body' => 'Every repair is backed by a warranty that lasts a lifetime.',
        'my_theme_hiw_standards_closing' => 'Every Goliath™ installation is fully insured and backed by a lifetime warranty, giving operators long-term confidence in the repair.',
        'my_theme_svc_reg_desc' => 'GOLIATH™ is independently tested and verified by Bureau Veritas and certified not to alter the original racking bay design. Work is fully insured and backed by a lifetime warranty.',
        'my_theme_svc_reg_item1' => 'Independently tested and verified by Bureau Veritas',
        'my_theme_svc_reg_item2' => 'Certified not to alter the original racking bay design',
        'my_theme_svc_reg_item3' => 'Fully insured',
        'my_theme_svc_reg_item4' => 'Lifetime warranty on every repair',
        'my_theme_comp_reg_box_h3' => 'Independently verified',
        'my_theme_comp_reg_box_p' => 'Every GOLIATH™ installation is independently tested and verified by Bureau Veritas. Work is fully insured and backed by a lifetime warranty.',
        'my_theme_comp_reg_p2' => 'Goliath™ supports warehouse safety by reinforcing the part of the upright most susceptible to impact. The system is independently tested and verified by Bureau Veritas and certified not to alter the original racking bay design.',
        'my_theme_comp_concerns_h2' => 'Addressing Common Warehouse Concerns',
        'my_theme_comp_concerns_intro' => 'A common concern is whether installing a non-manufacturer product could affect warranties or long-term structural performance.',
        'my_theme_comp_concern3_p' => 'Goliath™ also challenges the replace-and-repeat model by preventing recurring upright damage. This changes the maintenance cycle while maintaining a robust and reliable structure.',
        'my_theme_comp_only_right_h3' => 'From a Warehouse Safety Perspective',
        'my_theme_comp_only_right_p1' => 'Continuous damage causes structural weaknesses over time. A system that prevents that damage, like Goliath™, provides a more stable and consistent outcome.',
        'my_theme_comp_proven_p2' => 'Once installed, it provides continuous protection in the same location without the need to change your uprights regularly. This reduces the frequency of repairs and keeps your uprights in good condition over the long term.',
        'my_theme_comp_doc_subtitle' => 'Goliath™ provides access to clear technical and installation documentation for operators and procurement teams.',
        'my_theme_comp_doc_closing' => 'Downloadable PDFs are available to support internal reviews, safety records, and procurement decisions. Our resources make it easier to document due diligence and explain clearly how Goliath™ protects upright structures.',
        'my_theme_prevention_cta_btn2' => 'View Compliance Info',
        'my_theme_svc_prevention_cta_btn2' => 'View Compliance Info',
        'my_theme_about_leader_qualifications' => 'Experienced racking specialist',
        'my_theme_about_team_subtitle' => 'Experts delivering safe, permanent racking repairs across the UK.',
        'my_theme_about_cta_desc' => 'Our experts are ready to assess your warehouse racking and provide a permanent repair solution backed by a lifetime warranty.',
        'my_theme_about_hero_desc' => 'The team behind the UK\'s only permanent pallet racking upright repair system. Dedicated to ending the cycle of costly racking replacement.',
        'my_theme_about_story_p2' => 'Working closely with structural engineers, we created a repair solution that does not just restore uprights to their original strength but reinforces them against future impact. Goliath™ is independently tested and verified by Bureau Veritas and certified not to alter the original racking bay design.',
        'my_theme_about_story_p3' => 'Our installation team brings extensive warehouse racking experience to every job. We believe the people who repair your racking should understand how it is used, so every repair is carried out to a high safety standard.',
        'my_theme_cp_hero_desc' => 'Request a free warehouse racking assessment from our experienced team. We respond within one working day and provide transparent, no-obligation pricing.',
    ];
    foreach ($explicit as $key => $value) {
        update_option($key, $value);
    }

    $posts = get_posts([
        'post_type'      => 'any',
        'post_status'    => 'any',
        'posts_per_page' => -1,
        'fields'         => '',
    ]);
    foreach ($posts as $post) {
        $content = my_theme_strip_inspection_blocks_from_content((string) $post->post_content);
        $content = my_theme_sanitize_restricted_claims_string($content);
        $title   = my_theme_sanitize_restricted_claims_string((string) $post->post_title);
        $excerpt = my_theme_sanitize_restricted_claims_string((string) $post->post_excerpt);
        if ($content !== $post->post_content || $title !== $post->post_title || $excerpt !== $post->post_excerpt) {
            wp_update_post([
                'ID'           => $post->ID,
                'post_content' => $content,
                'post_title'   => $title,
                'post_excerpt' => $excerpt,
            ]);
        }
    }

    $inspections = get_page_by_path('services/annual-inspections');
    if ($inspections instanceof WP_Post && $inspections->post_status !== 'trash') {
        wp_update_post([
            'ID'          => $inspections->ID,
            'post_status' => 'draft',
        ]);
    }

    update_option('my_theme_restricted_claims_scrub', '1.4');
}
add_action('init', 'my_theme_apply_restricted_copy_scrub', 20);

/**
 * Rewrite restricted claims in saved Gutenberg block attributes.
 *
 * @param array<string, mixed> $parsed_block
 * @return array<string, mixed>
 */
function my_theme_sanitize_parsed_block(array $parsed_block): array
{
    if (isset($parsed_block['attrs']) && is_array($parsed_block['attrs'])) {
        $parsed_block['attrs'] = my_theme_sanitize_restricted_claims($parsed_block['attrs']);
        $name = (string) ($parsed_block['blockName'] ?? '');
        if (in_array($name, ['goliath/comp-standards', 'goliath/hiw-uk-standards'], true)) {
            foreach (['3', '4'] as $n) {
                $title_key = 'card' . $n . 'Title';
                $title     = (string) ($parsed_block['attrs'][$title_key] ?? '');
                if (my_theme_is_dropped_verification_card($title)) {
                    $parsed_block['attrs'][$title_key] = '';
                    $parsed_block['attrs']['card' . $n . 'Body'] = '';
                }
            }
        }
    }

    return $parsed_block;
}
add_filter('render_block_data', 'my_theme_sanitize_parsed_block');

/**
 * Safety net for leftover restricted claims in post bodies.
 */
function my_theme_sanitize_the_content(string $content): string
{
    $content = my_theme_strip_inspection_blocks_from_content($content);

    return my_theme_sanitize_restricted_claims_string($content);
}
add_filter('the_content', 'my_theme_sanitize_the_content', 12);

/**
 * Redirect the unpublished inspections service.
 */
function my_theme_redirect_annual_inspections(): void
{
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }

    $path = function_exists('my_theme_get_static_route_path') ? my_theme_get_static_route_path() : '';
    if ($path === 'services/annual-inspections') {
        wp_safe_redirect(home_url('/services/racking-upright-repair/'), 301);
        exit;
    }
}
add_action('template_redirect', 'my_theme_redirect_annual_inspections', 0);
