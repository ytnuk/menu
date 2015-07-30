<?php
namespace Ytnuk\Menu\Form\Control;

use Ytnuk;

/**
 * Interface Factory
 *
 * @package Ytnuk\Menu
 */
interface Factory
{

	/**
	 * @param Ytnuk\Menu\Entity $menu
	 *
	 * @return Ytnuk\Menu\Form\Control
	 */
	public function create(Ytnuk\Menu\Entity $menu);
}
