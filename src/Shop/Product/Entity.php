<?php

namespace Ytnuk\Shop\Product;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity $title {1:1d Ytnuk\Translation\Repository $product primary}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity|NULL $description {1:1d Ytnuk\Translation\Repository $category primary}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity|NULL $content {1:1d Ytnuk\Translation\Repository $product primary}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Link\Entity $link {1:1d Ytnuk\Link\Repository $product primary}
 * @property Nextras\Orm\Relationships\OneHasMany|Category\Entity[] $categoryNodes {1:m Category\Repository $product}
 * @property-read Nextras\Orm\Collection\ICollection|Ytnuk\Shop\Category\Entity[] $categories {virtual}
 * @property-read Ytnuk\Shop\Category\Entity|NULL $category {virtual}
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'title';

	/**
	 * @return Nextras\Orm\Collection\ICollection|Ytnuk\Shop\Category\Entity[]
	 */
	public function getterCategories()
	{
		return $this->getModel()->getRepository(Ytnuk\Shop\Category\Repository::class)->findBy(['this->productNodes->product' => $this->id]);
	}

	/**
	 * @return Ytnuk\Shop\Category\Entity|NULL
	 */
	public function getterCategory()
	{
		$node = $this->categoryNodes->get()->fetch();

		return $node ? $node->category : NULL;
	}
}
