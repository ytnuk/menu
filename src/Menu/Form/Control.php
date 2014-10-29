<?php

namespace WebEdit\Menu\Form;

use WebEdit\Database;
use WebEdit\Form;
use WebEdit\Menu;

final class Control extends Form\Control
{

	private $menu;
	private $form;

	public function __construct($menu, Database\Form\Factory $form)
	{
		$this->menu = $menu;
		$this->form = $form;
	}

	protected function createComponentForm()
	{
		return $this->form->create($this->menu ? : new Menu\Entity);
	}
}
