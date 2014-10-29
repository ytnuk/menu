<?php

namespace WebEdit\Menu\Admin;

use WebEdit\Admin;
use WebEdit\Database;
use WebEdit\Menu;

final class Presenter extends Admin\Presenter
{

	private $repository;
	private $menu;

	public function __construct(Menu\Repository $repository)
	{
		$this->repository = $repository;
	}

	public function actionEdit($id)
	{
		$this->menu = $this->repository->getById($id);
		if ( ! $this->menu) {
			$this->error();
		}
		$this['menu']->setMenu($this->menu);
	}

	public function renderEdit()
	{
		$this['menu'][] = 'menu.admin.presenter.action.edit';
	}
}
