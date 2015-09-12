<?php
namespace Ytnuk\Menu;

use Kdyby;
use Nette;
use Ytnuk;

final class Extension
	extends Nette\DI\CompilerExtension
	implements Ytnuk\Config\Provider
{

	public function getConfigResources() : array
	{
		return [
			Ytnuk\Orm\Extension::class => [
				'repositories' => [
					$this->prefix('repository') => Repository::class,
					$this->prefix('nodeRepository') => Node\Repository::class,
				],
			],
			Kdyby\Translation\DI\TranslationExtension::class => [
				'dirs' => [
					__DIR__ . '/../../locale',
				],
			],
			'services' => [
				Control\Factory::class,
				Form\Control\Factory::class,
			],
		];
	}
}
