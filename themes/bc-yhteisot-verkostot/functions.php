<?php
function bc_enqueue_styles() {
    $parenthandle = 'twentytwentyfive-style';
    $theme = wp_get_theme();
    wp_enqueue_style(
        $parenthandle,
        get_template_directory_uri() . '/style.css',
        [],
        $theme->parent()->get('Version')
    );
    wp_enqueue_style(
        'bc-yhteisot-style',
        get_stylesheet_directory_uri() . '/style.css', 
        [$parenthandle],
        $theme->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'bc_enqueue_styles');
add_theme_support('post-thumbnails');
function bc_register_verkostot_post_type() {
  $labels = array(
    'name' => 'Verkostot',
    'singular_name' => 'Verkosto',
    'add_new_item' => 'Lisää verkosto',
    'edit_item' => 'Muokkaa verkostoa',
    'new_item' => 'Uusi verkosto',
    'view_item' => 'Näytä verkosto',
    'search_items' => 'Hae verkostoja',
    'not_found' => 'Ei verkostoja löytynyt',
  );$args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => 'verkostot',
    'rewrite' => array('slug' => 'verkostot', 'with_front' => false),
    'supports' => array('title','editor','thumbnail','excerpt'),
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-networking',
);
  register_post_type('verkostot', $args);
}
add_action('init', 'bc_register_verkostot_post_type');
function bc_register_verkostot_taxonomies() {

  register_taxonomy('aihe', 'verkostot', array(
    'label' => 'Aihe',
    'hierarchical' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'aihe'),
    'show_admin_column' => true,
  ));

  register_taxonomy('tapaaminen', 'verkostot', array(
    'label' => 'Tapaaminen',
    'hierarchical' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'tapaaminen'),
    'show_admin_column' => true,
  ));

  register_taxonomy('jasenyys', 'verkostot', array(
    'label' => 'Jäsenyys',
    'hierarchical' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'jasenyys'),
    'show_admin_column' => true,
  ));
}
add_action('init', 'bc_register_verkostot_taxonomies');
function bc_get_term_badges($post_id) {
  $taxes = array('aihe', 'jasenyys', 'tapaaminen');
  $out = '';
  foreach ($taxes as $t) {
    $terms = get_the_terms($post_id, $t);
    if (!empty($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
        $out .= '<span class="badge">' . esc_html($term->name) . '</span> ';
      }
    }
  }
  return $out;
}
