<?php
/**
 * JSON-LD schema output.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Return JSON-LD graph entries for the active request.
 *
 * @return array<int, array<string, mixed>>
 */
function my_theme_build_schema_graph(): array
{
    $site_url = home_url('/');
    $path     = function_exists('my_theme_get_current_request_path') ? my_theme_get_current_request_path() : '';
    $current  = function_exists('my_theme_get_current_url') ? my_theme_get_current_url() : $site_url;
    $graph    = [];

    $org_name  = function_exists('my_theme_organization_name') ? my_theme_organization_name() : 'Goliath Pallet Racking Repair Ltd';
    $org_email = function_exists('my_theme_contact_email') ? my_theme_contact_email() : 'sales@goliathrepair.co.uk';
    $org_phone = function_exists('my_theme_contact_phone_e164') ? my_theme_contact_phone_e164() : '+441218056747';

    $same_as_raw = get_option('my_theme_schema_same_as', '');
    $same_as = [];
    if (is_string($same_as_raw) && $same_as_raw !== '') {
        $same_as = array_values(array_filter(array_map('trim', explode("\n", $same_as_raw))));
    }

    $area_served_raw = get_option('my_theme_schema_area_served', "England\nScotland\nWales\nNorthern Ireland");
    $area_served = [];
    if (is_string($area_served_raw) && $area_served_raw !== '') {
        foreach (array_filter(array_map('trim', explode("\n", $area_served_raw))) as $region) {
            $area_served[] = ['@type' => 'AdministrativeArea', 'name' => $region];
        }
    }
    if ($area_served === []) {
        $area_served = [['@type' => 'Country', 'name' => 'United Kingdom']];
    }

    $org = [
        '@context'       => 'https://schema.org',
        '@type'          => 'Organization',
        '@id'            => trailingslashit($site_url) . '#organization',
        'name'           => $org_name,
        'url'            => $site_url,
        'logo'           => [
            '@type'  => 'ImageObject',
            'url'    => get_theme_file_uri('assets/images/icons/Goliath_logo_fullcolor.svg'),
            'width'  => 280,
            'height' => 60,
        ],
        'image'          => [
            get_theme_file_uri('assets/images/icons/Goliath_logo_fullcolor.svg'),
            get_theme_file_uri('assets/images/Homepage/carousel-image1.webp'),
            get_theme_file_uri('assets/images/Homepage/carousel-image2.webp'),
        ],
        'email'          => $org_email,
        'telephone'      => $org_phone,
        'description'    => 'Permanent pallet racking upright repair with lifetime warranty. SEMA-aligned engineered steel repair system serving warehouses across the UK and EU.',
        'address'        => function_exists('my_theme_contact_schema_address') ? my_theme_contact_schema_address() : [],
        'areaServed'     => $area_served,
        'knowsAbout'     => [
            'Pallet racking repair',
            'Warehouse safety compliance',
            'SEMA racking inspection standards',
            'BS EN 15512 structural design',
            'BS EN 15635 storage equipment maintenance',
        ],
        'hasCredential'  => [
            [
                '@type'              => 'EducationalOccupationalCredential',
                'credentialCategory' => 'Industry Qualification',
                'name'               => 'SEMA Approved Racking Inspector',
                'recognizedBy'       => [
                    '@type' => 'Organization',
                    'name'  => 'Storage Equipment Manufacturers\' Association (SEMA)',
                    'url'   => 'https://www.sema.org.uk/',
                ],
            ],
            [
                '@type'              => 'EducationalOccupationalCredential',
                'credentialCategory' => 'Standards Compliance',
                'name'               => 'BS EN 15512:2020 + A1:2022 — Steel static storage systems',
            ],
            [
                '@type'              => 'EducationalOccupationalCredential',
                'credentialCategory' => 'Standards Compliance',
                'name'               => 'BS EN 15635:2008 — Steel static storage systems: Application and maintenance',
            ],
            [
                '@type'              => 'EducationalOccupationalCredential',
                'credentialCategory' => 'Intellectual Property',
                'name'               => 'Registered Design — Goliath Racking Repair System',
            ],
        ],
    ];
    if ($same_as !== []) {
        $org['sameAs'] = $same_as;
    }
    $graph[] = $org;

    if (is_front_page()) {
        $graph[] = [
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            '@id'             => trailingslashit($site_url) . '#website',
            'url'             => $site_url,
            'name'            => get_bloginfo('name'),
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => trailingslashit($site_url) . '?s={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    if ($path === 'contact' || $path === '' || is_front_page()) {
        $local_business = [
            '@context'      => 'https://schema.org',
            '@type'         => 'LocalBusiness',
            '@id'           => trailingslashit($site_url) . '#localbusiness',
            'name'          => $org_name,
            'url'           => $site_url,
            'telephone'     => $org_phone,
            'email'         => $org_email,
            'description'   => 'Permanent pallet racking upright repair specialists. Engineered steel repair system with lifetime warranty, 30-minute installation, and SEMA-qualified inspectors.',
            'image'         => [
                get_theme_file_uri('assets/images/icons/Goliath_logo_fullcolor.svg'),
                get_theme_file_uri('assets/images/Homepage/carousel-image1.webp'),
                get_theme_file_uri('assets/images/Homepage/carousel-image2.webp'),
            ],
            'address'       => function_exists('my_theme_contact_schema_address') ? my_theme_contact_schema_address() : [],
            'geo'           => function_exists('my_theme_contact_schema_geo') ? my_theme_contact_schema_geo() : [],
            'openingHoursSpecification' => [
                [
                    '@type'     => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                    'opens'     => '08:00',
                    'closes'    => '18:00',
                ],
            ],
            'areaServed'    => $area_served,
            'priceRange'    => '££ — Competitive pricing with free assessments',
        ];

        if ($same_as !== []) {
            $local_business['sameAs'] = $same_as;
        }

        $rating_count = (int) get_option('my_theme_schema_rating_count', 0);
        $rating_value = (float) get_option('my_theme_schema_rating_value', 0);
        if ($rating_count > 0 && $rating_value > 0) {
            $local_business['aggregateRating'] = [
                '@type'       => 'AggregateRating',
                'ratingValue' => number_format($rating_value, 1),
                'bestRating'  => '5',
                'ratingCount' => (string) $rating_count,
            ];
        }

        $graph[] = $local_business;
    }

    $service_schemas = [
        'Racking Upright Repair'       => 'services/racking-upright-repair',
        'Damage Prevention'            => 'services/damage-prevention',
        'Annual Inspections'           => 'services/annual-inspections',
        'Racking Installations & CDM'  => 'services/installations-cdm',
        'Racking Reconfiguration Services' => 'services/reconfiguration',
    ];

    if ($path === 'services' || isset(array_flip(array_values($service_schemas))[$path])) {
        foreach ($service_schemas as $service_name => $service_path) {
            if ($path === 'services' || $path === $service_path) {
                $graph[] = [
                    '@context'    => 'https://schema.org',
                    '@type'       => 'Service',
                    'name'        => $service_name,
                    'provider'    => [
                        '@id' => trailingslashit($site_url) . '#organization',
                    ],
                    'areaServed'  => $area_served,
                    'serviceType' => $service_name,
                    'url'         => home_url('/' . $service_path . '/'),
                ];
            }
        }
    }

    if ($path === 'faqs' || $path === 'faq') {
        $faq_items    = function_exists('my_theme_get_faq_items') ? my_theme_get_faq_items() : [];
        $faq_entities = [];

        foreach ($faq_items as $item) {
            $answer_text = implode(' ', $item['paragraphs']);
            $faq_entities[] = [
                '@type'          => 'Question',
                'name'           => $item['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => $answer_text,
                ],
            ];
        }

        $graph[] = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $faq_entities,
            'url'        => $current,
        ];
    }

    if ($path === 'case-studies/bm-racking-damage') {
        $graph[] = [
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => 'How B&M Eliminated Pallet Racking Damage with Goliath',
            'datePublished' => '2026-04-29',
            'author'        => [
                '@type' => 'Organization',
                'name'  => $org_name,
            ],
            'publisher'     => [
                '@id' => trailingslashit($site_url) . '#organization',
            ],
            'description'   => 'Case study showing how B&M reduced repeated rack upright damage, costs and disruption with Goliath.',
            'url'           => $current,
            'about'         => [
                '@type' => 'Service',
                'name'  => 'Racking Upright Repair',
                'url'   => home_url('/services/racking-upright-repair/'),
            ],
        ];
    }

    $library = function_exists('my_theme_get_video_library') ? my_theme_get_video_library() : [];
    if ($path === 'videos') {
        foreach ($library as $slug => $video) {
            $graph[] = [
                '@context'     => 'https://schema.org',
                '@type'        => 'VideoObject',
                'name'         => $video['title'],
                'description'  => $video['excerpt'],
                'thumbnailUrl' => function_exists('my_theme_video_thumbnail_is_readable') && my_theme_video_thumbnail_is_readable($video['file'])
                    ? my_theme_get_video_thumbnail_uri($video['file'])
                    : get_theme_file_uri('assets/images/Homepage/not-just-dent.webp'),
                'contentUrl'   => my_theme_get_video_file_uri($video['file']),
                'url'          => home_url('/videos/' . $slug . '/'),
                'uploadDate'   => '2026-04-29',
            ];
        }
    }

    if (preg_match('#^(?:videos|video)/([^/]+)$#', $path, $match)) {
        $slug = sanitize_title($match[1]);
        if (isset($library[ $slug ])) {
            $video = $library[ $slug ];
            $graph[] = [
                '@context'     => 'https://schema.org',
                '@type'        => 'VideoObject',
                'name'         => $video['title'],
                'description'  => $video['excerpt'],
                'thumbnailUrl' => function_exists('my_theme_video_thumbnail_is_readable') && my_theme_video_thumbnail_is_readable($video['file'])
                    ? my_theme_get_video_thumbnail_uri($video['file'])
                    : get_theme_file_uri('assets/images/Homepage/not-just-dent.webp'),
                'contentUrl'   => my_theme_get_video_file_uri($video['file']),
                'url'          => home_url('/videos/' . $slug . '/'),
                'uploadDate'   => '2026-04-29',
            ];
        }
    }

    if ($path === 'privacy-policy' || $path === 'terms-of-service') {
        $graph[] = [
            '@context'      => 'https://schema.org',
            '@type'         => 'WebPage',
            'name'          => wp_get_document_title(),
            'url'           => $current,
            'lastReviewed'  => '2026-04-29',
        ];
    }

    if ($path === 'why-goliath') {
        $graph[] = [
            '@context'    => 'https://schema.org',
            '@type'       => 'WebPage',
            'name'        => 'Why Goliath — Permanent Racking Upright Repair',
            'description' => 'Learn why the Goliath racking repair system offers a permanent, cost-effective alternative to upright replacement with a lifetime warranty.',
            'url'         => $current,
            'about'       => ['@id' => trailingslashit($site_url) . '#organization'],
        ];
    }

    if ($path === 'how-it-works') {
        $graph[] = [
            '@context'    => 'https://schema.org',
            '@type'       => 'HowTo',
            'name'        => 'How the Goliath Racking Repair System Works',
            'description' => 'Step-by-step overview of the Goliath pallet racking upright repair process, from inspection to installation.',
            'url'         => $current,
            'step'        => [
                ['@type' => 'HowToStep', 'position' => 1, 'name' => 'Assessment', 'text' => 'Our SEMA-qualified inspector assesses the damaged racking upright on site.'],
                ['@type' => 'HowToStep', 'position' => 2, 'name' => 'Precision cut', 'text' => 'The damaged section is removed using a specially designed jig for a factory-quality cut.'],
                ['@type' => 'HowToStep', 'position' => 3, 'name' => 'Goliath installation', 'text' => 'The Goliath engineered steel repair sleeve is fitted in under 30 minutes with no disruption to operations.'],
                ['@type' => 'HowToStep', 'position' => 4, 'name' => 'Certification', 'text' => 'The repair is load-tested and certified with a lifetime impact warranty.'],
            ],
            'totalTime' => 'PT30M',
        ];
    }

    if ($path === 'compliance') {
        $graph[] = [
            '@context'    => 'https://schema.org',
            '@type'       => 'WebPage',
            'name'        => 'Compliance & Standards — Goliath Racking Repair',
            'description' => 'How Goliath racking repairs comply with SEMA guidelines, HSE regulations, BS EN 15512 and BS EN 15635 standards.',
            'url'         => $current,
            'mentions'    => [
                ['@type' => 'Thing', 'name' => 'BS EN 15512:2020 + A1:2022'],
                ['@type' => 'Thing', 'name' => 'BS EN 15635:2008'],
                ['@type' => 'Thing', 'name' => 'SEMA Code of Practice'],
                ['@type' => 'Thing', 'name' => 'Health and Safety Executive (HSE)'],
            ],
        ];
    }

    if ($path === 'case-studies') {
        $graph[] = [
            '@context'         => 'https://schema.org',
            '@type'            => 'CollectionPage',
            'name'             => 'Case Studies — Goliath Racking Repair',
            'description'      => 'Real-world racking repair case studies showing cost savings, reduced downtime, and improved warehouse safety with Goliath.',
            'url'              => $current,
            'mainEntity'       => [
                '@type'            => 'ItemList',
                'itemListElement'  => [
                    [
                        '@type'    => 'ListItem',
                        'position' => 1,
                        'name'     => 'How B&M Eliminated Pallet Racking Damage with Goliath',
                        'url'      => home_url('/case-studies/bm-racking-damage/'),
                    ],
                ],
            ],
        ];
    }

    if ($path === 'about') {
        $graph[] = [
            '@context'    => 'https://schema.org',
            '@type'       => 'AboutPage',
            'name'        => 'About Goliath — Our Team & Credentials',
            'description' => 'Meet the SEMA-qualified team behind the UK\'s only permanent pallet racking upright repair system. Learn about our credentials, experience, and mission.',
            'url'         => $current,
            'about'       => ['@id' => trailingslashit($site_url) . '#organization'],
        ];

        $leader_name  = get_option('my_theme_about_leader_name', '');
        $leader_role  = get_option('my_theme_about_leader_role', '');
        $leader_quals = get_option('my_theme_about_leader_qualifications', '');
        if ($leader_name !== '' && $leader_name !== 'Managing Director') {
            $person = [
                '@context'  => 'https://schema.org',
                '@type'     => 'Person',
                'name'      => $leader_name,
                'jobTitle'  => $leader_role,
                'worksFor'  => ['@id' => trailingslashit($site_url) . '#organization'],
            ];
            if ($leader_quals !== '') {
                $person['hasCredential'] = [
                    '@type' => 'EducationalOccupationalCredential',
                    'credentialCategory' => 'Industry Qualification',
                    'name'  => $leader_quals,
                ];
            }
            $leader_photo_val = get_option('my_theme_about_leader_photo', '');
            if (is_numeric($leader_photo_val) && (int) $leader_photo_val > 0) {
                $photo_url = wp_get_attachment_image_url((int) $leader_photo_val, 'medium');
                if ($photo_url) {
                    $person['image'] = $photo_url;
                }
            } elseif (is_string($leader_photo_val) && $leader_photo_val !== '') {
                $person['image'] = $leader_photo_val;
            }
            $graph[] = $person;
        }

        $team_members = get_option('my_theme_about_team_members', []);
        if (is_array($team_members)) {
            $placeholder_names = ['Company Director', 'Managing Director', 'Team Member', ''];
            foreach ($team_members as $member) {
                $m_name = $member['name'] ?? '';
                if (in_array($m_name, $placeholder_names, true) || $m_name === $leader_name) {
                    continue;
                }
                $team_person = [
                    '@context'  => 'https://schema.org',
                    '@type'     => 'Person',
                    'name'      => $m_name,
                    'worksFor'  => ['@id' => trailingslashit($site_url) . '#organization'],
                ];
                if (! empty($member['role'])) {
                    $team_person['jobTitle'] = $member['role'];
                }
                if (! empty($member['qualifications'])) {
                    $team_person['hasCredential'] = [
                        '@type' => 'EducationalOccupationalCredential',
                        'credentialCategory' => 'Industry Qualification',
                        'name'  => $member['qualifications'],
                    ];
                }
                $photo_val = $member['photo'] ?? '';
                if (is_numeric($photo_val) && (int) $photo_val > 0) {
                    $photo_url = wp_get_attachment_image_url((int) $photo_val, 'medium');
                    if ($photo_url) {
                        $team_person['image'] = $photo_url;
                    }
                } elseif (is_string($photo_val) && $photo_val !== '') {
                    $team_person['image'] = $photo_val;
                }
                $graph[] = $team_person;
            }
        }
    }

    if (function_exists('my_theme_get_breadcrumb_items')) {
        $breadcrumbs = my_theme_get_breadcrumb_items();
        if (count($breadcrumbs) > 1) {
            $list_items = [];
            foreach ($breadcrumbs as $index => $crumb) {
                $list_items[] = [
                    '@type'    => 'ListItem',
                    'position' => $index + 1,
                    'name'     => $crumb['label'],
                    'item'     => $crumb['url'],
                ];
            }

            $graph[] = [
                '@context'         => 'https://schema.org',
                '@type'            => 'BreadcrumbList',
                'itemListElement'  => $list_items,
            ];
        }
    }

    return $graph;
}

/**
 * Print page schema.
 */
function my_theme_output_schema_graph(): void
{
    if (is_admin()) {
        return;
    }

    $graph = my_theme_build_schema_graph();
    if ($graph === []) {
        return;
    }

    echo '<script type="application/ld+json">' . wp_json_encode($graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'my_theme_output_schema_graph', 40);
