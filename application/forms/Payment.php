<?php

class Application_Form_Payment extends Zend_Form
{

    public function init()
    {
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        $idStudent = $this->createElement('text', 'idStudent');
        $this->addElement($idStudent);

        $date = $this->createElement('text', 'date');
        $date->setLabel('Дата платежа:')
            ->setValidators(array('Date'))
            ->setAttrib('placeholder', 'YYYY-MM-DD');
        $this->addElement($date);

        $sum = $this->createElement('text', 'sum');
        $sum->setLabel('Сумма платежа:')
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'Введите сумму');
        $this->addElement($sum);

        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => ''));
    }


}

