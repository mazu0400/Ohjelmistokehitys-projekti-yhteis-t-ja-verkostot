<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<main class="verkosto-single">
  <a href="<?php echo esc_url( home_url('/') ); ?>" class="back-link">&larr; Takaisin etusivulle</a>

  <h1 class="verkosto-title"><?php the_title(); ?></h1>

  <?php if ( has_post_thumbnail() ) : ?>
    <div class="verkosto-image">
      <?php the_post_thumbnail('large'); ?>
    </div>
  <?php endif; ?>

  <div class="verkosto-tags">
    <?php if ( function_exists('bc_get_term_badges') ) echo bc_get_term_badges(get_the_ID()); ?>
  </div>

  <div class="verkosto-content">
    <?php the_content(); ?>
  </div>

  <div class="verkosto-all">
    <a class="search-button" href="<?php echo esc_url( home_url( '/?post_type=verkostot' ) ); ?>">
      Näytä kaikki verkostot
    </a>
  </div>
</main>

<?php
endwhile; endif;
get_footer();
