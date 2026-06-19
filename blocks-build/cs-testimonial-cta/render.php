<?php
/**
 * Case Study – Testimonial CTA block — render.php.
 *
 * Attributes:
 *   client       string  Client name used in "A Word from {client}" heading.
 *   quote        string  Testimonial quote text. When non-empty the testimonial layout is shown.
 *   attribution  string  Optional attribution line (name, role) shown below the quote.
 *   ctaText      string  CTA button label. Defaults to "Get Similar Results".
 *   ctaUrl       string  CTA button URL. Defaults to "/contact/".
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$client      = (string) ($attributes['client']      ?? '');
$quote       = (string) ($attributes['quote']       ?? '');
$attribution = (string) ($attributes['attribution'] ?? '');
$cta_text    = (string) ($attributes['ctaText']     ?? 'Get Similar Results');
$cta_url     = (string) ($attributes['ctaUrl']      ?? '/contact/');

if ($cta_text === '') {
    $cta_text = 'Get Similar Results';
}
if ($cta_url === '') {
    $cta_url = '/contact/';
}

$cta_arrow = get_theme_file_uri('assets/images/icons/cta-arrow-right.svg');
$show_testimonial = $quote !== '';
?>
<section class="w-full bg-[#ff5c00]">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col items-center gap-3 px-5 py-14 text-center sm:px-6 lg:px-[267px] lg:py-[80px]">
        <?php if ($show_testimonial) : ?>
            <h2 class="font-montserrat text-[22px] font-bold leading-[32px] text-white lg:text-[24px]">
                <?php
                if ($client !== '') {
                    echo 'A Word from ' . esc_html($client);
                } else {
                    echo 'What Our Client Said';
                }
                ?>
            </h2>
            <p class="max-w-[1146px] font-montserrat text-[18px] italic leading-[28px] text-white">
                <?php echo esc_html($quote); ?>
            </p>
            <?php if ($attribution !== '') : ?>
                <p class="max-w-[547px] font-roboto text-[16px] font-bold leading-[24px] text-white">
                    &mdash; <?php echo esc_html($attribution); ?>
                </p>
            <?php endif; ?>
        <?php else : ?>
            <h2 class="font-montserrat text-[22px] font-bold leading-[32px] text-white lg:text-[24px]">
                Ready to Get Similar Results?
            </h2>
        <?php endif; ?>

        <a
            href="<?php echo esc_url($cta_url); ?>"
            class="mt-3 inline-flex h-[60px] w-full max-w-[320px] items-center justify-center bg-[#020202] px-[32px] font-roboto text-[16px] font-semibold leading-[24px] text-white hover:bg-[#1a1a1a] sm:w-auto sm:max-w-none"
        >
            <span><?php echo esc_html($cta_text); ?></span>
            <img src="<?php echo esc_url($cta_arrow); ?>" alt="" class="ml-3 size-5">
        </a>
    </div>
</section>
