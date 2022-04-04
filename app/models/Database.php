<?php

class Database{

	private $host	= "localhost";
	private $uname	= "root";
	private $pwd	= "";
	private $name	= "numericalsimulator";
	private $conn;
	
	
	function __construct(){
		$this->conn = mysqli_connect( $this->host, $this->uname, $this->pwd, $this->name ) 
		or die("ERROR:<br> Database(".$this->name.") Connection Failed. <br> Please check your local connection file to ammend any private variables.");
	}
	
	// ---------------- Basics ----------------
	function selTbl( $tbl, $sel, $spec ){ return "SELECT $sel FROM $tbl $spec"; }
	function runQuery( $qry ){ return mysqli_query( $this->conn, $qry ); }
	
	// ---------------- Generals ----------------
	public function readTbl( $tbl, $sel, $spec ){
		if( $result = mysqli_query( $this->conn, $this->selTbl($tbl,$sel,$spec) ) ){
			return $result;
		}
		else{
			echo "</br> Error: SQL error detected;";
			return false;
		}
	}
	public function tableToListRow( $result ){
		$listRow = array();
		for($i=0;$i<$result->num_rows;$i++){
			$row = mysqli_fetch_assoc($result); 
			array_push($listRow,$row);
		}
		return $listRow;
	}
	public function getRow( $tbl, $sel, $spec ){
		if ($result = $this->readTbl( $tbl, $sel, $spec )){
			if( $row = mysqli_fetch_assoc($result) )
				return $row;
			else
				return false;
		}
		else
			return false;
	}
	public function getID( $table, $spec ){
		if( $result = $this->readTbl( "$table", " * ", "WHERE $spec" ) ){
			$row = mysqli_fetch_assoc($result);
			return $row['id'];
		}
		else{
			return false;
		}
	}

	// ---------------- Implements ----------------
	

	function closeDB(){
		$this->conn->mysql_close();
	}
}


?>