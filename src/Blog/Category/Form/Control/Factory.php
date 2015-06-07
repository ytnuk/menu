<?php

namespace Ytnuk\Blog\Category\Form\Control;

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
	 * @return Ytnuk\Blog\Category\Form\Control
	 */
	public function create(Ytnuk\Blog\Category\Entity $category);
}
