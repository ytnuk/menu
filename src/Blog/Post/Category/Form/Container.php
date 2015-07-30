<?php
namespace Ytnuk\Blog\Post\Category\Form;

use Nette;
use Nextras;
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
	 */
	protected function addProperty(Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata)
	{
		$component = parent::addProperty($metadata);
		switch ($metadata->name) {
			case 'post':
			case 'category':
				$component->setOption(
					'unique',
					TRUE
				);
				break;
			case 'primary':
				$component->setOption(
					'unique',
					'post'
				);
				break;
		}

		return $component;
	}
}
