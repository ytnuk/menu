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
	protected function addProperty(Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata)
	{
		$component = parent::addProperty($metadata);
		switch ($metadata->name) {
			case 'menu':
			case 'parent':
				$component->setOption('unique', TRUE);
				break;
			case 'primary':
				$component->setOption('unique', 'menu');
				break;
		}

		return $component;
	}

}
