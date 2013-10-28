<?php

class Application_Form_Subject extends Zend_Form
{

    public function init()
    {
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        $subject = $this->createElement('text', 'subject');
        $subject->setLabel('Название предмета:')
            ->setRequired()
            ->setAttrib('placeholder', 'Введите номер');
        $this->addElement($subject);

        $subjectDurations	 = $this->createElement('text', 'subjectDurations	');
        $subjectDurations	->setLabel('Продолжительность в часах')
            ->setAttrib('placeholder', 'Введите к-во часов');
        $this->addElement($subjectDurations	);

        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => ''));
    }


}

