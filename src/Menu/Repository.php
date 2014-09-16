<?php

namespace WebEdit\Menu;

use WebEdit\Database;

final class Repository extends Database\Repository
{

    public function getByLink($link, $linkId = NULL)
    {
        return $this->getBy(['link' => $link, 'linkId' => $linkId]);
    }

//    public function getMenuByType($type) {
//        $data = $this->storage($type)->fetchPairs(NULL, 'menu_id');
//        return $this->storage()->where('id', $data);
//    }
}
