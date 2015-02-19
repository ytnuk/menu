<?php

namespace Ytnuk\Translation\Control;

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
	 * @return Ytnuk\Translation\Control
	 */
	public function create(Ytnuk\Translation\Entity $translation);
}
