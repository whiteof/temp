<?php

namespace Appmonitor\Model;

use Appmonitor\Entity\ServerLog;

class ServerLogModel
{

    protected $EntityManager;

    public function __construct($EntityManager)
    {
        $this->EntityManager = $EntityManager;
    }

    public function save(ServerLog $Item)
    {
        $this->EntityManager->persist($Item);
        $this->EntityManager->flush($Item);
    }
}
