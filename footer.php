</div><!-- /.container -->
</div><!-- /.wrapper -->
	<section id="breadcrumbs">
		<div class="container">
        	<?php social_media_html(); ?>
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			} ?>
		</div><!-- /.container -->
	</section><!-- /.breadcrumbs -->
	<footer class="footer">
		<div class="container">
        
        <div class="row">
        <div class="span4">
        &copy;<?php echo date(Y); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
        </div><!-- /.span4 -->
        <div class="span4 offset4">
        	<a href="http://refreshwebmarketing.com/" class="nolink" target="_blank" >Website Design</a>ed and Developed by <a href="http://refreshwebmarketing.com/" title="Refresh Web Marketing" target="_blank"><i class="icon-repeat tip" data-toggle="tooltip" title="Website Developed by Refresh Web Marketing"></i> Refresh Web Marketing</a> 
		
        </div><!-- /.container -->
        </div><!-- /.row -->
        
	
		</div><!-- /.span3 offset2 -->
	</footer><!-- /.footer -->
    
    
    <?php 
	$analcode = get_option('anal_code');
	if($analcode !== '') { ?>
	    
    <!--Google Analytics-->
    <script type="text/javascript">
	  
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', '<?php echo $analcode;?>']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
	
	<?php } ?>
    
    
<?php wp_footer(); ?>
</body>
</html>