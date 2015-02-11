<?php

namespace Ytnuk\Menu;

use Ytnuk;

/**
 * Class Mapper
 *
 * @package Ytnuk\Menu
 */
final class Mapper extends Ytnuk\Orm\Mapper
{

	/**
	 * @param array $links
	 * @param array $parameters
	 *
	 * @return Ytnuk\Link\Entity
	 */
	public function fetchByParameters(array $links, array $parameters)
	{
		//TODO: refactor
		$selection = $this->databaseContext->table('link');
		$selection->where('link.id', array_keys($links));
		foreach ($parameters as $key => $value) {
			$selection->order(implode(' AND ', [
					implode('=', [
						':link_parameter.key',
						'?'
					]),
					implode('=', [
						':link_parameter.value',
						'?'
					])
				]) . ' DESC', $key, $value);
		}

		return $links[$selection->fetch()
			->getPrimary()];
	}
}
