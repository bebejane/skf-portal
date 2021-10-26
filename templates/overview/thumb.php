
<a href="<?php echo get_permalink() ?>" class="thumb">

  <figure style="background-image:url('<?php echo get_template_directory_uri();?>/library/images/no-image.svg')">
    <div class="content">
      <?php the_post_thumbnail('medium'); ?>
    </div>
  </figure>

  <article>
    <div class="title">
      <h5>
      <?php
      $unix = strtotime( get_field('start_date') );
      echo date_i18n( 'j/n Y', $unix );
      ?>
      <span class='section-color bullet'>&nbsp;•&nbsp;</span>
      <?php bloginfo( 'name' ); ?></h5>
      <h4 class="section-color"><?php
        $excerpt = wp_trim_words( get_the_title(), $num_words = 10, $more = '...' );
        echo $excerpt;
         ?></h4>
      <div class="mid">
        <p><?php
            $excerpt = wp_trim_words( get_field('intro' ), $num_words = 20, $more = '...' );
            echo $excerpt;
             ?>
        </p>
    </div>
  </article>
</a>
