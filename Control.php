<?php

namespace WebEdit\Menu;

use WebEdit;
use WebEdit\Menu\Group;
use WebEdit\Menu\Breadcrumb;

final class Control extends WebEdit\Control {

    private $breadcrumbFactory;
    private $navbar;
    private $groups = [];
    private $showHeader = TRUE;

    public function __construct($groupKey, Group\Repository $groupRepository, Breadcrumb\Control\Factory $breadcrumbFactory) {
        $group = $groupRepository->getGroupByKey($groupKey);
        $groups = $groupRepository->getAllGroups()->fetchPairs('menu_id', 'id');
        $this->navbar = $this->getData($group->menu, $groups);
        $this->breadcrumbFactory = $breadcrumbFactory;
    }

    public function renderNavbar() {
        $template = $this->template;
        $template->menu = $this->navbar;
        $template->breadcrumb = $this['breadcrumb'];
        $template->setFile(__DIR__ . '/Control/navbar.latte');
        $template->render();
    }

    public function renderGroups() {
        $template = $this->template;
        $template->groups = $this->groups;
        $template->breadcrumb = $this['breadcrumb'];
        $template->setFile(__DIR__ . '/Control/groups.latte');
        $template->render();
    }

    public function renderHeader() {
        $template = $this->template;
        $template->showHeader = $this->showHeader;
        $template->last = $this['breadcrumb']->last();
        $template->setFile(__DIR__ . '/Control/header.latte');
        $template->render();
    }

    public function renderTitle() {
        $template = $this->template;
        $template->root = $this['breadcrumb']->getRoot();
        $template->last = $this['breadcrumb']->last();
        $template->setFile(__DIR__ . '/Control/title.latte');
        $template->render();
    }

    public function getData($menu, &$groups) {
        $data = ['data' => $menu, 'children' => []];
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
