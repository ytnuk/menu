<?php

namespace Ytnuk\Shop\Product\Category;

use Ytnuk;

/**
 * Class Mapper
 *
 * @package Ytnuk\Shop
 */
final class Mapper extends Ytnuk\Orm\Mapper
{

	/**
	 * @inheritdoc
	 */
	public function createCollection()
	{
		$collection = parent::createCollection();
		$collection->orderBy('primary', $collection::DESC);

		return $collection;
	}
}
