<?php

namespace Ytnuk\Menu;

use Nextras;
use Ytnuk;

/**
 * @property-read Entity|NULL $parent {virtual}
 * @property-read Entity[] $parents {virtual}
 * @property-read Entity[] $children {virtual}
 * @property-read Entity[] $tree {virtual}
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
	 * @return self[]
	 */
	protected function getterTree()
	{
		return array_merge([$this], $this->parent ? $this->parent->tree : []);
	}

	/**
	 * @return self|NULL
	 */
	protected function getterParent()
	{
		$nodes = $this->nodes->get();
		$node = $nodes->getBy([
			'this->symlink' => FALSE,
		]);

		return $node ? $node->parent : NULL;
	}

	/**
	 * @return self[]
	 */
	protected function getterParents()
	{
		$parents = [];
		foreach ($this->nodes as $node) {
			$parents[] = $node->parent;
		}

		return $parents;
	}

	/**
	 * @return self[]
	 */
	protected function getterChildren()
	{
		$children = [];
		foreach ($this->childNodes as $node) {
			$children[] = $node->menu;
		}

		return $children;
	}
}
