<?php

namespace Appmonitor;

class Module
{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                //User Model
                'Appmonitor\Model\UserModel' => function($sm) {
                    $EntityManager = $sm->get('doctrine.entitymanager.orm_default');
                    $obj = new \Appmonitor\Model\UserModel($EntityManager);
                    return $obj;
                },
                //Server Model
                'Appmonitor\Model\ServerModel' => function($sm) {
                    $EntityManager = $sm->get('doctrine.entitymanager.orm_default');
                    $obj = new \Appmonitor\Model\ServerModel($EntityManager);
                    return $obj;
                }            
            )
        );
    }
    
}


