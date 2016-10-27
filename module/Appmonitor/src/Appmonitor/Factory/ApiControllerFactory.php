<?php

namespace Appmonitor\Factory;

use Appmonitor\Controller\ApiController;
use Appmonitor\Model\UserModel;
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
        return new ApiController($UserModel);
    }
}