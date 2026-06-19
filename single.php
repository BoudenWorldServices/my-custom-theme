<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <h1 class="text-4xl font-bold mb-4"><?php the_title(); ?></h1>
            <div class="text-gray-600 text-sm mb-6">
                <time datetime="<?php echo get_the_date('c'); ?>"><?php the_date(); ?></time>
                &middot;
                <?php the_category(', '); ?>
            </div>
            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-6">
                    <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg']); ?>
                </div>
            <?php endif; ?>
            <div class="prose max-w-none">
                <?php the_content(); ?>
            </div>
        </article>

        <nav class="flex justify-between mt-12 pt-6 border-t border-gray-200">
            <div><?php previous_post_link('%link', '&larr; %title'); ?></div>
            <div><?php next_post_link('%link', '%title &rarr;'); ?></div>
        </nav>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
