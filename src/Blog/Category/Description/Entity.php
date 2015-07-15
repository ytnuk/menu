<?php

namespace Ytnuk\Blog\Category\Description;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Blog\Category\Entity $category {1:1d Ytnuk\Blog\Category\Repository $description primary}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity|NULL $value {1:1d Ytnuk\Translation\Repository $description primary}
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'value';
}