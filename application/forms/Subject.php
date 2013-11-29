<?php

class Application_Form_Subject extends Zend_Form
{

    public function init()
    {
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        $subject = $this->createElement('text', 'subject');
        $subject->setLabel('Предмет:')
            ->setRequired()
            ->setAttrib('placeholder', 'Введите название');
        $this->addElement($subject);

        $subjectDurations = $this->createElement('text', 'subjectDurations');
        $subjectDurations->setLabel('Продолжительность:')
            ->setRequired()
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'Введите продолжительность');
        $this->addElement($subjectDurations);

        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => ''));
    }


}

