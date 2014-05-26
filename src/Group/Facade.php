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

    public function add(array $data) {
        $menu = $this->menuFacade->add($data);
        $data['menu']['group']['menu_id'] = $menu->id;
        return $this->repository->insert($data['menu']['group']);
    }

    public function edit($group, array $data) {
        $this->menuFacade->editMenu($group->menu, $data);
    }

    public function delete($group) {
        $this->menuFacade->deleteMenu($group->menu);
        $this->repository->remove($group);
    }

}
