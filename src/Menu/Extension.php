<?php

namespace WebEdit\Menu;

use WebEdit\Bootstrap;
use WebEdit\Application;
use WebEdit\Database;
use WebEdit\Translation;
use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Extension extends Bootstrap\Extension implements Application\Provider, Database\Provider, Translation\Provider {

    public function getApplicationResources() {
        return [
            'services' => [
                Menu\Facade::class,
                Group\Control\Factory::class => ['group', 'breadcrumb']
            ],
            'presenter' => [
                'components' => [
                    'menu' => Menu\Control\Factory::class
                ]
            ]
        ];
    }

    public function getDatabaseResources() {
        return [
            'repositories' => [
                Menu\Repository::class,
                Group\Repository::class
            ]
        ];
    }

}
