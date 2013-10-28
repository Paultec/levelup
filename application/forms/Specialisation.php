<?php

class Application_Form_Specialisation extends Zend_Form
{

    public function init()
    {
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        $specialisation = $this->createElement('text', 'specialisation');
        $specialisation->setLabel('Специальность:')
            ->setRequired()
            ->setAttrib('placeholder', 'Введите название');
        $this->addElement($specialisation);

        $specDurations = $this->createElement('text', 'specDurations');
        $specDurations->setLabel('Длительность')
            ->setAttrib('placeholder', 'в месяцах');
        $this->addElement($specDurations);

        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => ''));
    }


}

