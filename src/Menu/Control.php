<?php

namespace Ytnuk\Menu;

use Nette;
use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Menu
 */
final class Control extends Ytnuk\Application\Control
{

	//TODO: menu can have only one parent, there should by a symlink entity with menu reference and own presenter and forward to target page/product/... and if possible the symlink still active in menu
	//TODO: or menu with the same link reference and just redirect
	//TODO: or menu with multiple parents.. one should be main - choosen while creating - on edit addDynamic others ... similiar logic should be used when creating products and attaching to category
	/**
	 * @var Entity
	 */
	private $menu;

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
	 * @var array
	 */
	private $breadcrumb = [];

	/**
	 * @var array
	 */
	private $append = [];

	/**
	 * @var Entity
	 */
	private $active;

	/**
	 * @param Entity $menu
	 * @param Repository $repository
	 * @param Control\Factory $control
	 * @param Form\Control\Factory $formControl
	 * @param Ytnuk\Orm\Grid\Control\Factory $gridControl
	 */
	public function __construct($menu, Repository $repository, Control\Factory $control, Form\Control\Factory $formControl, Ytnuk\Orm\Grid\Control\Factory $gridControl)
	{
		$this->menu = $menu;
		$this->repository = $repository;
		$this->control = $control;
		$this->formControl = $formControl;
		$this->gridControl = $gridControl;
	}

	/**
	 * @param string $offset
	 * @param string $title
	 */
	public function offsetSet($offset, $title)
	{
		$menu = new Entity;
		$menu->title = $title;
		$this->append[] = $menu;
	}

	/**
	 * @param int $id
	 *
	 * @return bool
	 */
	public function offsetExists($id)
	{
		foreach ($this->breadcrumb as $menu) {
			if ($menu->id === $id) {
				return $menu;
			}
		}

		return FALSE;
	}

	/**
	 * @param Entity $active
	 *
	 * @return $this
	 */
	public function setActive(Entity $active)
	{
		$this->active = $active;

		return $this;
	}

	/**
	 * @return array
	 */
	protected function getViews()
	{
		return [
			'breadcrumb' => TRUE,
			'navbar' => TRUE,
			'header' => TRUE,
			'title' => TRUE
		];
	}

	protected function startup()
	{
		$views = [
			$this->presenter->getView(),
			'view',
			'list'
		];
		foreach ($views as $view) {
			if ($this->active) {
				break;
			}
			$this->active = $this->repository->getByLink(':' . $this->presenter->getName() . ':' . $view);
		}
		//TODO: set active under $this->menu and matching $presenter->parameters
		$this->template->breadcrumb = $this->breadcrumb = array_merge($this->active ? $this->active->parents : [], [$this->active], $this->append);
		$this->template->last = end($this->breadcrumb);
		$this->template->first = reset($this->breadcrumb);
		$this->template->menu = $this->menu;
		$this->template->active = $this->active;
	}

	/**
	 * @return Form\Control
	 */
	protected function createComponentYtnukFormControl()
	{
		return $this->formControl->create($this->menu ? : new Entity);
	}

	/**
	 * @return Ytnuk\Orm\Grid\Control
	 */
	protected function createComponentYtnukGridControl()
	{
		return $this->gridControl->create($this->repository);
	}
}
