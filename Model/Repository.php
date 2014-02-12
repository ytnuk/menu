<?php

namespace WebEdit\Menu\Model;

use WebEdit\Database;

final class Repository extends Database\Repository {

    public function getMenu($id) {
        return $this->table()->get($id);
    }

    public function getMenuByLink($link, $link_id = NULL) {
        return $this->table()->where('link', $link)->where('link_id', $link_id)->fetch();
    }

    public function getParents($menu) {
        $data = array($menu->id => $menu);
        while ($menu->menu_id) {
            $menu = $data[$menu->menu_id] = $menu->menu;
        }
        return array_reverse($data, TRUE);
    }

    public function getChildren($menu, $active = NULL) {
        return $this->table()->where('id', $this->getIdsOfChildren($menu, $active));
    }

    private function getIdsOfChildren($menu, $active) {
        $data = array();
        if ($active && $menu->id == $active->id) {
            return $data;
        }
        $data[] = $menu->id;
        foreach ($menu->related('menu') as $child) {
            $data = array_merge($data, $this->getIdsOfChildren($child, $active));
        }
        return $data;
    }

    public function getMenuFromTable($name) {
        $data = $this->table($name)->fetchPairs(NULL, 'menu_id');
        return $this->table()->where('id', $data);
    }

}
