<?php

namespace WebEdit\Menu;

use WebEdit\Application;
use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Control extends Application\Control {

    private $repository;
    private $groupRepository;
    private $groupControl;
    private $breadcrumb;
    private $append = [];
    private $menu;

    public function __construct(Menu\Repository $repository, Group\Repository $groupRepository, Group\Control\Factory $groupControl) {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
        $this->groupControl = $groupControl;
    }

    protected function startup() {
        $this->menu = $this->menu ? : $this->repository->getByLink(':' . $this->presenter->getName() . ':view');
        $this->template->breadcrumb = $this->breadcrumb = $this->repository->getParents($this->menu) + $this->append; //TODO: $this->entity->parents
        $this->template->last = end($this->breadcrumb);
        $this->template->first = reset($this->breadcrumb);
        $this->template->menu = $this->menu;
    }

    public function setMenu(Menu\Entity $menu) {
        $this->menu = $menu;
    }

    protected function createComponentGroup() {
        return new Application\Control\Multiplier(function($key) {
            $group = $this->groupRepository->getByKey($key);
            return $this->groupControl->create($group, $this);
        });
    }

    public function offsetSet($offset, $value) {
        $menu = new Menu\Entity;
        $menu->title = $value;
        $this->append[$offset ? : uniqid('append-')] = $menu;
    }

    public function offsetExists($offset) {
        return isset($this->breadcrumb[$offset]);
    }

}
