<?php

namespace WebEdit\Menu\Breadcrumb;

use WebEdit;
use WebEdit\Menu\Node;

class Control extends WebEdit\Control {

    private $nodes = array();
    private $nodeFacade;
    private $node;

    public function __construct(Node\Model\Facade $nodeFacade) {
        $this->nodeFacade = $nodeFacade;
    }

    public function render() {
        $template = $this->template;
        $template->nodes = $this->nodes;
        $template->setFile(__DIR__ . '/Control/breadcrumb.latte');
        $template->render();
    }

    public function fromNode($node) {
        $this->nodes = $this->nodeFacade->repository->getParentNodes($node);
        $this->nodes[$node->id] = $node;
        $this->node = $node;
    }

    public function fromLink($link, $link_id = NULL) {
        $node = $this->nodeFacade->repository->getNodeByLink($link, $link_id);
        if ($node) {
            $this->fromNode($node);
        }
    }

    public function append($title, $link = NULL, $link_id = NULL) {
        $id = uniqid();
        $this->nodes[$id] = (object) array(
                    'id' => $id,
                    'title' => $title,
                    'link' => $link,
                    'link_id' => $link_id,
        );
    }

    public function getNode() {
        return $this->node;
    }

    public function getLast() {
        $values = array_values($this->nodes);
        return end($values);
    }

    public function has($id) {
        return isset($this->nodes[$id]);
    }

}
