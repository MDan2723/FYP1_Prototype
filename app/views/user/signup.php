<?php
	if(isset($_SESSION['user'])){
		header("Location: ".BASE_URL);
		exit();
	}
?>
<?=heads("Signup")?>

<body class='v-cent'>
	<div class="cent d-small pad marg f-cent t-cent">
		<main class="">
			<div class="d-small pad">
				<?php
				if( $data!=null AND $data=='success'){
					?>
					<h1> SIGN UP: successful! </h1>
					<hr>
					<h4> <a href="<?=BASE_URL?>user/login">Login to your new user account.</a> </h4>
					<?php
				}
				else{
					?>
					<h1> SIGN UP </h1>
					<hr>
					<p>  </p>
					<form action='<?=BASE_URL?>includes/account' method='post'>
							<br><input type='text' name='name' placeholder='User Name' required/>
							<br><input type='text' name='email' placeholder='E-mail' required/>
							<br><input type='password' name='pass' placeholder='Password' required/>
							<br><input type='password' name='pass-repeat' placeholder='Repeat Password' required/>
							
							<br><input type='submit' name='submit' value='signup'/>
							<br>
							<br>
						<?php
							if($data!=null){
								echo "<p class='t-error'>";
								switch($data){
									case 'emptyfields': echo "please fill up the whole form";
										break;
									case 'invalidemailusername': echo "ERROR: this email/username is invalid. please try again";
										break;
									case 'invalidemail': echo "ERROR: Invalid email. please try again";
										break;
									case 'invalidusername': echo "ERROR: Invalid username. please try again";
										break;
									case 'passwordcheck': echo "ERROR: Invalid repeat-password. please try again";
										break;
									case 'usernametaken': echo "ERROR: Taken username. please try again";
										break;
									case 'sqlerror': echo "SERVER ERROR: please try again another time";
										break;
									default:
								
								}
								echo "</p>";
							}
						?>
					</form>
					<?php
				}
				?>

				
			</div>
		</main>
		
	</div>

</body>