<?php


if ( ! function_exists( 'parkoursyllabusv1_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function parkoursyllabusv1_setup() {

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'parkoursyllabusv1' ),
		) );

	}
endif;

add_action( 'after_setup_theme', 'parkoursyllabusv1_setup' );