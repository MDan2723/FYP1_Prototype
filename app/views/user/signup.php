<?php
	if(isset($_SESSION['user'])){
		header("Location: ".BASE_URL);
		exit();
	}
?>
<?=heads("Signup")?>

<body class='v-cent'>
	<div class="cent pad marg f-cent t-cent">
		<main class="">
			<div class="">
				<?php
				if( $data!=null AND $data=='success'){
					?>
					<h1> SIGN UP: successful! </h1>
					<hr>
					<h4> <a href="<?=BASE_URL?>login">Login to your new user account.</a> </h4>
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
								echo "<p>";
								switch($data){
									case 'emptyfields': echo "";
										break;
									case 'invalidemailusername': echo "";
										break;
									case 'invalidemail': echo "";
										break;
									case 'invalidusername': echo "";
										break;
									case 'passwordcheck': echo "";
										break;
									case 'usernametaken': echo "";
										break;
									case 'sqlerror': echo "";
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