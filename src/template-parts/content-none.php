<?php
/**
 * No results / empty state.
 *
 * @package Silver_Liquid_Dev
 */
?>
<div class="empty-state">
	<span class="eyebrow"><?php esc_html_e( 'cat: no such file or directory', 'silver-liquid-dev' ); ?></span>
	<?php if ( is_search() ) : ?>
		<h2><?php esc_html_e( 'Nothing matched that search', 'silver-liquid-dev' ); ?></h2>
		<p><?php esc_html_e( 'Try a different keyword, or browse the topics from the menu.', 'silver-liquid-dev' ); ?></p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<h2><?php esc_html_e( 'No posts here yet', 'silver-liquid-dev' ); ?></h2>
		<p><?php esc_html_e( 'Check back soon — there is writing on the way.', 'silver-liquid-dev' ); ?></p>
	<?php endif; ?>
</div>
