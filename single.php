<?php get_header(); ?>

<section class="row-fluid">
<section class="span7">
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', get_post_format() ); ?>
<nav class="nav-single">
  <h3 class="assistive-text">
    <?php _e( 'Post navigation', 'refreshweb' ); ?>
  </h3>
  <span class="nav-previous">
  <?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'refreshweb' ) . '</span> %title' ); ?>
  </span> <span class="nav-next">
  <?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'refreshweb' ) . '</span>' ); ?>
  </span> </nav>
<!-- .nav-single -->

<?php

	if ( comments_open() || '0' != get_comments_number() )

	comments_template( '', true );

				?>
<?php endwhile; // end of the loop. ?>
            
</section><!-- /.span7 -->
            
<aside class="span4 offset1">
	<?php get_sidebar(); ?>
</aside><!-- /.span4 -->

</section><!-- /.row-fluid -->

<?php get_footer(); ?>