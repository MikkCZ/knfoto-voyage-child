<?php
/**
 * The template for displaying the footer.
 *
 * @package Voyage
 * @subpackage Voyage
 * @since Voyage 1.0
 */
?>
</div><!-- #container -->
</div><!-- #main -->
<?php global $voyage_options; ?>
<div id="footer" role="contentinfo">
	<div class="<?php echo voyage_container_class(); ?> clearfix">
		<?php get_sidebar( 'footer' ); ?>
		<div id="footer-menu" class="<?php echo voyage_grid_full(); ?>" role="complementary">
		<?php if ( has_nav_menu( 'footer-menu' ) ) {
			wp_nav_menu( array( 'container_class' => 'footer-menu', 'theme_location' => 'footer-menu' ) );
       	} ?>
		<?php if ( $voyage_options['sociallink_bottom'] == 1 ) {
			voyage_social_connection( 'bottom' );
		} ?>
<?php /*
			<div class="cf-scheme-switch">
				<?php // CloudFlare HTTP/HTTPS
					if ( isset( $_SERVER['HTTP_CF_VISITOR'] ) ) {
						$http_cf_visitor = json_decode( str_replace( '\\', '', $_SERVER['HTTP_CF_VISITOR'] ), true );
						if ( $http_cf_visitor['scheme'] == 'https' ) {
							$link_scheme = 'http';
						} else {
							$link_scheme = 'https';
						}
						printf( '<a href="%1$s://%2$s%3$s">%4$s</a>', $link_scheme, htmlspecialchars($_SERVER['SERVER_NAME']), htmlspecialchars($_SERVER['REQUEST_URI']), strtoupper($link_scheme) );
					}
				?>
			</div>
*/ ?>
		</div>

		<div id="site-info" class="<?php echo voyage_grid_half(); ?>">
			&copy; <?php _e(date('Y')); ?> <?php bloginfo( 'name' ); ?>
		</div><!-- #site-info -->

		<div id="site-generator" class="<?php echo voyage_grid_half(); ?>">
			<a href="http://www.voyagebc.com/voyagetheme/" title="Voyage Theme by Stephen Cui">Voyage</a> child by <a href="http://www.mikk.cz/">Michal Stanke</a>
		</div><!-- #site-generator -->
	</div><!-- #footer-container -->
	<div class="back-to-top"><a href="#masthead"><span class="icon-chevron-up"></span><?php _e(' TOP','voyage'); ?></a></div>
</div><!-- #footer -->
</div><!-- #wrapper -->
<?php
	wp_footer();
?>
</body>
</html>
