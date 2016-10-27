<?php

namespace Appmonitor\Factory;

use Appmonitor\Controller\ApiController;
use Appmonitor\Model\UserModel;
use Appmonitor\Model\ServerModel;
use Appmonitor\Model\ServerLogModel;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ApiControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return ApiController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $UserModel = $container->get(UserModel::class);
        $ServerModel = $container->get(ServerModel::class);
        $ServerLogModel = $container->get(ServerLogModel::class);
        return new ApiController($UserModel, $ServerModel, $ServerLogModel);
    }
}