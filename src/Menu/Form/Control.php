<?php

namespace Kutny\Menu\Form;

use Kutny;

/**
 * Class Control
 *
 * @package Kutny\Menu
 */
final class Control extends Kutny\Form\Control
{

	/**
	 * @var Kutny\Menu\Entity
	 */
	private $menu;

	/**
	 * @var Kutny\Orm\Form\Factory
	 */
	private $form;

	/**
	 * @param Kutny\Menu\Entity $menu
	 * @param Kutny\Orm\Form\Factory $form
	 */
	public function __construct(Kutny\Menu\Entity $menu, Kutny\Orm\Form\Factory $form)
	{
		$this->menu = $menu;
		$this->form = $form;
	}

	/**
	 * @return Kutny\Orm\Form
	 */
	protected function createComponentForm()
	{
		return $this->form->create($this->menu);
	}
}
