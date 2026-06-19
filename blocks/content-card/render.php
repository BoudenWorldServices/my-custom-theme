<?php
/**
 * Render callback for goliath/content-card.
 *
 * Designed to be used inside a standard WP Columns block, or as a standalone card.
 *
 * @package MyCustomTheme
 */

$heading       = $attributes['heading'] ?? '';
$body          = $attributes['body'] ?? '';
$icon_url      = $attributes['iconUrl'] ?? '';
$background    = $attributes['background'] ?? 'light';
$heading_color = $attributes['headingColor'] ?? 'black';

$bg_class      = match ( $background ) {
    'dark'  => 'bg-[#020202]',
    'white' => 'bg-white',
    default => 'bg-[#f9fafb]',
};

$heading_class = $heading_color === 'orange'
    ? 'font-montserrat text-[16px] font-bold leading-[24px] text-[#ff5c00]'
    : 'font-montserrat text-[16px] font-bold leading-[24px] text-[#020202]';

$body_class = $background === 'dark'
    ? 'mt-2 font-roboto text-[16px] font-normal leading-[24px] text-white/80'
    : 'mt-2 font-roboto text-[16px] font-normal leading-[24px] text-[#364153]';

if ( $heading === '' && $body === '' ) {
    return;
}
?>
<div class="<?php echo esc_attr( $bg_class ); ?> px-6 py-6">
    <?php if ( $icon_url !== '' ) : ?>
        <img
            src="<?php echo esc_url( $icon_url ); ?>"
            alt=""
            class="mb-4 size-10 object-contain"
            width="40"
            height="40"
            loading="lazy"
        >
    <?php endif; ?>
    <?php if ( $heading !== '' ) : ?>
        <h4 class="<?php echo esc_attr( $heading_class ); ?>">
            <?php echo esc_html( $heading ); ?>
        </h4>
    <?php endif; ?>
    <?php if ( $body !== '' ) : ?>
        <p class="<?php echo esc_attr( $body_class ); ?>">
            <?php echo nl2br( esc_html( $body ) ); ?>
        </p>
    <?php endif; ?>
</div>
