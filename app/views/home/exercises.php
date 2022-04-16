
<?=heads("Exercises")?>

<header>
    <div class='cent pad marg t-cent'>
        <h1>EXERCISES</h1>
    </div>
    <?php navHeader(2); ?>
</header>

<body class="main-body">
    

    <div class='cent pad marg'>
        <div class='desc'>
            <h3>AVAILABLE EXERCISES</h3>
            <hr>
            <?=exerciseList()?>
        </div>

    </div>

	<?=scriptings();?>
    
</body>

<?=footers()?>