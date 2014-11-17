<?php

namespace WebEdit\Menu\Form\Control;

use WebEdit;

/**
 * Interface Factory
 *
 * @package WebEdit\Menu
 */
interface Factory
{

	/**
	 * @param WebEdit\Menu\Entity
	 *
	 * @return WebEdit\Menu\Form\Control
	 */
	public function create($menu);
}
