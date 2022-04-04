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
            FORUM <hr> Dialogues, Comments and Ratings! Have Fun!
        </div>
        
        <?=forumList();?>

    </div>

	<?=scriptings();?>
	<?=scripts_forum();?>

</body>

<?=footers()?>