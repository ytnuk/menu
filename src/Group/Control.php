<?php

namespace WebEdit\Menu\Group;

use WebEdit;
use WebEdit\Menu\Group\Form;

final class Control extends WebEdit\Control {

    public function __construct(Form\Control\Factory $formControl) {
        $this->form = $formControl;
    }

    public function render() {
        //TODO
        $this->template->group = $this->entity;
        $this->template->render($this->getTemplateFiles('group'));
    }

}
