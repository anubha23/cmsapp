<?php
require_once 'DatabaseConfy.php';
class Val extends DatabaseConfy {

	var $errorsarr; 
	
	function validateAll($input,$desc = ''){
		if (trim($input) != "") {
			return true;
		}else{
			$this->errorsarr[] = $desc;
			return false;
		}
	}
	

	function ifText($input,$desc = ''){
		$result = preg_match ("/^[A-Za-z0-9\ ]+$/", $input );
		if ($result){
			return true;
		}else{
			$this->errorsarr[] = $desc;
			return false; 
		}
	}

	
	function ifTextNoSpace($input,$desc = ''){
		$result = preg_match ("/^[A-Za-z0-9]+$/", $input );
		if ($result){
			return true;
		}else{
			$this->errorsarr[] = $desc;
			return false; 
		}
	}
		

	function ifEmail($input,$desc = ''){
		$result = preg_match("/^[^@ ]+@[^@ ]+\.[^@ \.]+$/", $input );
		if ($result){
			return true;
		}else{
			$this->errorsarr[] = $desc;
			return false; 
		}
			
	}
	

	function ifNumeric($input,$desc = ''){
		if (is_numeric($input)) {
			return true; 
		}else{ 
			$this->errorsarr[] = $desc; 
			return false; 
		}
	}
	
	
	function ifDate($input,$desc= ''){

		if (strtotime($input) === -1 || $input == '') {
			$this->errorsarr[] = $desc;
			return false;
		}else{
			return true;
		}
	}
	
	
	function ifErrors() {
		if (count($this->errorsarr) > 0){
			return true;
		}else{
			return false;
		}
	}

	
	function listErrors($delim = ' '){
		return implode($delim,$this->errorsarr);
	}
	
	
	function addError($desc){
		$this->errorsarr[] = $desc;
	}	
		
}
?>