<?php
/**
 * Search form.
 *
 * @package Silver_Liquid_Dev
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'silver-liquid-dev' ); ?></label>
	<input type="search" id="s" class="search-field" name="s" placeholder="<?php esc_attr_e( 'grep posts…', 'silver-liquid-dev' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
	<button type="submit" class="search-submit"><?php esc_html_e( 'search', 'silver-liquid-dev' ); ?></button>
</form>
