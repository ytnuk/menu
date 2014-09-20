<?php

namespace WebEdit\Menu\Form;

use WebEdit\Form;

final class Container extends Form\Container
{

    protected function configure()
    {
        $this->addText('title', 'menu.form.title.label')->setRequired();
        $this->addSelect('parent', 'menu.form.parent.label')->setRequired()
            ->setPrompt('form.select.prompt');
    }

}
