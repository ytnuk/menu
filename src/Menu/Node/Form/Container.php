<?php

namespace Ytnuk\Menu\Node\Form;

use Ytnuk;
use Nextras;

/**
 * Class Container
 *
 * @package Ytnuk\Menu
 */
final class Container extends Ytnuk\Orm\Form\Container
{

	/**
	 * @inheritdoc
	 */
	public function setValues($values, $erase = FALSE)
	{
		$primary = $values->primary;
		unset($values['primary']);
		$self = parent::setValues($values, $erase);
		if ($primary && $menu = $this->getEntity()->menu) {
			if ( ! $primary = $this->getEntity()->primary) {
				$primary = $menu->primary ? : new Ytnuk\Menu\Node\Primary\Entity;
			}
			$primary->menu = $menu;
			$primary->node = $this->getEntity();
			$this->getEntity()->primary = $primary;
		} elseif ($primary = $this->getEntity()->primary) {
			$primary->getRepository()->remove($primary);
		}

		return $self;
	}

	/**
	 * @inheritdoc
	 */
	protected function addProperty(Nextras\Orm\Entity\Reflection\PropertyMetadata $property)
	{
		$component = parent::addProperty($property);
		switch ($property->name) {
			case 'menu':
			case 'parent':
			case 'primary':
				$component->setOption('unique', TRUE);
		}

		return $component;
	}

	/**
	 * @param Nextras\Orm\Entity\Reflection\PropertyMetadata $property
	 *
	 * @return \Nette\Forms\Controls\Checkbox
	 */
	protected function addPropertyPrimary(Nextras\Orm\Entity\Reflection\PropertyMetadata $property)
	{
		return $this->addCheckbox($property->name, $this->formatPropertyLabel($property))->setDefaultValue((bool) $this->getEntity()->primary);
	}
}
