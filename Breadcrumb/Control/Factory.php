<?php

namespace WebEdit\Menu\Breadcrumb\Control;

use WebEdit\Menu\Breadcrumb\Control;

interface Factory {

    /**
     * @return Control
     */
    public function create();
}
