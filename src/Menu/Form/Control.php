<?php
namespace Ytnuk\Menu\Form;

use Ytnuk;

final class Control
	extends Ytnuk\Orm\Form\Control
{

	public function __construct(
		Ytnuk\Menu\Entity $menu,
		Ytnuk\Orm\Form\Factory $form
	) {
		parent::__construct($menu, $form);
	}
}
