<?php

namespace WebEdit\Menu\Group\Model;

use WebEdit\Model,
    WebEdit\Menu,
    WebEdit\Menu\Group;

class Facade extends Model\Facade {

    public $repository;
    private $menuFacade;

    public function __construct(Group\Model\Repository $repository, Menu\Model\Facade $menuFacade) {
        $this->repository = $repository;
        $this->menuFacade = $menuFacade;
    }

    public function addGroup(array $data) {
        $menu = $this->menuFacade->addMenu($data['menu']);
        $group = array(
            'menu_id' => $menu->id
        );
        return $this->repository->insert($group);
    }

    public function editGroup($group, array $data) {
        $this->menuFacade->editMenu($group->menu, $data['menu']);
        return $group;
    }

    public function deleteGroup($group) {
        $this->menuFacade->deleteMenu($group->menu);
        return $this->repository->remove($group);
    }

}
