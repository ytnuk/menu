<?php

namespace WebEdit\Menu;

use WebEdit\Database;
use WebEdit\Menu;
use WebEdit\Page;

/**
 * @property-read Menu\Entity[] $tree {virtual}
 * @property-read Menu\Entity[] $parents {virtual}
 * @property Menu\Entity|NULL $parent {m:1 Menu\Repository $children}
 * @property Menu\Entity[] $children {1:m Menu\Repository $parent}
 * @property string $title
 * @property string $link
 * @property int|NULL $linkId
 * @property int|NULL $hidden
 * @property string|NULL $uid
 * @property Page\Entity $page {1:1d Page\Repository $menu}
 */
final class Entity extends Database\Entity
{

    public function getChildren()
    {
        return $this->getValue('children')->get()->findBy(['hidden' => NULL]);
    }

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
