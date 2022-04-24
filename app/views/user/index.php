<?php
	if(isset($_SESSION['user'])){
		$user = unserialize($_SESSION['user']);
	}else{
		header("Location: ".BASE_URL."user/login");
		exit();
	}
	
	heads("user");
    navHeader(1);
?>

<body class="v-cent main-body">
    
	<div class="cent d-small pad f-cent t-cent">
		<main class="">
            <img src="<?=BASE_URL?>pub/images/user-circle-solid-120.png">
			<div class="">
                <hr>
                <div class="grid-2" style="width:300px;">
                    <div class="t-left">
                        <?php 
                            $data = $user->getData();
                            echo "<h2 style='margin:0px;'>".$data['name']."</h2>";
                            echo "<p style='margin:0px;'>".$data['email']."</p>"; 
                        ?>

                    </div>
                    <div class="t-right">
                        <h4 class='t-s24 pad'>
                            <i class='pointer bx bx-trash' onclick="deleteAccount(<?=$data['id']?>)"></i>
                        </h4>

                    </div>
                </div>
                <hr>
                                
			</div>
		</main>
		
	</div>
    <script>
        function deleteAccount(id){
            
            if(window.confirm("Are you sure you want to delete your account?")){
                let password = prompt("Insert user password to confirm deletion");
                if(password){
                    let baseurl = window.location.origin;
                    let requestDelete = new XMLHttpRequest();
        
                    requestDelete.open('POST',baseurl+'/includes/deleteAccount?password='+password);
                    requestDelete.send();
                    window.location.reload();
                }
            }
        }
    </script>
    <?=scriptings()?>
</body>