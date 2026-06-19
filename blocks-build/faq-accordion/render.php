<?php
/**
 * Render callback for goliath/faq-accordion.
 *
 * Faithful to the FAQ page accordion: native HTML <details>/<summary> elements
 * with chevron icon, styled exactly as the original template.
 * If no items are defined in the block, falls back to the global FAQ items from
 * my_theme_get_faq_items().
 *
 * @package MyCustomTheme
 */

$items = $attributes['items'] ?? [];

if ( empty( $items ) && function_exists( 'my_theme_get_faq_items' ) ) {
    $raw = my_theme_get_faq_items();
    foreach ( $raw as $raw_item ) {
        $items[] = [
            'question'   => $raw_item['question'] ?? '',
            'answer'     => implode( "\n\n", $raw_item['paragraphs'] ?? [] ),
        ];
    }
}
?>
<section class="w-full bg-white" aria-labelledby="faq-list-heading">
    <div class="mx-auto w-full max-w-[1440px] px-5 pt-10 pb-8 sm:px-6 lg:px-[68px] lg:pt-[80px]">
        <h2 id="faq-list-heading" class="sr-only">Questions and answers</h2>
        <div class="space-y-4">
            <?php foreach ( $items as $item ) :
                $question = $item['question'] ?? '';
                $answer   = $item['answer']   ?? '';
                $paras    = array_filter( array_map( 'trim', explode( "\n\n", $answer ) ) );
                if ( empty( $paras ) ) {
                    $paras = [ $answer ];
                }
            ?>
                <details class="group border border-[#dedfe0] bg-white px-[28px] pb-[1px]">
                    <summary class="flex min-h-[76px] cursor-pointer list-none items-start justify-between gap-4 outline-none [&::-webkit-details-marker]:hidden focus-visible:ring-2 focus-visible:ring-[#ff5c00] focus-visible:ring-offset-2">
                        <h3 class="pt-[24px] font-montserrat text-[18px] font-bold leading-[28px] text-[#020202]"><?php echo esc_html( $question ); ?></h3>
                        <svg class="mt-[26px] size-4 shrink-0 text-[#6b7280] transition-transform group-open:rotate-180" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                            <path d="M6 8l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </summary>
                    <div class="space-y-3 pb-5 pr-6">
                        <?php foreach ( $paras as $para ) : ?>
                            <p class="max-w-[844px] font-roboto text-[14px] leading-[22.75px] text-[#364153]"><?php echo nl2br( esc_html( $para ) ); ?></p>
                        <?php endforeach; ?>
                    </div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
