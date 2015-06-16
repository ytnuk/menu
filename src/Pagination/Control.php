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
		$this->paginator->setItemCount(count($collection));
		$this->page = $this->iterator = $this->paginator->getBase();
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
	 * @inheritdoc
	 */
	public function count()
	{
		return $this->paginator->getPageCount();
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
	protected function attached($presenter)
	{
		parent::attached($presenter);
		$this->paginator->setPage($this->page);
	}

	protected function startup()
	{
		$this->getTemplate()->add('paginator', $this->paginator);
	}
}
