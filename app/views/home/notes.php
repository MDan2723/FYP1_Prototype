<?=heads("Notes")?>

<header>
    <div class='cent pad marg t_cent'>
        <h1>NOTES</h1>
    </div>
    <?php navHeader(3); ?>
</header>

<body class="main-body">
    

    <div class='cent pad marg '>
        <div class='desc'>
            <h3>AVAILABLE NOTES</h3>
            <hr>
            <?=notesTable()?>
        </div>
    </div>

    <?=scriptings()?>

</body>
<?=footers()?>