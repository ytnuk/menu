<?php

namespace WebEdit\Menu;

use WebEdit\Application;
use WebEdit\Database;
use WebEdit\Menu;
use WebEdit\Module;
use WebEdit\Translation;

final class Extension extends Module\Extension implements Application\Provider, Database\Provider, Translation\Provider
{

    public function getApplicationResources()
    {
        return [
            'presenter' => [
                'components' => [
                    'menu' => Menu\Control\Factory::class
                ]
            ],
            'services' => [
                [
                    'class' => Menu\Form\Control\Factory::class,
                    'parameters' => ['menu']
                ]
            ]
        ];
    }

    public function getDatabaseResources()
    {
        return [
            'repositories' => [
                Menu\Repository::class
            ]
        ];
    }

}
