<?php
/**
 * Render: goliath/hiw-installation
 *
 * @var array $attributes
 */

$heading    = $attributes['heading']   ?? 'Installation process';
$video_text = $attributes['videoText'] ?? 'Installation Video';

$steps = [
    [ 'title' => $attributes['step1Title'] ?? 'Precision Cutting',     'desc' => $attributes['step1Desc'] ?? '' ],
    [ 'title' => $attributes['step2Title'] ?? 'Fitting Goliath™',      'desc' => $attributes['step2Desc'] ?? '' ],
    [ 'title' => $attributes['step3Title'] ?? 'Securing the Structure','desc' => $attributes['step3Desc'] ?? '' ],
    [ 'title' => $attributes['step4Title'] ?? 'Floor Fixing',          'desc' => $attributes['step4Desc'] ?? '' ],
    [ 'title' => $attributes['step5Title'] ?? 'Installation Complete', 'desc' => $attributes['step5Desc'] ?? '' ],
];

$installation_video_file = $attributes['videoFile'] ?? 'goliath-demo.mp4';
$video_url_attr = $attributes['videoUrl'] ?? '';
$poster_url_attr = $attributes['posterUrl'] ?? '';
$video_page_url_attr = $attributes['videoPageUrl'] ?? '';

if ( $video_url_attr ) {
    $video_src = $video_url_attr;
    $has_mp4   = true;
} else {
    $video_src = function_exists( 'my_theme_get_video_file_uri' )
        ? my_theme_get_video_file_uri( $installation_video_file )
        : get_theme_file_uri( 'assets/videos/' . $installation_video_file );

    $has_mp4 = function_exists( 'my_theme_video_file_is_readable' )
        ? my_theme_video_file_is_readable( $installation_video_file )
        : is_readable( get_theme_file_path( 'assets/videos/' . $installation_video_file ) );
}

if ( $poster_url_attr ) {
    $poster = $poster_url_attr;
} else {
    $poster = ( function_exists( 'my_theme_video_thumbnail_is_readable' )
        && function_exists( 'my_theme_get_video_thumbnail_uri' )
        && my_theme_video_thumbnail_is_readable( $installation_video_file ) )
        ? my_theme_get_video_thumbnail_uri( $installation_video_file )
        : get_theme_file_uri( 'assets/images/video-thumbnails/' . pathinfo( $installation_video_file, PATHINFO_FILENAME ) . '.jpg' );
}

$video_page = $video_page_url_attr ? $video_page_url_attr : home_url( '/videos/' . pathinfo( $installation_video_file, PATHINFO_FILENAME ) . '/' );
?>
<section id="installation" class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1440px] px-5 py-10 lg:px-[68px] lg:py-[70px]">
        <div class="flex flex-col gap-[20px]">
            <h2 class="font-montserrat text-[28px] font-bold leading-[44px] text-[#020202] lg:text-[36px]">
                <?php echo esc_html( $heading ); ?>
            </h2>
            <div class="flex flex-col gap-8 lg:flex-row lg:gap-[36px]">
                <div class="flex min-w-0 flex-1 flex-col gap-0">
                    <div
                        class="relative h-[260px] w-full overflow-hidden bg-black sm:h-[340px] lg:h-[434px]"
                        data-hiw-installation-video-wrap
                    >
                        <video
                            id="hiw-installation-video"
                            class="block h-full w-full object-cover"
                            controls
                            playsinline
                            muted
                            preload="<?php echo $has_mp4 ? 'metadata' : 'none'; ?>"
                            poster="<?php echo esc_url( $poster ); ?>"
                            aria-label="<?php echo esc_attr( 'Goliath product demo: installation process' ); ?>"
                        >
                            <?php if ( $has_mp4 ) : ?>
                                <source src="<?php echo esc_url( $video_src ); ?>" type="video/mp4">
                            <?php endif; ?>
                        </video>
                    </div>
                    <?php if ( $has_mp4 ) : ?>
                        <script>
                            (function () {
                                var wrap = document.querySelector('[data-hiw-installation-video-wrap]');
                                if (!wrap) return;
                                var video = wrap.querySelector('#hiw-installation-video');
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
                    <a href="<?php echo esc_url( $video_page ); ?>" class="inline-flex w-full items-center justify-between gap-4 bg-[#ff5c00] px-[28px] py-[18px] font-montserrat text-[16px] font-bold leading-[24px] tracking-[0.35px] text-white hover:opacity-95">
                        <span><?php echo esc_html( $video_text ); ?></span>
                        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/icons/hiw-link-arrow.svg' ) ); ?>" alt="" class="size-5 shrink-0" width="20" height="20" aria-hidden="true">
                    </a>
                </div>
                <div class="flex flex-1 flex-col gap-[26px]">
                    <?php foreach ( $steps as $i => $step ) : ?>
                        <div class="flex items-start gap-[10px] border-t border-[#faf5ff] pt-[10px]">
                            <div class="flex h-[49px] shrink-0 items-center justify-center bg-[#ff5c00] p-[20px]">
                                <span class="font-montserrat text-[20px] font-medium text-white"><?php echo $i + 1; ?></span>
                            </div>
                            <div class="flex-1">
                                <p class="font-montserrat text-[16px] font-bold leading-[23px] text-[#020202]"><?php echo esc_html( $step['title'] ); ?></p>
                                <p class="font-montserrat text-[12px] font-medium leading-[23px] text-[#020202]"><?php echo esc_html( $step['desc'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
