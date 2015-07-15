<?php

namespace Ytnuk\Blog\Post\Description\Form;

use Ytnuk;

/**
 * Class Container
 *
 * @package Ytnuk\Blog
 */
final class Container extends Ytnuk\Orm\Form\Container
{

	/**
	 * @inheritdoc
	 */
	public function setValues($values, $erase = FALSE)
	{
		if ((array) $values->value->translates) {
			return parent::setValues($values, $erase);
		} else {
			$this->removeEntity(FALSE);

			return $this;
		}
	}
}
