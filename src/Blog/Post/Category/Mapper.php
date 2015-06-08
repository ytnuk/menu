<?php

namespace Ytnuk\Blog\Post\Category;

use Ytnuk;

/**
 * Class Mapper
 *
 * @package Ytnuk\Blog
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
