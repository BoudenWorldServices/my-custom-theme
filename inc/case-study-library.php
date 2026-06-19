<?php
/**
 * Case study catalogue for the case studies hub and detail routes.
 *
 * Reads from wp_options (Goliath Content Editor) with hardcoded defaults
 * that mirror all existing B&M content.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * All published case studies.
 *
 * Array is keyed by slug. Each entry contains all fields needed for both
 * the listing card (page-case-studies.php) and the detail page
 * (page-case-study-detail.php).
 *
 * @return array<string, array{
 *   client: string, title: string, image: string,
 *   challenge: string, solution: string,
 *   metric1_value: string, metric1_label: string,
 *   metric2_value: string, metric2_label: string,
 *   metric3_value: string, metric3_label: string,
 *   hero_intro: string, problem_text: string, problem_callout: string,
 *   tried_text: string, tried_callout: string,
 *   video: string, solution_text: string, solution_callout: string,
 *   results_image: string, results_intro: string,
 *   result1_title: string, result1_text: string,
 *   result2_title: string, result2_text: string,
 *   result3_title: string, result3_text: string,
 *   result4_title: string, result4_text: string,
 *   warranty_text: string, testimonial_quote: string, testimonial_attr: string,
 *   seo_title: string, seo_desc: string
 * }>
 */
function my_theme_get_case_study_library(): array
{
    $saved = get_option('my_theme_case_study_library');
    if (is_array($saved) && ! empty($saved)) {
        return $saved;
    }

    return [
        'bm-racking-damage' => [
            'client'          => 'B&M',
            'title'           => 'How B&M Eliminated Pallet Racking Damage with Goliath™',
            'image'           => get_theme_file_uri('assets/images/caseStudy/B&M.webp'),
            'challenge'       => 'B&M operates over 700 stores and has the distribution infrastructure to match. This company has also invested heavily in forklift driver training and traffic management.',
            'solution'        => 'Rollout of preventative Goliath installation across all sites with ongoing repair programme',
            'metric1_value'   => '30%',
            'metric1_label'   => 'Repair Budget Reduction',
            'metric2_value'   => '200+',
            'metric2_label'   => 'Units Installed',
            'metric3_value'   => 'Zero',
            'metric3_label'   => 'Downtime Events',
            'hero_intro'      => 'The UK warehousing industry loses up to £1.5 billion every year. This is due to racking damage and collapse incidents. For high-volume retailers like B&M, damaged pallet racking uprights are a costly maintenance headache that have become a direct threat to warehouse staff safety, availability of stock, and the ability to operate without disturbance.',
            'problem_text'    => "B&M operates over 700 stores and has the distribution infrastructure to match. This company has also invested heavily in forklift driver training and traffic management.\n\nStill, their warehouses kept experiencing recurring damage to their pallet racking uprights from continuous vehicle impacts, making it a safety hazard for warehouse staff, causing operational downtime, and increasing repair costs exponentially.",
            'problem_callout' => 'Every solution available was reactive. Fix it today and impact damages it again tomorrow.',
            'tried_text'      => "B&M tried many of the most common racking protection products on the market. They tried clip-on, floor-mounted, tie-on, and bolt-on column guards. None of these options successfully prevented severe impact damage.\n\nMany of them simply covered the impact, making inspections less reliable and creating hidden compliance risks.\n\nFloor-mounted guards were also a problem that caused secondary damage when these guards were peeled off by repeated impacts.",
            'tried_callout'   => "Standard racking protection products on the market weren't fit for the purpose.",
            'video'           => 'goliath-demo.mp4',
            'solution_text'   => "Goliath™, our patented upright repair kit was created to not just fix damaged racking. It prevents future damage from occurring at all.\n\nThis permanent racking upright repair is designed to fit all standard pallet racking systems and can be installed quickly by in-house teams. What makes installing Goliath™ more appealing is that there is no loss of pallet locations and no operational downtime.",
            'solution_callout' => "What Goliath™ provides is not just a repair.\nIt's a permanent structural reinforcement that breaks\nthe damage-and-replace cycle for good.",
            'results_image'   => get_theme_file_uri('assets/images/caseStudy/case-study1/B&Mcase.webp'),
            'results_intro'   => 'At B&M, the impact was immediate. Zero upright damage was recorded in every location where Goliath™ was fitted. This was recorded over a 12-month period following installation.',
            'result1_title'   => 'Lower Maintenance Costs',
            'result1_text'    => 'No further spend in areas where Goliath™ was fitted',
            'result2_title'   => 'Cheaper & Faster',
            'result2_text'    => 'Than fully replacing uprights',
            'result3_title'   => 'No Disruption',
            'result3_text'    => 'To stock management or daily operational logistics',
            'result4_title'   => 'Reduced Carbon Footprint',
            'result4_text'    => 'Through fewer steel upright replacements',
            'warranty_text'   => "After the initial installation, B&M installed over 250 Goliath™ kits across one of their distribution centres and committed to using Goliath™ as their standard solution for all future racking repairs.\n\nEvery one of our kits comes with a Lifetime Warranty against any manufacturing defects.",
            'testimonial_quote' => '"Goliath™ Upright Repair Kit has been a game changer for us. We\'ve had zero impact damage in the locations that Goliath™ has been fitted since installation took place over 12 months ago."',
            'testimonial_attr'  => 'Kenny Hudson, National Facilities & Maintenance Manager, B&M Retailers',
            'seo_title'         => '',
            'seo_desc'          => '',
        ],
    ];
}

