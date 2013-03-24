<?php get_header(); ?>

<section class="row-fluid">
  <section class="span7">
    <?php if ( have_posts() ) : ?>
    <header class="page-header">
      <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'refreshweb' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    </header>
    <?php refreshweb_content_nav( 'nav-above' ); ?>
    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'content', get_post_format() ); ?>
    <?php endwhile; ?>
    <?php refreshweb_content_nav( 'nav-below' ); ?>
    <?php else : ?>
    <article id="post-0" class="post no-results not-found">
      <header class="entry-header">
        <h1 class="entry-title">
          <?php _e( 'Nothing Found', 'refreshweb' ); ?>
        </h1>
      </header>
      <div class="entry-content">
        <p>
          <?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'refreshweb' ); ?>
        </p>
        <?php get_search_form(); ?>
      </div>
      <!-- .entry-content --> 
      
    </article>
    <!-- #post-0 -->
    
    <?php endif; ?>
  </section>
  <!-- /.span7 -->
  
  <aside class="span4 offset1">
    <?php get_sidebar(); ?>
  </aside>
  <!-- /.span4 --> 
  
</section>
<!-- /.row-fluid -->

<?php get_footer(); ?>
