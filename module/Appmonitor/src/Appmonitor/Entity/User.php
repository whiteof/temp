<?php

namespace Appmonitor\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */   
    protected $id;
    /**
     * @ORM\Column(name="cwid", type="string", nullable=true)
     */
    protected $cwid;
    /**
     * @ORM\Column(name="first_name", type="string", nullable=true)
     */
    protected $firstName;
    /**
     * @ORM\Column(name="middle_name", type="string", nullable=true)
     */
    protected $middleName;
    /**
     * @ORM\Column(name="last_name", type="string", nullable=true)
     */
    protected $lastName;
    /**
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    protected $title;
    /**
     * @ORM\ManyToMany(targetEntity="Server")
     * @ORM\JoinTable(name="appmonitor_server_user",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="server_id", referencedColumnName="id", unique=true)}
     * )
     **/
    protected $servers;
    /**
     * @ORM\OneToMany(targetEntity="ServerLog", mappedBy="user", fetch="LAZY")
     * @ORM\OrderBy({"createdAt" = "Desc"})
     **/
    protected $serverLogs;    

/**************************
*** Getters and Setters ***
**************************/

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $cwid
     * @return User
     */
    public function setCwid($cwid)
    {
        $this->cwid = $cwid;
        return $this;
    }    
    /**
     * @return string
     */
    public function getCwid()
    {
        return $this->cwid;
    }
    
    /**
     * @param string $firstName
     * @return Faculty
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }    

    /**
     * @param string $middleName
     * @return Faculty
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
        return $this;
    }
    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }    

    /**
     * @param string $lastName
     * @return Faculty
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }    

    /**
     * @param string $title
     * @return Faculty
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
     * @param array $servers
     * @return User
     */
    public function setServers(array $servers)
    {
        $this->servers = $servers;
        return $this;
    }
    /**
     * @return array
     */
    public function getServers()
    {
        return $this->servers;
    }
    /**
     * @return User
     */    
    public function addServers(array $servers)
    {
        foreach($servers as $server) {
            if(!$this->servers->contains($server)) {
                $this->servers->add($server);
            }
        }
        return $this;
    }
    /**
     * @return User
     */    
    public function removeServers(array $servers)
    {
        foreach($servers as $server) {
            if($this->servers->contains($server)) {
                $this->servers->removeElement($server);
            }
        }
        return $this;
    }
    
    /**
     * @param array $serverLogs
     * @return User
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
     * @return string
     */
    public function getFullName($format)
    {
        $format = str_replace('F', '&F&', $format);
        $format = str_replace('M', '&M&', $format);
        $format = str_replace('L', '&L&', $format);
        $full_name = $format;
        $full_name = str_replace('&F&', $this->getFirstName(), $full_name);
        if(!empty(trim($this->getMiddleName()))) $full_name = str_replace('&M&', $this->getMiddleName(), $full_name);
        else $full_name = str_replace('&M& ', '', $full_name);
        $full_name = str_replace('&L&', $this->getLastName(), $full_name);
        return $full_name;
    }

    /**
    * Exchange array - used in ZF2 form
    * @param array $data An array of data
    */        
    public function exchangeArray($data = array()) 
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->cwid = (!empty($data['cwid'])) ? $data['cwid'] : null;
        $this->firstName = (!empty($data['firstName'])) ? $data['firstName'] : null;
        $this->middleName = (!empty($data['middleName'])) ? $data['middleName'] : null;
        $this->lastName = (!empty($data['lastName'])) ? $data['lastName'] : null;
        $this->title = (!empty($data['title'])) ? $data['title'] : null;
        $this->serverLogs = (!empty($data['serverLogs'])) ? $data['serverLogs'] : null;
    }
    
    /**
    * Get an array copy of object
    * @return array
    */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
}