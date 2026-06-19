<?php
/**
 * Render: goliath/legal-content
 *
 * @var array $attributes
 */

$content = $attributes['content'] ?? '';

if ( ! $content ) {
    return;
}
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[80px]">
        <div class="max-w-[1100px] space-y-8">
            <?php echo wp_kses_post( $content ); ?>
        </div>
    </div>
</section>
