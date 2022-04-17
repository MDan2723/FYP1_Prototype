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
	// ---------- GENERALS ----------
	public function hasRated($type,$user_id,$id){
		$DB = new Database();
		$from = '';
		$select = '';
		$where = '';
		switch($type){
			case 'thread':
				$from = "accounts a INNER JOIN thread_ratings tr ON tr.acc_id = a.id";
				$select = "tr.id";
				$where = "WHERE a.id = $user_id AND tr.thread_id = $id";
				
				break;
			case 'comment':
				$from = "accounts a INNER JOIN comment_ratings cr ON cr.acc_id = a.id";
				$select = "cr.id";
				$where = "WHERE a.id = $user_id AND cr.comment_id = $id";
				break;
		}
		
		if ($result = $DB->readTbl( $from, $select, $where ))
		{
			if($result->num_rows>0) return true;
			else return false;
		}
		else return false;
	}

	// ---------- SIM HISTORY ----------
	public function isInHistory($user_id,$function){
		$DB = new Database();
		$from = "sim_history sh";
		$select = "sh.id, sh.acc_id, sh.function";
		$where = "WHERE sh.acc_id = $user_id AND sh.function = '$function'";
		if ($result = $DB->readTbl( $from, $select, $where ))
		{
			if($result->num_rows>0) return true;
			else return false;
		}
		else return false;
	}
	public function addSimHistory($user_id,$input){
		$DB = new Database();
		$m = $input['m'];
		$f = $input['f'];
		$x1 = $input['x'][0];
		$x2 = $input['x'][1];
		$tol = $input['tol'];
		$qry = "INSERT INTO sim_history ( acc_id, method, function, x1, x2, tolerance ) VALUES ( $user_id,$m,'$f',$x1,$x2,$tol )";
		if(!$DB->runQuery($qry)) echo "sql error<br>";
	}

	// ----------	THREADS ----------
	function ifExist($table,$select,$where){
		$DB = new Database();
		if($result = $DB->readTbl($table,$select,$where)){
			if($result->num_rows>0) return true;
			else return false;
			
		}else{
			echo 'exist error';
		}
	}
	function makeThread(){
		$DB = new Database();
		if( isset($_POST) ){
			$user_id = unserialize($_SESSION['user'])->getData()['id'];
			$title = $_POST['title'];
			$desc = $_POST['desc'];
			
			if( !$this->ifExist("threads","*","WHERE title = '$title' AND description = '$desc'") ){
				$qry = "INSERT INTO threads ( acc_id, date, title, description ) VALUES ( $user_id, CURRENT_TIMESTAMP, '$title', '$desc' )";
				if(!$DB->runQuery($qry)) echo "sql error<br>";

			}
		}
		go_to('forum');
	}
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