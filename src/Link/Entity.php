<?php

namespace Ytnuk\Link;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasMany|Alias\Entity[] $aliases {1:m Alias\Repository $link}
 * @property Nextras\Orm\Relationships\OneHasMany|Parameter\Entity[] $parameters {1:m Parameter\Repository $link}
 * @property string $destination
 * TODO:
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Menu\Entity|NULL $menu {1:1d Ytnuk\Menu\Repository $link}
 */
class Entity extends Ytnuk\Orm\Entity
{

}
