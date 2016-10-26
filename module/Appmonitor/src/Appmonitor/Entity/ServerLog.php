<?php

namespace Appmonitor\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="appmonitor_server_log")
 */
class ServerLog
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */    
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="serverLogs", fetch="LAZY")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */    
    protected $user;
    /**
     * @ORM\ManyToOne(targetEntity="Server", inversedBy="serverLogs", fetch="LAZY")
     * @ORM\JoinColumn(name="server_id", referencedColumnName="id")
     */    
    protected $server;
    /**
     * @ORM\Column(name="action", type="string", nullable=true)
     */
    protected $action;
    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;
    
/**************************
*** Getters and Setters ***
**************************/

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }    

    /**
     * @param User $user
     * @return ServerLog
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * @param Server $server
     * @return ServerLog
     */
    public function setServer($server)
    {
        $this->server = $server;
        return $this;
    }
    /**
     * @return Server
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param string $action
     * @return ServerLog
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }
    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
    
    /**
     * @param datetime $createdAt
     * @return ServerLog
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
/*******************************
*** End: Getters and Setters ***
*******************************/
    
    /**
     * Populate from an array.
     * @param array $data
     */
    public function exchangeArray($data = array()) 
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->user = (!empty($data['user'])) ? $data['user'] : null;
        $this->server = (!empty($data['server'])) ? $data['server'] : null;
        $this->action = (!empty($data['action'])) ? $data['action'] : null;
        $this->createdAt = (!empty($data['createdAt'])) ? $data['createdAt'] : null;
    }
    /*
     * Convert the object to an array.
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
        
}