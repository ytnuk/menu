<?php

namespace Ytnuk\Translation\Form;

use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Translation
 */
final class Control extends Ytnuk\Orm\Form\Control
{

	/**
	 * @param Ytnuk\Translation\Entity $translation
	 * @param Ytnuk\Orm\Form\Factory $form
	 */
	public function __construct(Ytnuk\Translation\Entity $translation, Ytnuk\Orm\Form\Factory $form)
	{
		parent::__construct($translation, $form);
	}
}
