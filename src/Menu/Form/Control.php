<?php

namespace WebEdit\Menu\Form;

use WebEdit\Form;
use WebEdit\Menu;
use WebEdit\Orm;

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
	 * @var Orm\Form\Factory
	 */
	private $form;

	/**
	 * @param Menu\Entity $menu
	 * @param Orm\Form\Factory $form
	 */
	public function __construct(Menu\Entity $menu, Orm\Form\Factory $form)
	{
		$this->menu = $menu;
		$this->form = $form;
	}

	/**
	 * @return Orm\Form
	 */
	protected function createComponentForm()
	{
		return $this->form->create($this->menu);
	}
}
