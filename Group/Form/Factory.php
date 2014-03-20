<?php

namespace WebEdit\Menu\Group\Form;

use WebEdit\Menu;

final class Factory {

    private $menuFormFactory;

    public function __construct(Menu\Form\Factory $menuFormFactory) {
        $this->menuFormFactory = $menuFormFactory;
    }

    public function create($group = NULL) {
        $menu = $group ? $group->menu : NULL;
        return $this->menuFormFactory->create($menu);
    }

}
