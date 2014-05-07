<?php

namespace WebEdit\Menu\Breadcrumb\Control;

use WebEdit\Menu\Breadcrumb;

interface Factory {

    /**
     * @return Breadcrumb\Control
     */
    public function create();
}
