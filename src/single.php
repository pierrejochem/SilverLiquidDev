<?php
/**
 * Single post template.
 *
 * @package Silver_Liquid_Dev
 */

get_header();
?>

<div class="wrap wrap--narrow">
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'single' );

		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</div>

<?php
get_footer();
