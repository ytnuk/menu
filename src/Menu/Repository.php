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
		//TODO: must be under $menu in tree, using $menu->node->left and $menu->node->right indexes.. use indexes of all $menu->nodes?
		//then web in link_parameters should be removed
		$collection = $this->findBy([
			'this->link->destination' => $destination,
		]);

		return $this->getBy([
			'this->link' => $this->mapper->fetchByParameters($collection->fetchPairs('link', 'link'), $parameters)
		]);
	}
}
