<?php
/**
 * Archive template (categories, tags, dates, author).
 *
 * @package Silver_Liquid_Dev
 */

get_header();
?>

<div class="wrap">
	<header class="page-hero">
		<span class="eyebrow">
			<?php
			if ( is_category() ) {
				esc_html_e( 'grep -r ~/posts', 'silver-liquid-dev' );
			} elseif ( is_tag() ) {
				esc_html_e( 'find . -tag', 'silver-liquid-dev' );
			} elseif ( is_author() ) {
				esc_html_e( 'whois author', 'silver-liquid-dev' );
			} else {
				esc_html_e( 'ls -lt archive/', 'silver-liquid-dev' );
			}
			?>
		</span>
		<h1><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
		<?php
		$desc = get_the_archive_description();
		if ( $desc ) {
			echo '<p>' . wp_kses_post( $desc ) . '</p>';
		}
		?>
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
