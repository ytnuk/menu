<?php

namespace WebEdit\Menu\Group;

use WebEdit\Entity;
use WebEdit\Menu\Group\Form;

final class Control extends Entity\Control {

    public function __construct(Form\Control\Factory $formControl) {
        $this->form = $formControl;
    }

    public function render() {
        //TODO
        $this->template->group = $this->entity;
        $this->template->render($this->getTemplateFiles('group'));
    }

}
