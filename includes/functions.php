<?php
/**
 * Functon File
 *
 * @package ckr-recurly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ckr_format_date' ) ) {

	/**
	 * Date Format for Recurly.
	 *
	 * @param  date   $date  recurly date.
	 * @param  string $format (Optional).
	 *
	 * @return date
	 */
	function ckr_format_date( $date, $format = 'F d, Y' ) {
		 $date = new DateTime( $date );
		return $date->format( $format );
	}
}
