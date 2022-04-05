<?=heads("Forums")?>

<header>
    <div class='cent pad marg t_cent'>
        <h1>
            FORUM
        </h1>
    </div>
    <?php navHeader(4); ?>
</header>

<body class="main-body">

    <div class='cent pad marg'>
        <div class='desc'>
            <div class="grid-2">
                <h3 class="t_left">THREADS</h3>
                <h3 class="t_right"><i class='bx bx-plus'></i></h3>
            </div>
            <hr>
            <?=forumList();?>
        </div>
        

    </div>

	<?=scriptings();?>
	<?=scripts_forum();?>

</body>

<?=footers()?>