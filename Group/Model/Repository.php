<?php

namespace WebEdit\Menu\Group\Model;

use WebEdit\Database;

final class Repository extends Database\Repository {

    public function getGroup($id) {
        return $this->table()->where('id', $id)->where('key', NULL)->fetch();
    }

    public function getGroupByKey($key) {
        return $this->table()->where('key', $key)->fetch();
    }

    public function getAllGroups() {
        return $this->table();
    }

}
