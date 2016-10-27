<?php

namespace Appmonitor\Factory;

use Appmonitor\Model\ServerLogModel;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ServerLogModelFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return ServerLogModel
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $EntityManager = $container->get('doctrine.entitymanager.orm_default');
        return new ServerLogModel($EntityManager);
    }
}