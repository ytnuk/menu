<?php

namespace WebEdit\Menu;

use WebEdit\Orm;

/**
 * Class Repository
 *
 * @package WebEdit\Menu
 */
final class Repository extends Orm\Repository
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

	/**
	 * @param Entity $menu
	 *
	 * @return Entity[]
	 */
	public function findChildren(Entity $menu)
	{
		return $this->findById($this->findChildrenIds($menu));
	}

	/**
	 * @param Entity $menu
	 *
	 * @return array
	 */
	public function findChildrenIds(Entity $menu)
	{
		$tree = [$menu->id];
		foreach ($menu->children as $menu) {
			$tree = array_merge($tree, $this->findChildrenIds($menu));
		}

		return $tree;
	}

	//    public function getMenuByType($type) {
	//        $data = $this->storage($type)->fetchPairs(NULL, 'menu_id');
	//        return $this->storage()->where('id', $data);
	//    }
}
