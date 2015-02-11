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
	 * @return self[]
	 */
	protected function getterTree()
	{
		return [$this->id => $this] + ($this->parent ? $this->parent->tree : []);
	}

	/**
	 * @return self|NULL
	 */
	protected function getterParent()
	{
		return $this->node ? $this->node->parent : NULL;
	}

	/**
	 * @return self[]
	 */
	protected function getterParents()
	{
		return $this->nodes->get()
			->fetchPairs('id', 'parent');
	}

	/**
	 * @return self[]
	 */
	protected function getterChildren()
	{
		return $this->childNodes->get()
			->fetchPairs('id', 'menu');
	}
}
