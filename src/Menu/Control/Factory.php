<?php

namespace Kutny\Menu\Control;

use Kutny;

/**
 * Interface Factory
 *
 * @package Kutny\Menu
 */
interface Factory
{

	/**
	 * @return Kutny\Menu\Control
	 */
	public function create();
}
