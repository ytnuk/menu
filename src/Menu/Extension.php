<?php

namespace WebEdit\Menu;

use WebEdit\Bootstrap;
use WebEdit\Translation;
use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Extension extends Bootstrap\Extension implements Translation\Provider {

    public function loadConfiguration() {
        $builder = $this->getContainerBuilder();
        $builder->addDefinition($this->prefix('repository'))
                ->setClass(Menu\Repository::class);
        $builder->addDefinition($this->prefix('facade'))
                ->setClass(Menu\Facade::class);
        $builder->addDefinition($this->prefix('control'))
                ->setImplement(Menu\Control\Factory::class);
        $builder->addDefinition($this->prefix('group.repository'))
                ->setClass(Group\Repository::class);
        $builder->addDefinition($this->prefix('group.control'))
                ->setImplement(Group\Control\Factory::class);
    }

}
