<?php

namespace Ytnuk\Menu;

use Nextras;
use Ytnuk;

/**
 * @property-read Entity|NULL $parent {virtual}
 * @property-read Entity[] $parents {virtual}
 * @property-read Entity[] $children {virtual}
 * @property-read Entity[] $tree {virtual}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Node\Entity|NULL $node {1:1d Node\Repository $main primary}
 * @property Nextras\Orm\Relationships\OneHasMany|Node\Entity[] $nodes {1:m Node\Repository $menu}
 * @property Nextras\Orm\Relationships\OneHasMany|Node\Entity[] $childNodes {1:m Node\Repository $parent}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Link\Entity $link {1:1d Ytnuk\Link\Repository $menu primary}
 * @property string $title
 * TODO:
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Page\Entity|NULL $page {1:1d Ytnuk\Page\Repository $menu}
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
		$nodes = $this->nodes->get();
		$parents = []; //TODO: refactor
		foreach ($nodes->fetchPairs(NULL, 'parent') as $parent) {
			$parents[$parent->id] = $parent;
		}

		return $parents;
	}

	/**
	 * @param bool|int $deep
	 *
	 * @return self[]
	 */
	public function getterChildren($deep = FALSE)
	{
		if (is_int($deep) || $deep) {
			$childNodes = $this->childNodes->get();
			$children = $deep > 0 ? $childNodes->fetchPairs(NULL, 'menu') : [];
			foreach ($children as $child) {
				$children += $child->getterChildren(is_int($deep) ? --$deep : $deep);
			}
			$indexed = [];
			foreach ($children as $child) {
				$indexed[$child->id] = $child;
			}

			return $indexed;
		}
		$childNodes = $this->childNodes->get();
		$children = []; //TODO: refactor
		foreach ($childNodes->fetchPairs(NULL, 'menu') as $child) {
			$children[$child->id] = $child;
		}

		return $children;
	}

	/**
	 * @return self|NULL
	 */
	protected function getterParent()
	{
		return $this->node ? $this->node->parent : NULL;
	}
}
