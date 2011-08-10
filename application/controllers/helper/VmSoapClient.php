<?php

class VmSoapClient {
	
	function getVmSoapClient() {
		
		$vmSoapClient = SOAPClient($_SESSION['vmweb']['soapServer'], array('login' => $_SESSION['vmweb']['user'], 
    						  'password' => $_SESSION['vmweb']['vmSession'], 'soap_version' => "SOAP_1_2"));
	
		return $vmSoapClient;
	}		
}

?>