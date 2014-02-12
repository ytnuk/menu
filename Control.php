<?php

namespace WebEdit\Menu;

use WebEdit,
    WebEdit\Menu,
    WebEdit\Menu\Group,
    WebEdit\Menu\Breadcrumb;

class Control extends WebEdit\Control {

    private $menuFacade;
    private $groupFacade;
    private $breadcrumbFactory;
    public $breadcrumb;
    private $navbar;
    private $groups = array();
    private $showHeader = TRUE;

    public function __construct($groupKey, Menu\Model\Facade $menuFacade, Group\Model\Facade $groupFacade, Breadcrumb\Control\Factory $breadcrumbFactory) {
        $this->menuFacade = $menuFacade;
        $this->groupFacade = $groupFacade;
        $this->breadcrumbFactory = $breadcrumbFactory;
        $this->breadcrumb = $this->getComponent('breadcrumb');
        $group = $this->groupFacade->repository->getGroupByKey($groupKey);
        $groups = $this->groupFacade->repository->getAllGroups()->fetchPairs('menu_id', 'id');
        $this->navbar = $this->getData($group->menu, $groups);
    }

    public function renderNavbar() {
        $template = $this->template;
        $template->menu = $this->navbar;
        $template->breadcrumb = $this->breadcrumb;
        $template->setFile(__DIR__ . '/Control/navbar.latte');
        $template->render();
    }

    public function renderGroups() {
        $template = $this->template;
        $template->groups = $this->groups;
        $template->breadcrumb = $this->breadcrumb;
        $template->setFile(__DIR__ . '/Control/groups.latte');
        $template->render();
    }

    public function renderHeader() {
        $template = $this->template;
        $template->showHeader = $this->showHeader;
        $template->last = $this->breadcrumb->getLast();
        $template->setFile(__DIR__ . '/Control/header.latte');
        $template->render();
    }

    public function renderTitle() {
        $template = $this->template;
        $template->menu = $this->breadcrumb->getMenu();
        $template->last = $this->breadcrumb->getLast();
        $template->setFile(__DIR__ . '/Control/title.latte');
        $template->render();
    }

    public function getData($menu, &$groups) {
        $data = array('data' => $menu, 'children' => array());
        foreach ($menu->related('menu') as $menu) {
            if (isset($groups[$menu->id])) {
                $this->groups[] = $this->getData($menu, $groups);
            } else {
                $data['children'][] = $this->getData($menu, $groups);
            }
        }
        return (object) $data;
    }

    public function showHeader($option = TRUE) {
        $this->showHeader = $option;
    }

    protected function createComponentBreadcrumb() {
        return $this->breadcrumbFactory->create();
    }

}
