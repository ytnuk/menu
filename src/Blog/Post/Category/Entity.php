<?php

namespace Ytnuk\Blog\Post\Category;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\ManyHasOne|Ytnuk\Blog\Post\Entity $post {m:1 Ytnuk\Blog\Post\Repository $categoryNodes}
 * @property Nextras\Orm\Relationships\ManyHasOne|Ytnuk\Blog\Category\Entity $category {m:1 Ytnuk\Blog\Category\Repository $postNodes}
 * @property bool|NULL $primary
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'category';
}
