<?php
/**
 * Single template for the Video CPT.
 *
 * Renders block content. Related videos are handled by the vid-related block.
 *
 * @package MyCustomTheme
 */

get_header();
?>

<main class="w-full bg-white overflow-x-hidden">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
