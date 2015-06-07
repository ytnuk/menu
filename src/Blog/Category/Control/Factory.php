<?php

namespace Ytnuk\Blog\Category\Control;

use Ytnuk;

/**
 * Interface Factory
 *
 * @package Ytnuk\Blog
 */
interface Factory
{

	/**
	 * @param Ytnuk\Blog\Category\Entity $category
	 *
	 * @return Ytnuk\Blog\Category\Control
	 */
	public function create(Ytnuk\Blog\Category\Entity $category);
}
