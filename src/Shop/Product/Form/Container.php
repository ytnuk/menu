<?php

namespace Ytnuk\Shop\Product\Form;

use Nette;
use Ytnuk;

/**
 * Class Container
 *
 * @package Ytnuk\Shop
 */
final class Container extends Ytnuk\Orm\Form\Container
{

	/**
	 * @inheritdoc
	 */
	public function setValues($values, $erase = FALSE)
	{
		$link = $this->getEntity()->link;
		$link->destination = ':Shop:Product:Presenter:view';
		$container = parent::setValues($values, $erase);
		if ( ! $link->parameters->get()->getBy(['key' => 'id'])) {
			$linkParameter = new Ytnuk\Link\Parameter\Entity;
			$linkParameter->key = 'id';
			$linkParameter->value = $this->getEntity()->getPersistedId() ? : $this->getRepository()->persist($this->getEntity())->getPersistedId();
			$link->parameters->add($linkParameter);
		}

		return $container;
	}

	/**
	 * @inheritdoc
	 */
	protected function attached($form)
	{
		parent::attached($form);;
		unset($this['link']);
	}
}
