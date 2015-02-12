<?php

namespace Ytnuk\Menu\Node;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\ManyHasOne|Ytnuk\Menu\Entity $menu {m:1 Ytnuk\Menu\Repository $nodes}
 * @property Nextras\Orm\Relationships\ManyHasOne|Ytnuk\Menu\Entity $parent {m:1 Ytnuk\Menu\Repository $childNodes}
 * @property bool $primary {default false}
 */
final class Entity extends Ytnuk\Orm\Entity //TODO: implement traversing
{

	const PROPERTY_NAME = 'menu';
}
