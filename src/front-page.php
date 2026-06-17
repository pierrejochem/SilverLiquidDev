<?php
/**
 * Front page template.
 *
 * @package Silver_Liquid_Dev
 */

get_header();
?>

<section class="hero wrap">
	<div class="intro-grid">
		<div class="hero-copy">
			<?php
			$display_name = get_bloginfo( 'name' );
			$tagline      = get_bloginfo( 'description' );
			?>
			<h1 class="hero-name"><?php echo esc_html( $display_name ); ?></h1>
			<p class="hero-tag">
				<?php
				echo $tagline
					? esc_html( $tagline )
					: esc_html__( 'Developer writing about networking, cross-platform tooling, and the APIs that hold systems together — C#, Python, Java, and the occasional Cordova plugin.', 'silver-liquid-dev' );
				?>
			</p>
			<div class="hero-actions">
				<a class="btn btn--primary" href="#latest">
					<?php esc_html_e( 'Read the blog', 'silver-liquid-dev' ); ?> <?php echo silver_liquid_dev_icon( 'arrow' ); // phpcs:ignore ?>
				</a>
				<?php
				$social = silver_liquid_dev_social_links();
				if ( isset( $social['github'] ) ) :
					?>
					<a class="btn" href="<?php echo esc_url( $social['github']['url'] ); ?>" target="_blank" rel="noopener">
						<?php echo silver_liquid_dev_icon( 'github' ); // phpcs:ignore ?> GitHub
					</a>
					<?php
				endif;
				?>
			</div>
		</div>

		<div class="hero-visual" aria-hidden="true">
			<div class="terminal">
				<div class="terminal-bar">
					<span class="terminal-dot"></span>
					<span class="terminal-dot"></span>
					<span class="terminal-dot"></span>
					<span class="terminal-title">~/pierre — zsh</span>
				</div>
				<div class="terminal-body">
					<span class="ln"><span class="prompt">pierre@dev</span>:<span class="path">~</span>$ <span class="cmd">whoami</span></span>
					<span class="ln out">developer · sysadmin · API tinkerer</span>
					<span class="ln"><span class="prompt">pierre@dev</span>:<span class="path">~</span>$ <span class="cmd">cat stack.txt</span></span>
					<span class="ln out">C# · Python · Java · JavaScript</span>
					<span class="ln out">Ubuntu · Windows · networking</span>
					<span class="ln"><span class="prompt">pierre@dev</span>:<span class="path">~</span>$ <span class="cmd">ls ~/posts | tail -3</span></span>
					<span class="ln out">port-forwarding-netsh.md</span>
					<span class="ln out">ubuntu-landscape-client.md</span>
					<span class="ln out">sharepoint-python-lib.md</span>
					<span class="ln"><span class="prompt">pierre@dev</span>:<span class="path">~</span>$ <span class="cursor"></span></span>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
// Stack tags built from the most-used categories.
$cats = get_categories( array(
	'orderby'    => 'count',
	'order'      => 'DESC',
	'number'     => 12,
	'hide_empty' => true,
) );
if ( ! empty( $cats ) ) :
	?>
	<section class="section wrap" aria-label="<?php esc_attr_e( 'Topics', 'silver-liquid-dev' ); ?>">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'ls topics/', 'silver-liquid-dev' ); ?></span>
			</div>
		</div>
		<div class="stack-tags">
			<?php foreach ( $cats as $cat ) : ?>
				<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
					<?php echo esc_html( $cat->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
endif;
?>

<section class="section wrap" id="latest">
	<div class="section-head">
		<div>
			<span class="eyebrow"><?php esc_html_e( 'tail -n 6 posts/', 'silver-liquid-dev' ); ?></span>
			<h2><?php esc_html_e( 'Latest writing', 'silver-liquid-dev' ); ?></h2>
		</div>
		<a class="section-link" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' ) ); ?>">
			<?php esc_html_e( 'all posts →', 'silver-liquid-dev' ); ?>
		</a>
	</div>

	<div class="post-list">
		<?php
		$latest = new WP_Query( array(
			'post_type'           => 'post',
			'posts_per_page'      => 6,
			'ignore_sticky_posts' => true,
		) );

		if ( $latest->have_posts() ) :
			while ( $latest->have_posts() ) :
				$latest->the_post();
				get_template_part( 'template-parts/content' );
			endwhile;
			wp_reset_postdata();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
	</div>
</section>

<?php
get_footer();
