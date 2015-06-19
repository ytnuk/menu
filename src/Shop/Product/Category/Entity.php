<?php

namespace Ytnuk\Shop\Product\Category;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\ManyHasOne|Ytnuk\Shop\Product\Entity $product {m:1 Ytnuk\Shop\Product\Repository $categoryNodes}
 * @property Nextras\Orm\Relationships\ManyHasOne|Ytnuk\Shop\Category\Entity $category {m:1 Ytnuk\Shop\Category\Repository $productNodes}
 * @property bool|NULL $primary
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'category';
}
