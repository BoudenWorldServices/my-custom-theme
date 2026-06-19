<?php
/**
 * Block render: goliath/hp-solution
 *
 * @var array $attributes Block attributes.
 */

$eyebrow       = $attributes['eyebrow']      ?? 'INSTALL ONCE,';
$badge         = $attributes['badge']        ?? 'Forever Protected';
$heading       = $attributes['heading']      ?? 'Protect for lifetime';
$intro         = $attributes['intro']        ?? 'Every warehouse is a high-pressure environment. Tight deadlines, high traffic, and continuous forklift movement increase the risk of damage to warehouse racks.';
$promise_title = $attributes['promiseTitle'] ?? 'Goliath Promise';
$promise_quote = $attributes['promiseQuote'] ?? '"We offer more than repairs. We deliver confidence, safety, and the certainty that your warehouse is protected for life."';

$main_image = $attributes['mainImage'] ?: my_theme_get_image_url('my_theme_hp_solution_img', get_theme_file_uri('assets/images/Homepage/installonce.webp'));
$features   = $attributes['features'] ?? [];
?>

<section id="solution" class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-12 sm:px-6 lg:px-[68px] lg:py-[120px]">
        <div class="relative flex flex-col items-start gap-8 lg:flex-row lg:items-center lg:justify-end lg:gap-[44px]">
            <div class="relative h-[744px] w-full overflow-hidden lg:w-[570px]">
                <img src="<?php echo esc_url($main_image); ?>" alt="Goliath team installing upright repair" class="absolute inset-0 h-full w-full object-cover" loading="lazy" decoding="async">
            </div>

            <div class="w-full lg:w-[635px]">
                <div class="mb-1 flex items-center gap-3">
                    <p class="font-montserrat text-[20px] font-medium uppercase leading-[44px] text-[#020202]"><?php echo esc_html($eyebrow); ?></p>
                    <span class="inline-flex rounded-[6px] bg-[#ff5c00] px-[10px] py-[6px] font-inter text-[12px] font-medium text-white tracking-[-0.1504px]"><?php echo esc_html($badge); ?></span>
                </div>
                <h2 class="font-montserrat text-[36px] font-bold leading-[44px] text-[#020202]"><?php echo esc_html($heading); ?></h2>
                <p class="mt-1 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]"><?php echo esc_html($intro); ?></p>

                <div class="mt-6 space-y-5">
                    <?php foreach ( $features as $feature ) : ?>
                    <div class="border-l border-[#ff5c00] px-[20px]">
                        <h3 class="font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]"><?php echo esc_html( $feature['title'] ); ?></h3>
                        <p class="font-montserrat text-[12px] font-medium leading-[23px] text-[#020202]"><?php echo esc_html( $feature['desc'] ); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="absolute bottom-[26px] left-0 flex h-[286px] w-full max-w-[435px] items-center bg-[#ff5c00] pl-[52px] pr-[32px]">
                <div class="w-[325.5px] text-white">
                    <p class="font-montserrat text-[36px] font-bold leading-[44px]"><?php echo esc_html($promise_title); ?></p>
                    <p class="font-montserrat text-[22px] font-medium leading-[29px]"><?php echo esc_html($promise_quote); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
