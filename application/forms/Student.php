<?php

class Application_Form_Student extends Zend_Form
{
    const MSG = "Поле обязательно для заполнения!";

    public function init()
    {
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        $status = $this->createElement('select', 'idStatus');
        $status->setLabel('Выберите статус студента:')
            ->addMultioption('1', 'Клиент')
            ->addMultioption('2', 'Студент')
            ->addMultioption('3', 'Завершил');
        $this->addElement($status);

        $group = new Application_Model_DbTable_Groups();
        $list = $group->getAllGroups();
        foreach ($list as $elem) {
            $nameGroups[] = $elem['name'];
            $numGroups[] = $elem['id'];
        }
        $listGroups = array_combine($nameGroups, $numGroups);
        $group = $this->createElement('select', 'idGroup');
        $group->setLabel('Выберите группу:');
        foreach ($listGroups as $name => $number) {
            $group->addMultioption($number, $name);
        }
        $this->addElement($group);

        $timestamp = $this->createElement('text', 'timestamp');
        $timestamp->setLabel('Отметка времени:')
            ->setAttrib('class', 'date')
            ->setAttrib('placeholder', 'Отметка времени');
        $this->addElement($timestamp);

        $numberContract = $this->createElement('text', 'numberContract');
        $numberContract->setLabel('Номер договора:')
            ->setRequired()
            ->setValidators(array('Alnum'))
            ->setAttrib('placeholder', 'Номер договора');
        $this->addElement($numberContract);
        //$this->_error(self::MSG);

        $dateContract = $this->createElement('text', 'dateContract');
        $dateContract->setLabel('Дата заключения договора:')            
            ->setAttrib('class', 'date')
            ->setAttrib('placeholder', 'Дата заключения договора');
        $this->addElement($dateContract);

        $lastNameCustomer = $this->createElement('text', 'lastNameCustomer');
        $lastNameCustomer->setLabel('Фамилия Заказчика обучения:')
            ->setRequired()
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Фамилия Заказчика обучения');
        $this->addElement($lastNameCustomer);

        $nameCustomer = $this->createElement('text', 'nameCustomer');
        $nameCustomer->setLabel('Имя Заказчика обучения:')
            ->setRequired()
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Имя Заказчика обучения');
        $this->addElement($nameCustomer);

        $patronymicCustomer = $this->createElement('text', 'patronymicCustomer');
        $patronymicCustomer->setLabel('Отчество Заказчика обучения:')
            ->setRequired()
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Отчество Заказчика обучения');
        $this->addElement($patronymicCustomer);

        $totalSumContractNum = $this->createElement('text', 'totalSumContractNum');
        $totalSumContractNum->setLabel('Общая сумма договора цифрами:')            
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'Общая сумма договора цифрами');
        $this->addElement($totalSumContractNum);

        $totalSumContractA = $this->createElement('text', 'totalSumContractA');
        $totalSumContractA->setLabel('Общая сумма договора прописью:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Общая сумма договора прописью');
        $this->addElement($totalSumContractA);

        $nameCourse = $this->createElement('text', 'nameCourse');
        $nameCourse->setLabel('Название учебного курса:')            
            ->setAttrib('placeholder', 'Название учебного курса');
        $this->addElement($nameCourse);

