<?=heads("Forums")?>

<header>
    <div class='cent pad marg t_cent'>
        <h1>
            FORUM THREAD
        </h1>
    </div>
    <?php navHeader(4); ?>
</header>

<body class="main-body">

    <div class='cent pad marg'>
        <?php
        $DB = new Database();
        $row = $DB->getRow("forum","*","WHERE id = ".$_GET["id"]);
        // testData($row);
        ?>
        <div class='desc'>
            <div class="row">
                <h2 class="title"> <?=$row["title"]?> </h2>
                <div class="bottom">
                    <p class="timestamp"> <?=$row["date"]?> </p>
                    <p class="comment-count">
                        <!-- <?=$list_data[$i]["title"]?> -->
                    </p>
                    <p class="rating"> <?=$row["rating"]?> </p>
                </div>
                <hr>
                <p class="description"> <?=$row["description"]?> </p>
                
            </div>
            <hr>
            <div class="main">
                <div class="header">
                </div>
                <textarea id="in_comment"></textarea>
                <button id="btn_comment">add comment</button>
                <div class="comments">
                </div>
            </div>
        </div>
        
        
    </div>

	<?=scriptings();?>
	<?=scripts_forum();?>

</body>

<?=footers()?>