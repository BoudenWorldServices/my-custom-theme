<?php
/**
 * Render: goliath/hiw-crash-video
 *
 * @var array $attributes
 */

$headline      = $attributes['headline'] ?? 'Install once stop damage for good.';
$video_file    = $attributes['videoFile'] ?? 'corporate-crash-test.mp4';
$video_url     = $attributes['videoUrl'] ?? '';
$poster_url    = $attributes['posterUrl'] ?? '';
$fallback_text = $attributes['fallbackText'] ?? 'Watch on video page';
$fallback_url  = $attributes['fallbackUrl'] ?? '';

if ( $video_url ) {
    $video_src = $video_url;
    $has_mp4   = true;
} else {
    $video_src = function_exists( 'my_theme_get_video_file_uri' )
        ? my_theme_get_video_file_uri( $video_file )
        : get_theme_file_uri( 'assets/videos/' . $video_file );

    $has_mp4 = function_exists( 'my_theme_video_file_is_readable' )
        ? my_theme_video_file_is_readable( $video_file )
        : is_readable( get_theme_file_path( 'assets/videos/' . $video_file ) );
}

if ( ! $poster_url ) {
    $poster_url = ( function_exists( 'my_theme_video_thumbnail_is_readable' )
        && function_exists( 'my_theme_get_video_thumbnail_uri' )
        && my_theme_video_thumbnail_is_readable( $video_file ) )
        ? my_theme_get_video_thumbnail_uri( $video_file )
        : get_theme_file_uri( 'assets/images/video-thumbnails/' . pathinfo( $video_file, PATHINFO_FILENAME ) . '.jpg' );
}

if ( ! $fallback_url ) {
    $fallback_url = home_url( '/videos/' . pathinfo( $video_file, PATHINFO_FILENAME ) . '/' );
}
?>
<section class="mt-8 w-full bg-white lg:mt-10" aria-label="<?php echo esc_attr( 'Goliath crash test video' ); ?>">
    <div class="mx-auto w-full max-w-[1440px] px-5 lg:px-[68px]">
        <div class="flex w-full flex-col overflow-hidden lg:flex-row lg:items-stretch">
            <div class="flex min-h-[240px] flex-none flex-col justify-center bg-[#ff5c00] px-8 py-10 lg:min-h-[580px] lg:w-[35%] lg:max-w-[480px] lg:px-10 lg:py-14">
                <h2 class="font-montserrat text-[28px] font-bold leading-[1.2] text-white sm:text-[32px] lg:text-[36px] xl:text-[40px]">
                    <span class="block"><?php echo esc_html( $headline ); ?></span>
                </h2>
            </div>
            <div
                class="relative min-h-[320px] flex-1 bg-black sm:min-h-[380px] lg:min-h-[580px]"
                data-hiw-crash-test-video-wrap
            >
                <?php if ( $has_mp4 ) : ?>
                    <video
                        id="hiw-crash-test-video-band"
                        class="absolute inset-0 z-0 h-full w-full object-cover"
                        controls
                        playsinline
                        muted
                        loop
                        preload="metadata"
                        poster="<?php echo esc_url( $poster_url ); ?>"
                        aria-label="<?php echo esc_attr( 'Goliath crash test: with versus without protection' ); ?>"
                    >
                        <source src="<?php echo esc_url( $video_src ); ?>" type="video/mp4">
                    </video>
                <?php else : ?>
                    <a href="<?php echo esc_url( $fallback_url ); ?>" class="relative flex min-h-[320px] w-full flex-col items-center justify-center bg-black sm:min-h-[380px] lg:min-h-[580px]">
                        <span class="flex size-12 items-center justify-center rounded-full bg-[#e53935] shadow-md sm:size-14" aria-hidden="true">
                            <span class="ml-px block h-0 w-0 border-y-[7px] border-l-[11px] border-y-transparent border-l-white sm:border-y-[8px] sm:border-l-[13px]"></span>
                        </span>
                        <span class="mt-4 font-montserrat text-[14px] font-bold uppercase tracking-[0.35px] text-white"><?php echo esc_html( $fallback_text ); ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if ( $has_mp4 ) : ?>
        <script>
            (function () {
                var wrap = document.querySelector('[data-hiw-crash-test-video-wrap]');
                if (!wrap) return;
                var video = wrap.querySelector('#hiw-crash-test-video-band');
                if (!video || !('IntersectionObserver' in window)) return;
                var played = false;
                var io = new IntersectionObserver(
                    function (entries) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting && entry.intersectionRatio >= 0.35) {
                                played = true;
                                var p = video.play();
                                if (p && typeof p.catch === 'function') {
                                    p.catch(function () {});
                                }
                            } else if (!entry.isIntersecting && played) {
                                video.pause();
                            }
                        });
                    },
                    { root: null, rootMargin: '0px 0px -12% 0px', threshold: [0, 0.35, 0.6] }
                );
                io.observe(wrap);
            })();
        </script>
    <?php endif; ?>
</section>
