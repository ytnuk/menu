<?php

namespace Ytnuk\Menu\Form;

use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Menu
 */
final class Control extends Ytnuk\Form\Control
{

	/**
	 * @var Ytnuk\Menu\Entity
	 */
	private $menu;

	/**
	 * @var Ytnuk\Orm\Form\Factory
	 */
	private $form;

	/**
	 * @param Ytnuk\Menu\Entity $menu
	 * @param Ytnuk\Orm\Form\Factory $form
	 */
	public function __construct(Ytnuk\Menu\Entity $menu, Ytnuk\Orm\Form\Factory $form)
	{
		$this->menu = $menu;
		$this->form = $form;
	}

	/**
	 * @return Ytnuk\Orm\Form
	 */
	protected function createComponentForm()
	{
		return $this->form->create($this->menu);
	}
}
