<?php
/**
 * Generic page template.
 *
 * Used for any WP Page that doesn't have a specific template assigned.
 * Renders the page title in a branded hero and the block editor content below.
 *
 * @package MyCustomTheme
 */
get_header();
?>

<main class="w-full bg-white overflow-x-hidden">

    <?php while (have_posts()) : the_post(); ?>

        <!-- Mini hero with page title -->
        <section class="relative w-full hero-gradient-bg">
            <div class="mx-auto w-full max-w-[1440px] px-5 pt-10 pb-10 sm:px-6 lg:px-[68px] lg:pt-[60px] lg:pb-[40px]">
                <h1 class="font-montserrat text-[36px] font-bold leading-[44px] text-white sm:text-[44px] lg:text-[52px] lg:leading-[60px]">
                    <?php the_title(); ?>
                </h1>
            </div>
        </section>

        <!-- Block content -->
        <?php if (has_blocks()) : ?>
            <?php the_content(); ?>
        <?php else : ?>
            <section class="w-full bg-white">
                <div class="mx-auto w-full max-w-[1440px] px-5 py-10 sm:px-6 lg:px-[68px]">
                    <div class="prose max-w-3xl font-roboto text-[16px] leading-[28px] text-[#364153]">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
