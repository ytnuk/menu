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
        $front = $this->groupRepository->getByKey('front');
        $children = $this->repository->getChildren($front->menu, $menu);
        return $children->fetchPairs('id', 'title');
    }

    public function getMenuByType($type)
    {
        $menu = $this->repository->getMenuByType($type);
        return $menu->fetchPairs('id', 'title');
    }

}
