<?php

namespace Ytnuk\Menu;

use Nextras\Orm\Mapper\IMapper;
use Nextras\Orm\Repository\IDependencyProvider;
use Nextras;
use Ytnuk;

/**
 * Class Repository
 *
 * @package Ytnuk\Menu
 */
final class Repository extends Ytnuk\Orm\Repository
{

	public function remove($entity, $recursive = FALSE)
	{
		if ($link = $entity->getValue('link')) {
			$link->getRepository()->removeAndFlush($link, TRUE);
		}

		return parent::remove($entity, $recursive);
	}
}
