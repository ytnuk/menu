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
	 * @var Service
	 */
	private $service;

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
	 * @param Service $service
	 * @param Control\Factory $control
	 * @param Form\Control\Factory $formControl
	 * @param Ytnuk\Orm\Grid\Control\Factory $gridControl
	 * @param Nette\Http\Request $request
	 */
	public function __construct(Entity $menu, Service $service, Control\Factory $control, Form\Control\Factory $formControl, Ytnuk\Orm\Grid\Control\Factory $gridControl, Nette\Http\Request $request)
	{
		$this->menu = $menu;
		$this->service = $service;
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
		if ( ! $menu instanceof Entity) {
			$entity = new Entity;
			$entity->id = $offset;
			$entity->title = $menu;
			$menu = $entity;
		}
		if ($offset === NULL) {
			$this->append[] = $menu;
		} else {
			$this->append[$offset] = $menu;
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
				$this->getPresenter()->getAction(),
				'list'
			]);
			foreach ($views as $view) {
				$destination = ':' . implode(':', [
						$this->getPresenter()->getName(),
						$view
					]);
				if ($menu = $this->service->getByLink($this->menu, $destination, $this->getPresenter()->getRequest()->getParameters())) {
					$this->setActive($menu);
					break;
				}
			}
		}

		return $this->active;
	}

	/**
	 * @param Entity $entity
	 */
	public function setActive(Entity $entity)
	{
		$this->active = $entity;
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
		] + parent::getViews();
	}

	protected function startup()
	{
		$this->getTemplate()->add('menu', $this->menu)->add('active', $this->getActive())->add('breadcrumb', $this->getBreadcrumb());
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
		return $this->gridControl->create($this->service->getRepository());
	}
}
