<?php

namespace Ytnuk\Blog\Post;

use Nextras;
use Ytnuk;

/**
 * Class Repository
 *
 * @package Ytnuk\Blog
 */
final class Repository extends Ytnuk\Orm\Repository
{

	/**
	 * @inheritdoc
	 */
	public function findAll()
	{
		return parent::findAll()->orderBy('id', Nextras\Orm\Collection\ICollection::DESC);
	}
}
