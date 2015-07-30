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
	 * @param Ytnuk\Menu\Entity $menu
	 *
	 * @return Ytnuk\Menu\Control
	 */
	public function create(Ytnuk\Menu\Entity $menu);
}
