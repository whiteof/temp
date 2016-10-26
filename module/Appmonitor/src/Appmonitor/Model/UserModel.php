<?php

namespace Appmonitor\Model;
use Zend\Session\Container;

class UserModel
{

    protected $EntityManager;

    public function __construct($EntityManager)
    {
        $this->EntityManager = $EntityManager;
    }

    /**
     * @return User
     */
    public function getUser($id) {
        $User = $this->EntityManager->getRepository('Appmonitor\Entity\User')->find($id);
        return $User;
    }

    /**
     * @return User
     */
    public function getUserByCwid($cwid) {
        $User = $this->EntityManager->getRepository('Appmonitor\Entity\User')->findOneByCwid($cwid);
        return $User;
    }

    /**
     * @return User
     */
    public function getUserFromSession() {
        $container = new Container('userSession');
        $UserSession = $container->UserSession;
        if($UserSession) $User = $this->EntityManager->getRepository('Appmonitor\Entity\User')->find($UserSession->getId());
        else $User = new \Appmonitor\Entity\User();
        return $User;
    }

}
