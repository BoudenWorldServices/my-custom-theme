<?php
/**
 * Case Study – Inline Quote block — render.php.
 *
 * Attributes:
 *   quote        string  The quote text (required — block is hidden if empty).
 *   attribution  string  Optional attribution line (e.g. "John Smith, Warehouse Manager").
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$quote       = (string) ($attributes['quote']       ?? '');
$attribution = (string) ($attributes['attribution'] ?? '');

if ($quote === '') {
    return;
}
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:py-[60px]">
        <blockquote class="m-0 border-l-4 border-[#ff5c00] pl-8 lg:pl-12">
            <span class="block font-montserrat text-[72px] font-bold leading-none text-[#ff5c00] lg:text-[96px]" aria-hidden="true">"</span>
            <p class="mt-[-20px] font-montserrat text-[20px] font-medium italic leading-[32px] text-[#020202] lg:text-[24px] lg:leading-[36px]">
                <?php echo nl2br(esc_html($quote)); ?>
            </p>
            <?php if ($attribution !== '') : ?>
                <footer class="mt-6 font-montserrat text-[14px] font-bold uppercase tracking-[1px] text-[#666]">
                    &mdash; <?php echo esc_html($attribution); ?>
                </footer>
            <?php endif; ?>
        </blockquote>
    </div>
</section>
