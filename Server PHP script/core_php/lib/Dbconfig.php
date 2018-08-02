<?php
Class Database
{
    private $user ;
    private $host;
    private $pass ;
    private $db;

    public function __construct()
    {
        $this->user = "root";
        $this->host = "localhost";
        $this->pass = "";
        $this->db = "android_db";
        date_default_timezone_set('Asia/Kolkata');

    }

    public function connect()
    {
        $conn = new mysqli($this->host,$this->user,  $this->pass, $this->db);
        return $conn;
    }

    public function close(){       
        $this->conn = null;
      }
}
?>