        $durationHours = $this->createElement('text', 'durationHours');
        $durationHours->setLabel('Продолжительность обучения (часов):')
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'Продолжительность обучения');
        $this->addElement($durationHours);

        $numberMonths = $this->createElement('text', 'numberMonths');
        $numberMonths->setLabel('Количество месяцев:')
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'Количество месяцев');
        $this->addElement($numberMonths);
        
        $passportCustomer = $this->createElement('text', 'passportCustomer');
        $passportCustomer->setLabel('Паспорт, серия/номер заказчика:')
            ->setValidators(array('Alnum'))
            ->setAttrib('placeholder', 'Паспорт, серия/номер заказчика');
        $this->addElement($passportCustomer);
        
        $INNCustomer = $this->createElement('text', 'INNCustomer');
        $INNCustomer->setLabel('ИНН Заказчика:')
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'ИНН Заказчика');
        $this->addElement($INNCustomer);
        
        $addressCustomer = $this->createElement('textarea', 'addressCustomer');
        $addressCustomer->setLabel('Адрес Заказчика:')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('placeholder', 'Адрес Заказчика')
            ->setAttrib('rows', '5');
        $this->addElement($addressCustomer);
        
        $telHouseCustomer = $this->createElement('text', 'telHouseCustomer');
        $telHouseCustomer->setLabel('Тел. дом. Заказчика:')
            ->setAttrib('placeholder', 'Тел. дом. Заказчика');
        $this->addElement($telHouseCustomer);
        
        $telMobCustomer = $this->createElement('text', 'telMobCustomer');
        $telMobCustomer->setLabel('Тел. моб. Заказчика:')
            ->setAttrib('placeholder', 'Тел. моб. Заказчика');
        $this->addElement($telMobCustomer);
        
        $emailCustomer = $this->createElement('text', 'emailCustomer');
        $emailCustomer->setLabel('Email Заказчика:')
            ->setValidators(array('EmailAddress'))
            ->setAttrib('placeholder', 'Email Заказчика');
        $this->addElement($emailCustomer);
        
        $lastNameStudent = $this->createElement('text', 'lastNameStudent');
        $lastNameStudent->setLabel('Фамилия Слушателя:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Фамилия Слушателя');
        $this->addElement($lastNameStudent);

        $nameStudent = $this->createElement('text', 'nameStudent');
        $nameStudent->setLabel('Имя Слушателя:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Имя Слушателя');
        $this->addElement($nameStudent);

        $patronymicStudent = $this->createElement('text', 'patronymicStudent');
        $patronymicStudent->setLabel('Отчество Слушателя:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Отчество Слушателя');
        $this->addElement($patronymicStudent);
        
        $passportStudent = $this->createElement('text', 'passportStudent');
        $passportStudent->setLabel('Паспорт, серия/номер Слушателя:')
            ->setValidators(array('Alnum'))
            ->setAttrib('placeholder', 'Паспорт, серия/номер Слушателя');
        $this->addElement($passportStudent);
        
        $INNStudent = $this->createElement('text', 'INNStudent');
        $INNStudent->setLabel('ИНН Слушателя:')
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'ИНН Слушателя');
        $this->addElement($INNStudent);
        
        $addressStudent = $this->createElement('textarea', 'addressStudent');
        $addressStudent->setLabel('Адрес Слушателя:')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('placeholder', 'Адрес Слушателя')
            ->setAttrib('rows', '5');
        $this->addElement($addressStudent);
        
        $telHouseStudent = $this->createElement('text', 'telHouseStudent');
        $telHouseStudent->setLabel('Тел. дом. Слушателя:')
            ->setAttrib('placeholder', 'Тел. дом. Слушателя');
        $this->addElement($telHouseStudent);
        
        $telMobStudent = $this->createElement('text', 'telMobStudent');
        $telMobStudent->setLabel('Тел. моб. Слушателя:')
            ->setAttrib('placeholder', 'Тел. моб. Слушателя');
        $this->addElement($telMobStudent);
        
        $emailStudent = $this->createElement('text', 'emailStudent');
        $emailStudent->setLabel('Email Слушателя:')
            ->setValidators(array('EmailAddress'))
            ->setAttrib('placeholder', 'Email Слушателя');
        $this->addElement($emailStudent);

        $birthday = $this->createElement('text', 'birthday');
        $birthday->setLabel('Дата рождения:')
            ->setAttrib('class', 'date')
            ->setAttrib('placeholder', 'Дата рождения');
        $this->addElement($birthday);
        
        $skype = $this->createElement('text', 'skype');
        $skype->setLabel('skype:')
            ->setAttrib('placeholder', 'Логин в Skype');
        $this->addElement($skype);

        $linkVK = $this->createElement('text', 'linkVK');
        $linkVK->setLabel('ВКонтакте:')
            ->setAttrib('placeholder', 'Введите');
        $this->addElement($linkVK);

        $linkFB = $this->createElement('text', 'linkFB');
        $linkFB->setLabel('Facebook:')
            ->setAttrib('placeholder', 'Введите');
        $this->addElement($linkFB);
        // Zend_Mime::encodeBase64()
        $photo = $this->createElement('text', 'photo');
        $photo->setLabel('Фото:')
            ->setAttrib('placeholder', 'Фото');
        $this->addElement($photo);
        
        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => ''));
    }

}

