<?php

namespace WebEdit\Menu\Group\Admin;

use WebEdit\Admin;

final class Presenter extends Admin\Presenter {

    /**
     * @inject
     * @var \WebEdit\Menu\Group\Form\Factory
     */
    public $formFactory;

    /**
     * @inject
     * @var \WebEdit\Menu\Group\Repository
     */
    public $repository;
    private $group;

    public function renderAdd() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('menu.group.admin.add');
    }

    public function actionEdit($id) {
        $this->group = $this->repository->getGroup($id);
        if (!$this->group) {
            $this->error();
        }
    }

    public function renderEdit() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('menu.group.admin.edit', NULL, ['group' => $this->group->menu->title]);
        $this->template->group = $this->group;
    }

    protected function createComponentGroupFormAdd() {
        return $this->formFactory->create();
    }

    protected function createComponentGroupFormEdit() {
        return $this->formFactory->create($this->group);
    }

}
