<?php

namespace WebEdit\Menu;

use WebEdit\Application;
use WebEdit\Menu;

final class Control extends Application\Control
{

    private $repository;
    private $control;
    private $breadcrumb = [];
    private $append = [];
    private $menu;

    public function __construct(Menu\Repository $repository, Menu\Control\Factory $control)
    {
        $this->repository = $repository;
        $this->control = $control;
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

    protected function startup()
    {
        $this->menu = $this->menu ?:
            $this->repository->getByLink(':' . $this->presenter->getName() . ':' . $this->presenter->getView()) ?:
                $this->repository->getByLink(':' . $this->presenter->getName() . ':view');
        $this->template->breadcrumb = $this->breadcrumb = array_merge($this->menu->parents, [$this->menu], $this->append);
        $this->template->last = end($this->breadcrumb);
        $this->template->first = reset($this->breadcrumb);
        $this->template->menu = $this->menu;
    }

    protected function createComponentUid()
    {
        return new Application\Control\Multiplier(function ($uid) {
            $menu = $this->repository->getByUid($uid);
            return $this->control->create()->setMenu($menu);
        });
    }

    public function setMenu(Menu\Entity $menu)
    {
        $this->menu = $menu;
        return $this;
    }

}
