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
 * Hardcoded case study definitions, used as defaults and for CPT provisioning.
 *
 * Optional key `content_sections` (array of arrays with keys heading, body, callout)
 * adds extra narrative cs-content-section blocks after the solution section when
 * the case study is rendered as a CPT post.
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
 *   seo_title: string, seo_desc: string,
 *   content_sections?: list<array{heading: string, body: string, callout: string}>
 * }>
 */
function my_theme_get_case_study_defaults(): array
{
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

        'gxo-lowestoft-xhd-redirack' => [
            'client'          => 'GXO Lowestoft',
            'title'           => 'UK Record-Breaking Pallet Racking Repair',
            'image'           => get_theme_file_uri('assets/images/case-study-1.jpg'),
            'challenge'       => 'A GXO logistics distribution centre operating Redirack XHD pallet racking faced a critical maintenance problem: like-for-like replacement parts were scarce in the UK market, lead times ran to weeks or months, and 597 damaged uprights were condemning usable storage capacity.',
            'solution'        => 'First large-scale deployment of the XL Goliath™ 125 — 597 units engineered for extra-heavy-duty XHD Redirack uprights, installed in under 30 minutes each with no OEM parts required.',
            'metric1_value'   => '597',
            'metric1_label'   => 'Goliath™ Units Installed',
            'metric2_value'   => 'XHD',
            'metric2_label'   => 'Racking Classification',
            'metric3_value'   => 'XL 125',
            'metric3_label'   => 'Goliath™ Product',
            'metric4_value'   => '#1',
            'metric4_label'   => "UK's Largest Installation",
            'hero_intro'      => 'When a major logistics distribution centre in Lowestoft needed a long-term solution for damaged XHD pallet racking uprights — and OEM replacement parts proved scarce, expensive to import, and subject to extended lead times — the answer was clear: Goliath™. This installation represents the single largest deployment of the Goliath™ Upright Racking Repair Kit completed to date in the UK and EU — 597 units of the newly launched XL Goliath™ 125, engineered specifically for extra-heavy-duty (XHD) racking systems.',
            'problem_text'    => "Redirack is a robust and well-regarded heavy-duty pallet racking system, built to handle demanding warehouse environments. However, like many legacy racking systems still in active use across UK warehouses, sourcing like-for-like compatible replacement uprights presents a significant operational problem.\n\nReplacement parts are scarce in the UK market. Extended lead times mean damaged uprights stay out of service for weeks or months. Downtime directly impacts throughput, storage capacity, and operational efficiency.\n\nFor a high-volume logistics distribution centre processing large quantities of goods daily, even a handful of condemned uprights represents a measurable loss of capacity. Across 597 damaged uprights, the scale of disruption — and the cost of conventional replacement — would have been substantial.",
            'problem_callout' => 'Replacing individual uprights within a legacy XHD racking system isn\'t simply a matter of ordering parts. The procurement lead times, import costs, and operational downtime can dwarf the cost of the steel itself. There had to be a better way.',
            'tried_text'      => '',
            'tried_callout'   => '',
            'video'           => '',
            'solution_text'   => "Goliath™ was already established as the UK and EU's first independently accredited pallet racking upright repair kit — but this project called for something even more capable. The XL Goliath™ 125 is a larger-format variant of the Goliath™ system, designed specifically for extra-heavy-duty (XHD) uprights where standard repair solutions simply aren't sufficient.\n\nEngineered to exceed the load-carrying capacity of the original XHD uprights, the XL Goliath™ 125 is manufactured from structural 6mm steel and is fully compatible with Redirack XHD profiles — no modification to the existing racking structure required.\n\nCritically, choosing XL Goliath™ 125 completely removed the dependency on OEM Redirack spare parts. No import delays. No extended procurement lead times. No repeated expenditure on like-for-like replacements. One installation, one lifetime warranty, zero ongoing replacement cost.",
            'solution_callout' => "Independently accredited to BS EN 15512:2020 + A1:2022, BS EN 15635:2008, and Industry Codes of Practice. If it is damaged in normal use, it is repaired or replaced at no charge.",
            'results_image'   => get_theme_file_uri('assets/images/case-study-2.jpg'),
            'results_intro'   => 'This project marks the first large-scale deployment of the XL Goliath™ 125 in the UK. With 597 units installed across a single site, it is the biggest Goliath™ installation ever completed. All repaired uprights are independently certified, structurally superior to the damaged components they replace, and protected under a lifetime warranty.',
            'result1_title'   => '£0 Ongoing Replacement Cost',
            'result1_text'    => 'No further expenditure on OEM Redirack spare parts',
            'result2_title'   => 'Under 30 Minutes Per Upright',
            'result2_text'    => 'No specialist equipment or hot works required',
            'result3_title'   => 'Lifetime Impact Warranty',
            'result3_text'    => 'Every repaired upright covered in perpetuity',
            'result4_title'   => '100% OEM Dependency Removed',
            'result4_text'    => 'No import delays, no procurement lead times',
            'warranty_text'   => "Every XL Goliath™ 125 unit is independently certified, structurally superior to the damaged component it replaces, and covered under a Lifetime Impact Warranty — if damaged in normal use, it is repaired or replaced at no charge.",
            'testimonial_quote' => '',
            'testimonial_attr'  => '',
            'seo_title'         => 'GXO Lowestoft XHD Racking Repair | 597 XL Goliath™ 125 Units | Goliath',
            'seo_desc'          => "How Goliath™ completed the UK's largest single racking repair installation — 597 XL Goliath™ 125 units on Redirack XHD uprights at a GXO distribution centre in Lowestoft.",
            'content_sections'  => [
                [
                    'heading' => 'A Landmark Installation',
                    'body'    => "This project marks the first large-scale deployment of the XL Goliath™ 125 in the UK, and with 597 units installed across a single site, it is the biggest Goliath™ installation ever completed. The project was completed using a phased approach that minimised disruption to live warehouse operations.\n\nFor any warehouse operating Redirack XHD, or any other heavy-duty racking system where OEM spare parts are becoming scarce, the XL Goliath™ 125 offers a proven, accredited, and permanent alternative.",
                    'callout' => '',
                ],
                [
                    'heading' => 'Key Technical Specification — XL Goliath™ 125',
                    'body'    => "System compatibility: XHD Redirack and compatible XHD profiles\nMaterial: 6mm structural steel\nAccreditation: BS EN 15512:2020 + A1:2022 | BS EN 15635:2008 | Industry Codes of Practice\nInstallation time: Under 30 minutes per upright\nWarranty: Lifetime Impact Warranty\nLead time: Available from stock",
                    'callout' => '',
                ],
            ],
        ],

        'gxo-thrapston-primark-pss' => [
            'client'          => 'GXO Thrapston (Primark)',
            'title'           => 'Extending the Life of an Obsolete Racking System',
            'image'           => get_theme_file_uri('assets/images/case-study-3.jpg'),
            'challenge'       => 'A large-scale GXO distribution centre in Thrapston was operating a PSS pallet racking system that had reached end-of-life support — with no viable supply of compatible spare parts, condemned bays were accumulating and full racking replacement seemed the only option.',
            'solution'        => 'Phase one: 60 Goliath™ units installed to restore condemned bays to full operational use. Phase two: a further 50 units on order, eliminating OEM dependency entirely and extending the PSS system\'s operational life permanently.',
            'metric1_value'   => '60',
            'metric1_label'   => 'Goliath™ Units Installed',
            'metric2_value'   => '50',
            'metric2_label'   => 'Further Units on Order',
            'metric3_value'   => 'PSS',
            'metric3_label'   => 'Legacy System Repaired',
            'metric4_value'   => 'EOL',
            'metric4_label'   => 'OEM Support Status: Resolved',
            'hero_intro'      => "When a large-scale distribution centre in Thrapston found itself operating a pallet racking system that had reached end-of-life support — with no viable supply of compatible spare parts — the conventional options were stark: endure ongoing downtime and condemned bays, or commit to a full racking replacement programme at enormous cost and disruption. Goliath™ offered a third way.",
            'problem_text'    => "The site operates a PSS pallet racking system — a system that, while structurally sound and fit for purpose in day-to-day use, has reached the point where OEM replacement components are no longer readily available. For a busy distribution operation, this creates a compounding problem:\n\nDamaged uprights cannot be replaced like-for-like because compatible parts are no longer manufactured or stocked. Condemned bays accumulate over time, steadily reducing usable storage capacity. Full system replacement is prohibitively expensive and operationally disruptive. Temporary fixes and safety workarounds create compliance risk and compromise structural integrity.\n\nThe only long-term answer is one that makes the supply of OEM spare parts entirely irrelevant — and that is precisely what Goliath™ delivers.",
            'problem_callout' => "Obsolete racking systems are a growing challenge across UK warehousing. As systems age out of manufacturer support, operators face a choice between expensive replacement programmes and ongoing disruption from condemned bays. Goliath™ removes that choice entirely.",
            'tried_text'      => '',
            'tried_callout'   => '',
            'video'           => '',
            'solution_text'   => "Goliath™ was designed from the outset to be universally compatible with all types of pallet racking systems manufactured and installed across the UK and Europe. This makes it uniquely suited to the challenge of obsolete or legacy racking — systems where the original manufacturer may no longer supply parts, or where compatible components have become scarce and costly.\n\nGoliath™ replaces only the most vulnerable section of the upright — the lower 700mm where 85% of all racking damage occurs — restoring full structural integrity. It is independently accredited to BS EN 15512:2020 + A1:2022, BS EN 15635:2008, and Industry Codes of Practice, and backed by a Lifetime Impact Warranty.\n\nIn short, Goliath™ transforms a problem that cannot be solved through conventional procurement — because the parts simply do not exist — into one that can be resolved on-site, in under half an hour, with zero OEM dependency.",
            'solution_callout' => "Goliath™ eliminates the need for OEM spare parts entirely. It is the spare part.",
            'results_image'   => get_theme_file_uri('assets/images/case-study-4.jpg'),
            'results_intro'   => 'Across both installation phases, Goliath™ will have delivered 110 permanent racking upright repairs at a site whose racking system was, by conventional measures, beyond its maintainable life. The PSS system is not being replaced — it is being extended, indefinitely, by a solution that requires no manufacturer support and no ongoing procurement headache.',
            'result1_title'   => '110 Total Units',
            'result1_text'    => 'Across both installation phases, including 50 on order',
            'result2_title'   => '0 OEM Parts Required',
            'result2_text'    => 'Complete independence from the original manufacturer',
            'result3_title'   => 'Under 30 Minutes Per Upright',
            'result3_text'    => 'No specialist equipment required',
            'result4_title'   => 'Lifetime Warranty on Every Repair',
            'result4_text'    => 'Each unit protected in perpetuity',
            'warranty_text'   => "The success of the initial 60-unit installation prompted a second phase order of a further 50 Goliath™ units, extending the repair programme across additional bays. This reflects the confidence the operation has in Goliath™ as its primary racking repair solution — not a temporary fix, but a permanent one.",
            'testimonial_quote' => '',
            'testimonial_attr'  => '',
            'seo_title'         => 'GXO Thrapston Primark PSS Racking Repair | Goliath™ Case Study',
            'seo_desc'          => 'How Goliath™ extended the life of an obsolete PSS racking system at a GXO distribution centre in Thrapston — 110 units installed, zero OEM parts required.',
            'content_sections'  => [
                [
                    'heading' => 'Phase One: 60 Units Installed and Operational',
                    'body'    => "The first phase of this installation saw 60 Goliath™ units fitted across the PSS racking system. Each unit was installed without disruption to the surrounding racking structure, restoring condemned bays to full operational use and returning usable storage capacity that had effectively been written off.\n\nThe results were immediate. Bays that had been taken out of service due to damaged uprights were back in use, structurally sound, independently certified, and covered under warranty — all without a single OEM replacement part being sourced.",
                    'callout' => '',
                ],
                [
                    'heading' => 'Phase Two: A Further 50 Units on Order',
                    'body'    => "The success of the initial installation has prompted a second phase order of a further 50 Goliath™ units, extending the repair programme across additional bays and consolidating the site's long-term racking maintenance strategy. This follow-on order reflects the confidence the operation now has in Goliath™ as its primary racking repair solution.",
                    'callout' => '',
                ],
                [
                    'heading' => 'Key Technical Specification — Goliath™ Upright Repair Kit',
                    'body'    => "System compatibility: Universal — all pallet racking types including legacy and obsolete systems\nMaterial: 6mm structural steel\nAccreditation: BS EN 15512:2020 + A1:2022 | BS EN 15635:2008 | Industry Codes of Practice\nInstallation time: Under 30 minutes per upright\nWarranty: Lifetime Impact Warranty\nOEM parts required: None",
                    'callout' => '',
                ],
            ],
        ],
    ];
}

/**
 * All published case studies.
 *
 * Reads from wp_options (Goliath Content Editor) with hardcoded defaults
 * as the fallback. New slugs from the hardcoded defaults are merged in so
 * that freshly seeded entries remain available even when the admin editor
 * has saved an older version of the library.
 *
 * @return array<string, mixed>
 */
function my_theme_get_case_study_library(): array
{
    $defaults = my_theme_get_case_study_defaults();
    $saved    = get_option('my_theme_case_study_library');

    if (! is_array($saved) || empty($saved)) {
        return $defaults;
    }

    // Merge any default entries not yet present in the saved library so that
    // new case studies added to the hardcoded defaults always appear.
    foreach ($defaults as $slug => $entry) {
        if (! isset($saved[$slug])) {
            $saved[$slug] = $entry;
        }
    }

    return $saved;
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
