<?php
/**
 * Header template.
 *
 * @package Silver_Liquid_Dev
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'silver-liquid-dev' ); ?></a>

<div class="site">
	<header class="site-header">
		<div class="wrap header-inner">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				$initials = 'pj';
				?>
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="brand-mark"><?php echo esc_html( $initials ); ?></span>
					<span class="brand-name"><?php bloginfo( 'name' ); ?><span class="caret">_</span></span>
				</a>
				<?php
			}
			?>

			<nav class="nav primary-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'silver-liquid-dev' ); ?>">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'menu',
						'depth'          => 1,
						'fallback_cb'    => false,
					) );
				} else {
					// Sensible default if no menu is assigned yet.
					echo '<ul class="menu">';
					echo '<li class="menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'silver-liquid-dev' ) . '</a></li>';
					wp_list_pages( array( 'title_li' => '', 'depth' => 1 ) );
					echo '</ul>';
				}
				?>
			</nav>

			<div class="header-tools">
				<button class="icon-btn theme-toggle" type="button" aria-label="<?php esc_attr_e( 'Toggle dark mode', 'silver-liquid-dev' ); ?>">
					<span class="sun"><?php echo silver_liquid_dev_icon( 'sun' ); // phpcs:ignore ?></span>
					<span class="moon"><?php echo silver_liquid_dev_icon( 'moon' ); // phpcs:ignore ?></span>
				</button>
				<button class="icon-btn nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="<?php esc_attr_e( 'Toggle menu', 'silver-liquid-dev' ); ?>">
					<span class="open-icon"><?php echo silver_liquid_dev_icon( 'menu' ); // phpcs:ignore ?></span>
					<span class="close-icon" hidden><?php echo silver_liquid_dev_icon( 'close' ); // phpcs:ignore ?></span>
				</button>
			</div>
		</div>
	</header>

	<main id="main" class="site-main">
