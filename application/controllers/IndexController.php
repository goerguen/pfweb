<?php

class IndexController extends Zend_Controller_Action
{

    public function init() {
        /* Initialize action controller here */
    }
    
    
     /**
	 * 
	 * Initiiert den LogIn bei VM, als Rückgabe erhält der Anwender ein Session String,
	 * dass statt des Passwortes bei Zugriffen von WebServices verwendet wird.
	 * 
	 * @author GK Consulting
	 * @author gk
	 * 
	 * @param $vmSoapClient - link zum VM WebServices Client, mögl. Protokolle http, https, vpn
	 * @param $username - LogIn Name des Users = wie in VM
	 * @param $password - Passwort in VM, PW wird weder in dieser DB noch in der App gespeichert
	 * @param $group - Wird in dieser Version noch nicht unterstützt
	 * 
	 * @return - Session String, der über 60min. gültig ist
	 */
    public function indexAction() {
    		    		
			$db = new Zend_Db_Adapter_Pdo_Mysql(array(
			    'host'     => '127.0.0.1',
			    'username' => 'root',
			    'password' => 'root',
			    'dbname'   => 'vmweb'));
			
			$form = new Application_Form_LogIn();
			$form->submit->setLabel('Einloggen');
			$this->view->form = $form;
			
			
			if ($this->getRequest()->isPost()) {
	            $formData = $this->getRequest()->getPost();
				
	            if ($form->isValid($formData)) {
	                $verlag = $form->getValue('Verlag');
	                $user 	= $form->getValue('Username');
	                $pw		= $form->getValue('Passwort');
	                	          
	                $verlagDb = new Application_Model_DbTable_Verlag();
	                
	                $stmt1 = $db->query(
	  					'SELECT v.soapServer FROM verlag v WHERE firmaAnzeige = ?',
  						array($verlag)
	  				);
	                $vmVerlag	= $stmt1->fetchAll();
	                
	  				$stmt2 = $db->query(
	  					'SELECT v.soapServer, v.validTo, m.username, m.vorname, m.nachname, m.active FROM verlag v, mitarbeiter m WHERE firmaAnzeige = ? AND m.username = ? AND v.id = m.verlagId',
  						array($verlag, $user)
	  				);
	                $vmUser	= $stmt2->fetchAll();
	                
	                $licenseOutOfTime = true;
	                if (!empty($vmUser[0]['validTo'])) {
		                $dateLicense = $vmUser[0]['validTo'];
			            $timearray = explode("-", $dateLicense);
						$timestamp = mktime(0, 0, 1, $timearray[1], $timearray[2], $timearray[0]);
						if($timestamp > time()) {
							$licenseOutOfTime = false;
						}
	            	}
	  				
	            	// Überprüft, ob Verlag in der DB existiert
                	if (empty($vmVerlag[0]['soapServer'])) {
                		$this->view->Meldung = "Verlag ist nicht registriert!";
                	// Überprüft, ob Benutzername in der DB existiert
                	} elseif (!empty($vmVerlag[0]['soapServer']) AND empty($vmUser[0]['soapServer'])) {
	  					$this->view->Meldung = "Benutzernamen und/oder Passwort ist falsch!";
                	} elseif (!empty($vmVerlag[0]['soapServer']) AND (!empty($vmUser[0]['soapServer'])) AND ($licenseOutOfTime) ) {
                		$this->view->Meldung = "Die Lizenz Ihres Verlages ist abgelaufen!";
                	} elseif (!empty($vmVerlag[0]['soapServer']) AND (!empty($vmUser[0]['soapServer'])) AND ($vmUser[0]['active']<=0) ) {
                		$this->view->Meldung = "Ihr Konto ist deaktiviert!";
                	} else {
                		try {
		  					session_start();
		  					$vmSoapClient = new SOAPClient($vmUser[0]['soapServer']);
		  					$vmSession = $vmSoapClient->ws_login($user, $pw, "");
                		
		  					$_SESSION['vmweb']['screenH']		= $form->getValue('ScreenHeight');
			                $_SESSION['vmweb']['soapServer'] 	= $vmUser[0]['soapServer'];
			                $_SESSION['vmweb']['user'] 			= $vmUser[0]['username'];
			                $_SESSION['vmweb']['vorname'] 		= $vmUser[0]['vorname'];
			                $_SESSION['vmweb']['nachname'] 		= $vmUser[0]['nachname'];
			                $_SESSION['vmweb']['vmSession'] 	= $vmSession;
			                
			                $vmClient = new SOAPClient($_SESSION['vmweb']['soapServer'], array('login' => $_SESSION['vmweb']['user'], 
	    						  'password' => $_SESSION['vmweb']['vmSession'], 'soap_version' => "SOAP_1_2"));
			                
			                $vmVersion = $vmClient->ws_VMVersion(); 
			                $_SESSION['vmweb']['vmVersion'] 	= $vmVersion['Version'];
			                $this->_redirector = $this->_helper->getHelper('Redirector');
			                switch($vmVersion['Version']) {
			                	case "2009" :  
			                		if ($vmVersion['SubVersion'] < 10) {
			                			$this->_helper->redirector('index'); //Beispiel !!!!!!
			                			break;
			                		} elseif ($vmVersion['SubVersion'] >= 10 and $vmVersion['SubVersion'] < 60) {
			                			$this->_helper->redirector('customerssearch','customer'); //Beispiel !!!!!! -erst Action-Methode, dann Controller-Klasse
			                			break;
			                		} else {
			                			$this->_helper->redirector->gotoUrl('http://'.$_SERVER['SERVER_NAME'].'/vmweb2009R1/public/start/startpage');
			                			break;
			                		}
			                	default: 
			                			$this->_helper->redirector('error'); //Beispiel !!!!!!
			                }
                		} catch (Exception $error) {
                			$this->view->Meldung = $error;
                		}
	  				}
	        	}
			}
    }   
}







