<?php
/**
 * Case Study – Solution block — render.php.
 *
 * Attributes:
 *   video           string  Video URL or theme-relative filename (e.g. goliath-demo.mp4).
 *                           Empty string hides the video column.
 *   solutionText    string  Solution body paragraphs, split on \n\n.
 *   solutionCallout string  Optional orange callout box text.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

$section_title    = (string) ($attributes['sectionTitle']    ?? 'The Solution: Goliath™');
$video_raw        = (string) ($attributes['video']           ?? '');
$solution_text    = (string) ($attributes['solutionText']    ?? '');
$solution_callout = (string) ($attributes['solutionCallout'] ?? '');

// Resolve video value to a full URL (mirrors my_theme_resolve_case_study_video).
$video_uri = '';
if ($video_raw !== '') {
    if (
        str_starts_with($video_raw, 'http://') ||
        str_starts_with($video_raw, 'https://') ||
        str_starts_with($video_raw, '/')
    ) {
        $video_uri = $video_raw;
    } else {
        $video_uri = get_theme_file_uri('assets/videos/' . ltrim($video_raw, '/'));
    }
}

$has_video = $video_uri !== '';

$section_arrow = get_theme_file_uri('assets/images/icons/hiw-link-arrow.svg');

if (! $has_video && $solution_text === '' && $solution_callout === '') {
    return;
}
?>
<section class="w-full bg-white">
    <div class="mx-auto flex w-full max-w-[1440px] flex-col gap-8 px-5 py-10 sm:px-6 lg:flex-row lg:items-start lg:gap-[30px] lg:px-[68px] lg:pt-[80px] lg:pb-[70px]">
        <?php if ($has_video) : ?>
            <div class="w-full min-w-0 lg:flex-1">
                <video
                    class="aspect-video w-full bg-black object-contain"
                    controls
                    playsinline
                    preload="metadata"
                    aria-label="Solution video"
                >
                    <source src="<?php echo esc_url($video_uri); ?>" type="video/mp4">
                </video>
            </div>
        <?php endif; ?>

        <div class="w-full <?php echo $has_video ? 'lg:flex-1' : 'max-w-3xl'; ?>">
            <h2 class="font-montserrat text-[34px] font-bold leading-[44px] text-[#ff5c00] lg:text-[42px] lg:leading-[52px]"><?php echo esc_html($section_title); ?></h2>

            <?php if ($solution_text !== '') : ?>
                <?php
                $paras = array_filter(array_map('trim', explode("\n\n", $solution_text)));
                foreach ($paras as $para) :
                ?>
                    <p class="mt-6 font-montserrat text-[16px] font-medium leading-[24px] text-[#666]">
                        <?php echo nl2br(esc_html($para)); ?>
                    </p>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($solution_callout !== '') : ?>
                <div class="mt-6 flex flex-col gap-3 bg-[#ff6b2c] px-[24px] py-[18px] sm:flex-row sm:items-center sm:justify-between lg:w-[631px] lg:px-[39px]">
                    <p class="font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white">
                        <?php echo nl2br(esc_html($solution_callout)); ?>
                    </p>
                    <img src="<?php echo esc_url($section_arrow); ?>" alt="" class="size-5 shrink-0 sm:ml-4">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
