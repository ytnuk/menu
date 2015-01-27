<?php

namespace Ytnuk\Menu;

use Ytnuk;

/**
 * @property-read Entity[] $parents {virtual}
 * @property Ytnuk\Link\Entity $link {1:1d Ytnuk\Link\Repository $menu primary}
 * @property Entity|NULL $parent {m:1 Repository $children}
 * @property Entity[] $children {1:m Repository $parent}
 * @property string $title
 * TODO:
 * @property Ytnuk\Page\Entity|NULL $page {1:1d Ytnuk\Page\Repository $menu}
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'title';

	/**
	 * @return array
	 */
	protected function getterParents()
	{
		$menu = $this;
		$parents = [];
		while ($menu = $menu->parent) {
			$parents[$menu->id] = $menu;
		}

		return array_reverse($parents, TRUE);
	}
}
