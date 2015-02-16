<?php

namespace Ytnuk\Menu\Node\Primary;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Menu\Entity $menu {1:1d Ytnuk\Menu\Repository $primary primary}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Menu\Node\Entity $node {1:1d Ytnuk\Menu\Node\Repository $primary primary}
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'menu';
}
