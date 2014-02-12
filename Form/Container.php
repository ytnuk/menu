<?php

namespace WebEdit\Menu\Form;

use WebEdit\Form;

class Container extends Form\Container {

    public function __construct($data, $row = NULL) {
        $this->addText('title', 'menu.admin.menu.form.title.label')->setRequired();
        if ($data) {
            $this->addSelect('menu_id', 'menu.admin.menu.form.parent.label', $data)->setRequired();
        }
        if ($row) {
            $this->setDefaults($row);
        }
    }

}
