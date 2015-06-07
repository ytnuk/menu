<?php

namespace Ytnuk\Blog\Category\Form;

use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Blog
 */
final class Control extends Ytnuk\Orm\Form\Control
{

	/**
	 * @param Ytnuk\Blog\Category\Entity $category
	 * @param Ytnuk\Orm\Form\Factory $form
	 */
	public function __construct(Ytnuk\Blog\Category\Entity $category, Ytnuk\Orm\Form\Factory $form)
	{
		parent::__construct($category, $form);
	}
}
