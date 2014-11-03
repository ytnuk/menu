<?php

namespace WebEdit\Menu;

use WebEdit\Orm;
use WebEdit\Page;

/**
 * @property-read Entity[] $parents {virtual}
 * @property-read Entity[] $children {virtual}
 * @property Entity|NULL $parent {m:1 Repository $allChildren}
 * @property Entity[] $allChildren {1:m Repository $parent}
 * @property string $title
 * @property string $link
 * @property int|NULL $linkId
 * @property bool|NULL $hidden
 * @property string|NULL $uid
 * @property Page\Entity|NULL $page {1:1d Page\Repository $menu}
 */
final class Entity extends Orm\Entity
{

	/**
	 * @return array
	 */
	public function getChildren()
	{
		return $this->getValue('allChildren')
			->get()
			->findBy(['hidden' => NULL]);
	}

	/**
	 * @return array
	 */
	public function getParents()
	{
		$menu = $this;
		$parents = [];
		while ($menu = $menu->parent) {
			$parents[$menu->id] = $menu;
		}

		return array_reverse($parents, TRUE);
	}
}
