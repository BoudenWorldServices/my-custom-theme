<?php
/**
 * Breadcrumb rendering helpers.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Build breadcrumb items for current page.
 *
 * @return list<array{label: string, url: string}>
 */
function my_theme_get_breadcrumb_items(): array
{
    $items = [
        [
            'label' => 'Home',
            'url'   => home_url('/'),
        ],
    ];

    $current_path = function_exists('my_theme_get_current_request_path') ? my_theme_get_current_request_path() : '';
    if ($current_path === '') {
        return $items;
    }

    $path        = $current_path;
    $library     = function_exists('my_theme_get_video_library') ? my_theme_get_video_library() : [];
    $cs_library  = function_exists('my_theme_get_case_study_library') ? my_theme_get_case_study_library() : [];

    $label_map = [
        'why-goliath'                     => 'Why Goliath',
        'how-it-works'                    => 'How It Works',
        'services'                        => 'Services',
        'services/racking-upright-repair' => 'Racking Upright Repair',
        'services/damage-prevention'      => 'Damage Prevention',
        'services/annual-inspections'     => 'Annual Inspections',
        'services/installations-cdm'      => 'Installations & CDM',
        'services/reconfiguration'        => 'Reconfiguration',
        'compliance'                      => 'Compliance',
        'contact'                         => 'Contact',
        'faqs'                            => 'FAQs',
        'faq'                             => 'FAQs',
        'videos'                          => 'Videos',
        'case-studies'                    => 'Case Studies',
        'privacy-policy'                  => 'Privacy Policy',
        'terms-of-service'                => 'Terms and Conditions',
    ];

    if ($path !== '' && isset($label_map[ $path ])) {
        $items[] = [
            'label' => $label_map[ $path ],
            'url'   => home_url('/' . $path . '/'),
        ];

        return $items;
    }

    if ($path !== '' && preg_match('#^(?:videos|video)/([^/]+)$#', $path, $match)) {
        $slug = sanitize_title($match[1]);
        $items[] = [
            'label' => 'Videos',
            'url'   => home_url('/videos/'),
        ];

        if (isset($library[ $slug ])) {
            $items[] = [
                'label' => $library[ $slug ]['title'],
                'url'   => home_url('/videos/' . $slug . '/'),
            ];
        }

        return $items;
    }

    if ($path !== '' && preg_match('#^case-studies/([^/]+)$#', $path, $match)) {
        $slug = sanitize_title($match[1]);
        $items[] = [
            'label' => 'Case Studies',
            'url'   => home_url('/case-studies/'),
        ];

        if (isset($cs_library[ $slug ])) {
            $cs_client = $cs_library[ $slug ]['client'] ?? '';
            $items[] = [
                'label' => $cs_client !== '' ? $cs_client . ' Case Study' : $cs_library[ $slug ]['title'],
                'url'   => home_url('/case-studies/' . $slug . '/'),
            ];
        }

        return $items;
    }

    if (is_singular()) {
        $items[] = [
            'label' => get_the_title() ?: 'Page',
            'url'   => get_permalink() ?: home_url('/'),
        ];
    }

    return $items;
}

/**
 * Render breadcrumb nav.
 */
function my_theme_breadcrumbs(): void
{
    $path = function_exists('my_theme_get_current_request_path') ? my_theme_get_current_request_path() : '';
    if ($path === '') {
        return;
    }

    $items = my_theme_get_breadcrumb_items();
    if (count($items) < 2) {
        return;
    }

    echo '<div class="w-full border-b border-black/5 bg-[#fafafa]">';
    echo '<div class="mx-auto w-full max-w-[1440px] px-5 py-3 sm:px-6 lg:px-[68px]">';
    echo '<nav aria-label="Breadcrumb navigation" class="text-sm text-[#666]">';
    foreach ($items as $index => $item) {
        $is_last = $index === (count($items) - 1);
        if ($index > 0) {
            echo '<span class="mx-2 text-[#999]" aria-hidden="true">/</span>';
        }

        if ($is_last) {
            echo '<span class="font-medium text-[#020202]">' . esc_html($item['label']) . '</span>';
        } else {
            echo '<a href="' . esc_url($item['url']) . '" class="hover:text-[#ff5c00] transition-colors">';
            echo esc_html($item['label']);
            echo '</a>';
        }
    }
    echo '</nav>';
    echo '</div>';
    echo '</div>';
}
