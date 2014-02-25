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

    /**
     * @inject
     * @var \WebEdit\Menu\Group\Facade
     */
    public $facade;
    private $group;

    public function actionAdd() {
        $this['form']->onSuccess[] = [$this, 'handleAdd'];
    }

    public function handleAdd($form) {
        $group = $this->facade->addGroup($form->getValues(TRUE));
        $this->redirect('Presenter:edit', ['id' => $group->id]);
    }

    public function renderAdd() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('menu.group.admin.add');
    }

    public function actionEdit($id) {
        $this->group = $this->repository->getGroup($id);
        if (!$this->group) {
            $this->error();
        }
        $this['form']['menu']->setDefaults($this->group->menu);
        $this['form']->onSuccess[] = [$this, 'handleEdit'];
    }

    public function handleEdit($form) {
        if ($form->submitted->name == 'delete') {
            $this->facade->deleteGroup($this->group);
            $this->redirect('Presenter:view');
        } else {
            $this->facade->editGroup($this->group, $form->getValues(TRUE));
            $this->redirect('this');
        }
    }

    public function renderEdit() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('menu.group.admin.edit', NULL, ['group' => $this->group->menu->title]);
    }

    protected function createComponentForm() {
        return $this->formFactory->create($this->group);
    }

}
