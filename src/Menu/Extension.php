<?php
namespace Ytnuk\Menu;

use Kdyby;
use Nette;
use Ytnuk;

final class Extension
	extends Nette\DI\CompilerExtension
	implements Ytnuk\Orm\Provider, Kdyby\Translation\DI\ITranslationProvider
{

	public function loadConfiguration()
	{
		parent::loadConfiguration();
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('control'))->setImplement(Control\Factory::class);
		$builder->addDefinition($this->prefix('form.control'))->setImplement(Form\Control\Factory::class);
	}

	public function getTranslationResources() : array
	{
		return [
			__DIR__ . '/../../locale',
		];
	}

	public function getOrmResources() : array
	{
		return [
			'repositories' => [
				$this->prefix('repository') => Repository::class,
				$this->prefix('nodeRepository') => Node\Repository::class,
			],
		];
	}
}
