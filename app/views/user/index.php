<?php
	if(isset($_SESSION['user'])){
		$user = unserialize($_SESSION['user']);
	}else{
		header("Location: ".BASE_URL."login");
		exit();
	}
	
	heads("user");
?>

<body class="main-body">
    <?php navHeader(1); ?>
    
	<div class="cent pad marg f_cent t_cent">
		<main class="">
			<div class="">
                <hr>
                <?php 
                    $data = $user->getData();
                    echo "Username:";
                    echo "<h4 style='margin:0px;'>".$data['name']."</h2>"; 
                ?>
                <hr>
                <?php 
                    echo "E-mail:";
                    echo "<h4 style='margin:0px;'>".$data['email']."</h2>"; 
                ?>
                <hr>
			</div>
		</main>
		
	</div>
    <?=scriptings()?>
</body>
<?=footers()?>