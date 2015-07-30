<?php
namespace Ytnuk\Blog\Category;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Description\Entity|NULL $description {1:1d Description\Entity::$category}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Menu\Entity $menu {1:1d Ytnuk\Menu\Entity::$category primary}
 * @property Nextras\Orm\Relationships\OneHasMany|Ytnuk\Blog\Post\Category\Entity[] $postNodes {1:m Ytnuk\Blog\Post\Category\Entity::$category}
 * @property-read Nextras\Orm\Collection\ICollection|Ytnuk\Blog\Post\Entity[] $posts {virtual}
 */
final class Entity
	extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'menu';

	/**
	 * @var Ytnuk\Blog\Post\Repository
	 */
	private $postRepository;

	/**
	 * @return Nextras\Orm\Collection\ICollection|Ytnuk\Blog\Post\Entity[]
	 */
	public function getterPosts()
	{
		return $this->postRepository->findBy(['this->categoryNodes->category' => $this->id]);
	}

	/**
	 * @param Ytnuk\Blog\Post\Repository $repository
	 */
	public function injectPostRepository(Ytnuk\Blog\Post\Repository $repository)
	{
		$this->postRepository = $repository;
	}
}
