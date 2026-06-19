<?php
/**
 * Case Study Hero block — render.php.
 *
 * Attributes:
 *   client  string  Client / company name (displayed in orange).
 *   intro   string  Optional introductory paragraph below the heading.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$client = (string) ($attributes['client'] ?? 'Case Study');
$intro  = (string) ($attributes['intro']  ?? '');
?>
<section class="relative w-full h-auto lg:h-[400px] hero-gradient-bg">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-8 pb-10 sm:px-6 lg:px-[68px] lg:pt-[66px] lg:pb-0">
        <div class="flex w-full flex-col gap-5 lg:h-[223px] lg:gap-5">
            <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[56px] lg:leading-[64px]">
                <span class="text-white">Case Study: </span>
                <span class="text-[#ff5c00]"><?php echo esc_html($client); ?></span>
            </h1>
            <?php if ($intro !== '') : ?>
                <p class="max-w-[1291px] font-montserrat text-[17px] font-normal leading-[28px] text-white/90 lg:text-[20px] lg:leading-[32px]">
                    <?php echo esc_html($intro); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>
