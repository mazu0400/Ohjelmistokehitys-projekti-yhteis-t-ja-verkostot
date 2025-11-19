<?php
get_header();
?>
<main class="verkostot-archive">
  <h1 class="archive-title">Verkostot</h1>

  <?php if ( have_posts() ) : ?>
    <div class="card-grid">
      <?php while ( have_posts() ) : the_post(); ?>
        <article class="card">
          <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
          <?php endif; ?>

          <h3><?php the_title(); ?></h3>

          <div class="meta">
            <?php 
              $aihe_terms = get_the_terms(get_the_ID(), 'aihe');
              $tapaaminen_terms = get_the_terms(get_the_ID(), 'tapaaminen');
              $jasenyys_terms = get_the_terms(get_the_ID(), 'jasenyys');

              if ($aihe_terms && !is_wp_error($aihe_terms)) {
                echo '<span>Aihe: ' . esc_html($aihe_terms[0]->name) . '</span><br>';
              }
              if ($tapaaminen_terms && !is_wp_error($tapaaminen_terms)) {
                echo '<span>Tapaaminen: ' . esc_html($tapaaminen_terms[0]->name) . '</span><br>';
              }
              if ($jasenyys_terms && !is_wp_error($jasenyys_terms)) {
                echo '<span>Jäsenyys: ' . esc_html($jasenyys_terms[0]->name) . '</span>';
              }
            ?>
          </div>

          <a href="<?php the_permalink(); ?>" class="button">Lue lisää</a>
        </article>
      <?php endwhile; ?>
    </div>

    <?php the_posts_pagination(array(
      'prev_text' => '&larr;',
      'next_text' => '&rarr;'
    )); ?>

  <?php else : ?>
    <p>Ei verkostoja löytynyt.</p>
  <?php endif; ?>
</main>
<?php
get_footer();
