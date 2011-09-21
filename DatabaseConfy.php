<?php
class DatabaseConfy {

    var $config;

    function getConfig() {

        // System variables
        $config['siteDir'] = 'C:\xampp\htdocs';

        // Database variables
        $config['dbhost'] = "localhost";
        $config['dbusername'] = "root";
        $config['dbpassword'] = "" ;
        $config['dbname'] = "CMS";

        return $config;

    }

}
?>