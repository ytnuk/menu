<?php

namespace Ytnuk\Link\Form;

use Ytnuk;
use Nette;

/**
 * Class Container
 *
 * @package Ytnuk\Link
 */
final class Container extends Ytnuk\Orm\Form\Container
{

	public function setEntityValues(Nette\Utils\ArrayHash $values)
	{
		return parent::setEntityValues($values);
		dump($entity);
		exit;

		return $entity;
	}

	/**
	 * @param Ytnuk\Form $form
	 */
	protected function attached($form)
	{
		parent::attached($form);
		unset($this['aliases']['link'], $this['parameters']['link']);
		foreach ($this['aliases']->controls as $control) {
			$control->setRequired(FALSE);
		}
		foreach ($this['parameters']->controls as $control) {
			$control->setRequired(FALSE);
		}
		unset($this['aliases'], $this['parameters']); //TODO: need addDynamic to allow 0 to X items...there will be no need to setRequired(FALSE)
	}
}
