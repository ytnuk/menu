<?php

namespace Ytnuk\Blog\Post;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity $title {1:1d Ytnuk\Translation\Repository $post primary}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Description\Entity|NULL $description {1:1d Description\Repository $post}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity $content {1:1d Ytnuk\Translation\Repository $post primary}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Link\Entity $link {1:1d Ytnuk\Link\Repository $post primary}
 * @property Nextras\Orm\Relationships\OneHasMany|Category\Entity[] $categoryNodes {1:m Category\Repository $post}
 * @property-read Nextras\Orm\Collection\ICollection|Ytnuk\Blog\Category\Entity[] $categories {virtual}
 * @property-read Ytnuk\Blog\Category\Entity|NULL $category {virtual}
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'title';

	/**
	 * @return Nextras\Orm\Collection\ICollection|Ytnuk\Blog\Category\Entity[]
	 */
	public function getterCategories()
	{
		return $this->getModel()->getRepository(Ytnuk\Blog\Category\Repository::class)->findBy(['this->postNodes->post' => $this->id]);
	}

	/**
	 * @return Ytnuk\Blog\Category\Entity|NULL
	 */
	public function getterCategory()
	{
		$node = $this->categoryNodes->get()->fetch();

		return $node ? $node->category : NULL;
	}
}
