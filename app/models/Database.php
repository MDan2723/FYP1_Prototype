<?php

class Database{

	private $host	= "localhost";
	private $uname	= "root";
	private $pwd	= "";
	private $name	= "dbmots";
	private $conn;
	
	
	function __construct(){
		$this->conn = mysqli_connect( $this->host, $this->uname, $this->pwd, $this->name ) 
		or die("ERROR:<br> Database(".$this->name.") Connection Failed. <br> Please check your local connection file to ammend any private variables.");
	}
	
	// ---------------- Basics ----------------
	function selTbl( $tbl, $sel, $spec ){ return "SELECT $sel FROM $tbl $spec"; }
	function runQuery( $qry ){ return mysqli_query( $this->conn, $qry ); }
	
	// ---------------- Impliments ----------------
	public function readTbl( $tbl, $sel, $spec ){
		if( $result = mysqli_query( $this->conn, $this->selTbl($tbl,$sel,$spec) ) ){
			return $result;
		}
		else{
			echo "</br> Error: SQL error detected;";
			return false;
		}
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
	// ---------------- Generals ----------------

	public function getID( $table, $spec ){
		if( $result = $this->readTbl( "$table", " * ", "WHERE $spec" ) ){
			$row = mysqli_fetch_assoc($result);
			return $row['id'];
		}
		else{
			return false;
		}
	}
	public function isActive( $table, $id ){
		$result = $this->readTbl( "$table", " * ", "WHERE id = '$id' AND status = 'active'" );
		if( mysqli_num_rows($result)>0 )
			return true;
		else
			return false;
	}

	// ---------------- Categories ----------------
	public function hasSub($root_id){
		$result = $this->readTbl( "root_sub rs INNER JOIN categories s ON s.id = rs.sub_id",
									"rs.root_id AS root_id, s.id AS id, s.name AS name, s.url AS url",
									"WHERE s.status = 'active' AND rs.root_id='$root_id'" );
		if( mysqli_num_rows($result)>0 )
			return $result;
		else
			return false;
	}
	public function getRoot($sub_id){
		$result = $this->readTbl( "root_sub rs INNER JOIN categories r ON r.id = rs.root_id",
									"rs.sub_id AS sub_id, r.id AS id, r.name AS name, r.url AS url, r.status AS status",
									"WHERE r.status = 'active' AND rs.sub_id='$sub_id'" );
		//	$result = $this->readTbl( "root_sub rs INNER JOIN categories c ON c.id = rs.sub_id", " c.id AS cat_id, rs.root_id AS root_id, rs.sub_id AS sub_id ", "WHERE c.id = $category_ID" );
		if( mysqli_num_rows($result)>0 ){
			$row = mysqli_fetch_assoc($result);
			return $row;
		}
		else
			return false;
	}
	public function hasProduct($category_ID){
		$result = $this->readTbl( "product_category, categories", " * ", "WHERE id = category_id AND id = $category_ID" );
		if( mysqli_num_rows($result)>0 )
			return true;
		else
			return false;
	}
	public function activeBranch( $table, $id ){
		
		switch($table){
			case "categories":
				
				$result = $this->readTbl( 	"root_sub rs 
												INNER JOIN categories r ON r.id = rs.root_id
												INNER JOIN categories s ON s.id = rs.sub_id", 
											" r.id AS root_id, s.id AS sub_id ", 
											"WHERE s.id = '$id' AND s.status = 'active'" );
				if( $result ){
					$row = mysqli_fetch_assoc($result);
					
					if( $row['root_id']==1 ){
						echo"good";
						die();
						return true;
					}else{
						$this->activeBranch( $table, $row['root_id'] );						
					}
				}
				else{
					echo"poopoo";
					die();
					return false;
				}
				
			break;
			case "products":
				
				
			break;
			default: break;
		}
		
		
	}
	
	public function mainSub(){
		if( $result = $this->readTbl( 	"root_sub rs 
											INNER JOIN categories r ON r.id = rs.root_id
											INNER JOIN categories s ON s.id = rs.sub_id", 
										"r.id AS root_id, s.id AS id, s.name AS name, s.url AS url", 
										"WHERE s.status = 'active' AND root_id='1'" ) ){
			return $result;
		}
		else{ return false; }
	}

	// ---------------- Products ----------------
	public function getCat( $prd ){
		if( $result = $this->readTbl( "product_category pc 
											INNER JOIN products p ON p.id = pc.product_id
											INNER JOIN categories c ON c.id = pc.category_id", 
										"pc.product_id AS prd_id, c.id AS id, c.name AS name, c.url AS url, c.status AS status", 
										"WHERE pc.product_id = '$prd'" ) ){
			$row = mysqli_fetch_assoc($result);
			return $row;
		}
		else{ return false; }
	}
	public function getInvntory( $prd ){
		if( $result = $this->readTbl( "products", 
										"*", 
										"WHERE id = '$prd'" ) ){
			$row = mysqli_fetch_assoc($result);
			return $row['inventory'];
		}
		else{ return false; }
	}

	// ---------------- Accounts ----------------
	
	public function isRecorded( $type, $i, $j ){
		switch($type){
			case "AC":	$result = $this->readTbl( "acc_cat", " * ", "WHERE acc_id = '$i' AND cat_id = '$j'" );
						if( mysqli_num_rows($result)>0 ){
						//	echo "category recorded";
							return true;
						}
						else{
						//	echo "not recorded";
							return false;
						}
			break;
			case "AP":	$result = $this->readTbl( "acc_prd", " * ", "WHERE acc_id = '$i' AND prd_id = '$j'" );
						if( mysqli_num_rows($result)>0 ){
						//	echo "product recorded";
							return true;
						}
						else{
						//	echo "not recorded";
							return false;
						}
			break;
			default:
			break;
		}
		
	}
	public function getDur( $table, $acc_id, $CP_id ){
		
		if($table=="acc_cat"){
			$spec = "WHERE acc_id = $acc_id AND cat_id = $CP_id";
		}else if($table=="acc_prd"){
			$spec = "WHERE acc_id = $acc_id AND prd_id = $CP_id";
		}else
			$spec = "";
		
		if($result = $this->readTbl( $table, " * ", $spec )){
			if( mysqli_num_rows($result)>0 ){
				$row = mysqli_fetch_assoc($result);
			//	echo "GOT DUR";
				return $row['duration_spent'];
				
			}
			else
			//	echo "NO DUR";
				return false;
			
		}
		else{
		//	echo "POOP HERE";
		}
	}
	
	// ---------------- Order ----------------
	public function hasUnpaidOrd($acc_id){
		if( $result = $this->readTbl( "orders", " * ", "WHERE acc_id = '$acc_id' AND status = 'unpaid'" ) ){
			return true;
		}
		else{ return false; }
	}
	public function getCost($prd_id){
		if( $result = $this->readTbl( "products", " price ", "WHERE id = '$prd_id'" ) ){
			$row = mysqli_fetch_assoc($result);
			return $row['price'];
		}
		else{ return false; }
	}
	
	// ---------------- Cart ----------------
	// public function hasCheck( $acc_id ){
	// 	$result = $this->readTbl( "cart", " * ", "WHERE acc_id = '$acc_id' AND checks = 'checked'" );
	// 	if( mysqli_num_rows($result)>0 )
	// 		return true;
	// 	else
	// 		return false;
	// }
	
	public function hasCart( $acc_id ){
		if( $result = $this->readTbl( "cart", " * ", "WHERE acc_id = '$acc_id'" ) )
			return mysqli_num_rows($result);
		else
			echo "Cart Request Error;";
	}


	function closeDB(){
		$this->conn->mysql_close();
	}
}


?>