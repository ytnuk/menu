<?php

namespace WebEdit\Menu\Group\Control;

use WebEdit\Menu\Group;

interface Factory {

    /**
     * @return Group\Control
     */
    public function create();
}
