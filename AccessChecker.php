<?php

class AccessChecker {
	
	var $signedin = false;	
	var $userdetails;

	
	function AccessChecker(){
		session_start();
		header("Cache-control: private"); 
		
	}
	
	
	function signout(){
		unset($this->userdetails);
		session_destroy();
		return true;
	}

	
	function checkLogin($user = '',$pass = '',$goodRedirect = '',$badRedirect = ''){

		
		require_once('DatabaseConn.php');
		require_once('Val.php');
		$val1 = new Val();
		$forlogin = new DatabaseConn();
		
		
		if (isset($_SESSION['user']) && isset($_SESSION['pass'])){

			
			//if (!$val1->ifText($_SESSION['user'])){return false;}
			//if (!$val1->ifText($_SESSION['pass'])){return false;}

			$getUser = $forlogin->queryexec("SELECT * FROM cmsusers WHERE user = '".$_SESSION['user']."' AND pass = '".$_SESSION['pass']."'");

			if ($forlogin->getNumRows($getUser) > 0){
				// user is good to go
				if ($goodRedirect != '') { 
					header("Location: ".$goodRedirect."&session id=".strip_tags(session_id())) ;
				}			
				return true;
			}else{
				// user is not ok, signout
				$this->signout();
				return false;
			}
			
		// user isn't logged in
		}else{	
			// val1 input
			//if (!$val1->ifText($user)){return false;}
			//if (!$val1->ifText($pass)){return false;}

			// find user
			$getUser = $forlogin->queryexec("SELECT * FROM cmsusers WHERE user = '$user' AND pass = PASSWORD('$pass')");
			$this->userdetails = $forlogin->fetchArray($getUser);

			if ($forlogin->getNumRows($getUser) > 0){
				// login OK, store session details
				// log in
				$_SESSION["user"] = $user;
				$_SESSION["pass"] = $this->userdetails['pass'];
				$_SESSION["designation"]=$this->userdetails['designation'];
				$_SESSION["time"]=time();
								
				if ($goodRedirect) { 
					header("Location: ".$goodRedirect."&session id=".strip_tags(session_id()));
				}
				return true;

			}else{
				// login not ok
				unset($this->userdetails);
				if ($badRedirect) { 
					header("Location: ".$badRedirect) ;
				}		
				return false;
			}
		}			
	}
}	
?>