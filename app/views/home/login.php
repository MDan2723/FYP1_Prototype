<?php
	if( isset($_SESSION['user']) ){
		header("Location: ".BASE_URL);
		exit();
	}
	
	$page_name = "Login";
?>
	
<body>

	<main class="">
		<div class="">
			<h1> LOGIN </h1>
			<p>  </p>
			
			<form action='<?=BASE_URL?>includes/account.inc.php' method='POST'>
				<input type='hidden' name='type' value='user'/>
				<br><input type='text' name='mailuname' placeholder='USER NAME / E-MAIL' required/>
				<br><input type='password' name='pwd' placeholder='PASSWORD' required/>
				<br><input type='submit' name='submit' value='LOGIN'/>
				<?php
					if($data!=null){
						echo "<p>";
						switch($data){
							case 'sqlerror': echo "SQL ERROR:<br>please wait while the website is being updated";
								break;
							case 'wrongpwd': echo "PASSWORD ERROR:<br>please try again";
								break;
							case 'nouser': echo "NO RECORDED NAME OR EMAIL:<br>please try a registered user name/email.";
								break;
							default:
						
						}
						echo "</p>";
					}
				?>
			</form>
			<hr>
			Create an account to get free shipping.
			<button><a href="<?=BASE_URL?>signup">SIGN UP</a></button>
		</div>
	</main>

</body>
</html>