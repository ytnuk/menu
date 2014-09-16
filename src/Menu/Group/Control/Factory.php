<?php

namespace WebEdit\Menu\Group\Control;

use WebEdit\Menu;
use WebEdit\Menu\Group;

interface Factory
{

    /**
     * @param string $group
     * @param Menu\Control $breadcrumb
     * @return Group\Control
     */
    public function create($group, $breadcrumb);
}
