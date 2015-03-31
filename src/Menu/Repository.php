<?php

namespace Ytnuk\Menu;

use Nextras\Orm\Mapper\IMapper;
use Nextras\Orm\Repository\IDependencyProvider;
use Nextras;
use Ytnuk;

/**
 * Class Repository
 *
 * @package Ytnuk\Menu
 */
final class Repository extends Ytnuk\Orm\Repository
{

	/**
	 * @var Ytnuk\Link\Repository
	 */
	public $linkRepository; //TODO: move to service/facade using __construct

	public function __construct(IMapper $mapper, IDependencyProvider $dependencyProvider = NULL, Ytnuk\Link\Repository $linkRepository)
	{
		parent::__construct($mapper, $dependencyProvider);
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
	public function getByLink(Entity $menu, $destination, $parameters = [], $alias = NULL) //TODO: separate to Link repository/service/facade
	{
		$links = $this->findBy([
			'this->link->destination' => $destination,
			'this->link->aliases->value' => $alias,
			'id' => array_keys([$menu->id => $menu] + $menu->getterChildren(TRUE))
		])->fetchPairs('link', 'link');
		$collection = $this->linkRepository->findBy([
			'this->id' => array_keys($links),
			'this->parameters->id!=' => NULL,
		]);
		$builder = $collection->getQueryBuilder();
		foreach ($parameters as $key => $value) {
			$arguments = [
				'query' => implode(' AND ', [
					implode('=', [
						'parameters.key',
						'%s'
					]),
					'parameters.value'
				]),
				'key' => $key,
			];
			if ($value === NULL) {
				$arguments['query'] .= ' IS NULL';
			} else {
				$arguments['query'] .= ' = %s';
				$arguments['value'] = $value;
			}
			call_user_func_array([
				$builder,
				'addOrderBy'
			], $arguments);
		}

		return $this->getBy([
			'this->link' => $collection->fetch() ? : reset($links),
		]);
	}
}
