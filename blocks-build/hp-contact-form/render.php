<?php
/**
 * Block render: goliath/hp-contact-form
 *
 * @var array $attributes Block attributes.
 */

$heading1       = $attributes['heading1']      ?? 'Get Your Free';
$heading2       = $attributes['heading2']      ?? 'Consultation';
$intro          = $attributes['intro']         ?? 'Lifetime warranty, 30-minute installation, minimal downtime. Find out how Goliath can reduce your racking repair costs.';
$submit_text    = $attributes['submitText']    ?? 'Request Free Assessment';
$privacy        = $attributes['privacyNote']   ?? 'Your information is confidential and secure.';
$trust_bar_text = $attributes['trustBarText']  ?? '100% Client Satisfaction • Save 70% • 30min Installation • Lifetime Warranty';
$why_h3         = $attributes['whyH3']         ?? 'Why Request an Assessment?';
$why_reasons    = $attributes['whyReasons']    ?? ['Free, no-obligation evaluation', 'Response within 1 working day', 'Transparent, honest pricing', 'Expert safety advice'];

$form_status = isset($_GET['form_status']) ? sanitize_key(wp_unslash((string) $_GET['form_status'])) : '';
$form_error  = isset($_GET['form_error'])  ? sanitize_key(wp_unslash((string) $_GET['form_error']))  : '';

$contact_items = [
    [
        'label' => 'Phone',
        'value' => my_theme_contact_phone_display(),
        'href'  => my_theme_contact_phone_href(),
        'icon'  => 'contact-phone-icon.svg',
    ],
    [
        'label' => 'Email',
        'value' => my_theme_contact_email(),
        'href'  => my_theme_contact_mailto_href(),
        'icon'  => 'contact-email-icon.svg',
    ],
    [
        'label' => 'Location',
        'value' => get_option('my_theme_hp_contact_location_label', 'Serving UK & EU'),
        'href'  => '',
        'icon'  => 'contact-location-icon.svg',
    ],
];
?>

