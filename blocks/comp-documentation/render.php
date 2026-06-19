<?php
/**
 * Render: goliath/comp-documentation
 *
 * @var array $attributes
 */

$heading  = $attributes['heading']  ?? '';
$subtitle = $attributes['subtitle'] ?? '';
$card1_h3  = $attributes['card1H3']  ?? '';
$card1_sub = $attributes['card1Sub'] ?? '';
$card2_h3  = $attributes['card2H3']  ?? '';
$card2_sub = $attributes['card2Sub'] ?? '';
$card3_h3  = $attributes['card3H3']  ?? '';
$card3_sub = $attributes['card3Sub'] ?? '';
$closing  = $attributes['closing']  ?? '';

$doc_a = get_theme_file_uri( 'assets/images/icons/doc.svg' );
$doc_b = get_theme_file_uri( 'assets/images/icons/badge.svg' );
$doc_c = get_theme_file_uri( 'assets/images/icons/hiw-standards-icon.svg' );

$cards = [
    [ 'icon' => $doc_a, 'h3' => $card1_h3, 'sub' => $card1_sub ],
    [ 'icon' => $doc_b, 'h3' => $card2_h3, 'sub' => $card2_sub ],
    [ 'icon' => $doc_c, 'h3' => $card3_h3, 'sub' => $card3_sub ],
];
?>
<section class="w-full bg-[#020202]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 text-white sm:px-6 lg:px-[68px] lg:py-[80px]">
        <h2 class="font-montserrat text-[32px] font-bold leading-[40px] lg:text-[36px]"><?php echo esc_html( $heading ); ?></h2>
        <p class="mt-4 font-montserrat text-[20px] font-normal leading-[28px]"><?php echo esc_html( $subtitle ); ?></p>
        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <?php foreach ( $cards as $card ) : ?>
                <article class="bg-white/10 px-[24px] py-[24px]">
                    <img src="<?php echo esc_url( $card['icon'] ); ?>" alt="" class="size-10 shrink-0 object-contain brightness-0 invert" width="40" height="40" aria-hidden="true">
                    <h3 class="mt-4 font-montserrat text-[18px] font-bold leading-[27px]"><?php echo esc_html( $card['h3'] ); ?></h3>
                    <p class="mt-2 font-montserrat text-[14px] font-normal leading-[20px]"><?php echo esc_html( $card['sub'] ); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
        <?php if ( $closing ) : ?>
            <p class="mt-8 max-w-[1284px] font-montserrat text-[18px] font-normal leading-[28px] text-white"><?php echo esc_html( $closing ); ?></p>
        <?php endif; ?>
    </div>
</section>
