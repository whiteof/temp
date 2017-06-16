<?php

namespace Appmonitor\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="appmonitor_server")
 */
class Server
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */    
    protected $id;
    /**
     * @ORM\Column(name="ip", type="string", nullable=false)
     */    
    protected $ip;
    /**
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    protected $title;
    /**
     * @ORM\Column(name="code", type="string", nullable=false)
     */
    protected $code;
    /**
     * @ORM\Column(name="restart_url", type="string", nullable=false)
     */
    protected $restartUrl;
    /**
     * @ORM\OneToMany(targetEntity="ServerLog", mappedBy="server", fetch="LAZY")
     * @ORM\OrderBy({"createdAt" = "Desc"})
     **/
    protected $serverLogs;
    
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
     * @param string $ip
     * @return Server
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }
    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }
    
    /**
     * @param string $title
     * @return Server
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $code
     * @return Server
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $restartUrl
     * @return Server
     */
    public function setRestartUrl($restartUrl)
    {
        $this->restartUrl = $restartUrl;
        return $this;
    }
    /**
     * @return string
     */
    public function getRestartUrl()
    {
        return $this->restartUrl;
    }
    
    /**
     * @param array $serverLogs
     * @return Server
     */
    public function setServerLogs(array $serverLogs)
    {
        $this->serverLogs = $serverLogs;
        return $this;
    }
    /**
     * @return array
     */
    public function getServerLogs()
    {
        return $this->serverLogs;
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
        $this->ip = (!empty($data['ip'])) ? $data['ip'] : null;
        $this->title = (!empty($data['title'])) ? $data['title'] : null;
        $this->code = (!empty($data['code'])) ? $data['code'] : null;
        $this->restartUrl = (!empty($data['restartUrl'])) ? $data['restartUrl'] : null;
        $this->serverLogs = (!empty($data['serverLogs'])) ? $data['serverLogs'] : null;
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