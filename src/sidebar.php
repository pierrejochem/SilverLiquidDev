<?php
/**
 * Sidebar with a sensible fallback when no widgets are configured.
 *
 * @package Silver_Liquid_Dev
 */

?>
<aside class="sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'silver-liquid-dev' ); ?>">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php else : ?>

		<section class="widget">
			<h2 class="widget-title"><?php esc_html_e( 'search', 'silver-liquid-dev' ); ?></h2>
			<?php get_search_form(); ?>
		</section>

		<section class="widget">
			<h2 class="widget-title"><?php esc_html_e( 'recent posts', 'silver-liquid-dev' ); ?></h2>
			<ul>
				<?php
				$recent = wp_get_recent_posts(
					array(
						'numberposts' => 5,
						'post_status' => 'publish',
					)
				);
				foreach ( $recent as $r ) {
					printf(
						'<li><a href="%s">%s</a></li>',
						esc_url( get_permalink( $r['ID'] ) ),
						esc_html( $r['post_title'] )
					);
				}
				?>
			</ul>
		</section>

		<section class="widget">
			<h2 class="widget-title"><?php esc_html_e( 'topics', 'silver-liquid-dev' ); ?></h2>
			<div class="tagcloud">
				<?php
				$cats = get_categories(
					array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'number'     => 14,
						'hide_empty' => true,
					)
				);
				foreach ( $cats as $category ) {
					printf(
						'<a href="%s">%s</a>',
						esc_url( get_category_link( $category->term_id ) ),
						esc_html( $category->name )
					);
				}
				?>
			</div>
		</section>

	<?php endif; ?>
</aside>
