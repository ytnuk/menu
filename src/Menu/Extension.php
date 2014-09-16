<?php

namespace WebEdit\Menu;

use WebEdit\Application;
use WebEdit\Database;
use WebEdit\Menu;
use WebEdit\Menu\Group;
use WebEdit\Module;
use WebEdit\Translation;

final class Extension extends Module\Extension implements Application\Provider, Database\Provider, Translation\Provider
{

    public function getApplicationResources()
    {
        return [
            'services' => [
                Menu\Facade::class,
                [
                    'class' => Group\Control\Factory::class,
                    'parameters' => ['group', 'breadcrumb']
                ]
            ],
            'presenter' => [
                'components' => [
                    'menu' => Menu\Control\Factory::class
                ]
            ]
        ];
    }

    public function getDatabaseResources()
    {
        return [
            'repositories' => [
                Menu\Repository::class,
                Group\Repository::class
            ]
        ];
    }

}
