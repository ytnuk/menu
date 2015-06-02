<?php

namespace Ytnuk\Menu;

use Ytnuk;

/**
 * Class Service
 *
 * @package Ytnuk\Menu
 */
final class Service
{

	/**
	 * @var Repository
	 */
	private $repository;

	/**
	 * @var Ytnuk\Link\Repository
	 */
	private $linkRepository;

	/**
	 * @param Repository $repository
	 * @param Ytnuk\Link\Repository $linkRepository
	 */
	function __construct(Repository $repository, Ytnuk\Link\Repository $linkRepository)
	{
		$this->repository = $repository;
		$this->linkRepository = $linkRepository;
	}

	/**
	 * @param Entity $menu
	 * @param string $destination
	 * @param array $parameters
	 * @param array|string|NULL $alias
	 *
	 * @return Entity
	 */
	public function getByLink(Entity $menu, $destination, $parameters = [], $alias = NULL)
	{
		$links = $this->repository->findBy([
			'this->link->destination' => $destination,
			'this->link->aliases->value' => $alias,
			'id' => array_keys([$menu->id => $menu] + $menu->getterChildren(TRUE))
		])->fetchPairs('link', 'link');

		return $this->repository->getBy([
			'this->link' => $this->linkRepository->getByParameters($parameters, ['this->id' => array_keys($links)]) ? : reset($links),
		]);
	}

	/**
	 * @return Repository
	 */
	public function getRepository()
	{
		return $this->repository;
	}
}
