<?php

namespace WebEdit\Menu;

use WebEdit;
use WebEdit\Entity;
use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Control extends Entity\Control {

    private $repository;
    private $groupRepository;
    private $groupControl;
    private $data = [];

    public function __construct(Menu\Repository $repository, Group\Repository $groupRepository, Group\Control\Factory $groupControl) {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
        $this->groupControl = $groupControl;
    }

    public function setEntity($menu) {
        if (is_array($menu)) {
            $menu = $this->repository->getMenuBy($menu);
        }
        if ($menu) {
            $this->data = $this->repository->getParents($menu);
        }
        parent::setEntity($menu);
    }

    public function renderTitle() {
        $this->template->last = end($this->data);
        $this->render('title');
    }

    public function renderBreadcrumb() {
        $this->template->data = $this->data;
        $this->render('breadcrumb');
    }

    protected function createComponentGroup() {
        return new WebEdit\Control\Multiplier(function($key) {
            $group = $this->groupRepository->getGroupByKey($key);
            $control = $this->groupControl->create();
            $control->setEntity($group);
            return $control;
        });
    }

    public function offsetSet($offset, $value) {
        $menu = new Menu\Entity;
        $menu->title = $value;
        $this->data[$offset ? : uniqid('append-')] = $menu;
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

}
