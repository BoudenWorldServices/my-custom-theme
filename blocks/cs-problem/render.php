<?php
/**
 * Case Study – Problem & Tried block — render.php.
 *
 * Attributes:
 *   title           string  Section heading displayed in orange (e.g. case study title).
 *   problemText     string  Main body for "The Problem" column. Paragraphs split on \n\n.
 *   problemCallout  string  Optional bold orange callout text under the problem.
 *   triedText       string  Main body for "What They Tried" column. Paragraphs split on \n\n.
 *   triedCallout    string  Optional bold orange callout text under "What They Tried".
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$title           = (string) ($attributes['title']          ?? '');
$problem_text    = (string) ($attributes['problemText']    ?? '');
$problem_callout = (string) ($attributes['problemCallout'] ?? '');
$tried_text      = (string) ($attributes['triedText']      ?? '');
$tried_callout   = (string) ($attributes['triedCallout']   ?? '');

$show_problem = $problem_text !== '';
$show_tried   = $tried_text   !== '';

if (! $show_problem && ! $show_tried) {
    return;
}
?>
<section class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-8 sm:px-6 lg:px-[68px] lg:pt-[30px] lg:pb-[40px]">
        <div class="border-b border-[#dedfe0] pb-8 lg:pb-[32px]">
            <?php if ($title !== '') : ?>
                <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]">
                    <?php echo esc_html($title); ?>
                </h2>
            <?php endif; ?>

            <div class="mt-6 grid grid-cols-1 gap-8 lg:mt-[24px] lg:grid-cols-2 lg:gap-6">
                <?php if ($show_problem) : ?>
                    <div>
                        <h3 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">The Problem</h3>
                        <?php
                        $paras = array_filter(array_map('trim', explode("\n\n", $problem_text)));
                        foreach ($paras as $para) :
                        ?>
                            <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                                <?php echo nl2br(esc_html($para)); ?>
                            </p>
                        <?php endforeach; ?>
                        <?php if ($problem_callout !== '') : ?>
                            <p class="mt-6 font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]">
                                <?php echo esc_html($problem_callout); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($show_tried) : ?>
                    <div>
                        <h3 class="font-montserrat text-[32px] font-bold leading-[40px] text-[#020202] lg:text-[36px] lg:leading-[44px]">What They Tried</h3>
                        <?php
                        $paras = array_filter(array_map('trim', explode("\n\n", $tried_text)));
                        foreach ($paras as $para) :
                        ?>
                            <p class="mt-4 font-montserrat text-[16px] font-medium leading-[24px] text-[#020202]">
                                <?php echo nl2br(esc_html($para)); ?>
                            </p>
                        <?php endforeach; ?>
                        <?php if ($tried_callout !== '') : ?>
                            <p class="mt-6 font-montserrat text-[16px] font-bold leading-[23px] text-[#ff5c00]">
                                <?php echo esc_html($tried_callout); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
