<?php
namespace Ytnuk\Shop\Category\Form;

use Nette;
use Nextras;
use Ytnuk;

/**
 * Class Container
 *
 * @package Ytnuk\Shop
 */
final class Container
	extends Ytnuk\Orm\Form\Container
{

	/**
	 * @inheritdoc
	 */
	public function setValues(
		$values,
		$erase = FALSE
	) {
		$link = $this['menu']->getEntity()->link;
		$link->module = 'Shop:Category';
		$container = parent::setValues(
			$values,
			$erase
		);
		if ( ! $link->parameters->get()->getBy(['key' => 'id'])) {
			$linkParameter = new Ytnuk\Link\Parameter\Entity;
			$linkParameter->key = 'id';
			$linkParameter->value = $this->getEntity()->getPersistedId() ? : $this->getRepository()->persist(
				$this->getEntity()
			)->getPersistedId()
			;
			$link->parameters->add($linkParameter);
		}

		return $container;
	}

	/**
	 * @inheritdoc
	 */
	protected function attached($form)
	{
		parent::attached($form);
		unset($this['menu']['link']);
	}

	/**
	 * @param Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata
	 *
	 * @return Nette\Forms\Container
	 */
	protected function addPropertyDescription(Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata)
	{
		return $this->addPropertyOneHasOneDirected(
			$metadata,
			TRUE
		);
	}
}
