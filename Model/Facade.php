<?php

namespace WebEdit\Menu\Model;

use WebEdit\Model,
    WebEdit\Menu,
    WebEdit\Menu\Group;

class Facade extends Model\Facade {

    public $repository;
    private $groupFacade;

    public function __construct(Menu\Model\Repository $repository, Group\Model\Facade $groupFacade) {
        $this->repository = $repository;
        $this->groupFacade = $groupFacade;
    }

    public function getFormContainer($menu = NULL, $table = NULL) {
        $data = array();
        $data[NULL] = 'form.select.empty';
        if ($table) {
            $children = $this->repository->getMenuFromTable($table);
        } else {
            $front = $this->groupFacade->repository->getGroupByKey('front');
            $children = $this->repository->getChildren($front->menu, $menu);
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
