<?php

namespace WebEdit\Menu\Form;

use WebEdit\Form;
use WebEdit\Menu;

class Factory {

    private $formFactory;
    private $facade;

    public function __construct(Form\Factory $formFactory, Menu\Facade $facade) {
        $this->formFactory = $formFactory;
        $this->facade = $facade;
    }

    public function create($menu = NULL, $table = NULL) {
        $form = $this->formFactory->create($menu);
        $form->addGroup('menu.form.group');
        $container = $form->addContainer('menu');
        $container->addText('title', 'menu.form.title.label')->setRequired();
        $items = $table ? $this->facade->getMenuFromTable($table) : $this->facade->getChildren($menu);
        $container->addSelect('menu_id', 'menu.form.parent.label')
                ->setItems($items)
                ->setRequired()
                ->setPrompt('form.select.prompt');
        return $form;
    }

}
