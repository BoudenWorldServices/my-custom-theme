<?php
/**
 * Render: goliath/service-image-split
 *
 * 2-column image + text split, reusable across service sub-pages.
 *
 * @var array $attributes
 */

$heading        = $attributes['heading']       ?? '';
$body           = $attributes['body']          ?? '';
$image          = $attributes['image']         ?? '';
$image_alt      = $attributes['imageAlt']      ?? '';
$image_position = $attributes['imagePosition'] ?? 'left';

$image_col = '<div class="w-full overflow-hidden bg-[#d9d9d9] lg:h-full lg:w-[532px] lg:shrink-0">';
if ( $image ) {
    $image_col .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $image_alt ) . '" class="h-full w-full object-cover" loading="lazy" decoding="async">';
}
$image_col .= '</div>';

$text_col = '<div class="flex w-full flex-col justify-center px-5 py-10 sm:px-6 lg:max-w-[684px] lg:px-[68px] lg:py-[80px]">';
if ( $heading ) {
    $text_col .= '<h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">' . esc_html( $heading ) . '</h2>';
}
if ( $body ) {
    $text_col .= '<p class="mt-6 font-roboto text-[18px] leading-[28px] text-[#364153]">' . esc_html( $body ) . '</p>';
}
$text_col .= '</div>';
?>
<section class="w-full bg-white">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col <?php echo $image_position === 'right' ? 'lg:flex-row-reverse' : 'lg:flex-row'; ?> items-stretch">
        <?php if ( $image_position === 'left' ) : ?>
            <?php echo $image_col; // phpcs:ignore WordPress.Security.EscapeOutput ?>
            <?php echo $text_col; // phpcs:ignore WordPress.Security.EscapeOutput ?>
        <?php else : ?>
            <?php echo $text_col; // phpcs:ignore WordPress.Security.EscapeOutput ?>
            <?php echo $image_col; // phpcs:ignore WordPress.Security.EscapeOutput ?>
        <?php endif; ?>
    </div>
</section>
