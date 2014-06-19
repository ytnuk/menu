<?php

namespace WebEdit\Menu\Group;

use WebEdit\Entity;

final class Control extends Entity\Control {

    protected function render() {
        $this->template->breadcrumb = $this->presenter['menu'];
        parent::render();
    }

}
