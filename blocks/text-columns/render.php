<?php
/**
 * Render callback for goliath/text-columns.
 *
 * @package MyCustomTheme
 */

$section_title = $attributes['sectionTitle'] ?? '';
$col1_heading  = $attributes['col1Heading'] ?? '';
$col1_body     = $attributes['col1Body'] ?? '';
$col1_callout  = $attributes['col1Callout'] ?? '';
$col2_heading  = $attributes['col2Heading'] ?? '';
$col2_body     = $attributes['col2Body'] ?? '';
$col2_callout  = $attributes['col2Callout'] ?? '';
$show_divider  = $attributes['showDivider'] ?? true;

$has_left  = $col1_heading !== '' || $col1_body !== '';
$has_right = $col2_heading !== '' || $col2_body !== '';

if ( ! $has_left && ! $has_right && $section_title === '' ) {
    return;
}

$divider_class = $show_divider ? 'border-b border-[#dedfe0] pb-8 lg:pb-[32px]' : '';
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-8 sm:px-6 lg:px-[68px] lg:pt-[30px] lg:pb-[40px]">
        <div class="<?php echo esc_attr( $divider_class ); ?>">
            <?php if ( $section_title !== '' ) : ?>
                <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">
                    <?php echo esc_html( $section_title ); ?>
                </h2>
            <?php endif; ?>

            <div class="mt-6 grid grid-cols-1 gap-8 lg:mt-[24px] <?php echo ( $has_left && $has_right ) ? 'lg:grid-cols-2 lg:gap-6' : ''; ?>">
                <?php if ( $has_left ) : ?>
                    <div>
                        <?php if ( $col1_heading !== '' ) : ?>
                            <h3 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
                                <?php echo esc_html( $col1_heading ); ?>
                            </h3>
                        <?php endif; ?>
                        <?php foreach ( array_filter( array_map( 'trim', explode( "\n\n", $col1_body ) ) ) as $para ) : ?>
                            <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                                <?php echo nl2br( esc_html( $para ) ); ?>
                            </p>
                        <?php endforeach; ?>
                        <?php if ( $col1_callout !== '' ) : ?>
                            <p class="mt-6 font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]">
                                <?php echo esc_html( $col1_callout ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ( $has_right ) : ?>
                    <div>
                        <?php if ( $col2_heading !== '' ) : ?>
                            <h3 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
                                <?php echo esc_html( $col2_heading ); ?>
                            </h3>
                        <?php endif; ?>
                        <?php foreach ( array_filter( array_map( 'trim', explode( "\n\n", $col2_body ) ) ) as $para ) : ?>
                            <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                                <?php echo nl2br( esc_html( $para ) ); ?>
                            </p>
                        <?php endforeach; ?>
                        <?php if ( $col2_callout !== '' ) : ?>
                            <p class="mt-6 font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]">
                                <?php echo esc_html( $col2_callout ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
