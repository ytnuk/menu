<?php

namespace WebEdit\Menu;

use Kdyby;
use Nette;
use WebEdit;

/**
 * Class Extension
 *
 * @package WebEdit\Menu
 */
final class Extension extends Nette\DI\CompilerExtension implements WebEdit\Config\Provider
{

	/**
	 * @return array
	 */
	public function getConfigResources()
	{
		return [
			WebEdit\Orm\Extension::class => [
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
					'tags' => [WebEdit\Application\Extension::COMPONENT_TAG]
				]
			]
		];
	}
}
