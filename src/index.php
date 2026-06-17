<?php
/**
 * Main index / blog listing.
 *
 * @package Silver_Liquid_Dev
 */

get_header();
?>

<div class="wrap">
	<header class="page-hero">
		<span class="eyebrow"><?php esc_html_e( 'cat ~/blog', 'silver-liquid-dev' ); ?></span>
		<h1>
			<?php
			if ( is_home() && ! is_front_page() ) {
				single_post_title();
			} else {
				esc_html_e( 'Blog', 'silver-liquid-dev' );
			}
			?>
		</h1>
		<p><?php esc_html_e( 'Notes, snippets, and small tools from day-to-day development.', 'silver-liquid-dev' ); ?></p>
	</header>

	<div class="layout-with-sidebar">
		<div class="content-area">
			<div class="post-list">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content' );
					endwhile;
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
			</div>

			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 1,
					'prev_text' => '←',
					'next_text' => '→',
				)
			);
			?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
