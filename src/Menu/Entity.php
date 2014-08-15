<?php

namespace WebEdit\Menu;

use WebEdit\Database;
use WebEdit\Menu;
use WebEdit\Menu\Group;

/**
 * @property-read array $parents {virtual}
 * @property Menu\Entity|NULL $menu {m:1 Menu\Repository $children}
 * @property Menu\Entity[] $children {1:m Menu\Repository $menu}
 * @property string $title
 * @property string $link
 * @property string|NULL $linkId
 * @property Group\Entity[] $groups {1:m Group\Repository $menu}
 */
final class Entity extends Database\Entity {

    public function getParents() {
        $menu = $this;
        $data = [$menu->id => $menu];
        while ($menu = $menu->parent) {
            $data[$menu->id] = $menu;
        }
        return array_reverse($data, TRUE);
    }

}
