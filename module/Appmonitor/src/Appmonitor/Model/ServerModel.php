<?php

namespace Appmonitor\Model;

class ServerModel
{

    protected $EntityManager;

    public function __construct($EntityManager)
    {
        $this->EntityManager = $EntityManager;
    }

    /**
     * @return User
     */
    public function getItem($id) {
        $Server = $this->EntityManager->getRepository('Appmonitor\Entity\Server')->find($id);
        return $Server;
    }

    /**
     * @return User
     */
    public function getItemByCode($code) {
        $Server = $this->EntityManager->getRepository('Appmonitor\Entity\Server')->findOneByCode($code);
        return $Server;
    }
    
}
