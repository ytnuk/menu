<?php

namespace WebEdit\Menu\Group\Form;

use WebEdit\Entity;
use WebEdit\Form;
use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Control extends Entity\Form\Control {

    private $menuFacade;

    public function __construct(Group\Facade $facade, Form\Factory $form, Menu\Facade $menuFacade) {
        $this->facade = $facade;
        $this->form = $form;
        $this->menuFacade = $menuFacade;
    }

    protected function createComponentForm() {
        $form = parent::createComponentForm();
        $form['menu'] = new Menu\Form\Container;
        $form['menu']['menu_id']->setItems($this->menuFacade->getChildren($this->entity ? $this->entity->menu : NULL));
        if ($this->entity) {
            $form['menu']->setDefaults($this->entity->menu);
        }
        return $form;
    }

}
