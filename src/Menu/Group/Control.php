<?php

namespace WebEdit\Menu\Group;

use WebEdit\Entity;

final class Control extends Entity\Control {

    public function render($type = 'group') {
        $this->template->breadcrumb = $this->presenter['menu'];
        parent::render($type);
    }

    public function renderNavbar() {
        $this->render('navbar');
    }

    public function renderPanel() {
        $this->render('panel');
    }

}
