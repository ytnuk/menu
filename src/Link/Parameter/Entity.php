<?php

namespace Ytnuk\Link\Parameter;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\ManyHasOne|Ytnuk\Link\Entity $link {m:1 Ytnuk\Link\Repository $parameters}
 * @property string $key
 * @property string $value
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'value';
}
