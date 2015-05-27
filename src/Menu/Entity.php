<?php

namespace Ytnuk\Menu;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity $title {1:1d Ytnuk\Translation\Repository $menu primary}
 * @property Nextras\Orm\Relationships\OneHasMany|Node\Entity[] $nodes {1:m Node\Repository $menu}
 * @property Nextras\Orm\Relationships\OneHasMany|Node\Entity[] $childNodes {1:m Node\Repository $parent}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Node\Primary\Entity|NULL $primary {1:1d Node\Primary\Repository $menu}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Link\Entity $link {1:1d Ytnuk\Link\Repository $menu primary}
 * @property-read Entity|NULL $node {virtual}
 * @property-read Entity|NULL $parent {virtual}
 * @property-read Entity[] $parents {virtual}
 * @property-read Entity[] $children {virtual}
 */
final class Entity extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'title';

	/**
	 * @param bool|int $deep
	 *
	 * @return self[]
	 */
	public function getterParents($deep = FALSE)
	{
		if (is_int($deep) || $deep) {
			return $this->parent ? [$this->parent->id => $this->parent] + (! is_int($deep) || --$deep > 0 ? $this->parent->getterParents($deep) : []) : [];
		}

		return $this->nodes->get()->fetchPairs('parent', 'parent');
	}

	/**
	 * @param bool|int $deep
	 *
	 * @return self[]
	 */
	public function getterChildren($deep = FALSE)
	{
		if (is_int($deep) || $deep) {
			$children = $deep > 0 ? $this->childNodes->get()->fetchPairs('menu', 'menu') : [];
			foreach ($children as $child) {
				$children += $child->getterChildren(is_int($deep) ? --$deep : $deep);
			}

			return $children;
		}

		return $this->childNodes->get()->fetchPairs('menu', 'menu');
	}

	/**
	 * @return self|NULL
	 */
	protected function getterParent()
	{
		return $this->node ? $this->node->parent : NULL;
	}

	/**
	 * @return self|NULL
	 */
	protected function getterNode()
	{
		return $this->primary ? $this->primary->node : NULL;
	}
}
