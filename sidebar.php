<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	
		<div id="secondary" class="widget-area" role="complementary">
			
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
            
            <aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'refreshweb' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'refreshweb' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
            
		</div><!-- #secondary -->
