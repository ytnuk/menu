<?php

namespace WebEdit\Menu;

use WebEdit\Database;
use WebEdit\Menu;
use WebEdit\Menu\Group;

/**
 * @property Menu\Entity|NULL $menu {m:1 Menu\Repository $allChildren}
 * @property Menu\Entity[] $allChildren {1:m Menu\Repository $menu}
 * @property-read Menu\Entity[] $children {virtual}
 * @property string $title
 * @property string $link
 * @property int|NULL $linkId
 * @property int $hidden
 * @property Group\Entity[] $groups {1:m Group\Repository $menu}
 */
final class Entity extends Database\Entity {

    public function getChildren() {
        return $this->allChildren->get()->findBy(['hidden' => FALSE]);
    }

}
