<?php
/**
 * Render: goliath/resource-cards
 *
 * @var array $attributes
 */

$heading = $attributes['heading'] ?? '';
$cards   = [];

for ( $n = 1; $n <= 4; $n++ ) {
    $title = trim( $attributes[ "card{$n}Title" ] ?? '' );
    $url   = trim( $attributes[ "card{$n}Url" ] ?? '' );
    if ( $title || $url ) {
        $cards[] = [
            'title'       => $title,
            'desc'        => $attributes[ "card{$n}Desc" ] ?? '',
            'button_text' => $attributes[ "card{$n}ButtonText" ] ?? 'Learn More',
            'url'         => $url,
        ];
    }
}

if ( empty( $cards ) ) {
    return;
}

$cols = count( $cards ) >= 3 ? 'sm:grid-cols-2 lg:grid-cols-' . count( $cards ) : 'sm:grid-cols-2';
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
        <?php if ( $heading ) : ?>
            <h2 class="mb-10 font-montserrat text-[28px] font-bold leading-[36px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
                <?php echo esc_html( $heading ); ?>
            </h2>
        <?php endif; ?>
        <div class="grid grid-cols-1 <?php echo esc_attr( $cols ); ?> gap-6">
            <?php foreach ( $cards as $card ) : ?>
                <article class="flex flex-col border border-[#e5e7eb] border-b-4 border-b-[#ff5c00] p-7">
                    <h3 class="font-montserrat text-[18px] font-bold leading-[27px] text-[#020202]">
                        <?php echo esc_html( $card['title'] ); ?>
                    </h3>
                    <?php if ( $card['desc'] ) : ?>
                        <p class="mt-3 grow font-roboto text-[15px] leading-[24px] text-[#364153]">
                            <?php echo esc_html( $card['desc'] ); ?>
                        </p>
                    <?php endif; ?>
                    <?php if ( $card['url'] ) : ?>
                        <a href="<?php echo esc_url( $card['url'] ); ?>"
                           class="mt-5 inline-flex items-center gap-2 font-montserrat text-[14px] font-bold text-[#ff5c00] hover:underline">
                            <?php echo esc_html( $card['button_text'] ); ?> →
                        </a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
