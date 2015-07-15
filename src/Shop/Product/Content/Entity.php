<?php

namespace Ytnuk\Shop\Product\Content;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Shop\Product\Entity $product {1:1d Ytnuk\Shop\Product\Repository $content primary}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity|NULL $value {1:1d Ytnuk\Translation\Repository $content primary}
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'value';
}
