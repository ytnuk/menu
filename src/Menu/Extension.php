<?php

namespace Kutny\Menu;

use Kdyby;
use Nette;
use Kutny;

/**
 * Class Extension
 *
 * @package Kutny\Menu
 */
final class Extension extends Nette\DI\CompilerExtension implements Kutny\Config\Provider
{

	/**
	 * @return array
	 */
	public function getConfigResources()
	{
		return [
			Kutny\Orm\Extension::class => [
				'repositories' => [
					$this->prefix('repository') => Repository::class
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
				'menu' => [
					'implement' => Control\Factory::class,
					'tags' => [Kutny\Application\Extension::COMPONENT_TAG]
				]
			]
		];
	}
}
