<?php
/**
 * Single post content.
 *
 * @package Silver_Liquid_Dev
 */
?>
<article <?php post_class( 'article' ); ?>>
	<header class="article-header">
		<div class="article-meta">
			<?php silver_liquid_dev_primary_category(); ?>
			<span class="sep" aria-hidden="true">·</span>
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></time>
			<span class="sep" aria-hidden="true">·</span>
			<span><?php echo esc_html( silver_liquid_dev_reading_time() ); ?> <?php esc_html_e( 'min read', 'silver-liquid-dev' ); ?></span>
		</div>
		<h1><?php the_title(); ?></h1>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="featured-media">
			<?php the_post_thumbnail( 'large' ); ?>
		</figure>
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

	<?php
	$tags = get_the_tags();
	if ( $tags ) :
		?>
		<div class="tags-row">
			<?php foreach ( $tags as $tag ) : ?>
				<a class="pill" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">#<?php echo esc_html( $tag->name ); ?></a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</article>

<?php
$prev_post = get_previous_post();
$next_post = get_next_post();
if ( $prev_post || $next_post ) :
	?>
	<nav class="post-nav" aria-label="<?php esc_attr_e( 'Post navigation', 'silver-liquid-dev' ); ?>">
		<?php if ( $prev_post ) : ?>
			<a class="prev" href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
				<span class="label">← <?php esc_html_e( 'Previous', 'silver-liquid-dev' ); ?></span>
				<span class="title"><?php echo esc_html( get_the_title( $prev_post ) ); ?></span>
			</a>
		<?php else : ?>
			<span></span>
		<?php endif; ?>

		<?php if ( $next_post ) : ?>
			<a class="next" href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
				<span class="label"><?php esc_html_e( 'Next', 'silver-liquid-dev' ); ?> →</span>
				<span class="title"><?php echo esc_html( get_the_title( $next_post ) ); ?></span>
			</a>
		<?php endif; ?>
	</nav>
	<?php
endif;
