<?php
/**
 * Render: goliath/contact-info-cards
 *
 * @var array $attributes
 */

$heading               = $attributes['heading'] ?? '';
$use_global            = (bool) ( $attributes['useGlobalContactDetails'] ?? true );

if ( $use_global ) {
    $cards = [
        [
            'icon'     => get_theme_file_uri( 'assets/images/icons/footer-phone-icon.svg' ),
            'title'    => 'Phone',
            'subtitle' => my_theme_contact_phone_display(),
            'href'     => my_theme_contact_phone_href(),
        ],
        [
            'icon'     => get_theme_file_uri( 'assets/images/icons/footer-email-icon.svg' ),
            'title'    => 'Email',
            'subtitle' => my_theme_contact_email(),
            'href'     => my_theme_contact_mailto_href(),
        ],
        [
            'icon'     => get_theme_file_uri( 'assets/images/icons/footer-location-icon.svg' ),
            'title'    => 'Address',
            'subtitle' => strip_tags( my_theme_contact_address_html() ),
            'href'     => '',
        ],
    ];
} else {
    $cards = [];
    for ( $n = 1; $n <= 3; $n++ ) {
        $title = $attributes[ "card{$n}Title" ] ?? '';
        if ( ! $title ) continue;
        $cards[] = [
            'icon'     => $attributes[ "card{$n}Icon" ] ?? '',
            'title'    => $title,
            'subtitle' => $attributes[ "card{$n}Subtitle" ] ?? '',
            'href'     => $attributes[ "card{$n}Href" ] ?? '',
        ];
    }
}

if ( empty( $cards ) ) {
    return;
}
?>
<section class="w-full bg-[#f9fafb]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
        <?php if ( $heading ) : ?>
            <h2 class="mb-10 font-montserrat text-[28px] font-bold leading-[36px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
                <?php echo esc_html( $heading ); ?>
            </h2>
        <?php endif; ?>
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:gap-8">
            <?php foreach ( $cards as $card ) : ?>
                <article class="bg-white px-8 py-8 text-center">
                    <div class="mx-auto flex size-[64px] items-center justify-center bg-[#ff5c00]">
                        <?php if ( $card['icon'] ) : ?>
                            <img src="<?php echo esc_url( $card['icon'] ); ?>" alt="" class="size-8 object-contain" width="32" height="32" aria-hidden="true">
                        <?php else : ?>
                            <span class="text-white text-2xl">📞</span>
                        <?php endif; ?>
                    </div>
                    <h3 class="mt-4 font-montserrat text-[18px] font-semibold leading-[27px] text-[#020202]">
                        <?php echo esc_html( $card['title'] ); ?>
                    </h3>
                    <?php if ( $card['subtitle'] ) : ?>
                        <p class="mt-2 font-roboto text-[16px] text-[#4a5565]">
                            <?php if ( $card['href'] ) : ?>
                                <a class="text-[#ff5c00] hover:underline" href="<?php echo esc_url( $card['href'] ); ?>">
                                    <?php echo esc_html( $card['subtitle'] ); ?>
                                </a>
                            <?php else : ?>
                                <?php echo esc_html( $card['subtitle'] ); ?>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
