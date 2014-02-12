<?php

namespace WebEdit\Menu\Control;

use WebEdit\Menu\Control;

interface Factory {

    /**
     * @return Control
     */
    public function create($groupKey);
}
