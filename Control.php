<?php

namespace WebEdit\Menu;

use WebEdit,
    WebEdit\Menu\Node,
    WebEdit\Menu\Group,
    WebEdit\Menu\Breadcrumb;

class Control extends WebEdit\Control {

    private $nodeFacade;
    private $groupFacade;
    private $breadcrumbFactory;
    public $breadcrumb;
    private $groups = array();
    private $sidebar = array();
    private $showHeader = TRUE;

    public function __construct(Node\Model\Facade $nodeFacade, Group\Model\Facade $groupFacade, Breadcrumb\Control\Factory $breadcrumbFactory) {
        $this->nodeFacade = $nodeFacade;
        $this->groupFacade = $groupFacade;
        $this->breadcrumbFactory = $breadcrumbFactory;
        $this->breadcrumb = $this->getComponent('breadcrumb');
        $this->groups = array_keys($this->nodeFacade->repository->getNodesInTable('menu_group')->fetchAll());
    }

    public function renderNavbar($key) {
        $group = $this->groupFacade->repository->getGroupByKey($key);
        $root = $group->node;
        $template = $this->template;
        $template->menu = $this->getMenu($root);
        $template->breadcrumb = $this->breadcrumb;
        $template->root = $root;
        $template->setFile(__DIR__ . '/Control/navbar.latte');
        $template->render();
    }

    public function renderSidebar() {
        $template = $this->template;
        $template->sidebar = $this->sidebar;
        $template->breadcrumb = $this->breadcrumb;
        $template->setFile(__DIR__ . '/Control/sidebar.latte');
        $template->render();
    }

    public function renderHeader() {
        $template = $this->template;
        $template->showHeader = $this->showHeader;
        $template->node = $this->breadcrumb->getLast();
        $template->setFile(__DIR__ . '/Control/header.latte');
        $template->render();
    }

    public function renderTitle() {
        $last = $this->breadcrumb->getLast();
        $template = $this->template;
        $template->node = $node = $this->breadcrumb->getNode();
        $template->custom = ($node->id != $last->id) ? $last : NULL;
        $template->setFile(__DIR__ . '/Control/title.latte');
        $template->render();
    }

    public function getMenu($node) {
        $menu = array();
        foreach ($node->related('node') as $node) {
            $data = (object) array(
                        'data' => $node,
                        'children' => $this->getMenu($node)
            );
            if (array_search($node->id, $this->groups)) {
                $this->sidebar[] = $data;
            } else {
                $menu[] = $data;
            }
        }
        return $menu;
    }

    public function showHeader($option = TRUE) {
        $this->showHeader = $option;
    }

    protected function createComponentBreadcrumb() {
        return $this->breadcrumbFactory->create();
    }

}
