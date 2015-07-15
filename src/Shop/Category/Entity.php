<?php

namespace Ytnuk\Shop\Category;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Description\Entity|NULL $description {1:1d Description\Repository $category}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Menu\Entity $menu {1:1d Ytnuk\Menu\Repository $category primary}
 * @property Nextras\Orm\Relationships\OneHasMany|Ytnuk\Shop\Product\Category\Entity[] $productNodes {1:m Ytnuk\Shop\Product\Category\Repository $category}
 * @property-read Nextras\Orm\Collection\ICollection|Ytnuk\Shop\Product\Entity[] $products {virtual}
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'menu';

	/**
	 * @return Nextras\Orm\Collection\ICollection|Ytnuk\Shop\Product\Entity[]
	 */
	public function getterProducts()
	{
		return $this->getModel()->getRepository(Ytnuk\Shop\Product\Repository::class)->findBy(['this->categoryNodes->category' => $this->id]);
	}
}
