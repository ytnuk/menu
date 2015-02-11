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
			$active = $this->getActive();
			$this->breadcrumb = array_merge($active ? array_reverse($active->getterParents(TRUE)) + [$active->id => $active] : [], $this->append);
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
			foreach ($views as $view) {
				$destination = ':' . implode(':', [
						$this->presenter->getName(),
						$view
					]);
				if ($this->active = $this->repository->getByLink($this->menu, $destination, $this->presenter->request->parameters)) {
					break;
				}
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
