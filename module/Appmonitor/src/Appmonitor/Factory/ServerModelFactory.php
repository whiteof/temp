<?php

namespace Appmonitor\Factory;

use Appmonitor\Model\ServerModel;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ServerModelFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return ServerModel
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $EntityManager = $container->get('doctrine.entitymanager.orm_default');
        return new ServerModel($EntityManager);
    }
}