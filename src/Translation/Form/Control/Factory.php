<?php

namespace Ytnuk\Translation\Form\Control;

use Ytnuk;

/**
 * Interface Factory
 *
 * @package Ytnuk\Translation
 */
interface Factory
{

	/**
	 * @param Ytnuk\Translation\Entity $translation
	 *
	 * @return Ytnuk\Translation\Form\Control
	 */
	public function create(Ytnuk\Translation\Entity $translation);
}
