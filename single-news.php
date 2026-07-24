<?php
/**
 * Template for a single News CPT post.
 *
 * Renders the block content stored in post_content.
 * The client builds and edits the article in the Gutenberg block editor
 * using the goliath/news-article-hero and goliath/news-hub-cta blocks.
 *
 * @package MyCustomTheme
 */

get_header();
?>
<main class="w-full bg-white overflow-x-hidden">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_content();
        }
    }
    ?>
</main>
<?php get_footer(); ?>
