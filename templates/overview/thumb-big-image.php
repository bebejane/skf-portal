<a class="swiper-slide" href="<?php the_permalink();?>">
  <article>
  <figure>
    <div class="content">
      <?php the_post_thumbnail('medium_large'); ?>
    </div>
  </figure>
  <div class="text">
    <h5>
      <?php
      $unix = strtotime( get_field('start_date') );
      echo date_i18n( 'j/n Y', $unix );
      ?>
      <span class='section-color bullet'> • </span>
      <?php bloginfo( 'name' ); ?>
      <?php
    global $post;
    $taxonomy = 'activities-category';
    $terms = wp_get_object_terms( $post->ID, $taxonomy);
    if ( ! empty( $terms ) ) {
      if ( ! is_wp_error( $terms ) ) {
              foreach( $terms as $term ) {
                  echo "<span class='section-color bullet'>• </span>" . esc_html( $term->name );
              }
      }
    }
    ?>
    </h5>
    <h1 class="section-color"><?php
    $title = get_the_title();
    $excerpt = wp_trim_words( $title, $num_words = 5, $more = '...' );
    if (get_sub_field('ny_rubrik')) {
      $title = get_sub_field('headline');
      $excerpt = $title;
    }
    echo $excerpt;
    ?></h1>
    <p><?php
        $excerpt = wp_trim_words( get_field('intro' ), $num_words = 20, $more = '...' );
        echo $excerpt;
         ?></p>
  </div>
  </article>
</a>
