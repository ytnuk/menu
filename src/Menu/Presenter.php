<?php

namespace Kutny\Menu;

use Nette;
use Kutny;

/**
 * Class Presenter
 *
 * @package Kutny\Menu
 */
final class Presenter extends Kutny\Web\Presenter
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
