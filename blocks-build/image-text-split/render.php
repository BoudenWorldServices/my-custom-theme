<?php
/**
 * Render: goliath/image-text-split
 *
 * @var array $attributes
 */

$image          = $attributes['image'] ?? '';
$image_alt      = $attributes['imageAlt'] ?? '';
$image_position = $attributes['imagePosition'] ?? 'left';
$heading        = $attributes['heading'] ?? '';
$heading_color  = $attributes['headingColor'] ?? 'black';
$body           = $attributes['body'] ?? '';
$callout        = $attributes['callout'] ?? '';
$button_text    = $attributes['buttonText'] ?? '';
$button_url     = $attributes['buttonUrl'] ?? '';
$background     = $attributes['background'] ?? 'white';

if ( ! $image && ! $heading && ! $body ) {
    return;
}

$bg_classes = [ 'white' => 'bg-white', 'gray' => 'bg-[#f9fafb]', 'dark' => 'bg-[#020202]' ];
$heading_colors = [ 'black' => 'text-[#020202]', 'orange' => 'text-[#ff5c00]', 'white' => 'text-white' ];
$body_class = $background === 'dark' ? 'text-white/80' : 'text-[#364153]';

$image_order = $image_position === 'right' ? 'lg:order-2' : 'lg:order-1';
$text_order  = $image_position === 'right' ? 'lg:order-1' : 'lg:order-2';
?>
<section class="w-full <?php echo esc_attr( $bg_classes[ $background ] ?? 'bg-white' ); ?>">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:flex lg:items-center lg:gap-[68px] lg:px-[68px] lg:py-[80px]">
        <?php if ( $image ) : ?>
            <div class="w-full overflow-hidden lg:w-1/2 <?php echo esc_attr( $image_order ); ?>">
                <img
                    src="<?php echo esc_url( $image ); ?>"
                    alt="<?php echo esc_attr( $image_alt ); ?>"
                    class="h-64 w-full object-cover lg:h-[480px]"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        <?php endif; ?>
        <div class="mt-8 w-full lg:mt-0 lg:w-1/2 <?php echo esc_attr( $text_order ); ?>">
            <?php if ( $heading ) : ?>
                <h2 class="font-montserrat text-[28px] font-bold leading-[36px] <?php echo esc_attr( $heading_colors[ $heading_color ] ?? 'text-[#020202]' ); ?> lg:text-[36px] lg:leading-[44px]">
                    <?php echo esc_html( $heading ); ?>
                </h2>
            <?php endif; ?>
            <?php if ( $body ) :
                $paras = preg_split( '/\n{2,}/', trim( $body ) );
                foreach ( (array) $paras as $para ) :
                    if ( trim( $para ) ) :
                ?>
                    <p class="mt-4 font-roboto text-[16px] leading-[26px] <?php echo esc_attr( $body_class ); ?>">
                        <?php echo nl2br( esc_html( trim( $para ) ) ); ?>
                    </p>
                <?php endif; endforeach; endif; ?>
            <?php if ( $callout ) : ?>
                <div class="mt-6 bg-[#ff5c00] px-5 py-3">
                    <p class="font-montserrat text-[15px] font-bold text-white"><?php echo esc_html( $callout ); ?></p>
                </div>
            <?php endif; ?>
            <?php if ( $button_text && $button_url ) : ?>
                <a href="<?php echo esc_url( $button_url ); ?>"
                   class="mt-6 inline-block bg-[#020202] px-8 py-4 font-montserrat text-[15px] font-bold text-white transition hover:bg-[#333]">
                    <?php echo esc_html( $button_text ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
