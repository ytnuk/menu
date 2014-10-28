<?php

namespace WebEdit\Menu\Control;

use WebEdit\Menu;

interface Factory
{

	/**
	 * @return Menu\Control
	 */
	public function create();
}
