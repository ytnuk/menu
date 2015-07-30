<?php
namespace Ytnuk\Menu\Form;

use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Menu
 */
final class Control
	extends Ytnuk\Orm\Form\Control
{

	/**
	 * @param Ytnuk\Menu\Entity $menu
	 * @param Ytnuk\Orm\Form\Factory $form
	 */
	public function __construct(
		Ytnuk\Menu\Entity $menu,
		Ytnuk\Orm\Form\Factory $form
	) {
		parent::__construct(
			$menu,
			$form
		);
	}
}
