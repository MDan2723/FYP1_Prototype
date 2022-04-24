<?php

    $DB = new Database();
    $row = $DB->getRow("threads t INNER JOIN accounts a ON a.id = t.acc_id",
                        "t.id, a.id AS author_id, a.name AS author, t.date, t.title, t.description",
                        "WHERE t.id = ".$_GET["id"]);
    if(!$row){
        header("Location: ".BASE_URL."forum");
        exit();
    }
    // testData($row);
    $commentCount = $DB->threadCommentNumber($_GET['id']);

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
        <div class='desc'>
            <div class="row grid-2">
                <div class="t-left"> 
                    <h2 class="title">
                            <?=$row["title"]?>
                    </h2>
                    <div class="bottom">
                        <p class="author"> <?=$row["author"]?> </p>
                        <p class="timestamp"> <?=$row["date"]?> </p>
                        <p class="comment-count">
                            <?php
                                echo $commentCount;
                                if($commentCount==1) echo " comment";
                                else echo " comments";
                            ?> 
                        </p>
                        <?php
                            if(isset($_SESSION['user'])){
                                ?>
                                <p class="rating pointer" onclick="makeRating('thread','<?=$_GET['id']?>')"> 
                                    <?=showRating('thread',$row["id"])?>
                                </p>
                                <?php
                            }
                            else{
                                ?>
                                <p class="rating"> 
                                    <?=showRating('thread',$row["id"])?>
                                </p>
                                <?php
                            }
                        ?>
                        
                    </div>
                    
                </div> 
                <div class="t-right">
                    <?php
                        if(isset($_SESSION['user'])){
                            $user_id = unserialize($_SESSION['user'])->getData()['id'];
                            if( $row['author_id'] == $user_id ){
                                ?>
                                <h4 class='t-s24 pad'><i class='pointer bx bx-trash' onclick="deletePost('thread','<?=$row['id']?>')"></i></h4>
                                <?php
                            }
                        }
                    ?>
                </div> 
            </div>
            <hr>
            <p class="thread-description"> <?=str_replace("\n","<br>",$row["description"])?> </p>
                
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