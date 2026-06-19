<?php
/**
 * Template for a single Case Study CPT post.
 *
 * Renders the block content stored in post_content.
 * The client builds and edits the page in the Gutenberg block editor.
 *
 * @package MyCustomTheme
 */

get_header();
?>
<main class="w-full bg-white overflow-x-hidden">
    <?php
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            the_content();
        }
    }
    ?>
</main>
<?php get_footer(); ?>
