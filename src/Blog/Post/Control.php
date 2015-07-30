<?php
namespace Ytnuk\Blog\Post;

use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Blog
 */
final class Control
	extends Ytnuk\Orm\Control
{

	/**
	 * @var Entity
	 */
	private $post;

	/**
	 * @var Form\Control\Factory
	 */
	private $formControl;

	/**
	 * @var Ytnuk\Orm\Grid\Control\Factory
	 */
	private $gridControl;

	/**
	 * @var Repository
	 */
	private $repository;

	/**
	 * @param Entity $post
	 * @param Form\Control\Factory $formControl
	 * @param Ytnuk\Orm\Grid\Control\Factory $gridControl
	 * @param Repository $repository
	 */
	public function __construct(
		Entity $post,
		Form\Control\Factory $formControl,
		Ytnuk\Orm\Grid\Control\Factory $gridControl,
		Repository $repository
	) {
		parent::__construct($post);
		$this->post = $post;
		$this->formControl = $formControl;
		$this->gridControl = $gridControl;
		$this->repository = $repository;
	}

	/**
	 * @return array
	 */
	protected function startup()
	{
		return [
			'post' => $this->post,
		];
	}

	/**
	 * @inheritdoc
	 */
	protected function getViews()
	{
		return [
			'view' => function () {
				return [
					$this->post,
				];
			},
		] + parent::getViews();
	}

	/**
	 * @return Form\Control
	 */
	protected function createComponentYtnukOrmFormControl()
	{
		return $this->formControl->create($this->post);
	}

	/**
	 * @return Ytnuk\Orm\Grid\Control
	 */
	protected function createComponentYtnukGridControl()
	{
		return $this->gridControl->create($this->repository);
	}
}
