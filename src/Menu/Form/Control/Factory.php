<?php

namespace Kutny\Menu\Form\Control;

use Kutny;

/**
 * Interface Factory
 *
 * @package Kutny\Menu
 */
interface Factory
{

	/**
	 * @param Kutny\Menu\Entity
	 *
	 * @return Kutny\Menu\Form\Control
	 */
	public function create($menu);
}
