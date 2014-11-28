<?php

namespace Ytnuk\Menu\Control;

use Ytnuk;

/**
 * Interface Factory
 *
 * @package Ytnuk\Menu
 */
interface Factory
{

	/**
	 * @return Ytnuk\Menu\Control
	 */
	public function create();
}
