<?php
/**
 * Render: goliath/hiw-uk-standards
 *
 * @var array $attributes
 */

$heading    = $attributes['heading'] ?? 'Designed to Meet UK Standards';
$intro1     = $attributes['intro1']  ?? '';
$intro2     = $attributes['intro2']  ?? '';
$closing    = $attributes['closing'] ?? '';

$cards = [
    [ 'title' => $attributes['card1Title'] ?? 'BS EN 15512:2020 + A1:2022', 'body' => $attributes['card1Body'] ?? '' ],
    [ 'title' => $attributes['card2Title'] ?? 'BS EN 15635:2008',           'body' => $attributes['card2Body'] ?? '' ],
    [ 'title' => $attributes['card3Title'] ?? 'SEMA code of practice',      'body' => $attributes['card3Body'] ?? '' ],
    [ 'title' => $attributes['card4Title'] ?? 'SEMA code of practice',      'body' => $attributes['card4Body'] ?? '' ],
];

$check_icon = get_theme_file_uri( 'assets/images/icons/why-goliath-bullet-dark.svg' );
?>
<section class="w-full bg-white" aria-labelledby="uk-standards-heading">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 lg:px-[68px] lg:pt-[80px] lg:pb-[60px]">
        <div class="flex flex-col gap-6 lg:gap-8">
            <h2 id="uk-standards-heading" class="font-montserrat text-[28px] font-bold leading-[40px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html( $heading ); ?>
            </h2>
            <?php if ( $intro1 ) : ?>
                <p class="max-w-[896px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html( $intro1 ); ?>
                </p>
            <?php endif; ?>
            <?php if ( $intro2 ) : ?>
                <p class="max-w-[896px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html( $intro2 ); ?>
                </p>
            <?php endif; ?>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5">
                <?php foreach ( $cards as $card ) : ?>
                    <div class="flex min-h-0 min-w-0 flex-col rounded-lg bg-[#f9fafb] p-6">
                        <img
                            src="<?php echo esc_url( $check_icon ); ?>"
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
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if ( $closing ) : ?>
                <p class="max-w-[896px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html( $closing ); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>
