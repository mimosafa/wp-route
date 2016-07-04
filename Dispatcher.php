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
interface Dispatcher {

	/**
	 * @param mimosafa\WP\Route\Route $router
	 * @param array $args
	 */
	public function _dispatch( Route $router, Array $args );

	/**
	 * @param array $args
	 */
	public function dispatch( $args );

}
