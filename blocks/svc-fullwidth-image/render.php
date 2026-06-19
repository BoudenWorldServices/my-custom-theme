<?php
$image = $attributes['image'] ?? '';
$alt = esc_attr($attributes['imageAlt'] ?? '');
if (!$image) return;
?>
<section class="relative h-[380px] w-full overflow-hidden lg:h-[604px]">
    <img src="<?php echo esc_url($image); ?>" alt="<?php echo $alt; ?>" class="h-full w-full object-cover">
</section>
