<?php

namespace Ytnuk\Link;

use Nette;
use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Link
 */
final class Control extends Ytnuk\Application\Control
{

	/**
	 * @var Entity
	 */
	private $link;

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
	 * @param Entity $link
	 * @param Repository $repository
	 * @param Control\Factory $control
	 * @param Form\Control\Factory $formControl
	 * @param Ytnuk\Orm\Grid\Control\Factory $gridControl
	 */
	public function __construct(Entity $link, Repository $repository, Control\Factory $control, Form\Control\Factory $formControl, Ytnuk\Orm\Grid\Control\Factory $gridControl)
	{
		$this->link = $link;
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
		return $this->formControl->create($this->link ? : new Entity);
	}

	/**
	 * @return Ytnuk\Orm\Grid\Control
	 */
	protected function createComponentYtnukGridControl()
	{
		return $this->gridControl->create($this->repository);
	}
}
