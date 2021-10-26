<?php
/*
 Template Name: Startsida Portal
*/
?>

<?php get_header(); ?>

<section class="intro content">
  <?php the_field('intro') ?>
</section>
  <aside class="related">
  <h5>Berätta mer</h5>
    <ul>
      <li class="mid">
        <span class="section-color icon">›</span><span class="link"><a href="https://sverigeskonstforeningar.nu/medlemskap/">Anslut er konstförening</a></span>
      </li>
      <li class="mid">
        <span class="section-color icon">›</span><span class="link"><a href="https://sverigeskonstforeningar.nu/medlemskap/starta-en-konstforening/">Starta en konstförening</a></span>
      </li>
      <li class="mid">
        <span class="section-color icon">›</span><span class="link"><a href="https://sverigeskonstforeningar.nu/nyheter/kostnadsfri-hemsida-for-er-konstforening-ny-medlemsforman/">Skaffa egen hemsida</a></span>
      </li>
    </ul>
</aside>

<section class="start-headline line">
<h6>Aktiviteter i föreningarna</h6>
</section>

  <section class="swiper-container big-image">
            <div class="swiper-wrapper">
              <?php
              $exclude = explode(',', get_field('excluded_sites','option'));

              global $switched;
              $subsites = get_sites(array(
                'site__not_in' => $exclude,
                'order_by' => 'last_updated',
                'order'  => 'DESC',
                'number' => 50,
                ));

              foreach( $subsites as $subsite ) {
                $subsite_id = get_object_vars($subsite)["blog_id"];
                switch_to_blog($subsite_id); //switched to 2

                $posts = get_posts(array(
                  'post_type'	  => array('activities'),
                  'numberposts'      => 1,
                  'tax_query' => array(
                        array(
                            'taxonomy' => 'activities-category',
                            'field' => 'term_id',
                            'terms' => array( 5, 9, 4, 10, 12, 2),
                        )
                    )
                  )
                );

                if( $posts ) {
                  foreach( $posts as $post ) {
                    setup_postdata( $post );
                    if(get_field('intro') && has_post_thumbnail()) {
                      include( locate_template( 'templates/overview/thumb-big-image.php', false, false ) );
                    }
                  }
                  wp_reset_postdata();
                }
              }

              switch_to_blog(1); //switched to 2
              ?>

            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
  </section>



<section class="start-headline line">
<h6>Utställningar i föreningarna</h6>
</section>

<section class="thumbs four">

  <?php
  $exclude = explode(',', get_field('excluded_sites','option'));

  global $switched;
  $subsites = get_sites(array(
    'site__not_in' => $exclude,
    'order_by' => 'last_updated',
    'order'  => 'DESC',
    'number' => 30,
    ));

  $ok_posts = 0;

  foreach( $subsites as $subsite ) {
    $subsite_id = get_object_vars($subsite)["blog_id"];
    switch_to_blog($subsite_id); //switched to 2

    $posts = get_posts(array(
      'post_type'	  => array('exhibitions'),
      'numberposts'      => 1,
      )
    );
    if( $ok_posts < 8 ) {
    if( $posts ) {
      foreach( $posts as $post ) {
        setup_postdata( $post );
        if( (get_field('intro') && has_post_thumbnail())) {
          include( locate_template( 'templates/overview/thumb.php', false, false ) );
          $ok_posts++;
        }
      }
      wp_reset_postdata();
    }
  }
  }

  switch_to_blog(1); //switched to 2
  ?>

</section>

<section class="start-headline line map-intro">
<h6>Våra föreningar</h6>
<p class="intro">På vår karta kan du hitta en konstförening nära dig som du kan bli medlem i. Placeringen på kartan är ingen exakt geografisk representation utan är baserad på ort. Du kan också <a href="https://www.google.com/maps/d/viewer?mid=1yIHY3XY2NqK66J73uQuA8Gq_iRcN3FL0" target="new">öppna kartan i ett separat fönster</a> för att kunna söka i den.</p>
</section>

<section class="map">
  <iframe src="https://www.google.com/maps/d/embed?mid=1yIHY3XY2NqK66J73uQuA8Gq_iRcN3FL0" width="100%" height="600"></iframe>
</section>

<section class="start-headline line">
<h6>Konstföreningar i fokus</h6>
</section>

<section class="thumbs four selected">

  <?php
  $exclude = explode(',', get_field('excluded_sites','option'));

  global $switched;
  $subsites = get_sites(array(
    'site__not_in' => $exclude,
    ));

  foreach( $subsites as $subsite ) {
    $subsite_id = get_object_vars($subsite)["blog_id"];
    switch_to_blog($subsite_id); //switched to 2

    $posts = get_posts(array(
      'post_type'	  => array('exhibitions', 'activites', 'news'),
      'numberposts'      => 1,
      )
    );

    if( $posts ) {
      foreach( $posts as $post ) {
        setup_postdata( $post );
          include( locate_template( 'templates/overview/thumb-org.php', false, false ) );
      }
      wp_reset_postdata();
    }
  }

  switch_to_blog(1); //switched to 2
  ?>

</section>




<?php get_footer(); ?>
