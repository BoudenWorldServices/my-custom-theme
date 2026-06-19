<?php
/**
 * Goliath Content Editor — Global Settings admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

function my_theme_admin_global_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-global') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_global_stats_strip'          => 'text',
        'my_theme_global_kpi_satisfaction'      => 'text',
        'my_theme_global_kpi_cost_savings'      => 'text',
        'my_theme_global_kpi_downtime'          => 'text',
        'my_theme_global_install_time'          => 'text',
        'my_theme_global_warranty_label'        => 'text',
        'my_theme_global_cost_saving_percent'   => 'text',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_global_fields', 10, 2);

function my_theme_admin_render_global(): void
{
    my_theme_admin_page_open('Global Settings', 'goliath-global');

    my_theme_admin_section_open('Shared Stats Strip', 'This text appears in the orange CTA bar across multiple pages.');
    my_theme_admin_text_field('my_theme_global_stats_strip', 'Stats Strip Text', '100% Client Satisfaction • Save 70% • 30min Installation • Lifetime Warranty');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Key Performance Indicators', 'These KPI values are used across the homepage and other pages.');
    my_theme_admin_text_field('my_theme_global_kpi_satisfaction', 'Client Satisfaction %', '100%');
    my_theme_admin_text_field('my_theme_global_kpi_cost_savings', 'Average Cost Savings %', '70%');
    my_theme_admin_text_field('my_theme_global_kpi_downtime', 'Reduction in Downtime %', '85%');
    my_theme_admin_text_field('my_theme_global_install_time', 'Installation Time', '30 Minutes');
    my_theme_admin_text_field('my_theme_global_warranty_label', 'Warranty Label', 'Lifetime');
    my_theme_admin_text_field('my_theme_global_cost_saving_percent', 'Cost Saving Comparison', '£350 vs £2,025');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
