<?php

namespace WebEdit\Menu\Breadcrumb;

use WebEdit;
use WebEdit\Menu;

class Control extends WebEdit\Control implements \Iterator, \ArrayAccess {

    private $menuRepository;
    private $data = array();
    private $root;

    public function __construct(Menu\Repository $menuRepository) {
        $this->menuRepository = $menuRepository;
    }

    public function render() {
        $template = $this->template;
        $template->setFile(__DIR__ . '/Control/breadcrumb.latte');
        $template->render();
    }

    public function getRoot() {
        return $this->root;
    }

    public function last() {
        $value = end($this->data);
        $this->rewind();
        return $value;
    }

    private function fromMenu($menu) {
        $this->root = $menu;
        $this->data = $this->menuRepository->getParents($menu);
    }

    private function fromArray($array) {
        $menu = $this->menuRepository->getMenuBy($array);
        if ($menu) {
            $this->fromMenu($menu);
        }
    }

    public function offsetSet($offset, $value) {
        if (is_object($value)) {
            $this->fromMenu($value);
        } elseif (is_array($value)) {
            $this->fromArray($value);
        } elseif (is_string($value)) {
            $value = (object) array('title' => $value);
            $this->data[] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset) {
        return $this->offsetExists($offset) ? $this->data[$offset] : NULL;
    }

    public function rewind() {
        reset($this->data);
    }

    public function current() {
        return current($this->data);
    }

    public function key() {
        return key($this->data);
    }

    public function next() {
        return next($this->data);
    }

    public function valid() {
        $key = key($this->data);
        return ($key !== NULL && $key !== FALSE);
    }

}
