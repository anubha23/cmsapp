<?php


class DatabaseConn {

    var $query1;
    var $conn;
    
    function DatabaseConn(){

      $host = "localhost";
        $db = "CMS";
        $user = "root";
        $pass = "";

        $this->conn = mysql_connect($host, $user, $pass);
        mysql_select_db($db);
        register_shutdown_function(array(&$this, 'closecon'));

    }

    function queryexec($query) {

        $this->query1 = $query;
        return mysql_query($query, $this->conn);

    }

    
    function fetchArray($res) {

        return mysql_fetch_array($res);

    }
	
	function getNumRows($res){
	return mysql_num_rows($res);
}

    function closecon() {

        mysql_close($this->conn);

    }


}
?>