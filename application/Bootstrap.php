<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initView()
    {
        $view = new Zend_View();
        $view->doctype('HTML5');
        $view->headTitle('LevelUp')->setDefaultAttachOrder(Zend_View_Helper_Placeholder_Container_Abstract::PREPEND);
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
        
        $view->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
        $view->headScript()->appendFile('http://code.jquery.com/ui/1.10.3/jquery-ui.js');
        $view->headScript()->appendFile('/js/scrollbar.js');
        $view->headScript()->appendFile('/js/script.js');
        $view->headScript()->appendFile('/js/formstyler.js');
        
        $view->headLink()->appendStylesheet('http://fonts.googleapis.com/css?family=PT+Sans');
        $view->headLink()->appendStylesheet('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
        $view->headLink()->appendStylesheet('/css/scrollbar.css');
        $view->headLink()->appendStylesheet('/css/formstyler.css');
        $view->headLink()->appendStylesheet('/css/style.css');

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
    
    protected function _initTranslation() {
        $translator = new Zend_Translate(
            array(
                'adapter' => 'array',
                'content' => APPLICATION_PATH . '/../resources/languages',
                'locale' => 'ru_RU',
                'scan' => Zend_Translate::LOCALE_DIRECTORY
            )
        );
    Zend_Validate_Abstract::setDefaultTranslator($translator);
    }
}
