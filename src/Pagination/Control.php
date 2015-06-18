<?php

namespace Ytnuk\Pagination;

use Ytnuk;
use Traversable;
use Iterator;
use Countable;
use Nette;

/**
 * Class Control
 *
 * @package Ytnuk\Pagination
 */
class Control extends Ytnuk\Application\Control implements Iterator, Countable
{

	/**
	 * @var int
	 * @persistent
	 */
	public $page = 0;

	/**
	 * @var int
	 */
	private $iterator;

	/**
	 * @var Traversable
	 */
	private $collection;

	/**
	 * @var Nette\Utils\Paginator
	 */
	private $paginator;

	/**
	 * @param Traversable $collection
	 * @param int $itemsPerPage
	 */
	public function __construct(Traversable $collection, $itemsPerPage = 1)
	{
		$this->collection = $collection;
		$this->paginator = new Nette\Utils\Paginator;
		$this->paginator->setItemsPerPage($itemsPerPage);
		if ($collection instanceof Countable) {
			$this->paginator->setItemCount($this->count($collection));
		}
		$this->page = $this->iterator = $this->paginator->getBase();
	}

	/**
	 * @inheritdoc
	 *
	 * @param Countable|NULL $collection
	 */
	public function count(Countable $collection = NULL)
	{
		return $collection ? count($collection) : $this->paginator->getPageCount();
	}

	/**
	 * @inheritdoc
	 */
	public function handleRedirect($fragment = NULL)
	{
		if ($this->getPresenter()->isAjax() && $parent = $this->lookup(Nette\Application\UI\IRenderable::class, FALSE)) {
			$parent->redrawControl();
		}
		parent::handleRedirect($fragment);
	}

	/**
	 * @inheritdoc
	 */
	public function next()
	{
		$this->iterator++;
	}

	/**
	 * @inheritdoc
	 */
	public function key()
	{
		return $this->iterator;
	}

	/**
	 * @inheritdoc
	 */
	public function valid()
	{
		return $this->iterator <= $this->paginator->getPageCount();
	}

	/**
	 * @inheritdoc
	 */
	public function current()
	{
		return $this->iterator === $this->paginator->getPage();
	}

	/**
	 * @return array
	 */
	public function getCollection()
	{
		return array_slice(iterator_to_array($this->collection), $this->paginator->getOffset(), $this->paginator->getItemsPerPage());
	}

	/**
	 * @return Nette\Utils\Paginator
	 */
	public function getPaginator()
	{
		return $this->paginator;
	}

	/**
	 * @inheritdoc
	 */
	public function rewind()
	{
		$this->iterator = $this->paginator->getBase();
	}

	/**
	 * @inheritdoc
	 */
	public function getCacheKey()
	{
		return array_merge(parent::getCacheKey(), [
			$this->paginator->getPage(),
			$this->paginator->getItemsPerPage()
		]);
	}

	/**
	 * @inheritdoc
	 */
	protected function attached($presenter)
	{
		parent::attached($presenter);
		$this->paginator->setPage($this->page);
	}

	/**
	 * @return array
	 */
	protected function startup()
	{
		return [
			'paginator' => $this->paginator
		];
	}
}
