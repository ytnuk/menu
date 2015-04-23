<?php

namespace Ytnuk\Translation;

use Nette;
use Ytnuk;

/**
 * Class Extension
 *
 * @package Ytnuk\Translation
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
					$this->prefix('translateRepository') => Translate\Repository::class,
					$this->prefix('localeRepository') => Locale\Repository::class,
				]
			],
			'services' => [
				Control\Factory::class,
				Form\Control\Factory::class,
			]
		];
	}
}
