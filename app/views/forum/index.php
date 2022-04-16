<?=heads("Forums")?>

<header>
    <div class='cent pad marg t-cent'>
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
                <h3 class="t-left">THREADS</h3>
                <?php
                if(isset($_SESSION['user']))
                    echo '<h3 class="t-right pointer" id="make-post-btn"><i class="bx bx-plus"></i></h3>';
                ?>
                
            </div>
            <hr>
            <div id="post-maker"></div>
            <?=forumList();?>
        </div>
        

    </div>

	<?=scriptings();?>
	<?=scripts_forum();?>

</body>

<?=footers()?>