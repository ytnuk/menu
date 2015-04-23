<?php

namespace Ytnuk\Translation;

use Nette;
use Ytnuk;

/**
 * Class Presenter
 *
 * @package Ytnuk\Translation
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
	private $translation;

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
		$this->translation = $this->repository->getById($id);
		if ( ! $this->translation) {
			$this->error();
		}
	}

	public function renderEdit()
	{
		$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = 'translation.presenter.action.edit';
	}

	/**
	 * @return Control
	 */
	protected function createComponentYtnukTranslationControl()
	{
		return $this->control->create($this->translation ? : new Entity);
	}
}
