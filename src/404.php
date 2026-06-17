<?php
/**
 * 404 template.
 *
 * @package Silver_Liquid_Dev
 */

get_header();
?>

<div class="wrap wrap--narrow">
	<div class="empty-state">
		<span class="eyebrow"><?php esc_html_e( 'Error: 404', 'silver-liquid-dev' ); ?></span>
		<h1 style="font-size:clamp(2rem,8vw,3.5rem);">404 — <?php esc_html_e( 'Page not found', 'silver-liquid-dev' ); ?></h1>
		<p><?php esc_html_e( 'bash: that page: No such file or directory. It may have moved or never existed.', 'silver-liquid-dev' ); ?></p>
		<p style="margin-top:1.4rem;">
			<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php echo silver_liquid_dev_icon( 'arrow' ); // phpcs:ignore ?> cd ~/
			</a>
		</p>
		<div style="max-width:420px;margin:2rem auto 0;">
			<?php get_search_form(); ?>
		</div>
	</div>
</div>

<?php
get_footer();
