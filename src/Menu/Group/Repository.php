<?php

namespace WebEdit\Menu\Group;

use WebEdit\Database;

final class Repository extends Database\Repository {

    public function getGroup($id) {
        return $this->storage()->where('id', $id)->fetch();
    }

    public function getGroupByKey($key) {
        return $this->storage()->where('key', $key)->fetch();
    }

    public function getAllGroups($withKey = TRUE) {
        $selection = $this->storage();
        if (!$withKey) {
            $selection->where('key', NULL);
        }
        return $selection;
    }

}
