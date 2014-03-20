<?php

namespace WebEdit\Menu\Group;

use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Facade {

    public $repository;
    private $menuFacade;

    public function __construct(Group\Repository $repository, Menu\Facade $menuFacade) {
        $this->repository = $repository;
        $this->menuFacade = $menuFacade;
    }

    public function addGroup(array $data) {
        $menu = $this->menuFacade->addMenu($data);
        $data['group']['menu_id'] = $menu->id;
        return $this->repository->insert($data['group']);
    }

    public function editGroup($group, array $data) {
        $this->menuFacade->editMenu($group->menu, $data);
    }

    public function deleteGroup($group) {
        $this->menuFacade->deleteMenu($group->menu);
        $this->repository->remove($group);
    }

}
