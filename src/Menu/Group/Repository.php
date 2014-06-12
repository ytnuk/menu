<?php

namespace WebEdit\Menu\Group;

use WebEdit\Database;

final class Repository extends Database\Repository {

    public function getGroup($id) {
        return $this->storage()->get($id);
    }

    public function getGroupByKey($key) {
        return $this->storage()->where('key', $key)->fetch();
    }

}
