<?php
/**
 * Render: goliath/hiw-image-gallery
 *
 * @var array $attributes
 */

$img1 = $attributes['img1'] ?? '';
$img2 = $attributes['img2'] ?? '';
$img3 = $attributes['img3'] ?? '';

if ( ! $img1 ) {
    $img1 = function_exists( 'my_theme_get_image_url' )
        ? my_theme_get_image_url( 'my_theme_hiw_gallery_img1', get_theme_file_uri( 'assets/images/howITworks/process1.webp' ) )
        : get_theme_file_uri( 'assets/images/howITworks/process1.webp' );
}
if ( ! $img2 ) {
    $img2 = function_exists( 'my_theme_get_image_url' )
        ? my_theme_get_image_url( 'my_theme_hiw_gallery_img2', get_theme_file_uri( 'assets/images/howITworks/process2.webp' ) )
        : get_theme_file_uri( 'assets/images/howITworks/process2.webp' );
}
if ( ! $img3 ) {
    $img3 = function_exists( 'my_theme_get_image_url' )
        ? my_theme_get_image_url( 'my_theme_hiw_gallery_img3', get_theme_file_uri( 'assets/images/howITworks/process3.webp' ) )
        : get_theme_file_uri( 'assets/images/howITworks/process3.webp' );
}

$img1_alt = $attributes['img1Alt'] ?? 'Initial stage of upright repair';
$img2_alt = $attributes['img2Alt'] ?? 'Mid-stage Goliath installation on damaged upright';
$img3_alt = $attributes['img3Alt'] ?? 'Completed Goliath repair in warehouse environment';
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-10 lg:px-[68px] lg:pt-[80px]">
        <div class="flex flex-col gap-[24px] sm:flex-row">
            <div class="flex-1 h-[200px] overflow-clip sm:h-[283px]">
                <img
                    src="<?php echo esc_url( $img1 ); ?>"
                    alt="<?php echo esc_attr( $img1_alt ); ?>"
                    class="h-full w-full object-cover"
                    loading="lazy"
                    decoding="async"
                >
            </div>
            <div class="w-full h-[200px] overflow-clip sm:w-[383px] sm:h-[283px] sm:shrink-0">
                <img
                    src="<?php echo esc_url( $img2 ); ?>"
                    alt="<?php echo esc_attr( $img2_alt ); ?>"
                    class="h-full w-full object-cover"
                    loading="lazy"
                    decoding="async"
                >
            </div>
            <div class="flex-1 h-[200px] overflow-clip sm:h-[283px]">
                <img
                    src="<?php echo esc_url( $img3 ); ?>"
                    alt="<?php echo esc_attr( $img3_alt ); ?>"
                    class="h-full w-full object-cover"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </div>
    </div>
</section>
