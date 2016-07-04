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
 * @author Toshimichi Mimoto <mimosafa@gmail.com>
 */
abstract class Router {

	/**
	 * @var string|array
	 */
	protected $flags;

	/**
	 * @final
	 * @access public
	 * @return void
	 */
	final public static function init() {
		static $instance;
		$instance ?: $instance = new static();
	}

	/**
	 * Constructor.
	 *
	 * @access protected
	 * @uses   mimosafa\WP\Route\Route::addRoute()
	 */
	protected function __construct() {
		if ( $this->flags ) {
			Route::addRoute( $this );
		}
	}

	/**
	 * @param  string $key
	 * @return boolean
	 */
	protected function isRoute( $key ) {
		if ( is_array( $this->flags ) ) {
			return in_array( $key, $this->flags, true );
		}
		return $key === $this->flags;
	}

}
