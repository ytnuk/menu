<?php

namespace Ytnuk\Blog\Category;

use Ytnuk;
use Nette;

/**
 * Class Control
 *
 * @package Ytnuk\Blog
 */
final class Control extends Ytnuk\Application\Control
{

	/**
	 * @var Entity
	 */
	private $category;

	/**
	 * @var Form\Control\Factory
	 */
	private $formControl;

	/**
	 * @var Ytnuk\Orm\Grid\Control\Factory
	 */
	private $gridControl;

	/**
	 * @var Repository
	 */
	private $repository;

	/**
	 * @param Entity $category
	 * @param Form\Control\Factory $formControl
	 * @param Ytnuk\Orm\Grid\Control\Factory $gridControl
	 * @param Repository $repository
	 */
	public function __construct(Entity $category, Form\Control\Factory $formControl, Ytnuk\Orm\Grid\Control\Factory $gridControl, Repository $repository)
	{
		$this->category = $category;
		$this->formControl = $formControl;
		$this->gridControl = $gridControl;
		$this->repository = $repository;
	}

	protected function startup()
	{
		$this->getTemplate()->add('category', $this->category);
	}

	protected function renderView()
	{
		$this->getTemplate()->add('posts', $this[Ytnuk\Orm\Pagination\Control::class]['posts']->current());
	}

	/**
	 * @inheritdoc
	 */
	protected function getViews()
	{
		return [
			'view' => function () {
				return [
					$this->category,
					$this[Ytnuk\Orm\Pagination\Control::class]['posts']->key()
				];
			}
		] + parent::getViews();
	}

	/**
	 * @return Form\Control
	 */
	protected function createComponentYtnukFormControl()
	{
		return $this->formControl->create($this->category);
	}

	/**
	 * @return Ytnuk\Orm\Grid\Control
	 */
	protected function createComponentYtnukGridControl()
	{
		return $this->gridControl->create($this->repository);
	}

	/**
	 * @return Nette\Application\UI\Multiplier
	 */
	protected function createComponentYtnukOrmPaginationControl()
	{
		return new Nette\Application\UI\Multiplier(function ($key) {
			return new Ytnuk\Orm\Pagination\Control($this->category->getValue($key));
		});
	}
}
