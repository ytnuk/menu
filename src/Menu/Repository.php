<?php
namespace Ytnuk\Menu;

use Nextras;
use Ytnuk;

/**
 * @method Entity|NULL getByLink(Ytnuk\Link\Entity $entity)
 */
final class Repository
	extends Ytnuk\Orm\Repository
{

	/**
	 * @var Ytnuk\Link\Repository
	 */
	private $linkRepository;

	public function setModel(Nextras\Orm\Model\IModel $model)
	{
		parent::setModel($model);
		$this->linkRepository = $model->getRepository(Ytnuk\Link\Repository::class);
	}

	public function getByMenuAndDestinationAndParameters(
		Entity $menu,
		string $destination,
		array $parameters = []
	) {
		$destination = explode(
			':',
			ltrim(
				$destination,
				':'
			)
		);
		$links = $this->findBy(
			[
				'this->link->action' => array_pop($destination),
				'this->link->presenter' => array_pop($destination),
				'this->link->module' => implode(
					':',
					$destination
				),
				current($menu->getMetadata()->getPrimaryKey()) => array_keys(
					[$menu->id => $menu] + $menu->getterChildren(TRUE)
				),
			]
		)->fetchPairs(
			NULL,
			'link'
		);
		$links = array_combine(
			array_map(
				function (Ytnuk\Link\Entity $entity) {
					return $entity->id;
				},
				$links
			),
			$links
		);
		if ( ! $links) {
			return NULL;
		}
		if ( ! $parameters || ! $link = $this->linkRepository->sortByParameters(
				$this->linkRepository->findById(array_keys($links)),
				$parameters
			)->fetch()
		) {
			$link = reset($links);
		}

		return $this->getByLink($link);
	}
}
