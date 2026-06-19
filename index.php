<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <h1 class="mb-8 text-3xl font-bold text-noir">Latest News</h1>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="mb-8">
                <h2 class="text-2xl font-bold mb-2">
                    <a href="<?php the_permalink(); ?>" class="hover:underline">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <div class="text-gray-600 text-sm mb-4">
                    <?php the_date(); ?>
                </div>
                <div class="prose max-w-none">
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p class="text-gray-500">No posts found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
