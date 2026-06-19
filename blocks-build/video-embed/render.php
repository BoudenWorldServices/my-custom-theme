<?php
/**
 * Render callback for goliath/video-embed.
 *
 * @package MyCustomTheme
 */

$video_url      = $attributes['videoUrl'] ?? '';
$heading        = $attributes['heading'] ?? '';
$body           = $attributes['body'] ?? '';
$callout        = $attributes['callout'] ?? '';
$video_position = $attributes['videoPosition'] ?? 'left';

if ( $video_url === '' && $heading === '' && $body === '' ) {
    return;
}

$section_arrow = get_theme_file_uri( 'assets/images/icons/hiw-link-arrow.svg' );

$video_col_order = $video_position === 'right' ? 'lg:order-2' : 'lg:order-1';
$text_col_order  = $video_position === 'right' ? 'lg:order-1' : 'lg:order-2';
?>
<section class="w-full bg-white">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:gap-[30px] lg:px-[68px] lg:pt-[80px] lg:pb-[70px]">
        <?php if ( $video_url !== '' ) : ?>
            <div class="w-full min-w-0 lg:flex-1 <?php echo esc_attr( $video_col_order ); ?>">
                <video
                    class="aspect-video w-full bg-black object-contain"
                    controls
                    playsinline
                    preload="metadata"
                    aria-label="<?php echo esc_attr( $heading !== '' ? $heading : 'Video' ); ?>"
                >
                    <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
                </video>
            </div>
        <?php endif; ?>

        <div class="w-full <?php echo $video_url !== '' ? 'lg:flex-1' : 'max-w-3xl'; ?> <?php echo esc_attr( $text_col_order ); ?>">
            <?php if ( $heading !== '' ) : ?>
                <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">
                    <?php echo esc_html( $heading ); ?>
                </h2>
            <?php endif; ?>

            <?php foreach ( array_filter( array_map( 'trim', explode( "\n\n", $body ) ) ) as $para ) : ?>
                <p class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#666]">
                    <?php echo nl2br( esc_html( $para ) ); ?>
                </p>
            <?php endforeach; ?>

            <?php if ( $callout !== '' ) : ?>
                <div class="mt-6 flex flex-col gap-3 bg-[#ff6b2c] px-[24px] py-[18px] sm:flex-row sm:items-center sm:justify-between lg:max-w-[631px] lg:px-[39px]">
                    <p class="font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white">
                        <?php echo nl2br( esc_html( $callout ) ); ?>
                    </p>
                    <img src="<?php echo esc_url( $section_arrow ); ?>" alt="" class="size-5 shrink-0 sm:ml-4">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
