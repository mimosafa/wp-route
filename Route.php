<?php

/*
 * This file is part of the mimosafa\wp-route package.
 *
 * (c) Toshimichi Mimoto <mimosafa@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace mimosafa\WP\Route;

/**
 * @access private
 * @author Toshimichi Mimoto <mimosafa@gmail.com>
 */
class Route {

	/**
	 * @param mimosafa\WP\Route\Dispatcher $patch
	 */
	public static function addRoute( Dispatcher $patch ) {
		self::init();
		add_action( __CLASS__ . '::action', [ $patch, '_dispatch' ], 10, 2 );
	}

	private static function init() {
		static $instance;
		$instance ?: $instance = new self();
	}

	private function __construct() {
		is_admin()
			? add_action( 'wp_loaded', [ $this, '_init_admin' ] )
			: add_action( 'parse_query', [ $this, '_init' ] )
		;
	}

	public function _init_admin() {
		if ( $q = $this->_parse_admin_request() ) {
			do_action( __CLASS__ . '::action', $this, $q );
		}
	}

	public function _init( \WP_Query $query ) {
		if ( $query->is_main_query() && $q = $this->_parse_request( $query ) ) {
			do_action( __CLASS__ . '::action', $this, $q );
		}
	}

	/**
	 * @return array
	 */
	private function _parse_admin_request() {
		global $pagenow;
		$q = [ 'pagenow' => $pagenow ];
		switch ( $pagenow ) {
			case 'edit.php' :
			case 'post-new.php' :
				$q['post_type'] = filter_input( \INPUT_GET, 'post_type' ) ?: 'post';
				break;
			case 'post.php' :
				/**
				 * @see https://ja.forums.wordpress.org/topic/150122
				 */
				$q['post_type'] = filter_input( \INPUT_GET, 'post' ) ? get_post_type( $_GET['post'] ) : filter_input( \INPUT_POST, 'post_type' );
				break;
		}
		return $q;
	}

	/**
	 * @return array
	 */
	private function _parse_request( \WP_Query $query ) {
		return array_merge(
			array_filter( get_object_vars( $query ), function( $var ) { return $var === true; } ),
			array_filter( $query->query )
		);
	}

}
