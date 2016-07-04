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
abstract class Posts extends Router implements Dispatcher {

	/**
	 * Post Type OR Post Types
	 * Alias of mimosafa\WP\Route\Router::$flags.
	 *
	 * @var string|array
	 */
	protected $post_types;

	/**
	 * Constructor.
	 *
	 * @final
	 * @access protected
	 */
	final protected function __construct() {
		if ( $this->post_types ) {
			$this->flags = $this->post_types;
		}
		parent::__construct();
	}

	/**
	 * @param  mimosafa\WP\Route\Route $route
	 * @param  array $args
	 * @return void
	 */
	public function _dispatch( Route $route, Array $args ) {
		if ( ! isset( $args['post_type'] ) ) {
			return;
		}
		if ( ! $this->isRoute( $args['post_type'] ) ) {
			return;
		}
		$this->dispatch( $args );
	}

}
