<?php
namespace Ytnuk\Blog\Post;

use Nette;
use Ytnuk;

/**
 * Class Presenter
 *
 * @package Ytnuk\Blog
 */
final class Presenter
	extends Ytnuk\Blog\Presenter
{

	/**
	 * @var Repository
	 */
	private $repository;

	/**
	 * @var Control\Factory
	 */
	private $control;

	/**
	 * @var Entity
	 */
	private $post;

	/**
	 * @param Repository $repository
	 * @param Control\Factory $control
	 */
	public function __construct(
		Repository $repository,
		Control\Factory $control
	) {
		parent::__construct();
		$this->repository = $repository;
		$this->control = $control;
	}

	/**
	 * @param int $id
	 *
	 * @throws \Nette\Application\BadRequestException
	 */
	public function actionView($id)
	{
		if ( ! $this->post = $this->repository->getById($id)) {
			$this->error();
		}
		if ($category = $this->post->category) {
			$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = $category->menu;
		}
		$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = $this->post->title;
	}

	/**
	 * @param $id
	 *
	 * @throws Nette\Application\BadRequestException
	 */
	public function actionEdit($id)
	{
		if ( ! $this->post = $this->repository->getById($id)) {
			$this->error();
		}
	}

	public function renderEdit()
	{
		$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = 'blog.post.presenter.action.edit';
	}

	/**
	 * @inheritdoc
	 */
	public function redrawControl(
		$snippet = NULL,
		$redraw = TRUE
	) {
		parent::redrawControl(
			$snippet,
			$redraw
		);
		if ($this->post) {
			$this[Control::class]->redrawControl(
				$snippet,
				$redraw
			);
		}
	}

	/**
	 * @return Control
	 */
	protected function createComponentYtnukBlogPostControl()
	{
		return $this->control->create($this->post ? : new Entity);
	}
}
