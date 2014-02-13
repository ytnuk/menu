<?php

namespace WebEdit\Menu\Group\Admin;

use WebEdit\Admin;

final class Presenter extends Admin\Presenter {

    /**
     * @inject
     * @var \WebEdit\Menu\Group\Form\Factory
     */
    public $groupFormFactory;

    /**
     * @inject
     * @var \WebEdit\Menu\Group\Model\Repository
     */
    public $groupRepository;
    private $group;

    public function renderAdd() {
        $title = $this->translator->translate('menu.group.admin.add');
        $this->menu->breadcrumb->append($title);
    }

    public function actionEdit($id) {
        $this->group = $this->groupRepository->getGroup($id);
        if (!$this->group) {
            $this->error();
        }
    }

    public function renderEdit() {
        $title = $this->translator->translate('menu.group.admin.edit', NULL, ['group' => $this->group->menu->title]);
        $this->menu->breadcrumb->append($title);
        $this->template->group = $this->group;
    }

    protected function createComponentGroupFormAdd() {
        return $this->groupFormFactory->create();
    }

    protected function createComponentGroupFormEdit() {
        return $this->groupFormFactory->create($this->group);
    }

}
