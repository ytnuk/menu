<?php

namespace Ytnuk\Link;

use Nette;
use Ytnuk;

/**
 * Class Presenter
 *
 * @package Ytnuk\Link
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
	private $link;

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
	public function actionEdit($id)
	{
		$this->link = $this->repository->getById($id);
		if ( ! $this->link) {
			$this->error();
		}
	}

	public function renderEdit()
	{
		$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = 'link.presenter.action.edit';
	}

	/**
	 * @return Control
	 */
	protected function createComponentYtnukLinkControl()
	{
		return $this->control->create($this->link ? : new Entity);
	}
}
