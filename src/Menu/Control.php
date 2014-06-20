<?php

namespace WebEdit\Menu;

use WebEdit\Application;
use WebEdit\Entity;
use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Control extends Entity\Control {

    private $repository;
    private $groupRepository;
    private $groupControl;
    private $data = [];
    private $append = [];

    public function __construct(Menu\Repository $repository, Group\Repository $groupRepository, Group\Control\Factory $groupControl) {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
        $this->groupControl = $groupControl;
    }

    protected function render() {
        if (!$this->entity) {
            $this->entity = $this->repository->getMenuByLink(':' . $this->presenter->getName() . ':view');
        }
        if (!$this->data) {
            $this->data = $this->repository->getParents($this->entity) + $this->append;
        }
        $this->template->data = $this->data;
        $this->template->last = end($this->data);
        parent::render();
    }

    protected function createComponentGroup() {
        return new Application\Control\Multiplier(function($key) {
            $group = $this->groupRepository->getGroupByKey($key);
            $control = $this->groupControl->create();
            $control->setEntity($group);
            return $control;
        });
    }

    public function offsetSet($offset, $value) {
        $menu = new Menu\Entity;
        $menu->title = $value;
        $this->append[$offset ? : uniqid('append-')] = $menu;
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

}
