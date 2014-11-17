<?php

namespace WebEdit\Menu\Control;

use WebEdit;

/**
 * Interface Factory
 *
 * @package WebEdit\Menu
 */
interface Factory
{

	/**
	 * @return WebEdit\Menu\Control
	 */
	public function create();
}