<section id="contact" class="relative left-1/2 right-1/2 w-[100dvw] max-w-[100dvw] -ml-[50dvw] -mr-[50dvw] bg-[#ff5c00] lg:bg-[linear-gradient(to_bottom,_#ff5c00_0%,_#ff5c00_58%,_#020202_58%,_#020202_100%)] pt-8 lg:pt-[40px] pb-10 lg:pb-[80px]">
    <div class="px-4 sm:px-6 lg:px-10">
        <div class="bg-white max-w-[1328px] mx-auto px-5 lg:px-[38px] py-5 lg:py-0 lg:h-[96px] mb-8 lg:mb-[51px]">
            <div class="w-full flex flex-col lg:flex-row gap-4 lg:h-full lg:items-center">
                <p class="font-montserrat font-bold text-[16px] text-noir leading-[23px] mb-0"><?php echo esc_html($trust_bar_text); ?></p>
            </div>
        </div>

        <div class="bg-white max-w-[1328px] mx-auto">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-[48px] px-5 sm:px-8 lg:px-[18px] py-6 lg:py-[28px]">

                <div class="lg:w-[445px] shrink-0">
                    <div class="mb-[10px]">
                        <p class="font-montserrat font-bold text-[30px] lg:text-[36px] text-noir leading-[38px] lg:leading-[44px] mb-0"><?php echo esc_html($heading1); ?></p>
                        <p class="font-montserrat font-bold text-[32px] text-noir leading-[40px] sm:text-[40px] sm:leading-[48px] lg:text-[56px] lg:leading-[75px] mb-0"><?php echo esc_html($heading2); ?></p>
                    </div>
                    <div class="w-[80px] h-[4px] bg-[#ff5c00] mb-[27px]"></div>
                    <p class="font-montserrat font-medium text-[16px] text-noir leading-[24px] mb-10 max-w-[417px]">
                        <?php echo esc_html($intro); ?>
                    </p>

                    <div class="flex flex-col gap-[24px] mb-10">
                        <?php foreach ($contact_items as $item) : ?>
                            <div class="flex items-center gap-[16px]">
                                <div class="w-[56px] h-[56px] bg-noir flex items-center justify-center shrink-0">
                                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/' . $item['icon'])); ?>" alt="" class="h-7 w-7 object-contain" aria-hidden="true">
                                </div>
                                <div>
                                    <p class="font-roboto text-[14px] text-[#666] uppercase tracking-[0.35px] leading-[20px] mb-[4px]"><?php echo esc_html($item['label']); ?></p>
                                    <?php if (! empty($item['href'])) : ?>
                                        <p class="mb-0 font-roboto text-[18px] font-semibold leading-[28px] text-noir">
                                            <a class="text-noir underline-offset-2 hover:underline" href="<?php echo esc_url($item['href']); ?>"><?php echo esc_html($item['value']); ?></a>
                                        </p>
                                    <?php else : ?>
                                        <p class="font-roboto font-semibold text-[18px] text-noir leading-[28px] mb-0"><?php echo esc_html($item['value']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="pt-8 px-3 sm:px-6 lg:px-8">
                        <h3 class="font-montserrat font-bold text-[18px] text-noir leading-[27px] mb-4"><?php echo esc_html($why_h3); ?></h3>
                        <ul class="flex flex-col gap-[12px]">
                            <?php foreach ($why_reasons as $reason) : ?>
                                <li class="font-roboto text-[16px] text-[#1a1a1a] leading-[24px]"><?php echo esc_html($reason); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="flex-1 bg-white">
                    <?php if ($form_status === 'success') : ?>
                        <p class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 font-roboto text-[14px] text-green-800">Thanks, your request has been submitted successfully.</p>
                    <?php elseif ($form_status === 'error') : ?>
                        <p class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 font-roboto text-[14px] text-red-700"><?php echo esc_html(my_theme_get_protection_error_message($form_error)); ?></p>
                    <?php endif; ?>
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="pt-[8px]">
                        <input type="hidden" name="action" value="my_theme_contact_form">
                        <?php wp_nonce_field('my_theme_contact_form_submit', 'my_theme_contact_nonce'); ?>
                        <?php my_theme_render_time_trap(); ?>
                        <div class="hidden" aria-hidden="true">
                            <label>Leave this field blank<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                        </div>
                        <div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
                            <label>Fax<input type="text" name="fax_number" tabindex="-1" autocomplete="off" value=""></label>
                        </div>
                        <div class="flex flex-col md:flex-row gap-4 lg:gap-[24px] mb-[24px]">
                            <div class="flex-1">
                                <label for="hp-name" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Your Name *</label>
                                <input type="text" id="hp-name" name="name" autocomplete="name" placeholder="John Smith" required
                                       class="w-full border-b-2 border-black/8 h-[58px] p-[16px] text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors">
                            </div>
                            <div class="flex-1">
                                <label for="hp-company" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Company Name *</label>
                                <input type="text" id="hp-company" name="company" autocomplete="organization" placeholder="Your Company Ltd" required
                                       class="w-full border-b-2 border-black/8 h-[58px] p-[16px] text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors">
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-4 lg:gap-[24px] mb-[24px]">
                            <div class="flex-1">
                                <label for="hp-email" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Email Address *</label>
                                <input type="email" id="hp-email" name="email" autocomplete="email" placeholder="john@company.co.uk" required
                                       class="w-full border-b-2 border-black/8 h-[58px] p-[16px] text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors">
                            </div>
                            <div class="flex-1">
                                <label for="hp-phone" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Phone Number</label>
                                <input type="tel" id="hp-phone" name="phone" autocomplete="tel" placeholder="07XXX XXXXXX"
                                       class="w-full border-b-2 border-black/8 h-[58px] p-[16px] text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors">
                            </div>
                        </div>
                        <div class="mb-[24px]">
                            <label for="hp-uprights" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Number of Damaged Uprights</label>
                            <div class="border-b-2 border-black/8 h-[55px]">
                                <select id="hp-uprights" name="uprights"
                                        class="w-full h-full bg-white text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors appearance-none px-[16px]">
                                    <option value="">Select range</option>
                                    <option value="1-10">1-10</option>
                                    <option value="11-25">11-25</option>
                                    <option value="26-50">26-50</option>
                                    <option value="50+">50+</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-[32px]">
                            <label for="hp-message" class="block font-roboto font-semibold text-[14px] text-noir uppercase tracking-[0.35px] mb-[12px]">Additional Information</label>
                            <textarea id="hp-message" name="message" rows="5" placeholder="Tell us about your requirements..."
                                      class="w-full border-2 border-black/8 h-[156px] p-[16px] text-[16px] focus:border-[#ff5c00] focus:outline-none transition-colors resize-none"></textarea>
                        </div>
                        <?php my_theme_render_turnstile_widget(); ?>
                        <button type="submit"
                                class="w-full bg-[#ff5c00] text-white h-[68px] font-roboto font-semibold text-[18px] text-center hover:bg-orange-light transition-colors">
                            <?php echo esc_html($submit_text); ?>
                        </button>
                        <p class="text-center font-roboto text-[16px] text-[#020202] mt-4"><?php echo esc_html($privacy); ?></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
