<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "smbd-app";

$mysqli = new mysqli($server, $user, $password, $database);

if ($mysqli->connect_error) {
    error_log('Connection error: ' . $mysqli->connect_error);
}

class Connection 
{
    private $hostname = "localhost";        
    private $username = "root";
    private $password = "";
    private $dbname = "smbd-app";

    public function connect()
    {
        $mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        return $mysqli;
        
        if($mysqli->connect_error)
        {
            error_log('Connection error: ' . $mysqli->connect_error);
        }
    }
}