<?=heads("Notes")?>

<header>
    <div class='cent pad marg t-cent'>
        <h1>NOTES</h1>
    </div>
    <?php navHeader(3); ?>
</header>

<body class="main-body">
    

    <div class='cent pad marg '>
        <div class='desc'>
            <h3>AVAILABLE NOTES</h3>
            <hr>
            <?=noteList()?>
        </div>
    </div>
    <div class='cent pad marg '>
        <div class='desc'>
            <h3>AVAILABLE SOURCES</h3>
            <hr>
            <?=sourceList()?>
        </div>
    </div>
    <?=scriptings()?>

</body>
<?=footers()?>