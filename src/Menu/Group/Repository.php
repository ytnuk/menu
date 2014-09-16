<?php

namespace WebEdit\Menu\Group;

use WebEdit\Database;

final class Repository extends Database\Repository
{

    public function getByKey($key)
    {
        return $this->findBy(['key' => $key])->fetch();
    }

}
