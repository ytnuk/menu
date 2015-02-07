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
	 * @var Nette\Http\Request
	 */
	private $request;

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
	 * @param Nette\Http\Request $request
	 */
	public function __construct(Entity $menu, Repository $repository, Control\Factory $control, Form\Control\Factory $formControl, Ytnuk\Orm\Grid\Control\Factory $gridControl, Nette\Http\Request $request)
	{
		$this->menu = $menu;
		$this->repository = $repository;
		$this->control = $control;
		$this->formControl = $formControl;
		$this->gridControl = $gridControl;
		$this->request = $request;
	}

	/**
	 * @param string $offset
	 * @param Entity|string $menu
	 */
	public function offsetSet($offset, $menu)
	{
		if ($menu instanceof Entity) {
			$this->active = $menu;
		} else {
			$append = new Entity;
			$append->id = $offset;
			$append->title = $menu;
			if ($offset) {
				$this->append[$offset] = $append;
			} else {
				$this->append[] = $append;
			}
		}
	}

	/**
	 * @param int $id
	 *
	 * @return bool
	 */
	public function offsetExists($id)
	{
		foreach ($this->getBreadcrumb() as $menu) {
			if ($menu->id === $id) {
				return $menu;
			}
		}

		return FALSE;
	}

	/**
	 * @return Entity[]
	 */
	public function getBreadcrumb()
	{
		if ( ! $this->breadcrumb) {
			$this->breadcrumb = array_merge($this->getActive() ? array_reverse($this->getActive()->tree) : [], $this->append);
		}

		return $this->breadcrumb;
	}

	/**
	 * @return Entity|NULL
	 */
	public function getActive()
	{
		if ($this->active === NULL) {
			$views = array_unique([
				$this->presenter->getAction(),
				'list'
			]);
			$parameters = array_diff_key($this->presenter->getFilteredParameters(), $this->request->getQuery());
			foreach ($views as $view) {
				$destination = implode(':', [
					$this->presenter->getName(),
					$view
				]);
				if ($this->active = $this->repository->getByLink(':' . $destination, $parameters)) {
					break;
				}
				$parameters = [];
			}
		}

		return $this->active;
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
		$this->template->breadcrumb = $breadcrumb = $this->getBreadcrumb();
		$this->template->last = end($breadcrumb);
		$this->template->first = reset($breadcrumb);
		$this->template->menu = $this->menu;
		$this->template->active = $this->getActive();
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
