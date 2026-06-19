<?php
/**
 * Canonical site contact details (visible copy, tel:, mailto:, schema).
 *
 * All getters read from wp_options with hardcoded defaults, allowing
 * the Goliath Content Editor to override values without code changes.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

function my_theme_contact_phone_display(): string
{
    return (string) get_option('my_theme_contact_phone_display', '0121 805 6747');
}

function my_theme_contact_phone_e164(): string
{
    return (string) get_option('my_theme_contact_phone_e164', '+441218056747');
}

function my_theme_contact_phone_href(): string
{
    $digits = str_replace([' ', '-'], '', my_theme_contact_phone_e164());

    return 'tel:' . $digits;
}

function my_theme_contact_email(): string
{
    return (string) get_option('my_theme_contact_email', 'sales@goliathrepair.co.uk');
}

function my_theme_contact_mailto_href(): string
{
    return 'mailto:' . my_theme_contact_email();
}

function my_theme_organization_name(): string
{
    return (string) get_option('my_theme_organization_name', 'Goliath Pallet Racking Repair Ltd');
}

function my_theme_contact_building(): string
{
    return (string) get_option('my_theme_contact_building', 'Calibre Industrial Park');
}

function my_theme_contact_street(): string
{
    return (string) get_option('my_theme_contact_street', 'Unit 2, Laches Close, Four Ashes');
}

function my_theme_contact_locality(): string
{
    return (string) get_option('my_theme_contact_locality', 'Staffordshire');
}

function my_theme_contact_postcode(): string
{
    return (string) get_option('my_theme_contact_postcode', 'WV10 7DZ');
}

function my_theme_contact_country_code(): string
{
    return (string) get_option('my_theme_contact_country_code', 'GB');
}

function my_theme_contact_geo_lat(): float
{
    return (float) get_option('my_theme_contact_geo_lat', 52.6249);
}

function my_theme_contact_geo_lng(): float
{
    return (float) get_option('my_theme_contact_geo_lng', -2.1168);
}

function my_theme_contact_opening_hours(): string
{
    return (string) get_option('my_theme_contact_opening_hours', 'Mo-Fr 08:00-18:00');
}

function my_theme_contact_opening_hours_display(): string
{
    return (string) get_option('my_theme_contact_opening_hours_display', 'Mon–Fri, 8am–6pm');
}

function my_theme_contact_address_html(): string
{
    return esc_html(my_theme_contact_building()) . '<br>'
        . esc_html(my_theme_contact_street()) . ',<br>'
        . esc_html(my_theme_contact_locality()) . ', '
        . esc_html(my_theme_contact_postcode());
}

/**
 * @return array<string, string>
 */
function my_theme_contact_schema_address(): array
{
    return [
        '@type'           => 'PostalAddress',
        'streetAddress'   => my_theme_contact_building() . ', ' . my_theme_contact_street(),
        'addressLocality' => my_theme_contact_locality(),
        'postalCode'      => my_theme_contact_postcode(),
        'addressCountry'  => my_theme_contact_country_code(),
    ];
}

/**
 * @return array<string, mixed>
 */
function my_theme_contact_schema_geo(): array
{
    return [
        '@type'     => 'GeoCoordinates',
        'latitude'  => my_theme_contact_geo_lat(),
        'longitude' => my_theme_contact_geo_lng(),
    ];
}
