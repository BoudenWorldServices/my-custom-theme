<?php
/**
 * Render callback for goliath/contact-form.
 *
 * Full assessment request form section with sidebar (large text, contact icons,
 * why-request bullets) and the actual contact form.
 * Calls the same form handler and spam-protection helpers as the original template.
 *
 * @package MyCustomTheme
 */

$form_heading  = $attributes['formHeading']  ?? 'Request a Free Warehouse Assessment';
$sidebar_line1 = $attributes['sidebarLine1'] ?? 'Get Your Free';
$sidebar_line2 = $attributes['sidebarLine2'] ?? 'Consultation';
$sidebar_body  = $attributes['sidebarBody']  ?? 'Lifetime warranty, 30-minute installation, minimal downtime. Find out how Goliath can reduce your racking repair costs.';
$why_heading   = $attributes['whyHeading']   ?? 'Why Request an Assessment?';
$bullet1       = $attributes['bullet1']      ?? 'Free, no-obligation evaluation';
$bullet2       = $attributes['bullet2']      ?? 'Response within 1 working day';
$bullet3       = $attributes['bullet3']      ?? 'Transparent, honest pricing';
$bullet4       = $attributes['bullet4']      ?? 'Expert safety advice';

$icon_phone    = get_theme_file_uri( 'assets/images/icons/footer-phone-icon.svg' );
$icon_email    = get_theme_file_uri( 'assets/images/icons/footer-email-icon.svg' );
$icon_location = get_theme_file_uri( 'assets/images/icons/footer-location-icon.svg' );

$form_status = isset( $_GET['form_status'] ) ? sanitize_key( wp_unslash( (string) $_GET['form_status'] ) ) : '';
$form_error  = isset( $_GET['form_error'] )  ? sanitize_key( wp_unslash( (string) $_GET['form_error'] ) )  : '';
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[30px] lg:pb-[70px]">
        <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#ff5c00] lg:text-[36px] lg:leading-[44px]">
            <?php echo esc_html( $form_heading ); ?>
        </h2>
        <div class="mt-8 grid grid-cols-1 gap-10 lg:grid-cols-[445px_1fr] lg:gap-[68px]">
            <aside>
                <p class="font-montserrat text-[36px] font-bold leading-[44px] text-black/90 mb-0"><?php echo esc_html( $sidebar_line1 ); ?></p>
                <p class="font-montserrat text-[32px] font-bold leading-[40px] text-black/90 sm:text-[40px] sm:leading-[48px] lg:text-[56px] lg:leading-[56px] mb-0"><?php echo esc_html( $sidebar_line2 ); ?></p>
                <div class="mt-4 h-1 w-20 bg-[#ff5c00]"></div>
                <p class="mt-6 max-w-[417px] font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                    <?php echo esc_html( $sidebar_body ); ?>
                </p>

                <div class="mt-10 space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="flex size-14 shrink-0 items-center justify-center bg-[#020202]"><img src="<?php echo esc_url( $icon_phone ); ?>" alt="" class="h-7 w-7 object-contain" width="28" height="28" aria-hidden="true"></div>
                        <div>
                            <p class="font-roboto text-[14px] uppercase tracking-[0.35px] text-[#020202]">Phone</p>
                            <p class="font-roboto text-[18px] font-semibold text-[#020202]"><a class="text-[#020202] hover:underline" href="<?php echo esc_url( my_theme_contact_phone_href() ); ?>"><?php echo esc_html( my_theme_contact_phone_display() ); ?></a></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex size-14 shrink-0 items-center justify-center bg-[#020202]"><img src="<?php echo esc_url( $icon_email ); ?>" alt="" class="h-7 w-7 object-contain" width="28" height="28" aria-hidden="true"></div>
                        <div>
                            <p class="font-roboto text-[14px] uppercase tracking-[0.35px] text-[#020202]">Email</p>
                            <p class="font-roboto text-[18px] font-semibold text-[#020202]"><a class="text-[#020202] hover:underline" href="<?php echo esc_url( my_theme_contact_mailto_href() ); ?>"><?php echo esc_html( my_theme_contact_email() ); ?></a></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex size-14 shrink-0 items-center justify-center bg-[#020202]"><img src="<?php echo esc_url( $icon_location ); ?>" alt="" class="h-7 w-7 object-contain" width="28" height="28" aria-hidden="true"></div>
                        <div>
                            <p class="font-roboto text-[14px] uppercase tracking-[0.35px] text-[#020202]">Location</p>
                            <p class="font-roboto text-[18px] font-semibold text-[#020202]">Serving UK &amp; EU</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h4 class="font-montserrat text-[18px] font-bold leading-[27px] text-[#020202]"><?php echo esc_html( $why_heading ); ?></h4>
                    <ul class="mt-2 space-y-2 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                        <li><?php echo esc_html( $bullet1 ); ?></li>
                        <li><?php echo esc_html( $bullet2 ); ?></li>
                        <li><?php echo esc_html( $bullet3 ); ?></li>
                        <li><?php echo esc_html( $bullet4 ); ?></li>
                    </ul>
                </div>
            </aside>

            <div>
                <?php if ( $form_status === 'success' ) : ?>
                    <p class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 font-roboto text-[14px] text-green-800">Thanks, your request has been submitted successfully.</p>
                <?php elseif ( $form_status === 'error' ) : ?>
                    <p class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 font-roboto text-[14px] text-red-700"><?php echo esc_html( my_theme_get_protection_error_message( $form_error ) ); ?></p>
                <?php endif; ?>
                <form class="bg-white px-4 py-2 lg:px-[30px] lg:py-[40px]" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <input type="hidden" name="action" value="my_theme_contact_form">
                    <?php wp_nonce_field( 'my_theme_contact_form_submit', 'my_theme_contact_nonce' ); ?>
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
                        <label class="block"><span class="font-roboto text-[14px] font-semibold uppercase tracking-[0.35px] text-[#141414]">Phone Number</span><input type="tel" name="phone" autocomplete="tel" placeholder="07XXX XXXXXX" pattern="[\+]?[\d\s\-\(\)\.]{7,20}" title="Please enter a valid phone number" class="mt-3 h-[58px] w-full border-0 border-b-2 border-black/10 px-4 font-montserrat text-[16px] focus:outline-none"></label>
                    </div>
                    <label class="mt-8 block"><span class="font-roboto text-[14px] font-semibold uppercase tracking-[0.35px] text-[#141414]">Number of Damaged Uprights</span><select name="uprights" class="mt-3 h-[55px] w-full border-0 border-b-2 border-black/10 px-4 font-montserrat text-[16px] focus:outline-none"><option value="">Select range</option><option value="1-10">1–10</option><option value="11-25">11–25</option><option value="26-50">26–50</option><option value="50+">50+</option></select></label>
                    <label class="mt-8 block"><span class="font-roboto text-[14px] font-semibold uppercase tracking-[0.35px] text-[#141414]">Additional Information</span><textarea name="message" rows="5" placeholder="Tell us about your requirements…" class="mt-3 h-[156px] w-full border-2 border-black/10 p-4 font-montserrat text-[16px] focus:outline-none"></textarea></label>
                    <?php my_theme_render_turnstile_widget(); ?>
                    <p class="mt-6 text-center font-montserrat text-[16px] font-medium text-[#020202]">Your information is confidential and secure.</p>
                    <button type="submit" class="mt-6 h-[68px] w-full bg-[#ff5c00] font-roboto text-[18px] font-semibold leading-[28px] text-white hover:bg-[#e55200]">Request Free Assessment</button>
                </form>
            </div>
        </div>
    </div>
</section>
