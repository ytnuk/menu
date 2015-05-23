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
	 * @inheritdoc
	 */
	public function getConfigResources()
	{
		return [
			Ytnuk\Orm\Extension::class => [
				'repositories' => [
					$this->prefix('repository') => Repository::class,
					$this->prefix('nodeRepository') => Node\Repository::class,
					$this->prefix('nodePrimaryRepository') => Node\Primary\Repository::class
				]
			],
			Kdyby\Translation\DI\TranslationExtension::class => [
				'dirs' => [
					__DIR__ . '/../../locale'
				]
			],
			'services' => [
				Service::class,
				Control\Factory::class,
				Form\Control\Factory::class,
			]
		];
	}
}