/**
 * Resolve a case study image value to a displayable URL.
 *
 * Supports WP media library attachment IDs, full URLs, and theme-relative paths.
 *
 * @param string $value   Stored image value (ID, URL, or theme path).
 * @param string $default Fallback URL if value is empty or unresolvable.
 * @param string $size    WP image size for attachment IDs.
 */
function my_theme_resolve_case_study_image(string $value, string $default = '', string $size = 'full'): string
{
    if ($value === '') {
        return $default;
    }

    if (is_numeric($value) && (int) $value > 0) {
        $url = wp_get_attachment_image_url((int) $value, $size);
        return $url ? $url : $default;
    }

    return $value;
}

/**
 * Resolve a case study video value to a displayable URL.
 *
 * Supports full URLs and theme-relative filenames (stored without path prefix).
 *
 * @param string $value Stored video value (URL or filename like goliath-demo.mp4).
 */
function my_theme_resolve_case_study_video(string $value): string
{
    if ($value === '') {
        return '';
    }

    if (
        str_starts_with($value, 'http://') ||
        str_starts_with($value, 'https://') ||
        str_starts_with($value, '/')
    ) {
        return $value;
    }

    return get_theme_file_uri('assets/videos/' . ltrim($value, '/'));
}

/**
 * Check whether a case study video file exists and is readable.
 *
 * @param string $value Stored video value (URL or filename).
 */
function my_theme_case_study_video_is_readable(string $value): bool
{
    if ($value === '') {
        return false;
    }

    if (
        str_starts_with($value, 'http://') ||
        str_starts_with($value, 'https://') ||
        str_starts_with($value, '/')
    ) {
        return true;
    }

    $path = get_theme_file_path('assets/videos/' . ltrim($value, '/'));
    return $path !== '' && is_readable($path);
}

/**
 * Get a single case study entry by slug.
 *
 * @param string $slug URL slug.
 * @return array<string, string>|null
 */
function my_theme_get_case_study(string $slug): ?array
{
    $library = my_theme_get_case_study_library();
    return $library[$slug] ?? null;
}

/**
 * Get all case study slugs in library order.
 *
 * @return list<string>
 */
function my_theme_get_case_study_slugs(): array
{
    return array_keys(my_theme_get_case_study_library());
}
