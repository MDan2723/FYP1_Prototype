<?php
    heads("Forums");
?>

<header>
    <div class='cent pad marg t-cent'>
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
        $row = $DB->getRow("threads t INNER JOIN accounts a ON a.id = t.acc_id",
                            "t.id, a.name AS author, t.date, t.title, t.description",
                            "WHERE t.id = ".$_GET["id"]);
        // testData($row);
        $commentCount = $DB->threadCommentNumber($_GET['id']);
        ?>
        <div class='desc'>
            <div class="row">
                <h2 class="title"> <?=$row["title"]?> </h2>
                <div class="bottom">
                    <p class="author"> <?=$row["author"]?> </p>
                    <p class="timestamp"> <?=$row["date"]?> </p>
                    <p class="comment-count">
                        <?php
                        
                            echo $commentCount;
                            if($commentCount==1)
                                echo " comment";
                            else
                                echo " comments";
                        ?> 
                    </p>
                    <p class="rating"> <?=rating('thread',$row["id"])?></p>
                </div>
                <hr>
                <p class="description"> <?=$row["description"]?> </p>
                
            </div>
            <hr>
            <?php
            if(isset($_SESSION['user'])){
                echo '<div class="row">';
                echo '<t class="f-cent"><button class="forum-btn" id="make-comment-btn">make a comment</button></t>';
                echo '<div id="comment-maker"></div>';
                echo '</div>';
            }
            else{
                echo '<div class="row">';
                echo '<a href="'.BASE_URL.'user/login" class="f-cent"><button class="forum-btn" id="make-comment-btn">Login to make a comment</button></a>';
                echo '</div>';
            }
            ?>
            <div class="row">
                <?=forumComments($_GET["id"])?>
            </div>
        </div>
        
        
    </div>

	<?=scriptings();?>
	<?=scripts_forum();?>

</body>

<?=footers()?>