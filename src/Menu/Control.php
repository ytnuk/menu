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
    private $append = [];

    public function __construct(Menu\Repository $repository, Group\Repository $groupRepository, Group\Control\Factory $groupControl) {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
        $this->groupControl = $groupControl;
    }

    public function render($type = 'menu') {
        if (is_array($this->entity)) {
            $this->entity = $this->repository->getMenuBy($this->entity);
        }
        $this->template->parents = []; //TODO
        $this->template->data = array_merge([$this->entity], $this->append);
        parent::render($type);
    }

    public function renderTitle() {
        $this->render('title');
    }

    public function renderBreadcrumb() {
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
        $menu = new Menu;
        $menu->title = $value;
        $this->append[] = $menu;
    }

}
