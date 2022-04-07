<?php
	if( isset($_SESSION['user']) ){
		header("Location: ".BASE_URL);
		exit();
	}
	
	$page_name = "Login";
?>
<?=heads("Login")?>

<body>
	<div class="cent pad marg f-cent t_cent">

		<main class="">
			<div class="">
				<h1> LOGIN </h1>
				<hrZ>
				<p>  </p>
			
				<form action='<?=BASE_URL?>includes/account' method='POST'>
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
				<p class="">Create an account to get additional features.</p>
				<button><a href="<?=BASE_URL?>user/signup">SIGN UP</a></button>
			</div>
		</main>
	</div>

</body>