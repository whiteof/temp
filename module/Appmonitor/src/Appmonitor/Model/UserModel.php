<?php

namespace Appmonitor\Model;

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

}
