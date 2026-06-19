<?php
/**
 * Render: goliath/comp-concerns
 *
 * @var array $attributes
 */

$heading = $attributes['heading'] ?? '';
$intro   = $attributes['intro']   ?? '';
$c1_h3   = $attributes['c1H3']    ?? '';
$c1_p    = $attributes['c1P']     ?? '';
$c2_h3   = $attributes['c2H3']    ?? '';
$c2_p    = $attributes['c2P']     ?? '';
$c3_h3   = $attributes['c3H3']    ?? '';
$c3_p    = $attributes['c3P']     ?? '';

$badge  = get_theme_file_uri( 'assets/images/icons/badge.svg' );
$shield = get_theme_file_uri( 'assets/images/icons/safe.svg' );

$cards = [
    [ 'icon' => $badge,  'h3' => $c1_h3, 'p' => $c1_p ],
    [ 'icon' => $badge,  'h3' => $c2_h3, 'p' => $c2_p ],
    [ 'icon' => $shield, 'h3' => $c3_h3, 'p' => $c3_p ],
];
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-10 pb-12 sm:px-6 sm:pb-14 lg:px-[68px] lg:pt-[80px] lg:pb-20">
        <div class="text-center">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html( $heading ); ?></h2>
            <p class="mx-auto mt-4 max-w-[800px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]"><?php echo esc_html( $intro ); ?></p>
        </div>
        <div class="mt-[60px] grid grid-cols-1 gap-6 lg:grid-cols-3">
            <?php foreach ( $cards as $card ) : ?>
                <article class="border border-[#e8e8e9] px-[41px] py-[41px] text-center">
                    <img src="<?php echo esc_url( $card['icon'] ); ?>" alt="" class="mx-auto size-12 shrink-0 object-contain" width="48" height="48" aria-hidden="true">
                    <h3 class="mt-4 font-montserrat text-[20px] font-bold leading-[28px] text-[#020202]"><?php echo esc_html( $card['h3'] ); ?></h3>
                    <p class="mt-4 font-montserrat text-[14px] font-normal leading-[22px] text-[#666]"><?php echo esc_html( $card['p'] ); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
