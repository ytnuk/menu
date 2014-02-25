<?php

namespace WebEdit\Menu;

use WebEdit,
    WebEdit\Menu,
    WebEdit\Menu\Group;

class Facade extends WebEdit\Facade {

    public $repository;
    private $groupRepository;

    public function __construct(Menu\Repository $repository, Group\Repository $groupRepository) {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
    }

    public function getChildren($menu = NULL) {
        $front = $this->groupRepository->getGroupByKey('front');
        $children = $this->repository->getChildren($front->menu, $menu);
        return $children->fetchPairs('id', 'title');
    }

    public function getMenuFromTable($table) {
        $menu = $this->repository->getMenuFromTable($table);
        return $menu->fetchPairs('id', 'title');
    }

    public function addMenu($data) {
        return $this->repository->insert($data['menu']);
    }

    public function editMenu($menu, $data) {
        $this->repository->update($menu, $data['menu']);
    }

    public function deleteMenu($menu) {
        $selection = $menu->related('menu');
        $this->repository->update($selection, ['menu_id' => $menu->menu_id]);
        $this->repository->remove($menu);
    }

}
