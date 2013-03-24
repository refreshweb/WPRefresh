<?php get_header(); ?>

<section class="row-fluid">

			<section class="span7"> 



		<?php if ( have_posts() ) : ?>

			<header class="archive-header">

				<h1 class="archive-title"><?php

					if ( is_day() ) :

						printf( __( 'Daily Archives: %s', 'refreshweb' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :

						printf( __( 'Monthly Archives: %s', 'refreshweb' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'refreshweb' ) ) . '</span>' );

					elseif ( is_year() ) :

						printf( __( 'Yearly Archives: %s', 'refreshweb' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'refreshweb' ) ) . '</span>' );

					else :

						_e( 'Archives', 'refreshweb' );

					endif;

				?></h1>

			</header><!-- .archive-header -->



			<?php

			/* Start the Loop */

			while ( have_posts() ) : the_post();



				/* Include the post format-specific template for the content. If you want to

				 * this in a child theme then include a file called called content-___.php

				 * (where ___ is the post format) and that will be used instead.

				 */

				get_template_part( 'content', get_post_format() );



			endwhile;



			refreshweb_content_nav( 'nav-below' );

			?>



		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>



            </section><!-- /.span7 -->
            
            <aside class="span4 offset1">
			
				<?php get_sidebar(); ?>
            
            </aside><!-- /.span4 -->

</section><!-- /.row-fluid -->

<?php get_footer(); ?>