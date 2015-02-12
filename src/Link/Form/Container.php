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

	/**
	 * @param Ytnuk\Form $form
	 */
	protected function attached($form)
	{
		parent::attached($form);
		foreach ($this['aliases']->getContainers() as $alias) {
			unset($alias['link']);
		}
		foreach ($this['parameters']->getContainers() as $parameter) {
			unset($parameter['link']);
		}
	}
}
