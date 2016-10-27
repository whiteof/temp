<?php

namespace Appmonitor\Factory;

use Appmonitor\Model\UserModel;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserModelFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return UserModel
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $EntityManager = $container->get('doctrine.entitymanager.orm_default');
        return new UserModel($EntityManager);
    }
}