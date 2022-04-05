<?=heads("Sim History")?>

<header>
    <div class='cent pad marg t_cent'>
        <h1>Sim History</h1>
    </div>
    <?php navHeader(2); ?>
</header>

<body class="main-body">
    

    <div class='cent pad marg'>
        <div class="desc">
            <h3>LIST</h3>
            <hr>
            <?php
                if(isset($_SESSION["user"])){
                    simHistoryList();
                }
                else{
                    echo "<a href='".BASE_URL."account/login'>Login or Sign up to use this feature.</a>";
                }
            ?>

        </div>

    </div>
    <?=scriptings();?>
</body>
<?=footers();?>