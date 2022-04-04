<?=heads("Forums")?>

<header>
    <div class='cent pad marg t_cent'>
        <h1>
            FORUM
        </h1>
    </div>
</header>

<body class="main-body">
    <?php navHeader(4); ?>

    <div class='cent pad marg'>
        <div class='desc'>
            <h3>THREADS</h3>
            <hr>
            <?=forumList();?>
        </div>
        

    </div>

	<?=scriptings();?>
	<?=scripts_forum();?>

</body>

<?=footers()?>