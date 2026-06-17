<?php
/**
 * Search results template.
 *
 * @package Silver_Liquid_Dev
 */

get_header();
?>

<div class="wrap">
	<header class="page-hero">
		<span class="eyebrow"><?php esc_html_e( 'grep', 'silver-liquid-dev' ); ?> "<?php echo esc_html( get_search_query() ); ?>"</span>
		<h1>
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Results for “%s”', 'silver-liquid-dev' ), esc_html( get_search_query() ) );
			?>
		</h1>
		<p>
			<?php
			global $wp_query;
			printf(
				/* translators: %d: number of results. */
				esc_html( _n( '%d match found.', '%d matches found.', (int) $wp_query->found_posts, 'silver-liquid-dev' ) ),
				(int) $wp_query->found_posts
			);
			?>
		</p>
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
			the_posts_pagination( array(
				'mid_size'  => 1,
				'prev_text' => '←',
				'next_text' => '→',
			) );
			?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
