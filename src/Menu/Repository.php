<?php

namespace WebEdit\Menu;

use WebEdit\Database;
use WebEdit\Menu;

final class Repository extends Database\Repository
{

    public function getByLink($link, $linkId = NULL)
    {
        return $this->getBy(['link' => $link, 'linkId' => $linkId]);
    }

    public function getByUid($uid)
    {
        return $this->findBy(['uid' => $uid])->fetch();
    }

    public function findChildren(Menu\Entity $menu)
    {
        return $this->findById($this->findChildrenIds($menu));
    }

    public function findChildrenIds(Menu\Entity $menu)
    {
        $tree = [$menu->id];
        foreach ($menu->children as $menu) {
            $tree = array_merge($tree, $this->findChildrenIds($menu));
        }
        return $tree;
    }

//    public function getMenuByType($type) {
//        $data = $this->storage($type)->fetchPairs(NULL, 'menu_id');
//        return $this->storage()->where('id', $data);
//    }
}
