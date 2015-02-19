<?php

namespace Ytnuk\Link\Control;

use Ytnuk;

/**
 * Interface Factory
 *
 * @package Ytnuk\Link
 */
interface Factory
{

	/**
	 * @param Ytnuk\Link\Entity $link
	 *
	 * @return Ytnuk\Link\Control
	 */
	public function create(Ytnuk\Link\Entity $link);
}
