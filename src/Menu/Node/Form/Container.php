<?php
namespace Ytnuk\Menu\Node\Form;

use Nette;
use Nextras;
use Ytnuk;

final class Container
	extends Ytnuk\Orm\Form\Container
{

	protected function addProperty(Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata)
	{
		$component = parent::addProperty($metadata);
		if ($component instanceof Nette\Forms\Controls\BaseControl) {
			switch ($metadata->name) {
				case 'menu':
				case 'parent':
					$component->setOption('unique', TRUE);
					break;
				case 'primary':
					$component->setOption('unique', 'menu');
					break;
			}
		}

		return $component;
	}
}
