<?php
namespace Ytnuk\Menu;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity $title {1:1d Ytnuk\Translation\Entity::$menu primary}
 * @property Nextras\Orm\Relationships\OneHasMany|Node\Entity[] $nodes {1:m Node\Entity::$menu}
 * @property Nextras\Orm\Relationships\OneHasMany|Node\Entity[] $childNodes {1:m Node\Entity::$parent}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Link\Entity $link {1:1d Ytnuk\Link\Entity::$menu primary}
 * @property-read Entity|NULL $node {virtual}
 * @property-read Entity|NULL $parent {virtual}
 * @property-read Entity[] $parents {virtual}
 * @property-read Entity[] $children {virtual}
 */
final class Entity
	extends Ytnuk\Orm\Entity
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
			return $this->parent ? [$this->parent->id => $this->parent] + (! is_int(
					$deep
				) || --$deep > 0 ? $this->parent->getterParents($deep) : []) : [];
		} elseif ($nodes = $this->nodes->getRawValue()) {
			return $this->getRepository()->findBy(['this->childNodes->id' => $nodes])->fetchPairs(
				current($this->metadata->getPrimaryKey())
			)
				;
		}

		return [];
	}

	/**
	 * @param bool|int $deep
	 *
	 * @return self[]
	 */
	public function getterChildren($deep = FALSE)
	{
		$children = [];
		if ($childNodes = $this->childNodes->getRawValue()) {
			$children += $this->getRepository()->findBy(['this->nodes->id' => $childNodes])->fetchPairs(
				current($this->metadata->getPrimaryKey())
			)
			;
		}
		if ($deep) {
			if (is_int($deep)) {
				$deep = max(
					$deep - 1,
					0
				);
			}
			foreach (
				$children as $child
			) {
				$children += $child->getterChildren($deep);
			}
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

	/**
	 * @return self|NULL
	 */
	protected function getterNode()
	{
		return $this->nodes->get()->getBy(['primary' => TRUE]);
	}
}

