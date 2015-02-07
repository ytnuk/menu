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
	 * @var Control\Factory
	 */
	private $control;

	/**
	 * @var Entity
	 */
	private $menu;

	/**
	 * @param Repository $repository
	 * @param Control\Factory $control
	 */
	public function __construct(Repository $repository, Control\Factory $control)
	{
		$this->repository = $repository;
		$this->control = $control;
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
	}

	public function renderView()
	{
		$this[Ytnuk\Web\Control::class][Control::class][] = 'menu.presenter.action.edit';
	}

	/**
	 * @return Control
	 */
	protected function createComponentYtnukMenuControl()
	{
		return $this->control->create($this->menu ? : new Entity);
	}
}
