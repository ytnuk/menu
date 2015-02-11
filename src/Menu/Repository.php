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
	 * @param Entity $menu
	 * @param string $destination
	 * @param array $parameters
	 *
	 * @return Entity
	 */
	public function getByLink(Entity $menu, $destination, $parameters = [])
	{
		$collection = $this->findBy([
			'this->link->destination' => $destination,
			'id' => array_keys([$menu->id => $menu] + $menu->getterChildren(TRUE))
		]);
		$links = [];
		foreach ($collection->fetchPairs(NULL, 'link') as $link) {
			$links[$link->id] = $link;
		}

		return $links ? $this->getBy([
			'this->link' => $this->mapper->fetchByParameters($links, $parameters)
		]) : NULL;
	}
}
