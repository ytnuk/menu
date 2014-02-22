<?php

namespace WebEdit\Menu\Group;

use WebEdit,
    WebEdit\Menu,
    WebEdit\Menu\Group;

class Facade extends WebEdit\Facade {

    public $repository;
    private $menuFacade;

    public function __construct(Group\Repository $repository, Menu\Facade $menuFacade) {
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
