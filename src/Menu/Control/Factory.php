<?php
namespace Ytnuk\Menu\Control;

use Ytnuk;

interface Factory
{

	public function create(Ytnuk\Menu\Entity $menu) : Ytnuk\Menu\Control;
}
