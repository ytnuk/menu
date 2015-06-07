<?php

namespace Ytnuk\Blog\Post\Form\Control;

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
	 * @return Ytnuk\Blog\Post\Form\Control
	 */
	public function create(Ytnuk\Blog\Post\Entity $post);
}
