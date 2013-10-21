<?php

class Application_Form_Student extends Zend_Form
{

    public function init()
    {
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        $status = $this->createElement('select', 'idStatus');
        $status->setLabel('Выберите статус нового студента:')
            ->addMultioption('1', 'Работает')
            ->addMultioption('2', 'В отпуске');
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

        $firstName = $this->createElement('text', 'firstName');
        $firstName->setLabel('Имя:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Введите имя');
        $this->addElement($firstName);

        $patronymic = $this->createElement('text', 'patronymic');
        $patronymic->setLabel('Отчество:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Введите отчество');
        $this->addElement($patronymic);

        $lastName = $this->createElement('text', 'lastName');
        $lastName->setLabel('Фамилия:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Введите фамилию');
        $this->addElement($lastName);

        $birthday = $this->createElement('text', 'birthday');
        $birthday->setLabel('Дата рождения:')
            ->setValidators(array('Date'))
            ->setAttrib('placeholder', 'YYYY-MM-DD');
        $this->addElement($birthday);

        $passportSeries = $this->createElement('text', 'passportSeries');
        $passportSeries->setLabel('Серия паспорта:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Введите 2 буквы серии');
        $this->addElement($passportSeries);

        $passportNumber = $this->createElement('text', 'passportNumber');
        $passportNumber->setLabel('Номер паспорта:')
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'Введите номер');
        $this->addElement($passportNumber);

        $inn = $this->createElement('text', 'inn');
        $inn->setLabel('ИНН:')
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'Введите ИНН');
        $this->addElement($inn);

        $photo = $this->createElement('text', 'photo');
        $photo->setLabel('Фото:')
            ->setAttrib('placeholder', 'Выберите файл');
        $this->addElement($photo);

        $phone = $this->createElement('text', 'phone');
        $phone->setLabel('Телефон:')
            ->setAttrib('placeholder', 'Введите телефон');
        $this->addElement($phone);

        $phoneFurther = $this->createElement('text', 'phoneFurther');
        $phoneFurther->setLabel('Доп. телефон:')
            ->setAttrib('placeholder', 'Опционально');
        $this->addElement($phoneFurther);

        $email = $this->createElement('text', 'email');
        $email->setLabel('Email:')
            ->setValidators(array('EmailAddress'))
            ->setAttrib('placeholder', 'Введите email');
        $this->addElement($email);

        $emailFurther = $this->createElement('text', 'emailFurther');
        $emailFurther->setLabel('Email дополнительный:')
            ->setValidators(array('EmailAddress'))
            ->setAttrib('placeholder', 'Опционально');
        $this->addElement($emailFurther);

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

        $numberContract = $this->createElement('text', 'numberContract');
        $numberContract->setLabel('Номер договора:')
            ->setAttrib('placeholder', 'Введите');
        $this->addElement($numberContract);

        $sumContract = $this->createElement('text', 'sumContract');
        $sumContract->setLabel('Сумма договора:')
            ->setAttrib('placeholder', 'Введите');
        $this->addElement($sumContract);

        $address = $this->createElement('textarea', 'address');
        $address->setLabel('Адрес')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('placeholder', 'Введите полный адрес')
            ->setAttrib('rows', '5');
        $this->addElement($address);

        $this->addElement('submit', 'submit', array('label' => 'Сохранить', 'class' => ''));
    }


}

