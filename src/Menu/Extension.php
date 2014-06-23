<?php

namespace WebEdit\Menu;

use WebEdit\Application;
use WebEdit\Translation;

final class Extension extends Application\Extension implements Translation\Provider {

    public function loadConfiguration() {
        $builder = $this->getContainerBuilder();
        $builder->addDefinition($this->prefix('repository'))
                ->setClass('WebEdit\Menu\Repository');
        $builder->addDefinition($this->prefix('facade'))
                ->setClass('WebEdit\Menu\Facade');
        $builder->addDefinition($this->prefix('control'))
                ->setImplement('WebEdit\Menu\Control\Factory');
        $builder->addDefinition($this->prefix('group.repository'))
                ->setClass('WebEdit\Menu\Group\Repository');
        $builder->addDefinition($this->prefix('group.control'))
                ->setImplement('WebEdit\Menu\Group\Control\Factory');
    }

}
