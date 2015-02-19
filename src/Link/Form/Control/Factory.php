<?php

namespace Ytnuk\Link\Form\Control;

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
	 * @return Ytnuk\Link\Form\Control
	 */
	public function create(Ytnuk\Link\Entity $link);
}
