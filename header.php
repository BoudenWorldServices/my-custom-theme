<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('antialiased bg-white text-noir font-roboto overflow-x-hidden'); ?>>
<?php wp_body_open(); ?>
<a href="#main-content-anchor" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[9999] focus:bg-white focus:px-4 focus:py-2 focus:text-black focus:shadow-lg">
    Skip to main content
</a>

<?php
$header_logo_url = my_theme_get_image_url('my_theme_header_logo', get_theme_file_uri('assets/images/icons/Goliath_logo_fullcolor.svg'));
$header_cta_url  = get_option('my_theme_header_cta_assessment_url', '/contact/');
if (strpos($header_cta_url, 'http') !== 0 && strpos($header_cta_url, '//') !== 0) {
    $header_cta_url = home_url($header_cta_url);
}

$menu_items     = my_theme_get_primary_nav_items();
$service_children = is_array($menu_items['Services'] ?? null) ? $menu_items['Services']['children'] : [];

$custom_nav = get_option('my_theme_header_nav_links');
if (is_array($custom_nav) && $custom_nav !== []) {
    $nav_items = [];
    foreach ($custom_nav as $item) {
        $label = $item['label'] ?? '';
        $url   = $item['url'] ?? '';
        if ($label === '' || $url === '') { continue; }
        if (strpos($url, 'http') !== 0 && strpos($url, '//') !== 0) {
            $url = home_url($url);
        }
        if (stripos($label, 'service') !== false && ! empty($service_children)) {
            $nav_items[$label] = [
                'url'      => $url,
                'children' => $service_children,
            ];
        } else {
            $nav_items[$label] = $url;
        }
    }
} else {
    $nav_items = $menu_items;
}
?>
<header class="bg-white/95 border-b border-black/10 sticky top-0 z-50 transition-transform duration-300 will-change-transform">
    <div class="mx-auto w-full max-w-[1440px] px-4 sm:px-6 lg:px-10 xl:pl-[68px] xl:pr-[59px]">
        <div class="flex items-center h-[80px] w-full gap-4">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="shrink-0 h-[32px] w-[150px] sm:w-[162px] flex items-center">
                <img src="<?php echo esc_url($header_logo_url); ?>" alt="<?php echo esc_attr(function_exists('my_theme_organization_name') ? my_theme_organization_name() : 'Goliath Pallet Racking Repair Ltd'); ?>" class="w-full h-full object-contain" width="162" height="32">
            </a>

            <nav aria-label="Primary navigation" class="hidden lg:flex items-center gap-6 xl:gap-[34px] ml-4 flex-1">
                <?php foreach ($nav_items as $label => $href) : ?>
                    <?php if (is_array($href)) : ?>
                        <div class="relative" data-dropdown>
                            <a href="<?php echo esc_url($href['url']); ?>"
                               class="inline-flex items-center gap-1 font-montserrat font-medium text-[14px] uppercase text-noir leading-[24px] whitespace-nowrap hover:text-[#ff5c00] transition-colors"
                               data-dropdown-toggle>
                                <?php echo esc_html($label); ?>
                                <svg class="w-3 h-3 mt-0.5 transition-transform" data-dropdown-chevron fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </a>
                            <div class="absolute left-0 top-full pt-2 hidden z-50" data-dropdown-menu>
                                <div class="bg-white border border-black/10 shadow-lg py-2 min-w-[220px]">
                                    <?php foreach ($href['children'] as $child_label => $child_href) : ?>
                                        <a href="<?php echo esc_url($child_href); ?>"
                                           class="block px-5 py-2.5 font-montserrat font-medium text-[13px] text-noir/80 hover:bg-[#ff5c00]/5 hover:text-[#ff5c00] transition-colors">
                                            <?php echo esc_html($child_label); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url($href); ?>"
                           class="font-montserrat font-medium text-[14px] uppercase text-noir leading-[24px] whitespace-nowrap hover:text-[#ff5c00] transition-colors">
                            <?php echo esc_html($label); ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>

            <div class="hidden lg:flex h-[44px] items-center gap-3 xl:gap-[16px] ml-auto">
                <a href="<?php echo esc_url(my_theme_contact_phone_href()); ?>"
                   class="group flex h-[44px] items-center gap-2 border border-noir bg-white px-4 font-roboto font-bold text-[14px] text-noir tracking-[0.35px] leading-[20px] whitespace-nowrap transition-colors hover:bg-noir hover:text-white">
                    <svg class="h-10 w-10 shrink-0 text-noir transition-colors group-hover:text-white" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M38.0004 32.92V35.92C38.0016 36.1985 37.9445 36.4742 37.8329 36.7294C37.7214 36.9845 37.5577 37.2136 37.3525 37.4019C37.1473 37.5901 36.905 37.7335 36.6412 37.8227C36.3773 37.9119 36.0978 37.9451 35.8204 37.92C32.7433 37.5856 29.7874 36.5342 27.1904 34.85C24.7742 33.3147 22.7258 31.2662 21.1904 28.85C19.5004 26.2412 18.4487 23.271 18.1204 20.18C18.0954 19.9035 18.1283 19.6248 18.2169 19.3616C18.3055 19.0985 18.448 18.8567 18.6352 18.6516C18.8224 18.4466 19.0502 18.2827 19.3042 18.1705C19.5582 18.0583 19.8328 18.0003 20.1104 18H23.1104C23.5957 17.9952 24.0662 18.1671 24.4342 18.4835C24.8022 18.8 25.0425 19.2395 25.1104 19.72C25.237 20.6801 25.4719 21.6227 25.8104 22.53C25.945 22.8879 25.9741 23.2769 25.8943 23.6509C25.8146 24.0249 25.6293 24.3681 25.3604 24.64L24.0904 25.91C25.514 28.4136 27.5869 30.4865 30.0904 31.91L31.3604 30.64C31.6323 30.3711 31.9756 30.1859 32.3495 30.1061C32.7235 30.0263 33.1125 30.0555 33.4704 30.19C34.3777 30.5286 35.3204 30.7634 36.2804 30.89C36.7662 30.9585 37.2098 31.2032 37.527 31.5775C37.8441 31.9518 38.0126 32.4296 38.0004 32.92Z" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span><?php echo esc_html(get_option('my_theme_header_cta_call_text', 'Call Us')); ?></span>
                </a>
                <a href="<?php echo esc_url($header_cta_url); ?>"
                   class="btn-dark h-[44px] w-full px-5 text-[12px] leading-[20px] sm:w-auto xl:w-[176px]">
                    <?php echo esc_html(get_option('my_theme_header_cta_assessment_text', 'Get Free Assessment')); ?>
                </a>
            </div>

            <button
                type="button"
                class="lg:hidden ml-auto inline-flex items-center justify-center w-11 h-11 border border-noir text-noir"
                aria-label="Toggle navigation menu"
                aria-expanded="false"
                aria-controls="mobile-menu"
                data-mobile-menu-toggle>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="lg:hidden hidden border-t border-black/10 py-4" data-mobile-menu>
            <nav aria-label="Mobile navigation" class="flex flex-col gap-1 mb-4">
                <?php foreach ($nav_items as $label => $href) : ?>
                    <?php if (is_array($href)) : ?>
                        <a href="<?php echo esc_url($href['url']); ?>"
                           class="px-2 py-2 font-montserrat font-medium text-[15px] text-noir hover:text-[#ff5c00] transition-colors"
                           data-mobile-menu-link>
                            <?php echo esc_html($label); ?>
                        </a>
                        <?php foreach ($href['children'] as $child_label => $child_href) : ?>
                            <a href="<?php echo esc_url($child_href); ?>"
                               class="pl-6 pr-2 py-1.5 font-montserrat font-medium text-[14px] text-noir/70 hover:text-[#ff5c00] transition-colors"
                               data-mobile-menu-link>
                                <?php echo esc_html($child_label); ?>
                            </a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url($href); ?>"
                           class="px-2 py-2 font-montserrat font-medium text-[15px] text-noir hover:text-[#ff5c00] transition-colors"
                           data-mobile-menu-link>
                            <?php echo esc_html($label); ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="<?php echo esc_url(my_theme_contact_phone_href()); ?>"
                   class="group flex h-[44px] items-center justify-center gap-2 border border-noir bg-white px-4 font-roboto font-bold text-[14px] text-noir tracking-[0.35px] leading-[20px] whitespace-nowrap transition-colors hover:bg-noir hover:text-white">
                    <svg class="h-7 w-7 shrink-0 text-noir transition-colors group-hover:text-white" width="28" height="28" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M38.0004 32.92V35.92C38.0016 36.1985 37.9445 36.4742 37.8329 36.7294C37.7214 36.9845 37.5577 37.2136 37.3525 37.4019C37.1473 37.5901 36.905 37.7335 36.6412 37.8227C36.3773 37.9119 36.0978 37.9451 35.8204 37.92C32.7433 37.5856 29.7874 36.5342 27.1904 34.85C24.7742 33.3147 22.7258 31.2662 21.1904 28.85C19.5004 26.2412 18.4487 23.271 18.1204 20.18C18.0954 19.9035 18.1283 19.6248 18.2169 19.3616C18.3055 19.0985 18.448 18.8567 18.6352 18.6516C18.8224 18.4466 19.0502 18.2827 19.3042 18.1705C19.5582 18.0583 19.8328 18.0003 20.1104 18H23.1104C23.5957 17.9952 24.0662 18.1671 24.4342 18.4835C24.8022 18.8 25.0425 19.2395 25.1104 19.72C25.237 20.6801 25.4719 21.6227 25.8104 22.53C25.945 22.8879 25.9741 23.2769 25.8943 23.6509C25.8146 24.0249 25.6293 24.3681 25.3604 24.64L24.0904 25.91C25.514 28.4136 27.5869 30.4865 30.0904 31.91L31.3604 30.64C31.6323 30.3711 31.9756 30.1859 32.3495 30.1061C32.7235 30.0263 33.1125 30.0555 33.4704 30.19C34.3777 30.5286 35.3204 30.7634 36.2804 30.89C36.7662 30.9585 37.2098 31.2032 37.527 31.5775C37.8441 31.9518 38.0126 32.4296 38.0004 32.92Z" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span><?php echo esc_html(get_option('my_theme_header_cta_call_text', 'Call Us')); ?></span>
                </a>
                <a href="<?php echo esc_url($header_cta_url); ?>"
                   class="btn-dark h-[44px] w-full px-5 text-[12px] leading-[20px] sm:w-auto">
                    <?php echo esc_html(get_option('my_theme_header_cta_assessment_text', 'Get Free Assessment')); ?>
                </a>
            </div>
        </div>
    </div>
</header>
<div id="main-content-anchor" tabindex="-1"></div>
<?php
my_theme_breadcrumbs();
?>
