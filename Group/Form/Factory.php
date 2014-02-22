<?php

namespace WebEdit\Menu\Group\Form;

use WebEdit\Form;
use WebEdit\Menu;
use WebEdit\Menu\Group;

final class Factory extends Form\Factory {

    private $menuFacade;
    private $groupFacade;

    public function __construct(Menu\Facade $menuFacade, Group\Facade $groupFacade) {
        $this->menuFacade = $menuFacade;
        $this->groupFacade = $groupFacade;
    }

    protected function addForm() {
        $this->form->addComponent($this->menuFacade->getFormContainer(), 'menu');
        parent::addForm();
    }

    protected function editForm($group) {
        $this->form->addComponent($this->menuFacade->getFormContainer($group->menu), 'menu');
        parent::editForm($group);
        $this->deleteForm($group);
    }

    protected function add($data) {
        $group = $this->groupFacade->addGroup($data);
        $this->presenter->redirect('Presenter:edit', array('id' => $group->id));
    }

    protected function edit($group, $data) {
        $this->groupFacade->editGroup($group, $data);
        $this->presenter->redirect('this');
    }

    protected function delete($group) {
        $this->groupFacade->deleteGroup($group);
        $this->presenter->redirect('Presenter:view');
    }

}
