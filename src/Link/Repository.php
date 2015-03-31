<?php

namespace Ytnuk\Link;

use Ytnuk;

/**
 * Class Repository
 *
 * @package Ytnuk\Link
 */
final class Repository extends Ytnuk\Orm\Repository
{

	public function orderByParameters(array $conds)
	{
		return parent::getBy($conds);
	}
}
