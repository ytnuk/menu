<?php

namespace WebEdit\Menu\Form\Control;

use WebEdit\Menu\Form;

interface Factory
{

	/**
	 * @return Form\Control
	 */
	public function create($menu);
}
