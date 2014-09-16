<?php

namespace WebEdit\Menu\Group;

use WebEdit\Application;
use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Control extends Application\Control
{

    private $group;
    private $breadcrumb;

    public function __construct(Group\Entity $group, Menu\Control $breadcrumb)
    {
        $this->group = $group;
        $this->breadcrumb = $breadcrumb;
    }

    protected function startup()
    {
        $this->template->breadcrumb = $this->breadcrumb;
        $this->template->group = $this->group;
    }

}
