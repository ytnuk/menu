<?php

namespace Ytnuk\Shop\Product\Category\Form;

use Nette;
use Ytnuk;
use Nextras;

/**
 * Class Container
 *
 * @package Ytnuk\Shop
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
			case 'product':
			case 'category':
				$component->setOption('unique', TRUE);
				break;
			case 'primary':
				$component->setOption('unique', 'product');
				break;
		}

		return $component;
	}
}
