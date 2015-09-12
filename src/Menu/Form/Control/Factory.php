<?php
namespace Ytnuk\Menu\Form\Control;

use Ytnuk;

interface Factory
{

	public function create(Ytnuk\Menu\Entity $menu) : Ytnuk\Menu\Form\Control;
}
