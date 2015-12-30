<?php
namespace Ytnuk\Menu;

use Nextras;
use Ytnuk;

/**
 * @property int $id {primary}
 * @property Nextras\Orm\Relationships\OneHasOne|Ytnuk\Translation\Entity $title {1:1 Ytnuk\Translation\Entity, oneSided=true, isMain=true, cascade=[persist, remove]}
 * @property Nextras\Orm\Relationships\OneHasMany|Node\Entity[] $nodes {1:m Node\Entity::$menu}
 * @property Nextras\Orm\Relationships\OneHasMany|Node\Entity[] $childNodes {1:m Node\Entity::$parent}
 * @property Nextras\Orm\Relationships\OneHasOne|Ytnuk\Link\Entity $link {1:1 Ytnuk\Link\Entity, oneSided=true, isMain=true}
 * @property-read Entity|NULL $node {virtual}
 * @property-read Entity|NULL $parent {virtual}
 * @property-read Entity[] $parents {virtual}
 * @property-read Entity[] $children {virtual}
 */
final class Entity
	extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'title';

	public function getterParents($deep = FALSE) : array
	{
		if (is_int($deep) || $deep) {
			return $this->parent ? [$this->parent->id => $this->parent] + (! is_int(
					$deep
				) || --$deep > 0 ? $this->parent->getterParents($deep) : []) : [];
		} elseif ($nodes = $this->nodes->getRawValue()) {
			return $this->getRepository()->findBy(['this->childNodes->id' => $nodes])->fetchPairs(
				current($this->metadata->getPrimaryKey())
			);
		}

		return [];
	}

	public function getterChildren($deep = FALSE) : array
	{
		$children = [];
		if ($childNodes = $this->childNodes->getRawValue()) {
			$children += $this->getRepository()->findBy(['this->nodes->id' => $childNodes])->fetchPairs(
				current($this->metadata->getPrimaryKey())
			);
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
				if ($child instanceof self) {
					$children += $child->getterChildren($deep);
				}
			}
		}

		return $children;
	}

	protected function getterParent()
	{
		return $this->node ? $this->node->parent : NULL;
	}

	protected function getterNode()
	{
		return $this->nodes->get()->getBy(['primary' => TRUE]);
	}
}

