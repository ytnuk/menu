<?php

namespace WebEdit\Menu\Group\Model;

use WebEdit\Model,
    WebEdit\Menu\Group;

class Facade extends Model\Facade {

    public $repository;

    public function __construct(Group\Model\Repository $repository) {
        $this->repository = $repository;
    }

}
