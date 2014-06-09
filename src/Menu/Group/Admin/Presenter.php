<?php

namespace WebEdit\Menu\Group\Admin;

use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Presenter extends Menu\Admin\Presenter {

    /**
     * @inject
     * @var Group\Repository
     */
    public $repository;

    /**
     * @inject
     * @var Group\Control\Factory
     */
    public $control;
    private $group;

    public function renderAdd() {
        $this['menu'][] = 'menu.group.admin.add';
    }

    public function actionEdit($id) {
        $this->group = $this->repository->getGroup($id);
        if (!$this->group) {
            $this->error();
        }
        $this['group']->setEntity($this->group);
    }

    public function renderEdit() {
        $this['menu'][] = 'menu.group.admin.edit';
    }

    protected function createComponentGroup() {
        return $this->control->create();
    }

}
