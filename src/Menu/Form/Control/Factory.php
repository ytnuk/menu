<?php

namespace WebEdit\Menu\Form\Control;

use WebEdit\Menu;

/**
 * Interface Factory
 *
 * @package WebEdit\Menu
 */
interface Factory
{

	/**
	 * @param Menu\Entity
	 *
	 * @return Menu\Form\Control
	 */
	public function create($menu);
}
