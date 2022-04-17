<?php
	if( isset($_SESSION['user']) ){
		header("Location: ".BASE_URL);
		exit();
	}
?>
<?=heads("Login")?>

<body class="v-cent">
	<div class="cent-reg pad marg f-cent t-cent">

		<main class="">
			<div class="">
				<h1> LOGIN </h1>
				<hr>
				<form action='<?=BASE_URL?>includes/account' method='POST'>
					<input type='hidden' name='type' value='user'/>
					<br><input type='text' name='mailuname' placeholder='USER NAME / E-MAIL' required/>
					<br><input type='password' name='pwd' placeholder='PASSWORD' required/>
					<br><input type='submit' name='submit' value='LOGIN'/>
					<br>
					<br>
					<?php
						if($data!=null){
							echo "<p class='t-error'>";
							switch($data){
								case 'sqlerror': echo "SQL ERROR: please wait while the website is being updated";
								break;
								case 'wrongpwd': echo "PASSWORD ERROR: please try again";
								break;
								case 'nouser': echo "NO RECORDED NAME OR EMAIL: please try a registered user name/email.";
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