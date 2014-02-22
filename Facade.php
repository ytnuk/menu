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

    public function getFormContainer($menu = NULL, $table = NULL) {
        $data = array();
        $data[NULL] = 'form.select.empty';
        if ($table) {
            $children = $this->repository->getMenuFromTable($table);
        } else {
            $front = $this->groupRepository->getGroupByKey('front');
            $children = $this->repository->getChildren($front->menu, $menu);
            if (!$menu) {
                $menu = $front;
            }
        }
        $data+=$children->fetchPairs('id', 'title');
        return new Menu\Form\Container($data, $menu);
    }

    public function addMenu($data) {
        return $this->repository->insert($data);
    }

    public function editMenu($menu, $data) {
        return $this->repository->update($menu, $data);
    }

    public function deleteMenu($menu) {
        $selection = $menu->related('menu');
        $data = array('menu_id' => $menu->menu_id);
        $this->repository->update($selection, $data);
        return $this->repository->remove($menu);
    }

}
