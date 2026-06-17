<?php
/**
 * Footer template.
 *
 * @package Silver_Liquid_Dev
 */
?>
	</main><!-- #main -->

	<footer class="site-footer">
		<div class="wrap footer-inner">
			<div class="footer-brand">
				<?php bloginfo( 'name' ); ?><span class="caret"> ~$</span>
			</div>

			<div class="footer-social">
				<?php
				foreach ( silver_liquid_dev_social_links() as $key => $link ) {
					printf(
						'<a href="%1$s" aria-label="%2$s" rel="noopener"%4$s>%3$s</a>',
						esc_url( $link['url'] ),
						esc_attr( $link['label'] ),
						silver_liquid_dev_icon( $key ), // phpcs:ignore
						( 'rss' === $key ? '' : ' target="_blank"' )
					);
				}
				?>
			</div>
		</div>
		<div class="footer-note">
			© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> · built with the Silver Liquid&nbsp;Dev theme
		</div>
	</footer>
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
