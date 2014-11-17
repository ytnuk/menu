<?php

namespace WebEdit\Menu\Form;

use WebEdit;

/**
 * Class Control
 *
 * @package WebEdit\Menu
 */
final class Control extends WebEdit\Form\Control
{

	/**
	 * @var WebEdit\Menu\Entity
	 */
	private $menu;

	/**
	 * @var WebEdit\Orm\Form\Factory
	 */
	private $form;

	/**
	 * @param WebEdit\Menu\Entity $menu
	 * @param WebEdit\Orm\Form\Factory $form
	 */
	public function __construct(WebEdit\Menu\Entity $menu, WebEdit\Orm\Form\Factory $form)
	{
		$this->menu = $menu;
		$this->form = $form;
	}

	/**
	 * @return WebEdit\Orm\Form
	 */
	protected function createComponentForm()
	{
		return $this->form->create($this->menu);
	}
}
