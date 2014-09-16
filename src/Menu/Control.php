<?php

namespace WebEdit\Menu;

use WebEdit\Application;
use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Control extends Application\Control
{

    private $repository;
    private $groupRepository;
    private $groupControl;
    private $breadcrumb = [];
    private $append = [];
    private $menu;

    public function __construct(Menu\Repository $repository, Group\Repository $groupRepository, Group\Control\Factory $groupControl)
    {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
        $this->groupControl = $groupControl;
    }

    public function setMenu(Menu\Entity $menu)
    {
        $this->menu = $menu;
    }

    public function offsetSet($offset, $title)
    {
        $menu = new Menu\Entity;
        $menu->title = $title;
        $this->append[] = $menu;
    }

    public function offsetExists($id)
    {
        foreach ($this->breadcrumb as $menu) {
            if ($menu->id === $id) {
                return $menu;
            }
        }
        return FALSE;
    }

    protected function startup()
    {
        $this->menu = $this->menu ?: $this->repository->getByLink(':' . $this->presenter->getName() . ':view');
        $this->template->breadcrumb = $this->breadcrumb = $this->menu->parents + [$this->menu] + $this->append;
        $this->template->last = end($this->breadcrumb);
        $this->template->first = reset($this->breadcrumb);
        $this->template->menu = $this->menu;
    }

    protected function createComponentGroup()
    {
        return new Application\Control\Multiplier(function ($key) {
            $group = $this->groupRepository->getByKey($key);
            return $this->groupControl->create($group, $this);
        });
    }

}
