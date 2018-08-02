<?php
class Session extends Functions{
	private $function;
	private $db;
	public function __construct(){
		$function = new Functions();	
		$this->function =  $function;

		$db = new Database();	
		$this->db =  $db;
		
		session_set_save_handler(
		array($this, "_open"),
		array($this, "_close"),
		array($this, "_read"),
		array($this, "_write"),
		array($this, "_destroy"),
		array($this, "_gc")
		);
		// Start the session
		session_start();
	}
	public function _open(){
		// If successful
		if($this->db){
		// Return True
		return true;
		}
		// Return False
		return false;
	}
	public function _close(){
		// Close the database connection
		// If successful
		if($this->db->close()){
		// Return True
		return true;
		}
		// Return False
		return false;
	}
	public function _read($id){
		$ip = $this->function->get_client_ip();
		// Set query
		$stmt = "SELECT data FROM ci_sessions WHERE id = '$id' AND ip_address =  '$ip'";
		// Attempt execution
		// If successful
		if($this->function->run($stmt)){
		// Save returned row
		$row = $this->function->get($stmt);
		// Return the data
		return $row['data'];
		}else{
		// Return an empty string
		return '';
		}
	}
	public function _write($id, $data){

		$ip = $this->function->get_client_ip();
		// Create time stamp
		$access = time();
		// Set query  
		$stmt = "REPLACE INTO ci_sessions VALUES ('$id','$ip','$access', '$data')";
		// Run Query			
		// Attempt Execution
		// If successful
		if($this->function->run($stmt)){
		// Return True
		return true;
		}
		// Return False
		return false;
	}
	public function _destroy($id){
		// Set query
		$stmt = "DELETE FROM ci_sessions WHERE id = '$id' ";
		// Bind data

		// Attempt execution
		// If successful
		if($this->function->run($stmt)){
		// Return True
		return true;
		}
		// Return False
		return false;
	} 
	public function _gc($max){
		// Calculate what is to be deemed old
		$old = time() - $max;
		// Set query
		$stmt = "DELETE FROM ci_sessions WHERE timestamp < '$old'";

		// Attempt execution
		if($this->function->run($stmt)){
		// Return True
		return true;
		}
		// Return False
		return false;
	}
}
?>