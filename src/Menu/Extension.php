<?php

namespace Ytnuk\Menu;

use Kdyby;
use Nette;
use Ytnuk;

/**
 * Class Extension
 *
 * @package Ytnuk\Menu
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
					$this->prefix('linkRepository') => Ytnuk\Link\Repository::class,
					$this->prefix('linkAliasRepository') => Ytnuk\Link\Alias\Repository::class,
					$this->prefix('linkParameterRepository') => Ytnuk\Link\Parameter\Repository::class
				]
			],
			Kdyby\Translation\DI\TranslationExtension::class => [
				'dirs' => [
					__DIR__ . '/../../locale'
				]
			],
			'services' => [
				$this->prefix('formControl') => [
					'implement' => Form\Control\Factory::class,
					'parameters' => ['menu'],
					'arguments' => ['%menu%']
				],
				[
					'implement' => Control\Factory::class,
					'parameters' => ['menu'],
					'arguments' => ['%menu%']
				]
			]
		];
	}
}
