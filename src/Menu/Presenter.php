<?php

namespace Ytnuk\Menu;

use Nette;
use Ytnuk;

/**
 * Class Presenter
 *
 * @package Ytnuk\Menu
 */
final class Presenter extends Ytnuk\Web\Presenter
{

	/**
	 * @var Repository
	 */
	private $repository;

	/**
	 * @var Entity
	 */
	private $menu;

	/**
	 * @param Repository $repository
	 */
	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @param $id
	 *
	 * @throws Nette\Application\BadRequestException
	 */
	public function actionView($id)
	{
		$this->menu = $this->repository->getById($id);
		if ( ! $this->menu) {
			$this->error();
		}
		$this['menu']->setMenu($this->menu);
	}

	public function renderView()
	{
		$this['menu'][] = 'menu.presenter.action.edit';
	}
}
