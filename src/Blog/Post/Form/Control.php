<?php

namespace Ytnuk\Blog\Post\Form;

use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Blog
 */
final class Control extends Ytnuk\Orm\Form\Control
{

	/**
	 * @param Ytnuk\Blog\Post\Entity $post
	 * @param Ytnuk\Orm\Form\Factory $form
	 */
	public function __construct(Ytnuk\Blog\Post\Entity $post, Ytnuk\Orm\Form\Factory $form)
	{
		parent::__construct($post, $form);
	}
}
