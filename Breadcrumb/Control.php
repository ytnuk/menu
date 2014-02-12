<?php

namespace WebEdit\Menu\Breadcrumb;

use WebEdit;
use WebEdit\Menu;

class Control extends WebEdit\Control {

    private $menuFacade;
    private $breadcrumb = array();
    private $append = array();
    private $menu;

    public function __construct(Menu\Model\Facade $menuFacade) {
        $this->menuFacade = $menuFacade;
    }

    public function render() {
        $template = $this->template;
        $template->breadcrumb = $this->getBreadcrumb();
        $template->setFile(__DIR__ . '/Control/breadcrumb.latte');
        $template->render();
    }

    public function fromMenu($menu) {
        $this->menu = $menu;
    }

    public function fromLink($link, $link_id = NULL) {
        $this->menu = array('link' => $link, 'link_id' => $link_id);
    }

    public function append($title, $link = NULL, $link_id = NULL) {
        $this->append[uniqid()] = (object) array(
                    'id' => NULL,
                    'title' => $title,
                    'link' => $link,
                    'link_id' => $link_id,
        );
    }

    private function getBreadcrumb() {
        if (!$this->breadcrumb) {
            $menu = $this->getMenu();
            $this->breadcrumb = $this->menuFacade->repository->getParents($menu);
            $this->breadcrumb+=$this->append;
        }
        return $this->breadcrumb;
    }

    public function getMenu() {
        if (is_array($this->menu)) {
            $this->menu = $this->menuFacade->repository->getMenuByLink($this->menu['link'], $this->menu['link_id']);
        }
        return $this->menu;
    }

    public function getLast() {
        $breadcrumb = $this->getBreadcrumb();
        $values = array_values($breadcrumb);
        return end($values);
    }

    public function has($id) {
        $breadcrumb = $this->getBreadcrumb();
        return isset($breadcrumb[$id]);
    }

}
