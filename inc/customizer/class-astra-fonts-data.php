<?php
/**
 * Helper class for font settings.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2017, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Font info class for System and Google fonts.
 */
if ( ! class_exists( 'Astra_Fonts_Data' ) ) :

	/**
	 * Fonts Data
	 */
	final class Astra_Fonts_Data {

		/**
		 * Localize Fonts
		 */
		static public function js() {

			$system = json_encode( Astra_Font_Families::system_fonts() );
			$google = json_encode( Astra_Font_Families::google_fonts() );

			return 'var AstFontFamilies = { system: ' . $system . ', google: ' . $google . ' };';
		}
	}

endif;

/**
 * Font info class for System and Google fonts.
 */
if ( ! class_exists( 'Astra_Font_Families' ) ) :

	/**
	 * Font info class for System and Google fonts.
	 */
	final class Astra_Font_Families {

		public static function system_fonts() {
			$system_fonts = array(
				'Helvetica' => array(
					'fallback' => 'Verdana, Arial, sans-serif',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
				'Verdana'   => array(
					'fallback' => 'Helvetica, Arial, sans-serif',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
				'Arial'     => array(
					'fallback' => 'Helvetica, Verdana, sans-serif',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
				'Times'     => array(
					'fallback' => 'Georgia, serif',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
				'Georgia'   => array(
					'fallback' => 'Times, serif',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
				'Courier'   => array(
					'fallback' => 'monospace',
					'weights'  => array(
						'300',
						'400',
						'700',
					),
				),
			);

			return apply_filters( 'astra_system_fonts', $system_fonts );
		}

		public static function google_fonts() {

			$google_fonts_file = apply_filters( 'astra_google_fonts_json_file', ASTRA_THEME_DIR . 'assets/fonts/google-fonts.json' );

			if ( ! file_exists( ASTRA_THEME_DIR . 'assets/fonts/google-fonts.json' ) ) {
				return array();
			}

			$google_fonts 		= array();
			$google_fonts_json 	= json_decode( file_get_contents( $google_fonts_file ), 1 );

			foreach ( $google_fonts_json as $key => $font ) {
				$name = key( $font );
				foreach( $font[$name] as $font_key => $variant ) {

					if( stristr( $variant, 'italic' ) ) {
						unset( $font[$name][$font_key] );
					}

					if( 'regular' == $variant ) {
						$font[$name][$font_key] = '400';
					}

					$google_fonts[ $name ] = $font[ $name ];
				}
			}

			return apply_filters( 'astra_google_fonts', $google_fonts );
		}

	}

endif;
