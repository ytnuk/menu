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
	 *
	 * @return Entity
	 */
	public function getByLink(Entity $menu, $destination, $parameters = [])
	{
		$destination = explode(':', ltrim($destination, ':'));
		$links = $this->repository->findBy([
			'this->link->action' => array_pop($destination),
			'this->link->presenter' => array_pop($destination),
			'this->link->module' => implode(':', $destination),
			'id' => array_keys([$menu->id => $menu] + $menu->getterChildren(TRUE))
		])->fetchPairs('link', 'link');
		if ( ! $links) {
			return NULL;
		}
		if ( ! $parameters || ! $link = $this->linkRepository->getByParameters($parameters, ['this->id' => array_keys($links)])) {
			$link = reset($links);
		}

		return $this->repository->getByLink($link);
	}

	/**
	 * @return Repository
	 */
	public function getRepository()
	{
		return $this->repository;
	}
}
