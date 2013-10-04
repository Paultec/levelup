<?php

class Application_Form_Auth extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $isAjax = false;
        $this->setAction( Zend_Controller_Front::getInstance()->getRouter()->assemble(array(), 'user-login'));

        if (isset($this->_attribs['ajax'])){
            if ($this->_attribs['ajax'] == true)
                $isAjax = true;
            $this->removeAttrib('ajax');
        }

        $decors = array(
            'ViewHelper',
            'Errors',
            array(array('data'=>'HtmlTag'),array('tag'=>'li', 'class' => 'element')),
            array('label'),
            array(array('row'=>'HtmlTag'),array('tag'=>'li', 'class' => 'element-label'))
        );

        $this->setAttrib('class', 'login well');

        $login = $this->createElement('text', 'usersLogin');

        $login->setLabel('Login:')
            ->setRequired()
            ->addFilter('StripTags')
            ->setAttrib('placeholder', 'Введите ваш login')
            ->setDecorators($decors);
        $this->addElement($login);

        $password = $this->createElement('password', 'usersPassword');
        $password->setLabel('Пароль:')
            ->setRequired()
            ->setAttrib('placeholder', 'Введите ваш пароль')
            ->setDecorators($decors);
        $this->addElement($password);

        $decors = array(
            'ViewHelper',
            'Errors',
            array(array('data'=>'HtmlTag'),
                array('tag'=>'li', 'class' => $isAjax? 'form-actions clear submit' : 'form-actions no-ajax clear submit')),
        );

        $submit = $this->addElement('button', 'loginsubmit', array(
            'label' => 'Login',
            'class' => 'btn btn-primary',
            'type' => 'submit',
            'decorators' => $decors));

        if ($isAjax){
            $decors = array(
                'ViewHelper',
                'Errors',
                array(array('data'=>'HtmlTag'),
                    array('tag'=>'li', 'class' => 'form-actions cancel')),
            );
            $this->addElement('button', 'logincancel', array(
                    'label'=>'Cancel',
                    'class'=>'btn',
                    'decorators' => $decors)
            );
        }

        $this->addDecorators(array(
                'FormElements',
                array(array('data'=>'HtmlTag', 'tag'=>'ul'),
                    array('tag'=>'ul','class'=>'login-form')))
        );

        $this->addDecorators(array('tag'=>'form'));
    }


}

