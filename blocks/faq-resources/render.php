<?php
/**
 * Render callback for goliath/faq-resources.
 *
 * Three-column resource cards: title, description, and "Learn More" link with arrow icon.
 *
 * @package MyCustomTheme
 */

$heading    = $attributes['heading']   ?? 'Explore More Resources';
$card1_title = $attributes['card1Title'] ?? 'How It Works';
$card1_desc  = $attributes['card1Desc']  ?? 'Learn about our 30-minute installation process';
$card1_url   = $attributes['card1Url']   ?? '/how-it-works/';
$card2_title = $attributes['card2Title'] ?? 'Compliance';
$card2_desc  = $attributes['card2Desc']  ?? 'Understand how Goliath™ meets UK safety standards';
$card2_url   = $attributes['card2Url']   ?? '/compliance/';
$card3_title = $attributes['card3Title'] ?? 'Case Studies';
$card3_desc  = $attributes['card3Desc']  ?? 'See real-world results from B&M and others';
$card3_url   = $attributes['card3Url']   ?? '/case-studies/';

$link_arrow = get_theme_file_uri( 'assets/images/icons/hiw-link-arrow.svg' );

$cards = [
    [ $card1_title, $card1_desc, $card1_url ],
    [ $card2_title, $card2_desc, $card2_url ],
    [ $card3_title, $card3_desc, $card3_url ],
];
?>
<section class="w-full bg-[#fafafa]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:h-[433px] lg:pt-[10px] lg:pb-0">
        <div class="flex h-full flex-col items-center justify-center gap-10 lg:gap-[60px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
                <?php echo esc_html( $heading ); ?>
            </h2>
            <div class="grid w-full grid-cols-1 gap-6 lg:grid-cols-3 lg:gap-[24px]">
                <?php foreach ( $cards as $card ) : ?>
                    <article class="bg-[#f9fafb] p-[24px]">
                        <h3 class="font-montserrat text-[20px] font-bold leading-[28px] text-[#020202]"><?php echo esc_html( $card[0] ); ?></h3>
                        <p class="mt-[14px] max-w-[235px] font-roboto text-[16px] leading-[24px] text-[#364153]"><?php echo esc_html( $card[1] ); ?></p>
                        <a href="<?php echo esc_url( home_url( $card[2] ) ); ?>" class="mt-[14px] inline-flex items-center gap-1 font-roboto text-[16px] leading-[24px] text-[#ff5c00]">Learn More <img src="<?php echo esc_url( $link_arrow ); ?>" alt="" class="size-4"></a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
