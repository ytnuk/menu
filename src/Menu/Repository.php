<?php

namespace WebEdit\Menu;

use WebEdit\Database;

final class Repository extends Database\Repository {

    public function getByLink($link, $linkId = NULL) {
        return $this->findBy(['link' => $link, 'linkId' => $linkId])->fetch();
    }

//    public function getMenu($id) {
//        return $this->storage()->get($id);
//    }
//
//    public function getMenuBy($params) {
//        return $this->storage()->where($params)->fetch();
//    }
//
//    public function getMenuByLink($link, $link_id = NULL) {
//        return $this->storage()->where('link', $link)->where('link_id', $link_id)->fetch();
//    }
//
//    public function getParents($menu) {
//        $data = [$menu->id => $menu];
//        while ($menu->menu_id) {
//            $menu = $data[$menu->menu_id] = $menu->menu;
//        }
//        return array_reverse($data, TRUE);
//    }
//
//    public function getChildren($menu, $active = NULL) {
//        return $this->storage()->where('id', $this->getIdsOfChildren($menu, $active));
//    }
//
//    private function getIdsOfChildren($menu, $active) {
//        $data = [];
//        if ($active && $menu->id == $active->id) {
//            return $data;
//        }
//        $data[] = $menu->id;
//        foreach ($menu->related('menu') as $child) {
//            $data = array_merge($data, $this->getIdsOfChildren($child, $active));
//        }
//        return $data;
//    }
//
//    public function getMenuByType($type) {
//        $data = $this->storage($type)->fetchPairs(NULL, 'menu_id');
//        return $this->storage()->where('id', $data);
//    }
}
