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
    private $menu = [];
    private $append = [];

    public function __construct(Menu\Repository $repository, Group\Repository $groupRepository, Group\Control\Factory $groupControl) {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
        $this->groupControl = $groupControl;
    }

    protected function render() {
        $this->entity = $this->entity ? : $this->repository->getByLink(':' . $this->presenter->getName() . ':view');
        dump($this->entity->groups->get()->fetchPairs('id', 'key'));
        dump($this->entity->children->get()->fetchAll());
        //dump($this->entity->menu);
        exit;
        $this->menu = $this->menu ? : $this->entity->parents + $this->append;
        $this->template->menu = $this->menu;
        $this->template->last = end($this->menu);
        $this->template->first = reset($this->menu);
        parent::render();
    }

    protected function createComponentGroup() {
        return new Application\Control\Multiplier(function($key) {
            $group = $this->groupRepository->getByKey($key);
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
        return isset($this->menu[$offset]);
    }

}
