<?php
/**
 * Render: goliath/comp-standards
 *
 * @var array $attributes
 */

$heading    = $attributes['heading']    ?? '';
$p1         = $attributes['p1']         ?? '';
$p2         = $attributes['p2']         ?? '';
$card1_title = $attributes['card1Title'] ?? '';
$card1_body  = $attributes['card1Body']  ?? '';
$card2_title = $attributes['card2Title'] ?? '';
$card2_body  = $attributes['card2Body']  ?? '';
$card3_title = $attributes['card3Title'] ?? '';
$card3_body  = $attributes['card3Body']  ?? '';
$card4_title = $attributes['card4Title'] ?? '';
$card4_body  = $attributes['card4Body']  ?? '';

$icon   = get_theme_file_uri( 'assets/images/icons/why-goliath-bullet-dark.svg' );
$cards  = [
    [ 'title' => $card1_title, 'body' => $card1_body ],
    [ 'title' => $card2_title, 'body' => $card2_body ],
    [ 'title' => $card3_title, 'body' => $card3_body ],
    [ 'title' => $card4_title, 'body' => $card4_body ],
];
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 pb-10 sm:px-6 lg:px-[59px] lg:pb-[80px]">
        <div class="flex flex-col gap-[37px]">
            <h2 class="font-montserrat text-[30px] font-bold leading-[40px] text-[#020202] lg:text-[36px]"><?php echo esc_html( $heading ); ?></h2>
            <div class="font-montserrat text-[18px] font-normal leading-[28px] text-[#364153]">
                <?php if ( $p1 ) : ?><p><?php echo esc_html( $p1 ); ?></p><?php endif; ?>
                <?php if ( $p2 ) : ?><p><?php echo esc_html( $p2 ); ?></p><?php endif; ?>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5">
                <?php foreach ( $cards as $card ) : ?>
                    <article class="flex min-h-0 min-w-0 flex-col rounded-lg bg-[#f9fafb] p-6">
                        <img
                            src="<?php echo esc_url( $icon ); ?>"
                            alt=""
                            class="size-10 shrink-0 object-contain"
                            width="40"
                            height="40"
                            aria-hidden="true"
                        >
                        <h3 class="mt-4 font-montserrat text-[16px] font-bold leading-[24px] text-[#020202] sm:text-[17px] lg:text-[18px] lg:leading-[27px]">
                            <?php echo esc_html( $card['title'] ); ?>
                        </h3>
                        <p class="mt-2 font-roboto text-[14px] font-normal leading-[22px] text-[#364153]">
                            <?php echo esc_html( $card['body'] ); ?>
                        </p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
