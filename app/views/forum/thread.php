<head>
    <title>Forums</title>
</head>

<header>
    <div class='cent pad marg t_cent'>
        <h1>
            FORUM THREAD
        </h1>
    </div>
</header>

<body class="main-body">
    <?php navHeader(4); ?>

    <div class='cent pad marg'>
        <div class='desc'>
            FORUM <hr> Comments and Ratings! Have Fun!
        </div>
        <div class="main">
            <div class="header">
            </div>
            <textarea id="in_comment"></textarea>
            <button id="btn_comment">add comment</button>
            <div class="comments">
            </div>
        </div>
        
    </div>

	<?=scriptings();?>
	<?=scripts_forum();?>

</body>

<?=footers()?>