<?php

namespace WebEdit\Menu\Group;

use WebEdit\Entity;
use WebEdit\Menu\Group\Form;

final class Control extends Entity\Control {

    public function __construct(Form\Control\Factory $formControl) {
        $this->formControl = $formControl;
    }

    public function render($type) {
        $this->template->breadcrumb = $this->presenter['menu'];
        parent::render($type);
    }

}
