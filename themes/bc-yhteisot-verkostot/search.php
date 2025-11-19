<?php get_header(); ?>

<main class="search-results">
    <h1>Hakutulokset</h1>
    <?php if ( have_posts() ) : ?>
        <ul>
            <?php while ( have_posts() ) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p>Ei hakutuloksia.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
