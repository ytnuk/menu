<?php

namespace WebEdit\Menu\Node\Model;

use WebEdit\Model,
    WebEdit\Menu\Node;

class Facade extends Model\Facade {

    public $repository;

    public function __construct(Node\Model\Repository $repository) {
        $this->repository = $repository;
    }

    public function getFormContainer($node = NULL, $table = NULL) {
        $data = array();
        $data[NULL] = 'form.select.empty';

        if ($table) {
            $children = $this->repository->getNodesInTable($table);
        } else {
            $root = $this->repository->getFrontNode();
            $data[$root->id] = $root->title;
            $children = $this->repository->getChildNodes($root);
        }

        $data+=$children->fetchPairs('id', 'title');

        if ($node) {
            unset($data[$node->id]);
            foreach ($this->repository->getIdsOfChildNodes($node) as $id) {
                unset($data[$id]);
            }
        }
        return new Node\Form\Container($data, $node);
    }

    public function addNode($data) {
        return $this->repository->insert($data);
    }

    public function editNode($node, $data) {
        return $this->repository->update($node, $data);
    }

    public function deleteNode($node) {
        $selection = $node->related('node');
        $data = array('node_id' => $node->node_id);
        $this->repository->update($selection, $data);
        return $this->repository->remove($node);
    }

}
