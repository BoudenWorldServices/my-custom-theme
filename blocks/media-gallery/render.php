<?php
/**
 * Render: goliath/media-gallery
 *
 * @var array $attributes
 */

$columns  = $attributes['columns'] ?? '3';
$height   = $attributes['height'] ?? 'medium';
$caption  = $attributes['caption'] ?? '';

$images = [];
for ( $n = 1; $n <= (int) $columns; $n++ ) {
    $url = $attributes[ "image{$n}" ] ?? '';
    $alt = $attributes[ "image{$n}Alt" ] ?? '';
    if ( $url ) {
        $images[] = [ 'url' => $url, 'alt' => $alt ];
    }
}

if ( empty( $images ) ) {
    return;
}

$heights = [ 'short' => 'h-48 lg:h-56', 'medium' => 'h-56 lg:h-72', 'tall' => 'h-72 lg:h-96' ];
$grid    = $columns === '2' ? 'grid-cols-1 sm:grid-cols-2' : 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3';
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[60px]">
        <div class="grid <?php echo esc_attr( $grid ); ?> gap-4">
            <?php foreach ( $images as $img ) : ?>
                <div class="overflow-hidden <?php echo esc_attr( $heights[ $height ] ?? 'h-56 lg:h-72' ); ?>">
                    <img
                        src="<?php echo esc_url( $img['url'] ); ?>"
                        alt="<?php echo esc_attr( $img['alt'] ); ?>"
                        class="h-full w-full object-cover"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ( $caption ) : ?>
            <p class="mt-4 text-center font-roboto text-[14px] text-[#6b7280]">
                <?php echo esc_html( $caption ); ?>
            </p>
        <?php endif; ?>
    </div>
</section>
