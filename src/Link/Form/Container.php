<?php

namespace Ytnuk\Link\Form;

use Nette;
use Ytnuk;

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
	}

	/**
	 * @param Ytnuk\Form $form
	 */
	protected function attached($form)
	{
		parent::attached($form);
		foreach ($this['aliases']->containers as $alias) {
			unset($alias['link']);
		}
		foreach ($this['parameters']->containers as $parameter) {
			unset($parameter['link']);
		}
	}
}
