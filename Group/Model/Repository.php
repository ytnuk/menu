<?php

namespace WebEdit\Menu\Group\Model;

use WebEdit\Database;

final class Repository extends Database\Repository {

    protected $table = "menu_group";

    public function getGroupByKey($key) {
        return $this->table()->where('key', $key)->fetch();
    }

}
