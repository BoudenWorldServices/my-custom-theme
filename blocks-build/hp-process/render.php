<?php
/**
 * Block render: goliath/hp-process
 *
 * @var array $attributes Block attributes.
 */

$heading    = $attributes['heading']    ?? 'Installation process';
$subheading = $attributes['subheading'] ?? 'Fast, Easy, Guaranteed';
$accent     = $attributes['accent']     ?? 'Unique solution to end the repetitive cycle of upright damage.';
$body1      = $attributes['body1']      ?? 'From assessment to installation to lifetime protection – we handle everything so you can focus on your business.';
$body2      = $attributes['body2']      ?? 'Our team can install GOLIATH™ in your warehouse in as little as 30 minutes.';

$steps = $attributes['steps'] ?? [];
if ( ! is_array($steps) || empty($steps) ) {
    $steps = [
        ['title' => 'Identify Damaged Upright',    'description' => 'Comprehensive evaluation of your racking system. Our expert team identifies all areas of concern and provides detailed recommendations.'],
        ['title' => 'Apply Fast, Permanent Repair', 'description' => 'Installation takes just 30 minutes per upright. Minimal disruption to your operations – get back to work quickly.'],
        ['title' => 'Lifetime Warranty Activated',  'description' => 'Your repair is covered forever. If any impact damage occurs, we replace the affected parts at no cost to you.'],
        ['title' => 'Peace of Mind Guaranteed',     'description' => 'Rest easy knowing your racking is safe, compliant, and protected. Focus on running your business, not worrying about safety.'],
    ];
}

$step_icons = ['proccess-1.svg', 'proccess-2.svg', 'proccess-3.svg', 'proccess-4.svg'];
?>

<section id="process" class="section-shell py-6 lg:py-10">

    <div class="mb-5">
        <p class="font-montserrat font-bold text-[30px] lg:text-[36px] text-noir leading-[36px] lg:leading-[44px] mb-0"><?php echo esc_html($heading); ?></p>
        <p class="font-montserrat font-medium text-[18px] lg:text-[20px] text-noir leading-[28px] lg:leading-[44px] mb-0"><?php echo esc_html($subheading); ?></p>
    </div>

    <div class="mb-[20px]">
        <p class="font-montserrat font-medium text-[16px] text-[#ff5c00] leading-[24px] mb-0"><?php echo esc_html($accent); ?></p>
        <p class="font-roboto font-medium text-[16px] text-black leading-[24px] mb-0"><?php echo esc_html($body1); ?></p>
        <p class="font-roboto font-medium text-[16px] text-black leading-[24px] mb-0"><?php echo esc_html($body2); ?></p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        <?php foreach ($steps as $i => $step) : ?>
            <div class="border-t border-[#faf5ff] w-full min-h-[232px] py-[24px] lg:py-[30px] flex flex-col gap-[10px]">
                <div class="h-[70px] w-[59px] shrink-0">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icons/' . ($step_icons[$i] ?? 'proccess-1.svg'))); ?>"
                         alt="<?php echo esc_attr(($step['title'] ?? '') . ' icon'); ?>"
                         width="59"
                         height="70"
                         class="block h-full w-full object-contain object-left-top"
                         loading="lazy"
                         decoding="async">
                </div>
                <div class="w-full max-w-[273px]">
                    <h3 class="font-montserrat font-bold text-[16px] text-noir leading-[23px] mb-0"><?php echo esc_html($step['title'] ?? ''); ?></h3>
                    <p class="font-montserrat font-medium text-[12px] text-noir leading-[23px]"><?php echo esc_html($step['description'] ?? $step['desc'] ?? ''); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>
