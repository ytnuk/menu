<?php

namespace Ytnuk\Link\Alias;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\ManyHasOne|Ytnuk\Link\Entity $link {m:1 Ytnuk\Link\Repository $aliases}
 * @property string $value
 */
final class Entity extends Ytnuk\Orm\Entity
{

}
