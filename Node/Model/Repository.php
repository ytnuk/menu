<?php

namespace WebEdit\Menu\Node\Model;

use WebEdit\Database;

final class Repository extends Database\Repository {

    protected $table = "node";

    public function getNode($id) {
        return $this->table()->get($id);
    }

    public function getNodeByLink($link, $link_id = NULL) {
        return $this->table()->where('link', $link)->where('link_id', $link_id)->fetch();
    }

    public function getFrontNode() {
        return $this->getNodeByLink(':Home:Presenter:view');
    }

    public function getAdminNode() {
        return $this->getNodeByLink(':Home:Admin:Presenter:view');
    }

    public function getParentNodes($node) {
        $nodes = array();
        while ($node->node) {
            $nodes[$node->node_id] = $node->node;
            $node = $node->node;
        }
        return array_reverse($nodes, TRUE);
    }

    public function getChildNodes($node, $current = NULL) {
        $data = $this->getIdsOfChildNodes($node, $current);
        return $this->table()->where('id', $data);
    }

    public function getIdsOfChildNodes($node, $current = NULL) {
        $data = array();
        if ($current) {
            $data[] = $node->id;
        }
        foreach ($node->related('node') as $child) {
            if (!$current) {
                $data[] = $child->id;
            }
            $data = array_merge($data, $this->getIdsOfChildNodes($child, $current));
        }
        return $data;
    }

    public function getNodesInTable($name) {
        $data = $this->table($name)->fetchPairs('id', 'node_id');
        return $this->table()->where('id', array_values($data));
    }

}
