<?php
/**
 * Goliath Content Editor — Contact Details admin page.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Register field definitions for the contact details page.
 */
function my_theme_admin_contact_details_fields(array $defs, string $page): array
{
    if ($page !== 'goliath-contact-details') {
        return $defs;
    }

    return array_merge($defs, [
        'my_theme_contact_phone_display' => 'text',
        'my_theme_contact_phone_e164'    => 'text',
        'my_theme_contact_email'         => 'email',
        'my_theme_organization_name'     => 'text',
        'my_theme_contact_building'      => 'text',
        'my_theme_contact_street'        => 'text',
        'my_theme_contact_locality'      => 'text',
        'my_theme_contact_postcode'      => 'text',
        'my_theme_contact_country_code'  => 'text',
        'my_theme_contact_geo_lat'       => 'float',
        'my_theme_contact_geo_lng'       => 'float',
        'my_theme_contact_opening_hours' => 'text',
        'my_theme_contact_opening_hours_display' => 'text',
        'my_theme_schema_same_as'        => 'textarea',
        'my_theme_schema_area_served'    => 'textarea',
        'my_theme_schema_rating_value'   => 'float',
        'my_theme_schema_rating_count'   => 'number',
    ]);
}
add_filter('my_theme_admin_field_definitions', 'my_theme_admin_contact_details_fields', 10, 2);

/**
 * Render the contact details admin page.
 */
function my_theme_admin_render_contact_details(): void
{
    my_theme_admin_page_open('Contact Details', 'goliath-contact-details');

    my_theme_admin_section_open('Phone & Email', 'These appear across the site in the header, footer, contact page, and schema markup.');
    my_theme_admin_text_field('my_theme_contact_phone_display', 'Phone (display)', '0121 805 6747', '0121 805 6747');
    my_theme_admin_text_field('my_theme_contact_phone_e164', 'Phone (E.164 format)', '+441218056747', '+441218056747');
    my_theme_admin_text_field('my_theme_contact_email', 'Email Address', 'sales@goliathrepair.co.uk', 'sales@goliathrepair.co.uk');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Organisation', 'Company name used in titles, schema, footer, and accessibility labels.');
    my_theme_admin_text_field('my_theme_organization_name', 'Organisation Name', 'Goliath Pallet Racking Repair Ltd');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Address', 'Used in the footer, contact page, and LocalBusiness schema markup.');
    my_theme_admin_text_field('my_theme_contact_building', 'Building / Park', 'Calibre Industrial Park');
    my_theme_admin_text_field('my_theme_contact_street', 'Street Address', 'Unit 2, Laches Close, Four Ashes');
    my_theme_admin_text_field('my_theme_contact_locality', 'Locality / County', 'Staffordshire');
    my_theme_admin_text_field('my_theme_contact_postcode', 'Postcode', 'WV10 7DZ');
    my_theme_admin_text_field('my_theme_contact_country_code', 'Country Code (ISO)', 'GB', 'GB');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Geo-coordinates', 'Used for Google Maps and LocalBusiness schema.');
    my_theme_admin_number_field('my_theme_contact_geo_lat', 'Latitude', '52.6249', '0.0001');
    my_theme_admin_number_field('my_theme_contact_geo_lng', 'Longitude', '-2.1168', '0.0001');
    my_theme_admin_section_close();

    my_theme_admin_section_open('Opening Hours');
    my_theme_admin_text_field('my_theme_contact_opening_hours', 'Schema Format', 'Mo-Fr 08:00-18:00', 'Mo-Fr 08:00-18:00');
    my_theme_admin_text_field('my_theme_contact_opening_hours_display', 'Display Format', 'Mon–Fri, 8am–6pm', 'Mon–Fri, 8am–6pm');
    my_theme_admin_section_close();

    my_theme_admin_section_open('SEO — Social & Directory Links (sameAs)', 'One URL per line. These are added to the Organisation and LocalBusiness schema to tell Google all these profiles belong to the same business. Add your LinkedIn page, Companies House listing, SEMA directory page, and any press coverage (e.g. Warehouse & Logistics News).');
    my_theme_admin_textarea_field('my_theme_schema_same_as', 'sameAs URLs (one per line)', "https://www.linkedin.com/company/YOUR-LINKEDIN-SLUG\nhttps://find-and-update.company-information.service.gov.uk/company/YOUR-COMPANY-NUMBER\nhttps://www.sema.org.uk/\nhttps://www.warehousenews.co.uk/YOUR-ARTICLE-URL", 6);
    my_theme_admin_section_close();

    my_theme_admin_section_open('SEO — Areas Served', 'One region per line. Used in LocalBusiness and Organisation schema instead of just "GB". List the specific UK regions you serve.');
    my_theme_admin_textarea_field('my_theme_schema_area_served', 'Regions served (one per line)', "England\nScotland\nWales\nNorthern Ireland", 5);
    my_theme_admin_section_close();

    my_theme_admin_section_open('SEO — Review / Rating Schema', 'When you have reviews to display, enter the aggregate rating data here. It will be included in the LocalBusiness schema markup. Leave rating count at 0 to disable.');
    my_theme_admin_number_field('my_theme_schema_rating_value', 'Average Rating (e.g. 4.8)', '0', '0.1');
    my_theme_admin_number_field('my_theme_schema_rating_count', 'Number of Reviews', '0', '1');
    my_theme_admin_section_close();

    my_theme_admin_page_close();
}
