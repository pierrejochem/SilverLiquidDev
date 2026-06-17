<?php
/**
 * Page template.
 *
 * @package Silver_Liquid_Dev
 */

get_header();
?>

<div class="wrap wrap--narrow">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'article' ); ?>>
			<header class="article-header">
				<span class="eyebrow" style="font-family:var(--font-mono);font-size:.82rem;color:var(--muted);">
					<?php echo esc_html( '~/' . sanitize_title( get_the_title() ) ); ?>
				</span>
				<h1><?php the_title(); ?></h1>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="featured-media"><?php the_post_thumbnail( 'large' ); ?></figure>
			<?php endif; ?>

			<div class="prose">
				<?php
				the_content();
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'silver-liquid-dev' ),
					'after'  => '</div>',
				) );
				?>
			</div>
		</article>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</div>

<?php
get_footer();
