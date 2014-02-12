<?php

namespace WebEdit\Menu\Group\Model;

use WebEdit\Database;

final class Repository extends Database\Repository {

    public function getGroupByKey($key) {
        return $this->table()->where('key', $key)->fetch();
    }

    public function getAllGroups() {
        return $this->table();
    }

}
