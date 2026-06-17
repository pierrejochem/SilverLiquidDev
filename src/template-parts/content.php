<?php
/**
 * Post card used in listings.
 *
 * @package Silver_Liquid_Dev
 */

?>
<article <?php post_class( 'card' ); ?>>
	<div class="card-meta">
		<?php silver_liquid_dev_primary_category(); ?>
		<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
		<span class="sep" aria-hidden="true">·</span>
		<span><?php echo esc_html( silver_liquid_dev_reading_time() ); ?> <?php esc_html_e( 'min read', 'silver-liquid-dev' ); ?></span>
	</div>

	<h3 class="card-title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>

	<p class="card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30, '…' ) ); ?></p>

	<div class="card-foot">
		<a class="read-more" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: post title. */ __( 'Read %s', 'silver-liquid-dev' ), get_the_title() ) ); ?>">
			<?php esc_html_e( 'read', 'silver-liquid-dev' ); ?> <?php echo silver_liquid_dev_icon( 'arrow' ); // phpcs:ignore ?>
		</a>
	</div>
</article>
