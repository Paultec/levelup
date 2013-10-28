<?php

class Application_Form_Status extends Zend_Form
{

    public function init()
    {
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        $status = $this->createElement('text', 'status');
        $status->setLabel('Статус:')
            ->setRequired()
            ->setAttrib('placeholder', 'Введите статус');
        $this->addElement($status);

        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => ''));
    }


}

