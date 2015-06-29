<?php

namespace Ytnuk\Menu\Node;

use Ytnuk;
use Nextras;

/**
 * Class Mapper
 *
 * @package Ytnuk\Menu
 */
final class Mapper extends Ytnuk\Orm\Mapper
{

	/**
	 * @inheritdoc
	 */
	public function createCollectionOneHasMany(Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata, Nextras\Orm\Entity\IEntity $parent)
	{
		return parent::createCollectionOneHasMany($metadata, $parent)->orderBy('primary', Nextras\Orm\Collection\ICollection::DESC);
	}
}
