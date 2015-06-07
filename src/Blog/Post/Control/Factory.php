<?php

namespace Ytnuk\Blog\Post\Control;

use Ytnuk;

/**
 * Interface Factory
 *
 * @package Ytnuk\Blog
 */
interface Factory
{

	/**
	 * @param Ytnuk\Blog\Post\Entity $post
	 *
	 * @return Ytnuk\Blog\Post\Control
	 */
	public function create(Ytnuk\Blog\Post\Entity $post);
}
