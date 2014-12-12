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
	private $menu;

	/**
	 * @var Entity
	 */
	private $active;

	/**
	 * @param Repository $repository
	 * @param Control\Factory $control
	 * @param Form\Control\Factory $formControl
	 * @param Ytnuk\Orm\Grid\Control\Factory $gridControl
	 */
	public function __construct(Repository $repository, Control\Factory $control, Form\Control\Factory $formControl, Ytnuk\Orm\Grid\Control\Factory $gridControl)
	{
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
		if ($this->presenter['menu'] !== $this) {
			return isset($this->presenter['menu'][$id]);
		}
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
		$this->template->breadcrumb = $this->breadcrumb = array_merge($this->active ? $this->active->parents : [], [$this->active], $this->append);
		$this->template->last = end($this->breadcrumb);
		$this->template->first = reset($this->breadcrumb);
		$this->template->active = $this->active;
		$this->template->menu = $this->menu;
	}

	/**
	 * @return Form\Control
	 */
	protected function createComponentForm()
	{
		return $this->formControl->create($this->menu ? : new Entity);
	}

	/**
	 * @return Ytnuk\Orm\Grid\Control
	 */
	protected function createComponentGrid()
	{
		return $this->gridControl->create($this->repository);
	}

	/**
	 * @return Nette\Application\UI\Multiplier
	 */
	protected function createComponentUid()
	{
		return new Nette\Application\UI\Multiplier(function ($uid) {
			return $this->control->create()
				->setMenu($this->repository->getByUid($uid));
		});
	}

	/**
	 * @param Entity $menu
	 *
	 * @return $this
	 */
	public function setMenu(Entity $menu)
	{
		$this->menu = $menu;

		return $this;
	}
}
