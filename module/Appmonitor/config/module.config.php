<?php

namespace Appmonitor;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'appmonitor_api_auth' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/appmonitor/api/auth',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'auth',
                    ],
                ],
                'may_terminate' => true,
            ],
            'appmonitor_api_servers' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/appmonitor/api/servers',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'servers',
                    ],
                ],
                'may_terminate' => true,
            ],
            'appmonitor_api_restart' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/appmonitor/api/restart',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'restart',
                    ],
                ],
                'may_terminate' => true,
            ],
            'appmonitor_api_server_status' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/appmonitor/api/server/status',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'serverStatus',
                    ],
                ],
                'may_terminate' => true,
            ],
            'appmonitor_api_server_log' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/appmonitor/api/server/log',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'serverLog',
                    ],
                ],
                'may_terminate' => true,
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\ApiController::class => Factory\ApiControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'appmonitor/api/auth' => __DIR__ . '/../view/api/auth.phtml',
            'appmonitor/api/servers' => __DIR__ . '/../view/api/servers.phtml',
            'appmonitor/api/restart' => __DIR__ . '/../view/api/restart.phtml',
            'appmonitor/api/serverstatus' => __DIR__ . '/../view/api/serverstatus.phtml',
            'appmonitor/api/serverlog' => __DIR__ . '/../view/api/serverlog.phtml'
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'factories' => [
            Model\UserModel::class => Factory\UserModelFactory::class,
            Model\ServerModel::class => Factory\ServerModelFactory::class,
            Model\ServerLogModel::class => Factory\ServerLogModelFactory::class,
        ]
    ]
];