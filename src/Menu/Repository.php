<?php

namespace WebEdit\Menu;

use WebEdit;

/**
 * Class Repository
 *
 * @package WebEdit\Menu
 */
final class Repository extends WebEdit\Orm\Repository
{

	/**
	 * @param string $link
	 * @param null $linkId
	 *
	 * @return Entity
	 */
	public function getByLink($link, $linkId = NULL)
	{
		return $this->getBy([
			'link' => $link,
			'linkId' => $linkId
		]);
	}

	/**
	 * @param string $uid
	 *
	 * @return Entity
	 */
	public function getByUid($uid)
	{
		return $this->findBy(['uid' => $uid])
			->fetch();
	}
}
