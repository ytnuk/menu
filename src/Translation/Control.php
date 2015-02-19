<?php

namespace Ytnuk\Translation;

use Nette;
use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Translation
 */
final class Control extends Ytnuk\Application\Control
{

	/**
	 * @var Entity
	 */
	private $translation;

	/**
	 * @var Repository
	 */
	private $repository;

	/**
	 * @var Control\Factory
	 */
	private $control;

	/**
	 * @var Form\Control\Factory
	 */
	private $formControl;

	/**
	 * @var Ytnuk\Orm\Grid\Control\Factory
	 */
	private $gridControl;

	/**
	 * @param Entity $translation
	 * @param Repository $repository
	 * @param Control\Factory $control
	 * @param Form\Control\Factory $formControl
	 * @param Ytnuk\Orm\Grid\Control\Factory $gridControl
	 */
	public function __construct(Entity $translation, Repository $repository, Control\Factory $control, Form\Control\Factory $formControl, Ytnuk\Orm\Grid\Control\Factory $gridControl)
	{
		$this->translation = $translation;
		$this->repository = $repository;
		$this->control = $control;
		$this->formControl = $formControl;
		$this->gridControl = $gridControl;
	}

	/**
	 * @return Form\Control
	 */
	protected function createComponentYtnukFormControl()
	{
		return $this->formControl->create($this->translation ? : new Entity);
	}

	/**
	 * @return Ytnuk\Orm\Grid\Control
	 */
	protected function createComponentYtnukGridControl()
	{
		return $this->gridControl->create($this->repository);
	}
}
