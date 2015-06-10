<?php

namespace Ytnuk\Pagination;

use Ytnuk;
use Traversable;
use Iterator;
use Countable;

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
	public $page = 1;

	/**
	 * @var Traversable
	 */
	private $collection;

	/**
	 * @param Traversable $collection
	 */
	public function __construct(Traversable $collection)
	{
		$this->collection = $collection;
	}

	/**
	 * @inheritdoc
	 */
	public function current()
	{
		// TODO: Implement current() method.
	}

	/**
	 * @inheritdoc
	 */
	public function next()
	{
		// TODO: Implement next() method.
	}

	/**
	 * @inheritdoc
	 */
	public function key()
	{
		// TODO: Implement key() method.
	}

	/**
	 * @inheritdoc
	 */
	public function valid()
	{
		// TODO: Implement valid() method.
	}

	/**
	 * @inheritdoc
	 */
	public function rewind()
	{
		// TODO: Implement rewind() method.
	}

	/**
	 * @inheritdoc
	 */
	public function count()
	{
		// TODO: Implement count() method.
	}
}
