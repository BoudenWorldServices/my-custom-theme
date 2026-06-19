<?php
/*
Template Name: Contact Page
*/
get_header();
// If this page has Gutenberg blocks, render the block editor content.
// Otherwise the existing template below is used unchanged.
$_current_page = get_queried_object();
if ($_current_page instanceof WP_Post && has_blocks($_current_page)) {
    setup_postdata($_current_page);
    echo "<main class=\"w-full bg-white overflow-x-hidden\">";
    the_content();
    echo "</main>";
    wp_reset_postdata();
    get_footer();
    return;
}

$assets = [
    'photo' => my_theme_get_image_url('my_theme_cp_bottom_image', get_theme_file_uri('assets/images/contact/experts.webp')),
    'card_phone' => get_theme_file_uri('assets/images/icons/footer-phone-icon.svg'),
    'card_email' => get_theme_file_uri('assets/images/icons/footer-email-icon.svg'),
    'card_location' => get_theme_file_uri('assets/images/icons/footer-location-icon.svg'),
    'contact_phone' => get_theme_file_uri('assets/images/icons/footer-phone-icon.svg'),
    'contact_email' => get_theme_file_uri('assets/images/icons/footer-email-icon.svg'),
    'contact_location' => get_theme_file_uri('assets/images/icons/footer-location-icon.svg'),
    'tick' => get_theme_file_uri('assets/images/icons/Icon-1.svg'),
];
?>

