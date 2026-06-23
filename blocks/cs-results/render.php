<?php
/**
 * Case Study – Results block — render.php.
 *
 * Attributes:
 *   resultsImage  string  URL or attachment ID for the results banner image.
 *   resultsIntro  string  Introductory paragraph below "The Results" heading.
 *   result1Title … result4Title  string  Card headings (card hidden when title is empty).
 *   result1Text  … result4Text   string  Card body text.
 *   warrantyText  string  Text for the dark warranty/closing panel (supports \n\n paragraphs).
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$section_title = (string) ($attributes['sectionTitle'] ?? 'The Results');
$results_image = (string) ($attributes['resultsImage'] ?? '');
$results_intro = (string) ($attributes['resultsIntro'] ?? '');
$warranty_text = (string) ($attributes['warrantyText'] ?? '');

// Resolve image: supports attachment IDs and direct URLs.
if ($results_image !== '' && is_numeric($results_image) && (int) $results_image > 0) {
    $resolved = wp_get_attachment_image_url((int) $results_image, 'full');
    $results_image = $resolved ?: $results_image;
}

// Collect result cards (only include rows where title is non-empty).
$icon_circle_check = get_theme_file_uri('assets/images/icons/Icon-1.svg');
$icon_trend_down   = get_theme_file_uri('assets/images/icons/Icon-3.svg');
$warranty_icon     = get_theme_file_uri('assets/images/icons/case-study-banner-check.svg');

$result_cards = [];
for ($n = 1; $n <= 4; $n++) {
    $card_title = (string) ($attributes["result{$n}Title"] ?? '');
    $card_text  = (string) ($attributes["result{$n}Text"]  ?? '');
    if ($card_title !== '') {
        $result_cards[] = [
            'icon'  => $n === 1 ? $icon_trend_down : $icon_circle_check,
            'title' => $card_title,
            'text'  => $card_text,
        ];
    }
}

if ($results_image === '' && $results_intro === '' && empty($result_cards) && $warranty_text === '') {
    return;
}
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px] lg:pt-[80px] lg:pb-[60px]">
        <?php if ($results_image !== '') : ?>
            <img
                src="<?php echo esc_url($results_image); ?>"
                alt="Case study results"
                class="h-auto w-full object-cover lg:h-[464px]"
                loading="lazy"
                decoding="async"
            >
        <?php endif; ?>

        <div class="mt-10 lg:mt-[60px]">
            <h2 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]"><?php echo esc_html($section_title); ?></h2>

            <?php if ($results_intro !== '') : ?>
                <p class="mt-6 max-w-[1024px] font-roboto text-[18px] font-normal leading-[28px] text-[#364153]">
                    <?php echo esc_html($results_intro); ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($result_cards)) : ?>
                <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
                    <?php foreach ($result_cards as $card) : ?>
                        <div class="bg-[#f9fafb] px-6 pt-6 pb-6">
                            <div class="flex items-start gap-4">
                                <img src="<?php echo esc_url($card['icon']); ?>" alt="" class="size-10 shrink-0 object-contain" width="40" height="40">
                                <div>
                                    <h4 class="font-montserrat text-[16px] font-bold leading-[24px] text-[#020202]"><?php echo esc_html($card['title']); ?></h4>
                                    <?php if ($card['text'] !== '') : ?>
                                        <p class="mt-2 font-roboto text-[16px] font-normal leading-[24px] text-[#364153]"><?php echo esc_html($card['text']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($warranty_text !== '') : ?>
                <div class="mt-6 flex flex-col gap-4 bg-[#020202] px-6 pt-8 pb-8 lg:h-auto lg:flex-row lg:items-start lg:gap-4 lg:px-8">
                    <div class="shrink-0">
                        <img
                            src="<?php echo esc_url($warranty_icon); ?>"
                            alt=""
                            class="h-12 w-12 shrink-0 object-contain lg:h-14 lg:w-14"
                            width="56"
                            height="56"
                        >
                    </div>
                    <div class="space-y-4">
                        <?php
                        $paras = array_filter(array_map('trim', explode("\n\n", $warranty_text)));
                        foreach ($paras as $para) :
                        ?>
                            <p class="font-roboto text-[18px] font-normal leading-[28px] text-white">
                                <?php echo nl2br(esc_html($para)); ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
