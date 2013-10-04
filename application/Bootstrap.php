<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initView()
    {
        $view = new Zend_View();
        $view->doctype('HTML5');
        $view->headTitle('LevelUp')->setDefaultAttachOrder(Zend_View_Helper_Placeholder_Container_Abstract::PREPEND);
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');

        $view->headScript()->appendFile('/js/myscript.js');

        $view->headLink()->appendStylesheet('/css/mystyle.css');

        return $view;
    }

    protected function _initAutoLoad()
    {
        $autoLoader = Zend_Loader_Autoloader::getInstance();
        $autoLoader->registerNamespace('LevelUp_');

        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
            'basePath'      => APPLICATION_PATH,
            'namespace'     => '',
            'resourceTypes' => array(
                'form' => array(
                    'path'      => 'forms/',
                    'namespace' => 'Application_Form_',
                ),
                'model' => array(
                    'path'      => 'models/dbtable',
                    'namespace' => 'Application_Model_DbTable_'
                )
            ),
        ));
        return $autoLoader;
    }

}

