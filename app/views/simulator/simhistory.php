<?=heads("Sim History")?>

<header>
    <div class='cent pad marg t_cent'>
        <h1>Sim History</h1>
    </div>
</header>

<body class="main-body">
    
    <?php navHeader(2); ?>

    <div class='cent pad marg'>
        <div class="desc">
            <h3>LIST</h3>
            <hr>
            <?=simHistoryList()?>

        </div>

    </div>
    <?=scriptings();?>
</body>
<?=footers();?>