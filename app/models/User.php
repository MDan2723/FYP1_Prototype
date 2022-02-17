<?php
if (session_status() === PHP_SESSION_NONE){ session_start(); }
require_once "Account.php";
require_once "Duration.php";

class User{

	private $data;
	private $start;
	private $dt;
//	private $	= "";
	
	
	/*Basics*/
	public function __construct($data){
		$this->data = $data;
	}
	public function getData(){
		return $this->data;
	}

	public function getStart(){
		return $this->start;
	}
	public function getStop(){
		return $this->stop;
	}
	
	/*Implements*/
	
	function recAC( $dur ){
		$cat = $_SESSION['prv_cat'];
		//$db = new Database;
		if(!$db->isRecorded( 'AC', $this->data['id'], $cat )){
			$qry = "INSERT INTO acc_cat ( acc_id, cat_id, duration_spent ) VALUES ( '".$this->data['id']."', '$cat', '".$this->dt."' )";
			$db->runQuery($qry);
		}
		else{
			$old_dur = $db->getDur( "acc_cat", $this->data['id'], $cat );
			
			$dur = Duration::fromString($this->dt);
			$dur->add(Duration::fromString($old_dur));
	
			$qry = "UPDATE acc_cat SET duration_spent = '$dur' WHERE acc_id = '".$this->data['id']."' AND cat_id = '$cat'";
			$db->runQuery($qry);
		}
		$_SESSION['prv_cat']=null;
	}
	function recAP( $dur ){
		$prd = $_SESSION['prv_prd'];
		//$db = new Database;
		if(!$db->isRecorded( 'AP', $this->data['id'], $prd )){
			$qry = "INSERT INTO acc_prd ( acc_id, prd_id, duration_spent ) VALUES ( '".$this->data['id']."', '$prd', '".$this->dt."' )";
			$db->runQuery($qry);
		}
		else{
			$old_dur = $db->getDur( "acc_prd", $this->data['id'], $prd );
			
			$dur = Duration::fromString($this->dt);
			$dur->add(Duration::fromString($old_dur));
			
			$qry = "UPDATE acc_prd SET duration_spent = '".$dur."' WHERE acc_id = '".$this->data['id']."' AND prd_id = '$prd'";
			$db->runQuery($qry);
		}
		$_SESSION['prv_prd']=null;
	}
	
	public function recStart($data){
		date_default_timezone_set("Asia/Kuala_Lumpur");
		
		if($this->start==null) $this->start = date_create("now");
		$_SESSION['user'] = serialize($this);

		if( isset($_SESSION['from']) ){
			switch( substr($_SESSION['from'],0,3) ){
				case 'cat':
					break;
				case 'pro':
					break;
				default:
			}
			$cat = $_SESSION['cat'];
			$_SESSION['prv_cat']= $cat;
			$prd = $_SESSION['prd'];
			$_SESSION['prv_prd']= $prd;	
		}
		
	}
	
	public function recStop(){
		date_default_timezone_set("Asia/Kuala_Lumpur");
		// $this->stop = date_create("now");
		
		$dur = date_diff( $this->start, date_create("now") );
		$this->dt = $dur->format("%H:%I:%S");
		
		if( isset($_SESSION['prv_cat']) ){
			$this->recAC($dur);
		}
		if( isset($_SESSION['prv_prd']) ){
			$this->recAP($dur);
		}
		
		$this->start = null;
		// $this->stop = null;
		$_SESSION['from'] = null;
		$_SESSION['user'] = serialize($this);
	}
	
	public function close(){
		$this->die();
	}
}


?>