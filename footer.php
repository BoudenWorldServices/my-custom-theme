<footer class="bg-noir text-white pt-[64px] pb-[33px] relative z-10">
    <div class="mx-auto w-full max-w-[1440px] px-4 sm:px-6 lg:px-10 xl:px-[75px]">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 lg:gap-12 mb-12 lg:mb-16">
            <div class="w-full xl:max-w-[568px]">
                <?php $footer_logo_url = my_theme_get_image_url('my_theme_footer_logo', get_theme_file_uri('assets/images/logo-grayscale.png')); ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block mb-[24px]">
                    <img src="<?php echo esc_url($footer_logo_url); ?>" alt="Goliath lifetime racking repair" class="w-40 sm:w-44 lg:w-[200px] h-auto" width="200" height="44">
                </a>
                <p class="text-white/80 font-montserrat font-medium text-[16px] leading-[24px] max-w-[290px]">
                    <?php echo esc_html(get_option('my_theme_footer_tagline', 'Safe, instant repair for damaged uprights. We deliver confidence, safety, and the certainty that your warehouse is protected for life.')); ?>
                </p>
            </div>

            <div class="w-full xl:max-w-[260px]">
                <h3 class="font-montserrat font-bold text-[18px] text-white uppercase tracking-[0.45px] leading-[28px] mb-6">Quick Links</h3>
                <ul class="flex flex-col gap-[12px]">
                    <?php
                    $quick_links = get_option('my_theme_footer_quick_links');
                    if (! is_array($quick_links) || $quick_links === []) {
                        $quick_links = function_exists('my_theme_footer_default_quick_links') ? my_theme_footer_default_quick_links() : [];
                    }
                    foreach ($quick_links as $link) :
                        $href = $link['url'] ?? '';
                        if ($href === '') { continue; }
                        if (strpos($href, 'http') !== 0 && strpos($href, '//') !== 0) {
                            $href = home_url($href);
                        }
                    ?>
                        <li>
                            <a href="<?php echo esc_url($href); ?>" class="font-montserrat font-medium text-[16px] text-white/80 leading-[34px] hover:text-[#ff5c00] transition-colors">
                                <?php echo esc_html($link['label'] ?? ''); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="w-full xl:max-w-[175px]">
                <h3 class="font-montserrat font-bold text-[18px] text-white uppercase tracking-[0.45px] leading-[28px] mb-6">Services</h3>
                <ul class="flex flex-col gap-[12px]">
                    <?php
                    $service_links = get_option('my_theme_footer_service_links');
                    if (! is_array($service_links) || $service_links === []) {
                        $service_links = function_exists('my_theme_footer_default_service_links') ? my_theme_footer_default_service_links() : [];
                    }
                    foreach ($service_links as $link) :
                        $href = $link['url'] ?? '';
                        if ($href === '') { continue; }
                        if (strpos($href, 'http') !== 0 && strpos($href, '//') !== 0) {
                            $href = home_url($href);
                        }
                    ?>
                        <li>
                            <a href="<?php echo esc_url($href); ?>" class="font-montserrat font-medium text-[16px] text-white/80 leading-[34px] hover:text-[#ff5c00] transition-colors">
                                <?php echo esc_html($link['label'] ?? ''); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="w-full xl:max-w-[260px]">
                <h3 class="font-montserrat font-bold text-[18px] text-white uppercase tracking-[0.45px] leading-[28px] mb-6">Contact</h3>
                <ul class="flex flex-col gap-[16px]">
                    <li class="flex items-center gap-[14px]">
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/footer-phone-icon.svg')); ?>" alt="" class="h-7 w-7 shrink-0 object-contain" width="28" height="28" aria-hidden="true">
                        <a href="<?php echo esc_url(my_theme_contact_phone_href()); ?>" class="font-montserrat font-medium text-[16px] text-white/80 leading-[24px] hover:text-[#ff5c00] transition-colors"><?php echo esc_html(my_theme_contact_phone_display()); ?></a>
                    </li>
                    <li class="flex items-center gap-[14px]">
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/footer-email-icon.svg')); ?>" alt="" class="h-7 w-7 shrink-0 object-contain" width="28" height="28" aria-hidden="true">
                        <a href="<?php echo esc_url(my_theme_contact_mailto_href()); ?>" class="font-montserrat font-medium text-[16px] text-white/80 leading-[24px] hover:text-[#ff5c00] transition-colors"><?php echo esc_html(my_theme_contact_email()); ?></a>
                    </li>
                    <li class="flex items-start gap-[14px]">
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/footer-location-icon.svg')); ?>" alt="" class="h-7 w-7 shrink-0 object-contain mt-0.5" width="28" height="28" aria-hidden="true">
                        <span class="font-montserrat font-medium text-[16px] text-white/80 leading-[24px] break-words"><?php echo my_theme_contact_address_html(); ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 pt-[33px] flex flex-col md:flex-row md:items-center justify-between gap-4">
            <p class="font-montserrat font-medium text-[12px] text-white/60 leading-[23px]">&copy; <?php echo esc_html(gmdate('Y')); ?> <?php echo esc_html(get_option('my_theme_footer_copyright_entity', my_theme_organization_name())); ?>. All rights reserved.</p>
            <div class="flex flex-wrap items-center gap-6 md:gap-[32px]">
                <?php
                $bottom_links = get_option('my_theme_footer_bottom_links');
                if (! is_array($bottom_links) || $bottom_links === []) {
                    $bottom_links = function_exists('my_theme_footer_default_bottom_links') ? my_theme_footer_default_bottom_links() : [];
                }
                foreach ($bottom_links as $link) :
                    $href = $link['url'] ?? '';
                    if ($href === '') { continue; }
                    if (strpos($href, 'http') !== 0 && strpos($href, '//') !== 0) {
                        $href = home_url($href);
                    }
                    $logo_url = '';
                    $logo_val = $link['logo'] ?? '';
                    if (is_numeric($logo_val) && (int) $logo_val > 0) {
                        $logo_url = wp_get_attachment_image_url((int) $logo_val, 'thumbnail') ?: '';
                    } elseif (is_string($logo_val) && $logo_val !== '') {
                        $logo_url = $logo_val;
                    }
                ?>
                    <a href="<?php echo esc_url($href); ?>" class="inline-flex items-center gap-2 font-montserrat font-medium text-[12px] text-white/60 leading-[23px] hover:text-white transition-colors"<?php echo (strpos($href, 'http') === 0 && strpos($href, home_url()) !== 0) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
                        <?php if ($logo_url !== '') : ?>
                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($link['label'] ?? ''); ?>" class="h-5 w-auto shrink-0 opacity-60 hover:opacity-100 transition-opacity" loading="lazy" decoding="async">
                        <?php endif; ?>
                        <?php echo esc_html($link['label'] ?? ''); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