<main class="w-full bg-white overflow-x-hidden">
    <!-- Hero -->
    <section
        class="relative w-full h-auto lg:h-[400px] hero-gradient-bg"
    >
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
            <div class="flex w-full flex-col gap-4 lg:h-[223px] lg:justify-between lg:gap-0">
                <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                    <?php
                    $cp_h1 = get_option('my_theme_cp_hero_h1', 'Get in Touch');
                    $cp_h1_parts = explode(' ', $cp_h1, 2);
                    ?>
                    <span class="text-white"><?php echo esc_html($cp_h1_parts[0]); ?> </span><span class="text-[#ff5c00]"><?php echo esc_html($cp_h1_parts[1] ?? ''); ?></span>
                </h1>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    <?php echo esc_html(get_option('my_theme_cp_hero_desc', 'Request a free warehouse racking assessment from our SEMA-qualified team. We respond within one working day and provide transparent, no-obligation pricing.')); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Contact quick cards -->
    <section class="w-full bg-[#f9fafb]">
        <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[70px]">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:gap-[32px]">
                <article class="bg-white px-8 py-8 text-center">
                    <div class="mx-auto flex size-[64px] items-center justify-center bg-[#ff5c00]">
                        <img src="<?php echo esc_url($assets['card_phone']); ?>" alt="" class="size-8 object-contain" width="32" height="32" aria-hidden="true">
                    </div>
                    <h3 class="mt-4 font-montserrat text-[18px] font-semibold leading-[27px] text-[#020202]">Phone</h3>
                    <p class="mt-2 font-roboto text-[16px] text-[#4a5565]"><?php echo esc_html(get_option('my_theme_cp_phone_subtitle', 'Mon-Fri, 8am-6pm GMT')); ?></p>
                    <p class="mt-2 font-roboto text-[16px] text-[#ff5c00]">
                        <a class="text-[#ff5c00] hover:underline" href="<?php echo esc_url(my_theme_contact_phone_href()); ?>"><?php echo esc_html(my_theme_contact_phone_display()); ?></a>
                    </p>
                </article>
                <article class="bg-white px-8 py-8 text-center">
                    <div class="mx-auto flex size-[64px] items-center justify-center bg-[#ff5c00]">
                        <img src="<?php echo esc_url($assets['card_email']); ?>" alt="" class="size-8 object-contain" width="32" height="32" aria-hidden="true">
                    </div>
                    <h3 class="mt-4 font-montserrat text-[18px] font-semibold leading-[27px] text-[#020202]">Email</h3>
                    <p class="mt-2 font-roboto text-[16px] text-[#4a5565]"><?php echo esc_html(get_option('my_theme_cp_email_subtitle', 'We respond within 1 working day')); ?></p>
                    <p class="mt-2 font-roboto text-[16px] text-[#ff5c00]">
                        <a class="text-[#ff5c00] hover:underline" href="<?php echo esc_url(my_theme_contact_mailto_href()); ?>"><?php echo esc_html(my_theme_contact_email()); ?></a>
                    </p>
                </article>
                <article class="bg-white px-8 py-8 text-center">
                    <div class="mx-auto flex size-[64px] items-center justify-center bg-[#ff5c00]">
                        <img src="<?php echo esc_url($assets['card_location']); ?>" alt="" class="size-8 object-contain" width="32" height="32" aria-hidden="true">
                    </div>
                    <p class="mt-6 font-roboto text-[16px] leading-[24px] text-[#4a5565]">
                        <?php echo my_theme_contact_address_html(); ?>
                    </p>
                </article>
            </div>
        </div>
    </section>

    <!-- Form section -->
    <section class="w-full bg-white">
        <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[30px] lg:pb-[70px]">
            <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00] lg:text-[36px] lg:leading-[44px]">
                <?php echo esc_html(get_option('my_theme_cp_form_h2', 'Request a Free Warehouse Assessment')); ?>
            </h2>
            <div class="mt-8 grid grid-cols-1 gap-10 lg:grid-cols-[445px_1fr] lg:gap-[68px]">
                <aside>
                    <p class="font-montserrat text-[36px] font-bold leading-[44px] text-black/90 mb-0"><?php echo esc_html(get_option('my_theme_cp_sidebar_large1', 'Get Your Free')); ?></p>
                    <p class="font-montserrat text-[32px] font-bold leading-[40px] text-black/90 sm:text-[40px] sm:leading-[48px] lg:text-[56px] lg:leading-[56px] mb-0"><?php echo esc_html(get_option('my_theme_cp_sidebar_large2', 'Consultation')); ?></p>
                    <div class="mt-4 h-1 w-20 bg-[#ff5c00]"></div>
                    <p class="mt-6 max-w-[417px] font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                        <?php echo esc_html(get_option('my_theme_cp_sidebar_body', 'Lifetime warranty, 30-minute installation, minimal downtime. Find out how Goliath can reduce your racking repair costs.')); ?>
                    </p>

                    <div class="mt-10 space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="flex size-14 shrink-0 items-center justify-center bg-[#020202]"><img src="<?php echo esc_url($assets['contact_phone']); ?>" alt="" class="h-7 w-7 object-contain" width="28" height="28" aria-hidden="true"></div>
                            <div><p class="font-roboto text-[14px] uppercase tracking-[0.35px] text-[#020202]">Phone</p><p class="font-roboto text-[18px] font-semibold text-[#020202]"><a class="text-[#020202] hover:underline" href="<?php echo esc_url(my_theme_contact_phone_href()); ?>"><?php echo esc_html(my_theme_contact_phone_display()); ?></a></p></div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex size-14 shrink-0 items-center justify-center bg-[#020202]"><img src="<?php echo esc_url($assets['contact_email']); ?>" alt="" class="h-7 w-7 object-contain" width="28" height="28" aria-hidden="true"></div>
                            <div><p class="font-roboto text-[14px] uppercase tracking-[0.35px] text-[#020202]">Email</p><p class="font-roboto text-[18px] font-semibold text-[#020202]"><a class="text-[#020202] hover:underline" href="<?php echo esc_url(my_theme_contact_mailto_href()); ?>"><?php echo esc_html(my_theme_contact_email()); ?></a></p></div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex size-14 shrink-0 items-center justify-center bg-[#020202]"><img src="<?php echo esc_url($assets['contact_location']); ?>" alt="" class="h-7 w-7 object-contain" width="28" height="28" aria-hidden="true"></div>
                            <div><p class="font-roboto text-[14px] uppercase tracking-[0.35px] text-[#020202]">Location</p><p class="font-roboto text-[18px] font-semibold text-[#020202]">Serving UK &amp; EU</p></div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-montserrat text-[18px] font-bold leading-[27px] text-[#020202]"><?php echo esc_html(get_option('my_theme_cp_sidebar_why_heading', 'Why Request an Assessment?')); ?></h4>
                        <ul class="mt-2 space-y-2 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                            <li><?php echo esc_html(get_option('my_theme_cp_sidebar_bullet1', 'Free, no-obligation evaluation')); ?></li>
                            <li><?php echo esc_html(get_option('my_theme_cp_sidebar_bullet2', 'Response within 1 working day')); ?></li>
                            <li><?php echo esc_html(get_option('my_theme_cp_sidebar_bullet3', 'Transparent, honest pricing')); ?></li>
                            <li><?php echo esc_html(get_option('my_theme_cp_sidebar_bullet4', 'Expert safety advice')); ?></li>
                        </ul>
                    </div>
                </aside>

                <?php $form_status = isset($_GET['form_status']) ? sanitize_key(wp_unslash((string) $_GET['form_status'])) : ''; ?>
                <?php $form_error = isset($_GET['form_error']) ? sanitize_key(wp_unslash((string) $_GET['form_error'])) : ''; ?>
                <?php if ($form_status === 'success') : ?>
                    <p class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 font-roboto text-[14px] text-green-800">Thanks, your request has been submitted successfully.</p>
                <?php elseif ($form_status === 'error') : ?>
                    <p class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 font-roboto text-[14px] text-red-700"><?php echo esc_html(my_theme_get_protection_error_message($form_error)); ?></p>
                <?php endif; ?>
                <form class="bg-white px-4 py-2 lg:px-[30px] lg:py-[40px]" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                    <input type="hidden" name="action" value="my_theme_contact_form">
                    <?php wp_nonce_field('my_theme_contact_form_submit', 'my_theme_contact_nonce'); ?>
                    <?php my_theme_render_time_trap(); ?>
                    <div class="hidden" aria-hidden="true">
                        <label>Leave this field blank
                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                        </label>
                    </div>
                    <div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
                        <label>Fax
                            <input type="text" name="fax_number" tabindex="-1" autocomplete="off" value="">
                        </label>
                    </div>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <label class="block"><span class="font-roboto text-[14px] font-semibold uppercase tracking-[0.35px] text-[#141414]">Your Name *</span><input type="text" name="name" autocomplete="name" placeholder="John Smith" required class="mt-3 h-[58px] w-full border-0 border-b-2 border-black/10 px-4 font-montserrat text-[16px] focus:outline-none"></label>
                        <label class="block"><span class="font-roboto text-[14px] font-semibold uppercase tracking-[0.35px] text-[#141414]">Company Name *</span><input type="text" name="company" autocomplete="organization" placeholder="Your Company Ltd" required class="mt-3 h-[58px] w-full border-0 border-b-2 border-black/10 px-4 font-montserrat text-[16px] focus:outline-none"></label>
                        <label class="block"><span class="font-roboto text-[14px] font-semibold uppercase tracking-[0.35px] text-[#141414]">Email Address *</span><input type="email" name="email" autocomplete="email" placeholder="john@company.co.uk" required class="mt-3 h-[58px] w-full border-0 border-b-2 border-black/10 px-4 font-montserrat text-[16px] focus:outline-none"></label>
                        <label class="block"><span class="font-roboto text-[14px] font-semibold uppercase tracking-[0.35px] text-[#141414]">Phone Number</span><input type="tel" name="phone" autocomplete="tel" placeholder="07XXX XXXXXX" class="mt-3 h-[58px] w-full border-0 border-b-2 border-black/10 px-4 font-montserrat text-[16px] focus:outline-none"></label>
                    </div>
                    <label class="mt-8 block"><span class="font-roboto text-[14px] font-semibold uppercase tracking-[0.35px] text-[#141414]">Number of Damaged Uprights</span><select name="uprights" class="mt-3 h-[55px] w-full border-0 border-b-2 border-black/10 px-4 font-montserrat text-[16px] focus:outline-none"><option value="">Select range</option><option value="1-10">1-10</option><option value="11-25">11-25</option><option value="26-50">26-50</option><option value="50+">50+</option></select></label>
                    <label class="mt-8 block"><span class="font-roboto text-[14px] font-semibold uppercase tracking-[0.35px] text-[#141414]">Additional Information</span><textarea name="message" rows="5" placeholder="Tell us about your requirements..." class="mt-3 h-[156px] w-full border-2 border-black/10 p-4 font-montserrat text-[16px] focus:outline-none"></textarea></label>
                    <?php my_theme_render_turnstile_widget(); ?>
                    <p class="mt-6 text-center font-montserrat text-[16px] font-medium text-[#020202]">Your information is confidential and secure.</p>
                    <button type="submit" class="mt-6 h-[68px] w-full bg-[#ff5c00] font-roboto text-[18px] font-semibold leading-[28px] text-white hover:bg-[#e55200]">Request Free Assessment</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Bottom info -->
    <section class="w-full bg-[#fafafa]">
        <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:gap-[60px] lg:px-[68px] lg:pt-[80px] lg:pb-[56px]">
            <div class="w-full overflow-hidden bg-[#d9d9d9] lg:h-[438px] lg:w-[609px] lg:shrink-0">
                <img src="<?php echo esc_url($assets['photo']); ?>" alt="Goliath team on site for a warehouse racking assessment" class="h-full w-full object-cover" loading="lazy" decoding="async">
            </div>
            <div class="w-full lg:w-[619px]">
                <p class="font-roboto text-[16px] font-normal leading-[26px] text-[#364153]">
                    <?php echo esc_html(get_option('my_theme_cp_bottom_desc', 'Our expert team will visit your facility, assess your racking condition, identify damage and risk areas, and provide a detailed quote with no obligation. Most assessments are completed within 48 hours of booking.')); ?>
                </p>
                <ul class="mt-10 space-y-6">
                    <?php
                    $benefits = [
                        [get_option('my_theme_cp_benefit1_title', 'Free Site Survey'), get_option('my_theme_cp_benefit1_subtitle', 'Complete damage assessment and risk mapping')],
                        [get_option('my_theme_cp_benefit2_title', 'Detailed Quote'), get_option('my_theme_cp_benefit2_subtitle', 'Transparent pricing with no hidden costs')],
                        [get_option('my_theme_cp_benefit3_title', 'Expert Recommendations'), get_option('my_theme_cp_benefit3_subtitle', 'Tailored solutions for your specific needs')],
                        [get_option('my_theme_cp_benefit4_title', 'Fast Response'), get_option('my_theme_cp_benefit4_subtitle', 'Emergency installations within 48 hours')],
                    ];
                    foreach ($benefits as $b) :
                        ?>
                        <li class="flex items-start gap-4">
                            <img src="<?php echo esc_url($assets['tick']); ?>" alt="" class="mt-0.5 size-8 shrink-0 object-contain" width="32" height="32" aria-hidden="true">
                            <div>
                                <p class="font-montserrat text-[18px] font-semibold leading-[27px] text-[#020202]"><?php echo esc_html($b[0]); ?></p>
                                <p class="font-roboto text-[16px] leading-[24px] text-[#4a5565]"><?php echo esc_html($b[1]); ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
