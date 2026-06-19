<?php
/**
 * Render: goliath/dark-bar-cta
 *
 * @var array $attributes
 */

$text                  = $attributes['text'] ?? '';
$primary_button_text   = $attributes['primaryButtonText'] ?? '';
$primary_button_url    = $attributes['primaryButtonUrl'] ?? '';
$secondary_button_text = $attributes['secondaryButtonText'] ?? '';
$secondary_button_url  = $attributes['secondaryButtonUrl'] ?? '';

if ( ! $primary_button_text && ! $text ) {
    return;
}
?>
<section class="w-full bg-[#020202]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:flex lg:items-center lg:justify-between lg:gap-12 lg:px-[68px] lg:py-[52px]">
        <?php if ( $text ) : ?>
            <p class="font-roboto text-[17px] leading-[28px] text-white/90 lg:text-[18px] lg:leading-[30px]">
                <?php echo esc_html( $text ); ?>
            </p>
        <?php endif; ?>
        <div class="mt-6 flex shrink-0 flex-wrap gap-4 lg:mt-0">
            <?php if ( $primary_button_text && $primary_button_url ) : ?>
                <a href="<?php echo esc_url( $primary_button_url ); ?>"
                   class="inline-flex h-[52px] items-center justify-center bg-[#1a1a1a] px-8 font-montserrat text-[15px] font-bold text-white ring-1 ring-[#333] transition hover:bg-[#2a2a2a]">
                    <?php echo esc_html( $primary_button_text ); ?>
                </a>
            <?php endif; ?>
            <?php if ( $secondary_button_text && $secondary_button_url ) : ?>
                <a href="<?php echo esc_url( $secondary_button_url ); ?>"
                   class="inline-flex h-[52px] items-center justify-center px-8 font-montserrat text-[15px] font-bold text-white ring-1 ring-white/40 transition hover:ring-white">
                    <?php echo esc_html( $secondary_button_text ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
