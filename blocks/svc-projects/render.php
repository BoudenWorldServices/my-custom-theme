<?php
/**
 * Block render: goliath/svc-projects
 *
 * @var array $attributes Block attributes.
 */

$description = $attributes['description'] ?? "Whether you're building from scratch, expanding operations, or upgrading your storage systems, GOLIATH™ provides the protection your investment deserves.";
$cta_text    = $attributes['ctaText']     ?? 'Watch the video';
$image       = $attributes['image']       ?: my_theme_get_image_url('my_theme_svc_project_img', get_theme_file_uri('assets/images/Services/foreveryproject.webp'));

$projects = [
    [$attributes['proj1Title'] ?? 'New Warehouse Builds',   $attributes['proj1Desc'] ?? 'Complete warehouse construction projects with GOLIATH™ protection integrated from the ground up.'],
    [$attributes['proj2Title'] ?? 'Warehouse Expansions',   $attributes['proj2Desc'] ?? 'Expanding your facility? Protect new racking installations while maintaining consistency with existing systems.'],
    [$attributes['proj3Title'] ?? 'Racking System Upgrades',$attributes['proj3Desc'] ?? 'Upgrading your storage system? Add GOLIATH™ to ensure your investment is protected for decades.'],
    [$attributes['proj4Title'] ?? 'High-Traffic Zones',     $attributes['proj4Desc'] ?? 'Identify high-risk areas and install proactive protection where forklift traffic is heaviest.'],
];

$arrow = get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg');
?>

<section class="w-full bg-[#fafafa]">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[80px]">
        <div class="flex flex-col gap-10 lg:flex-row lg:items-start lg:gap-[60px]">
            <div class="flex flex-1 flex-col gap-[28px]">
                <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[42px] lg:leading-[52px]">
                    <span>Perfect for </span><span class="text-[#ff5c00]">Every Project</span>
                </h2>
                <p class="max-w-[569px] font-montserrat text-[18px] font-normal leading-[28px] text-[#666]">
                    <?php echo esc_html($description); ?>
                </p>

                <div class="flex flex-col gap-[18px]">
                    <?php foreach ($projects as $p) : ?>
                        <div>
                            <p class="font-montserrat text-[18px] font-bold leading-[27px] text-[#020202]">
                                <?php echo esc_html($p[0]); ?>
                            </p>
                            <p class="mt-2 max-w-[621px] font-montserrat text-[14px] font-normal leading-[22px] text-[#666]">
                                <?php echo esc_html($p[1]); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <a href="<?php echo esc_url(home_url('/videos/explanation-video/')); ?>"
                   class="inline-flex h-[52px] w-full items-center justify-center gap-3 bg-[#ff5c00] px-[26px] font-montserrat text-[14px] font-bold leading-[20px] tracking-[0.35px] text-white transition hover:bg-[#e55200] sm:w-fit">
                    <span class="text-center sm:whitespace-nowrap"><?php echo esc_html($cta_text); ?></span>
                    <img src="<?php echo esc_url($arrow); ?>" alt="" class="size-5 shrink-0">
                </a>
            </div>

            <div class="w-full shrink-0 bg-[#d9d9d9] lg:h-[790px] lg:w-[570px]">
                <img src="<?php echo esc_url($image); ?>" alt="Warehouse racking project with Goliath protection installed" class="h-full w-full object-cover" loading="lazy" decoding="async">
            </div>
        </div>
    </div>
</section>
