<?php

namespace Ytnuk\Menu;

use Ytnuk;

/**
 * Class Repository
 *
 * @package Ytnuk\Menu
 */
final class Repository extends Ytnuk\Orm\Repository
{

	/**
	 * @param string $destination
	 * @param array $parameters
	 *
	 * @return Entity
	 */
	public function getByLink($destination, $parameters = [])
	{
		//TODO: get menu with matching destination + most matching parameters
		$parameters = array_filter($parameters, function ($value) {
			return ! is_null($value);
		});
		$conditions = [
			'this->link->destination' => $destination
		];
		if ($parameters) {
			$conditions += [
				'this->link->parameters->key' => array_keys($parameters),
				'this->link->parameters->value' => array_values($parameters)
			];
		}

		return $this->getBy($conditions);
	}
}
