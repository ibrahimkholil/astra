<?php
/**
 * WIDGET Styling Loader for Astra theme.
 *
 * @package     Astra Builder
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Astra x.x.x
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Customizer Initialization
 *
 * @since x.x.x
 */
class Astra_Footer_Widget_Component_Loader {

	/**
	 * Constructor
	 *
	 * @since x.x.x
	 */
	public function __construct() {

		add_filter( 'astra_theme_defaults', array( $this, 'theme_defaults' ) );
		add_action( 'customize_register', array( $this, 'customize_register' ), 2 );
		add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 110 );
	}

	/**
	 * Set Options Default Values
	 *
	 * @param  array $defaults  Astra options default value array.
	 * @return array
	 *
	 * @since x.x.x
	 */
	public function theme_defaults( $defaults ) {

		// Specify all the default values for Button from here.
		return $defaults;
	}

	/**
	 * Load color configs for the Heading Colors.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @since x.x.x
	 */
	public function customize_register( $wp_customize ) {

		/**
		 * Register Panel & Sections
		 */
		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once ASTRA_BUILDER_FOOTER_WIDGET_DIR . '/class-astra-footer-widget-component-configs.php';
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}

	/**
	 * Customizer Preview
	 *
	 * @since x.x.x
	 */
	public function preview_scripts() {
		/**
		 * Load unminified if SCRIPT_DEBUG is true.
		 */
		/* Directory and Extension */
		$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
		wp_enqueue_script( 'astra-footer-widget-customizer-preview-js', ASTRA_BUILDER_FOOTER_WIDGET_URI . '/assets/js/customizer-preview.js', array( 'customize-preview', 'astra-customizer-preview-js' ), ASTRA_THEME_VERSION, true );

		// Localize variables for WIDGET JS.
		wp_localize_script(
			'astra-footer-widget-customizer-preview-js',
			'AstraBuilderWIDGETData',
			array(
				'footer_widget_count' => Astra_Constants::$num_of_footer_widgets,
				'tablet_break_point' => astra_get_tablet_breakpoint(),
				'mobile_break_point' => astra_get_mobile_breakpoint(),
			)
		);
	}
}

/**
*  Kicking this off by creating the object of the class.
*/
new Astra_Footer_Widget_Component_Loader();
