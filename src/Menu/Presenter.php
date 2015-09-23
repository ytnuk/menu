<?php
namespace Ytnuk\Menu;

use Nette;
use Ytnuk;

final class Presenter
	extends Ytnuk\Web\Application\Presenter
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

	public function __construct(
		Repository $repository,
		Control\Factory $control
	) {
		parent::__construct();
		$this->repository = $repository;
		$this->control = $control;
	}

	public function actionEdit(int $id)
	{
		if ( ! $this->menu = $this->repository->getById($id)) {
			$this->error();
		}
	}

	public function renderEdit()
	{
		$this[Ytnuk\Web\Control::NAME][Control::NAME][] = 'menu.presenter.action.edit';
	}

	protected function createComponentMenu() : Control
	{
		return $this->control->create($this->menu ? : new Entity);
	}
}
