<?php get_header(); ?>

<section class="hero">
  <h1>Yhteisöt & Verkostot</h1>
  <p>Löydä juuri sinulle sopiva yhteisö ja verkostoidu muiden opiskelijoiden kanssa. Sivustolta löydät erilaisia verkostoja, tapahtumia ja ryhmiä joissa voit jakaa osaamistasi ja oppia uutta ja rakentaa tärkeitä kontakteja tulevaisuutta varten.</p>
</section>
<section class="search-section">
  <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="hidden" name="post_type" value="verkostot">
    <div class="search-row">
      <input type="search" name="s" placeholder="Hae verkostoja..." value="<?php echo isset($_GET['s']) ? esc_attr($_GET['s']) : ''; ?>">
      <button type="submit">Hae</button>
    </div>
    <div class="filters-row">
      <select name="aihe">
        <option value="">Kaikki aiheet</option>
        <?php
        $aiheet = get_terms(array('taxonomy' => 'aihe', 'hide_empty' => false));
        foreach ($aiheet as $aihe) {
          $selected = (isset($_GET['aihe']) && $_GET['aihe'] == $aihe->slug) ? 'selected' : '';
          echo '<option value="' . esc_attr($aihe->slug) . '" ' . $selected . '>' . esc_html($aihe->name) . '</option>';
        }
        ?>
      </select>

      <select name="tapaaminen">
        <option value="">Kaikki tapaamiset</option>
        <?php
        $tapaamiset = get_terms(array('taxonomy' => 'tapaaminen', 'hide_empty' => false));
        foreach ($tapaamiset as $tapaaminen) {
          $selected = (isset($_GET['tapaaminen']) && $_GET['tapaaminen'] == $tapaaminen->slug) ? 'selected' : '';
          echo '<option value="' . esc_attr($tapaaminen->slug) . '" ' . $selected . '>' . esc_html($tapaaminen->name) . '</option>';
        }
        ?>
      </select>

      <select name="jasenyys">
        <option value="">Kaikki jäsenyydet</option>
        <?php
        $jasen = get_terms(array('taxonomy' => 'jasenyys', 'hide_empty' => false));
        foreach ($jasen as $jas) {
          $selected = (isset($_GET['jasenyys']) && $_GET['jasenyys'] == $jas->slug) ? 'selected' : '';
          echo '<option value="' . esc_attr($jas->slug) . '" ' . $selected . '>' . esc_html($jas->name) . '</option>';
        }
        ?>
      </select>
    </div>
  </form>
</section>
<?php
$aihe = isset($_GET['aihe']) ? sanitize_text_field($_GET['aihe']) : '';
$tapaaminen = isset($_GET['tapaaminen']) ? sanitize_text_field($_GET['tapaaminen']) : '';
$jasenyys = isset($_GET['jasenyys']) ? sanitize_text_field($_GET['jasenyys']) : '';
$search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$tax_query = array('relation' => 'AND');

if ($aihe) {
  $tax_query[] = array(
    'taxonomy' => 'aihe',
    'field' => 'slug',
    'terms' => $aihe,
  );
}
if ($tapaaminen) {
  $tax_query[] = array(
    'taxonomy' => 'tapaaminen',
    'field' => 'slug',
    'terms' => $tapaaminen,
  );
}
if ($jasenyys) {
  $tax_query[] = array(
    'taxonomy' => 'jasenyys',
    'field' => 'slug',
    'terms' => $jasenyys,
  );
}
$args = array(
  'post_type' => 'verkostot',
  'posts_per_page' => 3, 
  'orderby' => empty($_GET) ? 'rand' : 'date',
  's' => $search,
);
if (!empty($aihe) || !empty($tapaaminen) || !empty($jasenyys)) {
  $args['tax_query'] = $tax_query;
}

$query = new WP_Query($args);
?>
<section class="results">
  <?php if ($query->have_posts()) : ?>
    <div class="card-grid">
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <article class="card">
          <?php if (has_post_thumbnail()) : ?>
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
  <?php else : ?>
    <p>Ei löytynyt tuloksia valituilla suodattimilla.</p>
  <?php endif; ?>
  <?php wp_reset_postdata(); ?>
</section>



<?php get_footer(); ?>
