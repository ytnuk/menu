<?php

namespace Ytnuk\Menu;

use Ytnuk;

/**
 * Class Repository
 *
 * @package Ytnuk\Menu
 */
final class Repository extends Ytnuk\Orm\Repository
{

	/**
	 * @param Ytnuk\Link\Entity $link
	 *
	 * @return Entity|NULL
	 */
	public function getByLink(Ytnuk\Link\Entity $link)
	{
		return $this->getBy(['this->link' => $link]);
	}
}
