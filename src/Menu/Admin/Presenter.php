<?php

namespace WebEdit\Menu\Admin;

use WebEdit\Admin;
use WebEdit\Database;
use WebEdit\Menu;

final class Presenter extends Admin\Presenter
{

    private $repository;
    private $control;
    private $databaseGridControl;
    private $menu;

    public function __construct(Menu\Repository $repository, Menu\Control\Factory $control, Database\Grid\Control\Factory $databaseGridControl)
    {
        $this->repository = $repository;
        $this->control = $control;
        $this->databaseGridControl = $databaseGridControl;
    }

    public function actionEdit($id)
    {
        $this->menu = $this->repository->getById($id);
        if (!$this->menu) {
            $this->error();
        }
        $this['menu']->setMenu($this->menu);
    }

    public function renderEdit()
    {
        $this['menu'][] = 'menu.admin.edit';
    }

    protected function createComponentDatabaseGrid()
    {
        return $this->databaseGridControl->create($this->repository);
    }

}
