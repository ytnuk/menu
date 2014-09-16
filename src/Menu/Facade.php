<?php

namespace WebEdit\Menu;

use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Facade
{

    private $repository;
    private $groupRepository;

    public function __construct(Menu\Repository $repository, Group\Repository $groupRepository)
    {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
    }

    public function getChildren($menu = NULL)
    {
        $front = $this->groupRepository->getGroupByKey('front');
        $children = $this->repository->getChildren($front->menu, $menu);
        return $children->fetchPairs('id', 'title');
    }

    public function getMenuByType($type)
    {
        $menu = $this->repository->getMenuByType($type);
        return $menu->fetchPairs('id', 'title');
    }

    public function add($data)
    {
        return $this->repository->insert($data['menu']);
    }

    public function edit($menu, $data)
    {
        $this->repository->update($menu, $data['menu']);
    }

    public function delete($menu)
    {
        $selection = $menu->related('menu');
        $this->repository->update($selection, ['menu_id' => $menu->menu_id]);
        $this->repository->remove($menu);
    }

}
