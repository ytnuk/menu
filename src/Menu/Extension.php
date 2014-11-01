<?php

namespace WebEdit\Menu;

use Kdyby\Translation;
use Nette\DI;
use WebEdit\Application;
use WebEdit\Config;
use WebEdit\Menu;
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
					$this->prefix('repository') => Menu\Repository::class
				]
			],
			Translation\DI\TranslationExtension::class => [
				'dirs' => [
					__DIR__ . '/../../locale'
				]
			],
			'services' => [
				[
					'implement' => Menu\Form\Control\Factory::class,
					'parameters' => ['menu'],
					'arguments' => ['%menu%']
				],
				'menu' => [
					'implement' => Menu\Control\Factory::class,
					'tags' => [Application\Extension::COMPONENT_TAG]
				]
			]
		];
	}
}
