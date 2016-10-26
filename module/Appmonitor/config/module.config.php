<?php

namespace Appmonitor;

return array(
    'router' => array(
        'routes' => array(
            'appmonitor_api_auth' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/appmonitor/api/auth',
                    'defaults' => array(
                        'controller' => 'Appmonitor\Controller\Api',
                        'action'     => 'auth',
                    ),
                ),
                'may_terminate' => true,
            ),
            'appmonitor_api_servers' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/appmonitor/api/servers',
                    'defaults' => array(
                        'controller' => 'Appmonitor\Controller\Api',
                        'action'     => 'servers',
                    ),
                ),
                'may_terminate' => true,
            ),
            'appmonitor_api_restart' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/appmonitor/api/restart',
                    'defaults' => array(
                        'controller' => 'Appmonitor\Controller\Api',
                        'action'     => 'restart',
                    ),
                ),
                'may_terminate' => true,
            ),
            'appmonitor_api_server_status' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/appmonitor/api/server/status',
                    'defaults' => array(
                        'controller' => 'Appmonitor\Controller\Api',
                        'action'     => 'serverStatus',
                    ),
                ),
                'may_terminate' => true,
            ),
            'appmonitor_api_server_log' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/appmonitor/api/server/log',
                    'defaults' => array(
                        'controller' => 'Appmonitor\Controller\Api',
                        'action'     => 'serverLog',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Appmonitor\Controller\Api' => 'Appmonitor\Controller\ApiController'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'appmonitor/api/auth' => __DIR__ . '/../view/api/auth.phtml',
            'appmonitor/api/servers' => __DIR__ . '/../view/api/servers.phtml',
            'appmonitor/api/restart' => __DIR__ . '/../view/api/restart.phtml',
            'appmonitor/api/serverstatus' => __DIR__ . '/../view/api/serverstatus.phtml',
            'appmonitor/api/serverlog' => __DIR__ . '/../view/api/serverlog.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    // Doctrine config
    /*
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    */
);