<?php

namespace Ytnuk\Menu\Node\Form;

use Ytnuk;
use Nextras;

/**
 * Class Container
 *
 * @package Ytnuk\Menu
 */
final class Container extends Ytnuk\Orm\Form\Container
{

	/**
	 * @inheritdoc
	 */
	protected function addProperty(Nextras\Orm\Entity\Reflection\PropertyMetadata $property)
	{
		$component = parent::addProperty($property);
		switch ($property->name) {
			case 'menu':
			case 'parent':
				$component->setOption('unique', TRUE);
		}

		return $component;
	}
}
