<?php
/**
 * Render: goliath/legal-document
 *
 * @var array $attributes
 */

$intro_text = $attributes['introText'] ?? '';
$sections   = [];

for ( $n = 1; $n <= 8; $n++ ) {
    $heading = trim( $attributes[ "section{$n}Heading" ] ?? '' );
    $body    = trim( $attributes[ "section{$n}Body" ] ?? '' );
    if ( $heading || $body ) {
        $sections[] = [ 'n' => $n, 'heading' => $heading, 'body' => $body ];
    }
}

if ( ! $intro_text && empty( $sections ) ) {
    return;
}
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[760px] px-5 py-12 sm:px-6 lg:py-[80px]">
        <?php if ( $intro_text ) :
            $paras = preg_split( '/\n{2,}/', trim( $intro_text ) );
            foreach ( (array) $paras as $para ) :
                if ( trim( $para ) ) :
        ?>
            <p class="mb-4 font-roboto text-[16px] leading-[28px] text-[#364153]">
                <?php echo nl2br( esc_html( trim( $para ) ) ); ?>
            </p>
        <?php endif; endforeach; endif; ?>

        <?php foreach ( $sections as $section ) : ?>
            <div class="mt-10">
                <?php if ( $section['heading'] ) : ?>
                    <h2 class="font-montserrat text-[22px] font-bold leading-[30px] text-[#020202] lg:text-[26px] lg:leading-[34px]">
                        <?php echo esc_html( $section['heading'] ); ?>
                    </h2>
                <?php endif; ?>
                <?php if ( $section['body'] ) :
                    $paras = preg_split( '/\n{2,}/', trim( $section['body'] ) );
                    foreach ( (array) $paras as $para ) :
                        if ( trim( $para ) ) :
                ?>
                    <p class="mt-4 font-roboto text-[16px] leading-[28px] text-[#364153]">
                        <?php echo nl2br( esc_html( trim( $para ) ) ); ?>
                    </p>
                <?php endif; endforeach; endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
