<?php

class Application_Form_AddUser extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        $role = $this->createElement('select', 'idUsersRole');//idUsersRole - имя колонки в БД
        $role->setLabel('Выберите роль нового пользователя:')
            ->addMultioption('1', 'Админ')//1 - id роли из БД
            ->addMultioption('2', 'Менеджер')
            ->addMultioption('3', 'Преподаватель');
        $this->addElement($role);

        $login = $this->createElement('text', 'usersLogin');
        $login->setLabel('Логин для этого пользователя:')
            ->setAttrib('placeholder', 'Введите логин')
            ->setRequired();
        $this->addElement($login);

        $password = $this->createElement('text', 'usersPassword');
        $password->setLabel('Пароль для этого пользователся:')
            ->setAttrib('placeholder', 'Введите пароль')
            ->setRequired();
        $this->addElement($password);

        $status = $this->createElement('select', 'idStatus');
        $status->setLabel('Выберите статус нового пользователя:')
            ->addMultioption('1', 'Работает')
            ->addMultioption('2', 'В отпуске');
        $this->addElement($status);

        $firstName = $this->createElement('text', 'firstName');
        $firstName->setLabel('Имя:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Введите имя')
            ->setRequired();
        $this->addElement($firstName);

        $lastName = $this->createElement('text', 'lastName');
        $lastName->setLabel('Фамилия:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Введите фамилию')
            ->setRequired();
        $this->addElement($lastName);
        
        $patronymic = $this->createElement('text', 'patronymic');
        $patronymic->setLabel('Отчество:')
            ->setValidators(array('Alpha'))
            ->setAttrib('placeholder', 'Введите отчество');
        $this->addElement($patronymic);

        $birthday = $this->createElement('text', 'birthday');
        $birthday->setLabel('Дата рождения:')
            ->setAttrib('class', 'date')            
            ->setAttrib('placeholder', 'Дата рождения');
        $this->addElement($birthday);

        $passport = $this->createElement('text', 'passport');
        $passport->setLabel('Паспорт, серия/номер:')
            ->setRequired()
            ->setAttrib('placeholder', 'Паспорт, серия/номер');
        $this->addElement($passport);

        $inn = $this->createElement('text', 'inn');
        $inn->setLabel('ИНН:')
            ->setRequired()
            ->setValidators(array('Digits'))
            ->setAttrib('placeholder', 'Введите ИНН');
        $this->addElement($inn);

        $photo = $this->createElement('file', 'photo');
        $photo->setLabel('Фото:')
              ->addValidator('Size', false, 1024000)
              ->addValidator('Extension', false, 'jpg,png,gif')
              ->setDestination('c:/xampp/htdocs/levelup/public/img/photos/users') // Абсолютный путь
              ->addFilter('Rename', substr(md5(microtime()), 0, 10).'.jpg');
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

