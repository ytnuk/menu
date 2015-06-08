<?php

namespace Ytnuk\Blog\Post\Category\Form;

use Nette;
use Ytnuk;
use Nextras;

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
	protected function addProperty(Nextras\Orm\Entity\Reflection\PropertyMetadata $property)
	{
		$component = parent::addProperty($property);
		switch ($property->name) {
			case 'post':
			case 'category':
				$component->setOption('unique', TRUE);
				break;
			case 'primary':
				$component->setOption('unique', 'post');
				break;
		}

		return $component;
	}
}
