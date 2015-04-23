<?php

namespace Ytnuk\Translation\Translate;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\ManyHasOne|Ytnuk\Translation\Entity $translation {m:1 Ytnuk\Translation\Repository $translations}
 * @property Nextras\Orm\Relationships\ManyHasOne|Ytnuk\Translation\Locale\Entity $locale {m:1 Ytnuk\Translation\Locale\Repository $translations}
 * @property string $value
 */
class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'value';
}
