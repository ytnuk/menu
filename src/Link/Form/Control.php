<?php

namespace Ytnuk\Link\Form;

use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Link
 */
final class Control extends Ytnuk\Orm\Form\Control
{

	/**
	 * @param Ytnuk\Link\Entity $link
	 * @param Ytnuk\Orm\Form\Factory $form
	 */
	public function __construct(Ytnuk\Link\Entity $link, Ytnuk\Orm\Form\Factory $form)
	{
		parent::__construct($link, $form);
	}
}
