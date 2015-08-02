<?php
namespace Ytnuk\Blog\Post\Category;

use Nextras;
use Ytnuk;

/**
 * Class Mapper
 *
 * @package Ytnuk\Blog
 */
final class Mapper
	extends Ytnuk\Orm\Mapper
{

	/**
	 * @inheritdoc
	 */
	public function createCollectionOneHasMany(
		Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata,
		Nextras\Orm\Entity\IEntity $parent
	) {
		return parent::createCollectionOneHasMany(
			$metadata,
			$parent
		)->orderBy(
			'primary',
			Nextras\Orm\Collection\ICollection::DESC
		);
	}
}
