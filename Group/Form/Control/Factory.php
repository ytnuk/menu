<?php

namespace WebEdit\Menu\Group\Form\Control;

use WebEdit\Menu\Group\Form;

interface Factory {

    /**
     * @return Form\Control
     */
    public function create();
}
