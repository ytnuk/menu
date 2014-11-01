<?php

namespace WebEdit\Menu\Form;

use WebEdit\Database;
use WebEdit\Form;
use WebEdit\Menu;

/**
 * Class Control
 *
 * @package WebEdit\Menu
 */
final class Control extends Form\Control
{

	/**
	 * @var Menu\Entity
	 */
	private $menu;

	/**
	 * @var Database\Form\Factory
	 */
	private $form;

	/**
	 * @param Menu\Entity $menu
	 * @param Database\Form\Factory $form
	 */
	public function __construct(Menu\Entity $menu, Database\Form\Factory $form)
	{
		$this->menu = $menu;
		$this->form = $form;
	}

	/**
	 * @return Database\Form
	 */
	protected function createComponentForm()
	{
		return $this->form->create($this->menu);
	}
}
