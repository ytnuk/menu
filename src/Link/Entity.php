<?php

namespace Ytnuk\Link;

use Ytnuk;

/**
 * @property Alias\Entity[] $aliases {1:m Alias\Repository $link primary}
 * @property Parameter\Entity[] $parameters {1:m Parameter\Repository $link primary}
 * @property string $destination
 * TODO:
 * @property Ytnuk\Menu\Entity $menu {1:1d Ytnuk\Menu\Repository $link}
 */
class Entity extends Ytnuk\Orm\Entity
{

}
