<?php
/*
 * Perform basic authentication on WCMC LDAP server MDS.
 */
namespace Application\Model\User;


use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\Ldap as AuthAdapter;
use Zend\Authentication\Result;

/* DEBUG
use Zend\Config\Reader\Ini as ConfigReader;
use Zend\Config\Config;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream as LogWriter;
use Zend\Log\Filter\Priority as LogFilter;
*/

class LdapWCMC
{
	/**
	 * @var array
	 */	
	protected $messages = array();//return messages from authenticate()
	
	/**
	 * @var string
	 */
	protected $password;
	
	/**
	 * @var string
	 */		
	protected $username;//cwid

	/**
	 * @var boolean
	 */
	protected $isValid = false;//set true or false after authenticate()
	public function __construct()
	{
		
	}	
	/* Perform LDAP authentication agains WCMC LDAP server to check user's username and password.
	 * Errors or messages are returned in stored in $this->messages; use getMessages() to retrieve them.
	 * 
	 * @param string $username CWID or username of user you wish to authenticate
	 * @param string $password Password the user has entered for authentication.
	 * @param 
	 * @param boolean true if LDAP authentication was successful else false if error or user entered incorrect $username and/or $password
	 */
	public function authenticate($username,$password){
    	//    	$username = $this->_request->getParam('username');
    	//    	$password = $this->_request->getParam('password');
    	$this->username = $username;
    	$this->password = $password;
    	//DEBUG need to pass in  $sm=$this->getServiceLocator() to get this logger
    	//DEBUG $logger = $sm->get('Zend\Log');
    	$auth = new AuthenticationService();
    	/*
    	 * Put the username and password in the options array and pass to AuthAdapter.
    	 * This is the way I got it working through trial-and-error.
    	 */
    	$options = array(
    			array(
    					'host'              => 'mds.med.cornell.edu',
    					'username'          => 'uid='. $username .',ou=people,o=nycornell.org',
    					'password'          => $password,
    					'bindRequiresDn'    => true,
    					'accountDomainName' => 'med.cornell.edu',
    					'baseDn'            => 'ou=people, o=nycornell.org',
    			)
    	);
    	 
    	$adapter = new AuthAdapter($options,$username,$password);
    	
    	$result = $auth->authenticate($adapter);
    	
    	$this->isValid = $result->isValid();
    	if ($this->isValid){
    		//successful validation
    	}
    /*DEBUG
    	foreach ($this->messages  as $i => $message) {
    		if ($i-- > 1) { // $messages[2] and up are log messages
    			$message = str_replace("\n", "\n  ", $message);
    			$logger->log(Logger::DEBUG,"Ldap: $i: $message" );
    		}
    	}
    	*/ 	
    	return $this->isValid;
     
    }  
    /*
     * Return messages after calling authenticate().Typical success might return 2 messages:
     * 
     * 1 host=mds.med.cornell.edu,username=uid=hel2011,ou=people,o=nycornell.org,password=*****,bindRequiresDn=1,accountDomainName=med.cornell.edu,baseDn=ou=people, o=nycornell.org
     * 2 hel2011@med.cornell.edu authentication successful
     * 
     * A typical failure (password incorrect might be:
     * 1 host=mds.med.cornell.edu,username=uid=hel2011,ou=people,o=nycornell.org,password=*****,bindRequiresDn=1,accountDomainName=med.cornell.edu,baseDn=ou=people, o=nycornell.org
     * 2 C:\Developer\wamp2\projects\evaltool\vendor\zendframework\zendframework\library\Zend\Ldap\Ldap.php(795): 0x1: Failed to retrieve DN for account: hel2011@med.cornell.edu [0x31 (Invalid credentials): uid=hel2011,ou=people,o=nycornell.org]
     * 3 #0 C:\Developer\wamp2\projects\evaltool\vendor\zendframework\zendframework\library\Zend\Authentication\Adapter\Ldap.php(290): Zend\Ldap\Ldap->bind('hel2011@med.cor...', '*****')
     * 4 hel2011 authentication failed: 0x1: Failed to retrieve DN for account: hel2011@med.cornell.edu [0x31 (Invalid credentials): uid=hel2011,ou=people,o=nycornell.org]
     */
    public function getMessages(){
    	return $this->messages;
    	
    }
    /*
     * Return true if authenticate() was successful, else return false. Call authenticate() before
     * calling isValid().
     * 
     * @return boolean
     */
    public function isValid(){
    	return $this->isValid;
    }
}