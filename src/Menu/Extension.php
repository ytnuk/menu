<?php

namespace WebEdit\Menu;

use Kdyby\Translation;
use Nette\DI;
use WebEdit\Application;
use WebEdit\Config;
use WebEdit\Orm;

/**
 * Class Extension
 *
 * @package WebEdit\Menu
 */
final class Extension extends DI\CompilerExtension implements Config\Provider
{

	/**
	 * @return array
	 */
	public function getConfigResources()
	{
		return [
			Orm\Extension::class => [
				'repositories' => [
					$this->prefix('repository') => Repository::class
				]
			],
			Translation\DI\TranslationExtension::class => [
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
					'tags' => [Application\Extension::COMPONENT_TAG]
				]
			]
		];
	}
}
