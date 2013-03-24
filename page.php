<?php get_header(); ?>

<section class="row-fluid">

			<section class="span7"> 

				<?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', 'page' ); ?>
                    <?php comments_template( '', true ); ?>
                <?php endwhile; // end of the loop. ?>
            
            </section><!-- /.span7 -->
            
            <aside class="span4 offset1">
			
				<?php get_sidebar(); ?>
            
            </aside><!-- /.span4 -->

</section><!-- /.row-fluid -->

<?php get_footer(); ?>