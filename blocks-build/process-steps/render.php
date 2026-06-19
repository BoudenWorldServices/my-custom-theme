<?php
/**
 * Render: goliath/process-steps
 *
 * @var array $attributes
 */

$section_heading = $attributes['sectionHeading'] ?? '';
$layout          = $attributes['layout'] ?? 'vertical';

$steps = [];
for ( $n = 1; $n <= 6; $n++ ) {
    $title = trim( $attributes[ "step{$n}Title" ] ?? '' );
    $body  = trim( $attributes[ "step{$n}Body" ] ?? '' );
    if ( $title ) {
        $steps[] = [ 'n' => $n, 'title' => $title, 'body' => $body ];
    }
}

if ( empty( $steps ) ) {
    return;
}

$grid_cols = $layout === 'horizontal' ? 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3' : 'grid-cols-1';
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[80px]">
        <?php if ( $section_heading ) : ?>
            <h2 class="mb-10 font-montserrat text-[28px] font-bold leading-[36px] text-[#020202] lg:text-[36px] lg:leading-[44px]">
                <?php echo esc_html( $section_heading ); ?>
            </h2>
        <?php endif; ?>
        <div class="grid <?php echo esc_attr( $grid_cols ); ?> gap-8">
            <?php foreach ( $steps as $step ) : ?>
                <div class="flex items-start gap-5">
                    <div class="flex size-12 shrink-0 items-center justify-center bg-[#ff5c00] font-montserrat text-[20px] font-bold text-white">
                        <?php echo (int) $step['n']; ?>
                    </div>
                    <div>
                        <h3 class="font-montserrat text-[18px] font-bold leading-[27px] text-[#020202]">
                            <?php echo esc_html( $step['title'] ); ?>
                        </h3>
                        <?php if ( $step['body'] ) : ?>
                            <p class="mt-2 font-roboto text-[16px] leading-[26px] text-[#364153]">
                                <?php echo esc_html( $step['body'] ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
