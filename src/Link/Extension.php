<?php

namespace Ytnuk\Link;

use Nette;
use Ytnuk;

/**
 * Class Extension
 *
 * @package Ytnuk\Link
 */
final class Extension extends Nette\DI\CompilerExtension implements Ytnuk\Config\Provider
{

	/**
	 * @return array
	 */
	public function getConfigResources()
	{
		return [
			Ytnuk\Orm\Extension::class => [
				'repositories' => [
					$this->prefix('repository') => Repository::class,
					$this->prefix('aliasRepository') => Alias\Repository::class,
					$this->prefix('parameterRepository') => Parameter\Repository::class
				]
			],
			'services' => [
				Control\Factory::class,
				Form\Control\Factory::class,
			]
		];
	}
}
