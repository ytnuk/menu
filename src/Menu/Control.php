<?php
namespace Ytnuk\Menu;

use Nette;
use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Menu
 */
final class Control
	extends Ytnuk\Orm\Control
{

	/**
	 * @var Entity
	 */
	private $menu;

	/**
	 * @var Repository
	 */
	private $repository;

	/**
	 * @var Control\Factory
	 */
	private $control;

	/**
	 * @var Form\Control\Factory
	 */
	private $formControl;

	/**
	 * @var Ytnuk\Orm\Grid\Control\Factory
	 */
	private $gridControl;

	/**
	 * @var Nette\Http\Request
	 */
	private $request;

	/**
	 * @var array
	 */
	private $breadcrumb = [];

	/**
	 * @var array
	 */
	private $append = [];

	/**
	 * @var Entity
	 */
	private $active;

	/**
	 * @var Nette\Localization\ITranslator
	 */
	private $translator;

	/**
	 * @param Entity $menu
	 * @param Repository $repository
	 * @param Control\Factory $control
	 * @param Form\Control\Factory $formControl
	 * @param Ytnuk\Orm\Grid\Control\Factory $gridControl
	 * @param Nette\Http\Request $request
	 * @param Nette\Localization\ITranslator $translator
	 */
	public function __construct(
		Entity $menu,
		Repository $repository,
		Control\Factory $control,
		Form\Control\Factory $formControl,
		Ytnuk\Orm\Grid\Control\Factory $gridControl,
		Nette\Http\Request $request,
		Nette\Localization\ITranslator $translator
	) {
		parent::__construct($menu);
		$this->menu = $menu;
		$this->repository = $repository;
		$this->control = $control;
		$this->formControl = $formControl;
		$this->gridControl = $gridControl;
		$this->request = $request;
		$this->translator = $translator;
	}

	/**
	 * @inheritdoc
	 */
	protected function getViews()
	{
		return [
			'breadcrumb' => TRUE,
			'navbar' => TRUE,
			'title' => TRUE,
			'xml' => FALSE,
		] + parent::getViews();
	}

	/**
	 * @param string $offset
	 * @param Entity|Ytnuk\Translation\Entity|string $menu
	 */
	public function offsetSet(
		$offset,
		$menu
	) {
		if ($menu instanceof Entity && ! $this->active && $offset === NULL) {
			$this->active = $menu;

			return;
		} elseif ($menu instanceof Ytnuk\Translation\Entity) {
			$entity = new Entity;
			$entity->title = $menu;
			$menu = $entity;
		} elseif (is_string($menu)) {
			$this->repository->attach($entity = new Entity);
			$entity->title = new Ytnuk\Translation\Entity;
			$translate = new Ytnuk\Translation\Translate\Entity;
			$translate->value = $this->translator->translate($menu);
			$entity->title->translates->add($translate);
			$menu = $entity;
		}
		if ($menu instanceof Entity) {
			if ($offset === NULL) {
				$this->append[] = $menu;
			} else {
				$this->append[$offset] = $menu;
			}
		} else {
			parent::offsetSet(
				$offset,
				$menu
			);
		}
	}

	/**
	 * @return array
	 */
	protected function startup()
	{
		return [
			'menu' => $this->menu,
		];
	}

	/**
	 * @return array
	 */
	protected function renderTitle()
	{
		return [
			'last' => $this->append ? end($this->append) : $this->getActive(),
		];
	}

	/**
	 * @return array
	 */
	protected function renderBreadcrumb()
	{
		return [
			'breadcrumb' => $this->getBreadcrumb(),
		];
	}

	/**
	 * @return array
	 */
	protected function renderNavbar()
	{
		return [
			'breadcrumb' => $this->getBreadcrumb(FALSE),
		];
	}

	/**
	 * @return Form\Control
	 */
	protected function createComponentYtnukOrmFormControl()
	{
		return $this->formControl->create($this->menu ? : new Entity);
	}

	/**
	 * @return Ytnuk\Orm\Grid\Control
	 */
	protected function createComponentYtnukGridControl()
	{
		return $this->gridControl->create($this->repository);
	}

	/**
	 * @param bool $append
	 *
	 * @return Entity[]
	 */
	private function getBreadcrumb($append = TRUE)
	{
		if ( ! $this->breadcrumb && $active = $this->getActive()) {
			$this->breadcrumb = array_reverse(
				$active->getterParents(TRUE),
				TRUE
			);
			$this->breadcrumb[$active->id] = $active;
		}

		return $append ? array_merge(
			$this->breadcrumb,
			$this->append
		) : $this->breadcrumb;
	}

	/**
	 * @return Entity
	 */
	private function getActive()
	{
		if ($this->active === NULL) {
			if ( ! $menu = $this->repository->getByMenuAndDestinationAndParameters(
				$this->menu,
				$destination = $this->getPresenter()->getAction(TRUE),
				$this->getPresenter()->getRequest()->getParameters()
			)
			) {
				$destination = substr(
					$destination,
					0,
					-strlen($this->getPresenter()->getAction())
				);
				foreach (
					$this->menu->getterChildren(TRUE) as $child
				) {
					if (strpos(
							$child->link->destination,
							$destination
						) !== FALSE
					) {
						$menu = $child;
						break;
					}
				}
			}
			$this->active = $menu ? : $this->menu;
		}

		return $this->active;
	}
}
