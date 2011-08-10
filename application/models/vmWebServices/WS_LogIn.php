<?php


	class LogIn {
		
		function vmLogIn($vmSoapClient, $username, $password, $group) {
			
			$vmClient = new SOAPClient($sessionNamespace);
			
			// "Gruppe" wird von VM 2009 R1 nicht unterstützt und kann daher in dieser Version ignoriert werden.
			$result = $vmClient->ws_login($username, $password);
			
			return $result;			
		}
		
	}

?>