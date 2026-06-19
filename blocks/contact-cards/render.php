<?php
/**
 * Render callback for goliath/contact-cards.
 *
 * Three quick-contact cards: Phone, Email, Location.
 * Contact details (phone number, email address, address HTML) are pulled from
 * global theme helper functions so they stay in sync with site settings.
 *
 * @package MyCustomTheme
 */

$phone_subtitle = $attributes['phoneSubtitle'] ?? 'Mon–Fri, 8am–6pm GMT';
$email_subtitle = $attributes['emailSubtitle'] ?? 'We respond within 1 working day';

$icon_phone    = get_theme_file_uri( 'assets/images/icons/footer-phone-icon.svg' );
$icon_email    = get_theme_file_uri( 'assets/images/icons/footer-email-icon.svg' );
$icon_location = get_theme_file_uri( 'assets/images/icons/footer-location-icon.svg' );
?>
<section class="w-full bg-[#f9fafb]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[70px]">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:gap-[32px]">
            <article class="bg-white px-8 py-8 text-center">
                <div class="mx-auto flex size-[64px] items-center justify-center bg-[#ff5c00]">
                    <img src="<?php echo esc_url( $icon_phone ); ?>" alt="" class="size-8 object-contain" width="32" height="32" aria-hidden="true">
                </div>
                <h3 class="mt-4 font-montserrat text-[18px] font-semibold leading-[27px] text-[#020202]">Phone</h3>
                <p class="mt-2 font-roboto text-[16px] text-[#4a5565]"><?php echo esc_html( $phone_subtitle ); ?></p>
                <p class="mt-2 font-roboto text-[16px] text-[#ff5c00]">
                    <a class="text-[#ff5c00] hover:underline" href="<?php echo esc_url( my_theme_contact_phone_href() ); ?>"><?php echo esc_html( my_theme_contact_phone_display() ); ?></a>
                </p>
            </article>
            <article class="bg-white px-8 py-8 text-center">
                <div class="mx-auto flex size-[64px] items-center justify-center bg-[#ff5c00]">
                    <img src="<?php echo esc_url( $icon_email ); ?>" alt="" class="size-8 object-contain" width="32" height="32" aria-hidden="true">
                </div>
                <h3 class="mt-4 font-montserrat text-[18px] font-semibold leading-[27px] text-[#020202]">Email</h3>
                <p class="mt-2 font-roboto text-[16px] text-[#4a5565]"><?php echo esc_html( $email_subtitle ); ?></p>
                <p class="mt-2 font-roboto text-[16px] text-[#ff5c00]">
                    <a class="text-[#ff5c00] hover:underline" href="<?php echo esc_url( my_theme_contact_mailto_href() ); ?>"><?php echo esc_html( my_theme_contact_email() ); ?></a>
                </p>
            </article>
            <article class="bg-white px-8 py-8 text-center">
                <div class="mx-auto flex size-[64px] items-center justify-center bg-[#ff5c00]">
                    <img src="<?php echo esc_url( $icon_location ); ?>" alt="" class="size-8 object-contain" width="32" height="32" aria-hidden="true">
                </div>
                <p class="mt-6 font-roboto text-[16px] leading-[24px] text-[#4a5565]">
                    <?php echo my_theme_contact_address_html(); ?>
                </p>
            </article>
        </div>
    </div>
</section>
