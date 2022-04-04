<?=heads("Sim History")?>

<header>
    <div class='cent pad marg t_cent'>
        <h1>Sim History</h1>
    </div>
</header>

<body class="main-body">
    
    <?php navHeader(2); ?>

    <div class='cent pad marg'>
        
        <h3 class='t_cent'>LIST</h3>
        <hr>
        <br>
        <?=exercisesTbl1()?>

    </div>
    <?=scriptings();?>
</body>
<?=footers();?>