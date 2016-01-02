<?php
namespace Ytnuk\Menu;

use Nette;
use Nextras;
use Ytnuk;

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

	protected function getViews() : array
	{
		return [
			'breadcrumb' => TRUE,
			'navbar' => TRUE,
			'navbarNav' => TRUE,
			'title' => TRUE,
		] + parent::getViews();
	}

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
			$this->repository->detach($entity);
			$menu = $entity;
		}
		if ($menu instanceof Entity) {
			if ($offset === NULL) {
				$this->append[] = $menu;
			} else {
				$this->append[$offset] = $menu;
			}
		} else {
			parent::offsetSet($offset, $menu);
		}
	}

	protected function startup() : array
	{
		return [
			'menu' => $this->menu,
		];
	}

	protected function renderTitle() : array
	{
		return [
			'last' => $this->append ? end($this->append) : $this->getActive(),
		];
	}

	protected function renderBreadcrumb() : array
	{
		return [
			'breadcrumb' => $this->getBreadcrumb(),
		];
	}

	protected function renderNavbarNav() : array
	{
		return [
			'breadcrumb' => $this->getBreadcrumb(FALSE),
		];
	}

	protected function createComponentForm() : Form\Control
	{
		return $this->formControl->create($this->menu);
	}

	protected function createComponentGrid() : Ytnuk\Orm\Grid\Control
	{
		return $this->gridControl->create($this->repository);
	}

	private function getBreadcrumb(bool $append = TRUE) : array
	{
		if ( ! $this->breadcrumb && $active = $this->getActive()) {
			$this->breadcrumb = array_reverse($active->getterParents(TRUE), TRUE);
			$this->breadcrumb[$active->id] = $active;
		}

		return $append ? array_merge($this->breadcrumb, $this->append) : $this->breadcrumb;
	}

	private function getActive() : Entity
	{
		if ($this->active === NULL) {
			if ( ! $menu = $this->repository->getByMenuAndDestinationAndParameters($this->menu, $destination = $this->getPresenter()->getAction(TRUE), array_map(function ($parameter) {
				return $parameter instanceof Nextras\Orm\Entity\IEntity ? $parameter->getPersistedId() : $parameter;
			}, $this->getPresenter()->getRequest()->getParameters()))
			) {
				$destination = substr($destination, 0, -strlen($this->getPresenter()->getAction()));
				foreach (
					$this->menu->getterChildren(TRUE) as $child
				) {
					if (strpos($child->link->destination, $destination) !== FALSE) {
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
