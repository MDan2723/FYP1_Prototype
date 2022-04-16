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
	function closeDB(){ $this->conn->mysql_close(); }
	
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
		if($result){
			for($i=0;$i<$result->num_rows;$i++){
				$row = mysqli_fetch_assoc($result); 
				array_push($listRow,$row);
			}
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

	// ---------- FORUMS ----------
	// ----------	THREADS ----------

    function threadCommentNumber($id){
		$DB = new Database();
		if ($result = $DB->readTbl( "threads t INNER JOIN comments c ON t.id = c.thread_id",
										"COUNT(c.id) AS comment_counts",
										"WHERE t.id = $id" )){
			if( $row = mysqli_fetch_assoc($result) )
				return $row["comment_counts"];
			else
				return 0;
		}
	}
	
    function threadRateCounter($id){
		$DB = new Database();
		if ($result = $DB->readTbl( "thread_ratings r INNER JOIN threads t ON t.id = r.thread_id",
										"COUNT(r.id) AS thread_ratings",
										"WHERE t.id = $id" )){
			if( $row = mysqli_fetch_assoc($result) )
				return $row["thread_ratings"];
			else
				return 0;
		}
	}
	
	// ----------	COMMENTS ----------
	function makeComment(){
		echo 'commenting';
	}
	function addRating(){
		echo 'give rating';
	}
	function commentRateCounter($id){
		$DB = new Database();
		if ($result = $DB->readTbl( "comment_ratings r INNER JOIN comments c ON c.id = r.comment_id",
										"COUNT(r.id) AS comment_ratings",
										"WHERE c.id = $id" )){
			if( $row = mysqli_fetch_assoc($result) )
				return $row["comment_ratings"];
			else
				return 0;
		}
	}

}


?>