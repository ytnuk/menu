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
     * @var Group\Facade
     */
    public $facade;

    /**
     * @inject
     * @var Menu\Facade
     */
    public $menuFacade;
    protected $entity;

    public function actionAdd() {
        $this['form']['menu']['menu_id']->setItems($this->menuFacade->getChildren());
    }

    public function renderAdd() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('menu.group.admin.add');
    }

    public function actionEdit($id) {
        $this->entity = $this->repository->getGroup($id);
        if (!$this->entity) {
            $this->error();
        }
        $this['form']['menu']['menu_id']->setItems($this->menuFacade->getChildren($this->entity->menu));
        $this['form']['menu']->setDefaults($this->entity->menu);
    }

    public function renderEdit() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('menu.group.admin.edit', NULL, ['group' => $this->entity->menu->title]);
    }

    protected function createComponentForm() {
        $form = $this->formFactory->create($this->entity);
        $form['menu'] = new Menu\Form\Container;
        return $form;
    }

}
