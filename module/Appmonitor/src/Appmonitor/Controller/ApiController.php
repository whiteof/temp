<?php

namespace Appmonitor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\User\LdapWCMC;
use Appmonitor\Model\SmbclientModel;
use Appmonitor\Entity\ServerLog;

class ApiController extends AbstractActionController
{
    
    public function authAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('appmonitor/api/auth');
        
        $request = $this->getRequest();
        $response = array();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            if(isset($post_data['cwid']) && isset($post_data['pass'])) {
                if(!empty($post_data['cwid']) && !empty($post_data['pass'])) {
                    $ldapWCMC = new LdapWCMC(); //Perform LDAP authentication if cwid and password are there.
                    $ldapValid = $ldapWCMC->authenticate($post_data['cwid'], $post_data['pass']);
                    if($ldapValid === true) {                        
                        $result = 'success';
                        $message = '';
                    }else {
                        $result = 'failed';
                        $message = 'CWID or Password is incorrect.';
                    }
                    $response = array(
                        'response' => array(
                            'auth' => array(
                                'cwid' => $post_data['cwid'],
                                'pass' => $post_data['pass'],
                                'result' => $result,
                                'message' => $message
                            )
                        )
                    );
                }else {
                    $response = array(
                        'response' => array(
                            'auth' => array(
                                'cwid' => $post_data['cwid'],
                                'pass' => $post_data['pass'],
                                'result' => 'faild',
                                'message' => 'CWID or password is empty.'
                            )
                        )
                    );
                }
            }else {
                $response = array(
                    'response' => array(
                        'auth' => array(
                            'cwid' => $post_data['cwid'],
                            'pass' => $post_data['pass'],
                            'result' => 'failed',
                            'message' => 'No CWID or Password found in request.'
                        )
                    )
                );
            } 
        }else {
            $response = array(
                'response' => array(
                    'general-error' => 'no POST data found'
                )
            );
        }
        
        $viewModel->setVariables(array(
            'response' => $response
        ));
        return $viewModel;
    }
    
    public function serversAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('appmonitor/api/servers');
        
        $request = $this->getRequest();
        $response = array();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            if(isset($post_data['cwid'])) {
                if(!empty($post_data['cwid'])) {
                    
                    $UserModel = $this->getServiceLocator()->get('Appmonitor\Model\UserModel');
                    $User = $UserModel->getUserByCwid($post_data['cwid']);
                    $servers = array();
                    foreach($User->getServers() as $Server) {
                        $server = array(
                            'id' => $Server->getId(),
                            'ip' => $Server->getIp(),
                            'title' => $Server->getTitle(),
                            'code' => $Server->getCode()
                        );
                        $servers[] = $server;
                    }
                    
                    $response = array(
                        'response' => array(
                            'servers' => $servers
                        )
                    );
                    
                }
            }
        }else {
            $response = array(
                'response' => array(
                    'general-error' => 'no POST data found'
                )
            );
        }
        
        $viewModel->setVariables(array(
            'response' => $response
        ));
        return $viewModel;
    }
    
    public function restartAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('appmonitor/api/restart');
        
        $request = $this->getRequest();
        $response = array();
        
        if ($request->isPost()) {
            $post_data = $request->getPost();
            if(isset($post_data['cwid'])) {
                if(!empty($post_data['cwid'])) {
                    
                    $UserModel = $this->getServiceLocator()->get('Appmonitor\Model\UserModel');
                    $User = $UserModel->getUserByCwid($post_data['cwid']);
                    
                    $ServerModel = $this->getServiceLocator()->get('Appmonitor\Model\ServerModel');
                    $Server = $ServerModel->getItemByCode($post_data['code']);
                    
                    $SmbclientModel = new SmbclientModel('//povm-apop01.med.cornell.edu/dropfile$', 'CUMC\svc_dropfile_W', '!0$,dr0pF!L3');
                    $result = "";
                    if (!$SmbclientModel->put(BASE_PATH.'/public/scripts/reboot.txt', 'reboot.txt')){
                        $result = "Failed to retrieve file.";
                        //var_dump($SmbclientModel->get_last_cmd_stdout());
                    }else {
                        $result = "Restart request has been sent successfully.";
                        $ServerLog = new ServerLog();
                        $ServerLog->setUser($User);
                        $ServerLog->setServer($Server);
                        $ServerLog->setAction('Restart requested');
                        $ServerLog->setCreatedAt(new \DateTime("now"));
                        $EntityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                        $EntityManager->persist($ServerLog);
                        $EntityManager->flush($ServerLog);
                    }                    
                                                            
                    $response = array(
                        'response' => array(
                            'action' => 'restart',
                            'result' => $result
                        )
                    );
                    
                }
            }
        }else {
            $response = array(
                'response' => array(
                    'general-error' => 'no POST data found'
                )
            );
        }
        
        $viewModel->setVariables(array(
            'response' => $response
        ));
        return $viewModel;
    }
    
    public function serverStatusAction()
    {        
        
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('appmonitor/api/serverstatus');
        
        $request = $this->getRequest();
        $response = array();
        
        if ($request->isPost()) {
            $post_data = $request->getPost();
            if(isset($post_data['code'])) {
                if(!empty($post_data['code'])) {
                    
                    $UserModel = $this->getServiceLocator()->get('Appmonitor\Model\UserModel');
                    $User = $UserModel->getUserByCwid($post_data['cwid']);
                    
                    $ServerModel = $this->getServiceLocator()->get('Appmonitor\Model\ServerModel');
                    $Server = $ServerModel->getItemByCode($post_data['code']);
                    
                    $SmbclientModel = new SmbclientModel('//povm-apop01.med.cornell.edu/dropfile$', 'CUMC\svc_dropfile_W', '!0$,dr0pF!L3');
                    
                    $SmbclientModel = new SmbclientModel('//povm-apop01.med.cornell.edu/dropfile$', 'CUMC\svc_dropfile_W', '!0$,dr0pF!L3');
                    $result = $SmbclientModel->dir('.', 'reboot.txt');
                    if($result) {
                        $return = "requested";
                    }else {
                        $return = "false";
                    }
                    $response = array(
                        'response' => array(
                            'action' => 'status',
                            'result' => $return
                        )
                    );
                    
                }
            }
        }else {
            $response = array(
                'response' => array(
                    'general-error' => 'no POST data found'
                )
            );
        }
        
        $viewModel->setVariables(array(
            'response' => $response
        ));
        return $viewModel;
    }
    
    public function serverLogAction()
    {        
        
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('appmonitor/api/serverlog');
        
        $request = $this->getRequest();
        $response = array();
        
        if ($request->isPost()) {
            $post_data = $request->getPost();
            if(isset($post_data['code'])) {
                if(!empty($post_data['code'])) {
                    
                    $UserModel = $this->getServiceLocator()->get('Appmonitor\Model\UserModel');
                    $User = $UserModel->getUserByCwid($post_data['cwid']);
                    
                    $ServerModel = $this->getServiceLocator()->get('Appmonitor\Model\ServerModel');
                    $Server = $ServerModel->getItemByCode($post_data['code']);
                    
                    $log = array();
                    foreach($Server->getServerLogs() as $i => $ServerLog) {
                        $log[] = array(
                            'id' => $ServerLog->getId(),
                            'user_name' => trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $ServerLog->getUser()->getFullName('F M L')))),
                            'action' => $ServerLog->getAction(),
                            'created_at' => $ServerLog->getCreatedAt()->format('m/d/Y g:ia')
                        );
                        if($i >= 5) break;
                    }                    
                    $response = array(
                        'response' => array(
                            'log' => $log
                        )
                    );
                    
                }
            }
        }else {
            $response = array(
                'response' => array(
                    'general-error' => 'no POST data found'
                )
            );
        }
        
        $viewModel->setVariables(array(
            'response' => $response
        ));
        return $viewModel;
    }    
}
