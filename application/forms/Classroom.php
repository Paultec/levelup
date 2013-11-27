<?php

class Application_Form_Classroom extends Zend_Form
{

    public function init()
    {
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        $number = $this->createElement('text', 'number');
        $number->setLabel('Номер аудитории:')
            ->setAttrib('required', 'required')
            ->setRequired()
            ->setAttrib('placeholder', 'Введите номер');
        $this->addElement($number);

        $description = $this->createElement('textarea', 'description');
        $description->setLabel('Описание')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('placeholder', 'Опишите аудиторию')
            ->setAttrib('rows', '5');
        $this->addElement($description);

        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => ''));
    }


}

