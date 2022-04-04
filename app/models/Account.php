<?php

class Account{

	private $data;
	public function __construct($data){ $this->data = $data; }

	public function getData(){ return $this->data; }
	public function setData( $data ){ return $this->data = $data; }


	public function login_acc(){
		$db = new Database;
			
		// $type = $_POST['type'];
		$mailuname = $_POST['mailuname'];
		$password = $_POST['pwd'];
		// testDataHere($type);
		
		if(!$result = $db->readTbl("accounts","*","WHERE name = '$mailuname' OR email = '$mailuname'")){
			go_to("login/sqlerror");
		}
		else{
			if($row = mysqli_fetch_assoc($result)){
				$pwdCheck = password_verify($password, $row['password']);
				
				if($pwdCheck){
					$user = new Account($row);
					$_SESSION[$type] = serialize($user);
	
					if($type=='user') unset($_SESSION['guest']);
					
					// if($type=='admin'){
					// 	go_to("admin");
					// }
					// else{
					// 	rtrn();
					// }
				}
				else{ go_to("login/wrongpwd"); }
			}
			else{ go_to("login/nouser"); }
		}
	}
	
	public function signup_acc(){
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$passRepeat = $_POST['pass-repeat'];
		
		$db = new Database;
		
		if( empty($name) || empty($email) || empty($pass) || empty($passRepeat)){
			go_to("signup/emptyfields");
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9 ]*$/", $name)){
			go_to("signup/invalidemailusername");
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			go_to("signup/invalidemail");
		}
		else if(!preg_match("/^[a-zA-Z0-9 ]*$/", $name)){
			go_to("signup/invalidusername");
		}
		else if( $pass !== $passRepeat ){
			go_to("signup/passwordcheck");
		}
		else{
			if(!$resultCheck = $db->readTbl("accounts","*","WHERE name = '$name' OR email = '$email'")){
				go_to("signup/usernametaken");
			}
			else{
				$hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
				$qry = "INSERT INTO accounts ( name, email, password ) VALUES ( '$name', '$email', '$hashedPwd' )";
				if($db->runQuery($qry))
					go_to("signup/success");
				else 
					go_to("signup/sqlerror");
			}
		}
	}
	
	public function edit_acc(){
		
		$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		
		$db = new Database;
		
		if($name!="")	{ $db->runQuery("UPDATE accounts SET name='$name' WHERE id = '$id'"); }
		if($url!="")	{ $db->runQuery("UPDATE accounts SET email='$email' WHERE id = '$id'"); }
		if($status!="")	{ $db->runQuery("UPDATE accounts SET address='$address' WHERE id = '$id'"); }
		
		$db->runQuery($qry);
			
		$_SESSION['success'] = 'Account "'.$name.'" editted.';
	}
	
	public function delete_acc(){
		
		$id = $_POST['id'];
		
		$db = new Database;
		$qry = "DELETE FROM accounts WHERE id = '$id'";
		$db->runQuery($qry);
		
		$_SESSION['id']=null;
		$_SESSION['name']=null;
		
		$_SESSION['success'] = 'Account ['.$id.'] deleted.';
	}
	
	
	public function close(){
		$this->die();
	}
}


?>