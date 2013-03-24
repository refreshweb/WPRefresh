<?php get_header(); ?>

<section class="row-fluid">

    
    <article id="post-0" class="post error404 no-results not-found">
      <header class="entry-header">
        <h1 class="entry-title">
          <?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'refreshweb' ); ?>
        </h1>
      </header>
      <div class="entry-content">
        <p>
          <?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'refreshweb' ); ?>
        </p>
        <?php get_search_form(); ?>
      </div>
      <!-- .entry-content --> 
      
    </article>
    <!-- #post-0 --> 
    

</section><!-- /.row-fluid -->

<?php get_footer(); ?>