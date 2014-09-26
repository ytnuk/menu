<?php

namespace WebEdit\Menu\Form;

use WebEdit\Database;
use WebEdit\Form;
use WebEdit\Menu;

final class Control extends Form\Control
{

    private $menu;
    private $form;
    private $repository;

    public function __construct($menu, Menu\Repository $repository, Form\Factory $form)
    {
        $this->menu = $menu;
        $this->repository = $repository;
        $this->form = $form;
    }

    protected function createComponentForm()
    {
        $form = $this->form->create();
        $form['menu'] = new Menu\Form\Container($this->menu ?: new Menu\Entity, $this->repository);
        if ($this->menu) {
            $form->addSubmit('edit', 'form.button.save');
            $form->addSubmit('delete', 'form.button.delete')->setValidationScope(FALSE);
        } else {
            $form->addSubmit('add', 'form.button.add');
        }
        return $form;
    }

}
