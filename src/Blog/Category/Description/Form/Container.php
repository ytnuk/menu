<?php
namespace Ytnuk\Blog\Category\Description\Form;

use Ytnuk;

/**
 * Class Container
 *
 * @package Ytnuk\Blog
 */
final class Container
	extends Ytnuk\Orm\Form\Container
{

	/**
	 * @inheritdoc
	 *
	 * @param Ytnuk\Blog\Category\Description\Entity $values
	 */
	public function setValues(
		$values,
		$erase = FALSE
	) {
		if ((array) $values->value->translates) {
			return parent::setValues(
				(array) $values,
				$erase
			);
		} else {
			$this->removeEntity(FALSE);

			return $this;
		}
	}
}
