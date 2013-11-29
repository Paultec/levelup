<?php

class Application_Form_Specialisation extends Zend_Form
{

    public function init()
    {
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        $specialisation = $this->createElement('text', 'specialisation');
        $specialisation->setLabel('Название специальности:')
            ->setValidators(array('Alnum'))
            ->setRequired()
            ->setAttrib('placeholder', 'Введите название');
        $this->addElement($specialisation);

        $specDurations = $this->createElement('text', 'specDurations');
        $specDurations->setLabel('Продолжиттельность обучения:')
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'Введите к-во месяцев');
        $this->addElement($specDurations);

        $subject = new Application_Model_DbTable_Subjects();
        $list = $subject->getAllSubject();
        foreach ($list as $elem) {
            $nameSubject[] = $elem['subject'];
            $numSubject[] = $elem['id'];
        }
        $listSubject = array_combine($numSubject, $nameSubject);

        $subject = new Zend_Form_Element_MultiCheckbox('idSubject', array('multiOptions' => $listSubject));
        $subject->setLabel('Выберите предметы для этой специальности:');
        $this->addElement($subject);

        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => ''));
    }


}

