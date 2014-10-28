<?php

namespace WebEdit\Menu;

use WebEdit\Application;
use WebEdit\Database;
use WebEdit\Menu;

final class Control extends Application\Control
{

	private $repository;
	private $control;
	private $formControl;
	private $gridControl;
	private $breadcrumb = [];
	private $append = [];
	private $menu;
	private $active;

	public function __construct(Menu\Repository $repository, Menu\Control\Factory $control, Menu\Form\Control\Factory $formControl, Database\Grid\Control\Factory $gridControl)
	{
		$this->repository = $repository;
		$this->control = $control;
		$this->formControl = $formControl;
		$this->gridControl = $gridControl;
	}

	public function offsetSet($offset, $title)
	{
		$menu = new Menu\Entity;
		$menu->title = $title;
		$this->append[] = $menu;
	}

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

	public function setActive(Menu\Entity $active)
	{
		$this->active = $active;
		return $this;
	}

	protected function startup()
	{
		$this->active = $this->active ?:
			$this->repository->getByLink(':' . $this->presenter->getName() . ':' . $this->presenter->getView()) ?:
				$this->repository->getByLink(':' . $this->presenter->getName() . ':view');
		$this->template->breadcrumb = $this->breadcrumb = array_merge($this->active ? $this->active->parents : [], [$this->active], $this->append);
		$this->template->last = end($this->breadcrumb);
		$this->template->first = reset($this->breadcrumb);
		$this->template->active = $this->active;
		$this->template->menu = $this->menu;
	}

	protected function createComponentForm()
	{
		return $this->formControl->create($this->menu);
	}

	protected function createComponentGrid()
	{
		return $this->gridControl->create($this->repository);
	}

	protected function createComponentUid()
	{
		return new Application\Control\Multiplier(function ($uid) {
			return $this->control->create()->setMenu($this->repository->getByUid($uid));
		});
	}

	public function setMenu(Menu\Entity $menu)
	{
		$this->menu = $menu;
		return $this;
	}

}
