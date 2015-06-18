<?php

namespace Ytnuk\Blog\Category;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity|NULL $description {1:1d Ytnuk\Translation\Repository $category primary}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Menu\Entity $menu {1:1d Ytnuk\Menu\Repository $category primary}
 * @property Nextras\Orm\Relationships\OneHasMany|Ytnuk\Blog\Post\Category\Entity[] $postNodes {1:m Ytnuk\Blog\Post\Category\Repository $category}
 * @property-read Nextras\Orm\Collection\ICollection|Ytnuk\Blog\Post\Entity[] $posts {virtual}
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'menu';

	/**
	 * @var array
	 */
	public $itemsPerPage = [
		'posts' => 2,
	];

	/**
	 * @return Nextras\Orm\Collection\ICollection|Ytnuk\Blog\Post\Entity[]
	 */
	public function getterPosts()
	{
		return $this->getModel()->getRepository(Ytnuk\Blog\Post\Repository::class)->findBy(['this->categoryNodes->category' => $this->id]);
	}
}
