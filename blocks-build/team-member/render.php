<?php
/**
 * Render: goliath/team-member
 *
 * @var array $attributes
 */

$photo          = $attributes['photo'] ?? '';
$name           = $attributes['name'] ?? '';
$role           = $attributes['role'] ?? '';
$qualifications = $attributes['qualifications'] ?? '';
$bio            = $attributes['bio'] ?? '';
$background     = $attributes['background'] ?? 'white';

if ( ! $name ) {
    return;
}

$bg_class = $background === 'gray' ? 'bg-[#f9fafb]' : 'bg-white';
?>
<div class="w-full <?php echo esc_attr( $bg_class ); ?> border-t-4 border-[#ff5c00] p-8">
    <div class="flex items-center gap-5">
        <?php if ( $photo ) : ?>
            <div class="size-20 shrink-0 overflow-hidden rounded-full">
                <img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="h-full w-full object-cover">
            </div>
        <?php else : ?>
            <div class="flex size-20 shrink-0 items-center justify-center rounded-full bg-[#e5e7eb] font-montserrat text-[28px] font-bold text-[#9ca3af]">
                <?php echo esc_html( mb_substr( $name, 0, 1 ) ); ?>
            </div>
        <?php endif; ?>
        <div>
            <h3 class="font-montserrat text-[20px] font-bold leading-[28px] text-[#020202]">
                <?php echo esc_html( $name ); ?>
            </h3>
            <?php if ( $role ) : ?>
                <p class="font-roboto text-[15px] font-semibold text-[#ff5c00]">
                    <?php echo esc_html( $role ); ?>
                </p>
            <?php endif; ?>
            <?php if ( $qualifications ) : ?>
                <p class="font-roboto text-[13px] text-[#6b7280]">
                    <?php echo esc_html( $qualifications ); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <?php if ( $bio ) :
        $paras = preg_split( '/\n{2,}/', trim( $bio ) );
        foreach ( (array) $paras as $para ) :
            if ( trim( $para ) ) :
    ?>
        <p class="mt-4 font-roboto text-[15px] leading-[26px] text-[#364153]">
            <?php echo nl2br( esc_html( trim( $para ) ) ); ?>
        </p>
    <?php endif; endforeach; endif; ?>
</div>
