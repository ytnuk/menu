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
	 * @param Ytnuk\Menu\Entity
	 *
	 * @return Ytnuk\Menu\Control
	 */
	public function create($menu);
}
