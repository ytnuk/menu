<?php

namespace WebEdit\Menu;

use WebEdit\Database;
use WebEdit\Menu;
use WebEdit\Page;

/**
 * @property-read Menu\Entity[] $parents {virtual}
 * @property-read Menu\Entity[] $children {virtual}
 * @property Menu\Entity|NULL $parent {m:1 Menu\Repository $allChildren}
 * @property Menu\Entity[] $allChildren {1:m Menu\Repository $parent}
 * @property string $title
 * @property string $link
 * @property int|NULL $linkId
 * @property bool|NULL $hidden
 * @property string|NULL $uid
 * @property Page\Entity|NULL $page {1:1d Page\Repository $menu}
 */
final class Entity extends Database\Entity
{

	/**
	 * @return array
	 */
	public function getChildren()
	{
		return $this->getValue('allChildren')->get()->findBy(['hidden' => NULL]);
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
