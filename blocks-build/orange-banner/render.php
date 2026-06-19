<?php
/**
 * Render: goliath/orange-banner
 *
 * @var array $attributes
 */

$text       = $attributes['text'] ?? '';
$background = $attributes['background'] ?? 'orange';
$centered   = (bool) ( $attributes['centered'] ?? true );
$size       = $attributes['size'] ?? 'medium';

if ( ! $text ) {
    return;
}

$bg_classes   = [ 'orange' => 'bg-[#ff5c00]', 'dark' => 'bg-[#020202]', 'gray' => 'bg-[#f3f4f6]' ];
$text_classes = [ 'orange' => 'text-white', 'dark' => 'text-white', 'gray' => 'text-[#020202]' ];
$pad_classes  = [ 'small' => 'py-5 lg:py-6', 'medium' => 'py-8 lg:py-10', 'large' => 'py-12 lg:py-16' ];
$font_classes = [ 'small' => 'text-[15px] lg:text-[17px]', 'medium' => 'text-[17px] lg:text-[20px]', 'large' => 'text-[20px] lg:text-[24px]' ];
?>
<section class="w-full <?php echo esc_attr( $bg_classes[ $background ] ?? 'bg-[#ff5c00]' ); ?>">
    <div class="mx-auto w-full max-w-[1440px] px-5 <?php echo esc_attr( $pad_classes[ $size ] ?? 'py-8 lg:py-10' ); ?> sm:px-6 lg:px-[68px]">
        <p class="font-montserrat <?php echo esc_attr( $font_classes[ $size ] ?? '' ); ?> font-bold leading-[1.4] <?php echo esc_attr( $text_classes[ $background ] ?? 'text-white' ); ?> <?php echo $centered ? 'text-center' : ''; ?>">
            <?php echo esc_html( $text ); ?>
        </p>
    </div>
</section>
