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
	 * @param string $link
	 * @param null $linkId
	 *
	 * @return Entity
	 */
	public function getByLink($link, $linkId = NULL) //TODO: refactor
	{
		return $this->getBy([
			'this->link->destination' => $link,
		]);
	}
}
