<?php

namespace WebEdit\Menu;

use WebEdit\Application;
use WebEdit\Database;
use WebEdit\Menu;
use WebEdit\Module;
use WebEdit\Translation;

/**
 * Class Extension
 *
 * @package WebEdit\Menu
 */
final class Extension extends Module\Extension implements Application\Provider, Database\Provider, Translation\Provider
{

	/**
	 * @return array
	 */
	public function getApplicationResources()
	{
		return ['presenter' => ['components' => ['menu' => Menu\Control\Factory::class]], 'services' => [['class' => Menu\Form\Control\Factory::class, 'parameters' => ['menu']]]];
	}

	/**
	 * @return array
	 */
	public function getDatabaseResources()
	{
		return ['repositories' => [Menu\Repository::class]];
	}
}
