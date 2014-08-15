<?php

namespace WebEdit\Menu;

use WebEdit\Bootstrap;
use WebEdit\Database;
use WebEdit\Translation;
use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Extension extends Bootstrap\Extension implements Database\Provider, Translation\Provider {

    public function loadConfiguration() {
        $builder = $this->getContainerBuilder();
        $builder->addDefinition($this->prefix('facade'))
                ->setClass(Menu\Facade::class);
        $builder->addDefinition($this->prefix('control'))
                ->setImplement(Menu\Control\Factory::class);
        $builder->addDefinition($this->prefix('group.control'))
                ->setImplement(Group\Control\Factory::class);
    }

    public function getDatabaseResources() {
        return [
            'repositories' => [
                'menu' => Menu\Repository::class,
                'menuGroup' => Group\Repository::class
            ]
        ];
    }

}
