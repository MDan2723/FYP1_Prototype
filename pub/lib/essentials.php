
<?php 

require_once "config.php";
require_once "ess.debug.php";

// ----------- HEAD HEADER FOOTER -----------
function heads( $title ){
	?>
	<head>
		<!-- <link rel="shortcut icon" type="image/png" href="<?=BASE_URL?>pub/icons/chart-solid-48.png"> -->
		<link rel="shortcut icon" type="image/svg" href="<?=BASE_URL?>pub/icons/bxs-chart.svg">
		<style>
			<?php require_once 'pub/lib/css/SS2.css';?>
			<?php require_once 'pub/lib/css/cursor.css';?>
			<?php require_once 'pub/lib/css/form.css';?>
			<?php require_once 'pub/lib/css/texts.css';?>
			<?php require_once 'pub/lib/css/lists.css';?>
			<?php require_once 'pub/lib/css/tables.css';?>
			<?php require_once 'pub/lib/css/graphs.css';?>
			<?php require_once 'pub/lib/css/sidebar.css';?>
			<?php require_once 'pub/lib/css/forums.css';?>
			<?php require_once 'pub/lib/css/tooltip.css';?>
		</style>
		<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

		<title><?=$title?></title>
	</head>
	<?php
}
function navHeader( $page ){
	$pages = [	['1','&#9750','../'],
				['2','SIM HISTORY','/simhistory'],
				['3','NOTES','/notes'],
				['4','FORUM','/forum'],
				['5','SETTINGS','/settings'],
				];
	
	?>
	<div class="sidebar">
        <div class="logo-content">
            <div class="logo">
				<a href="/">
					<i class='bx bx-chart'></i>
					<div class="logo-name">NumericalSim</div>
				</a>
            </div>
            <i class='bx bx-menu pointer' id="menu-btn"></i>
        </div>
        <ul>
            <li>
                <i class='bx bx-search pointer'></i><input class='in-search' type="text" placeholder="Search..." value="">
                <span class="tooltip">Search</span>
            </li>
			<li><a href="<?=BASE_URL?>simulator">
				<i class='bx bx-line-chart'></i><span class="links-name">Simulator</span>
				</a><span class="tooltip">Simulator</span>
			</li>
			<li><a href="<?=BASE_URL?>simulator/simhistory">
				<i class='bx bx-history'></i><span class="links-name">Sim History</span>
				</a><span class="tooltip">Sim History</span>
			</li>
            <li><a href="<?=BASE_URL?>notes">
                <i class='bx bx-notepad'></i><span class="links-name">Notes</span>
                </a><span class="tooltip">Notes</span>
            </li>
			<li><a href="<?=BASE_URL?>exercises">
				<i class='bx bx-file-blank'></i><span class="links-name">Exercises</span>
                </a><span class="tooltip">Exercises</span>
            </li>
            <li><a href="<?=BASE_URL?>forum">
                <i class='bx bxs-conversation'></i><span class="links-name">Forum</span>
                </a><span class="tooltip">Forum</span>
            </li>
            <li><a href="<?=BASE_URL?>settings">
                <i class='bx bx-cog' ></i><span class="links-name">Setting</span>
                </a><span class="tooltip">Setting</span>
            </li>
        </ul>
        <div class="profile-content">
            <div class="profile">
                <div class="profile-details">
					<?php
					
					if (session_status() === PHP_SESSION_NONE){ session_start(); }
					
					// testDataHere($user->getData());
					if(isset($_SESSION['user'])){
						?>
						<a><i class="bx bx-log-out log-btn" id="logout-btn"></i></a>
						<?php
						$user = unserialize($_SESSION['user']);
						?>
						<!-- <profile image here> -->
						<a href="/user">
							<div class="name-job">
								<div class="name"><?=$user->getdata()["name"] ?></div>
								<div class="job"><?=$user->getdata()["email"] ?></div>
							</div>
						</a>
						<?php

					}
					else{
						?>
						<a href="/user/login"><i class="bx bx-log-in log-btn"></i></a>
						<?php
						?>
						<a>
							<div class="name-job">
								<div class="name">Login or Signup</div>
								<div class="job">for additional features</div>
							</div>
						</a>
						<?php
					}
					?>
                </div>
				<i class="bx bx-user pointer" id="loggings"></i>
				<span class="tooltip">My Account</span>
            </div>
        </div>
    </div>
	<?php
}
function footers(){
	?>
	<footer>
		<div class='cent pad marg f-cent'>
			<p class="">MMU Cyberjaya | Faculty of Computer & Informatics | Muhammad Danial</p>
		</div>
	</footer>	
	<?php
}

// ----------- NOTES & EXERCISE -----------
function exerciseList(){
	$arrExercises = [	["Starter Exercise","#","M.Danial", "easy"],
						["Intermediate Exercise","#","M.Danial", "medium"],
						["Advanced Exercise","#","M.Danial", "hard"]
					];
	$source_num = count($arrExercises);
	?>
	<div class='list'>
		<ol>
			<?php
			if($source_num == 0){
				?>
				<p class="">
					No sim history found; try simulating.
				</p>
				<?php
			}else{
				for( $i=0; $i<$source_num; $i++ ){
					?>
					<li class="row">
					<a href="<?=BASE_URL?>exercises?id=<?=$arrExercises[$i][1]?>">
							<h4 class="title">
								<?=$arrExercises[$i][0]?>
								<i class='bx bxs-file-blank t-s18'></i>
							</h4>
							<div class="bottom">
								<p class="author"> <?=$arrExercises[$i][2]?> </p>
								<p class="difficulty"> <?=$arrExercises[$i][3]?> </p>
							</div>
						</a>
					</li>
					<?php
				}
					
			}
			?>
			
		</ol>

	</div>
	<?php
}
function noteList(){
	$arrNotes = [	['Bisection Method','#',"M.Danial"],
					['Secant Method','#',"M.Danial"],
					['Newton Method','#',"M.Danial"]
				];
	$source_num = count($arrNotes);
	?>
	<div class='list'>
		<ol>
			<?php
			if($source_num == 0){
				?>
				<p class="">
					No files found; file maintenance.
				</p>
				<?php
			}else{
				for( $i=0; $i<$source_num; $i++ ){
					?>
					<li class="row">
					<a href="<?=BASE_URL?>notes?id=<?=$arrNotes[$i][1]?>">
							<h4 class="title">
								<?=$arrNotes[$i][0]?>
								<i class='bx bxs-notepad t-s18'></i>
							</h4>
							<div class="bottom">
								<p class="author">
									<?=$arrNotes[$i][2]?>
								</p>
								<p class="difficulty">
									<!-- Difficulty_<?=$i?> -->
								</p>
								<p class="rating">
									<!-- Rating_<?=$i?> -->
								</p>
							</div>
						</a>
					</li>
					<?php
				}
					
			}
			?>
			
		</ol>

	</div>
	<?php
}
function sourceList(){
	$arrNotes = [	["Applied Engineering Analysis","https://www.sjsu.edu/me/docs/hsu-Chapter%2010%20Numerical%20solution%20methods.pdf"],
					["Pitt Mathematics - MATH1070 5 Rootfinding","http://www.math.pitt.edu/~trenchea/math1070/MATH1070_5_Rootfinding.pdf"],
					["Newton's Method (1 of 2: How does it work?)","https://www.youtube.com/watch?v=j6ikEASjbWE"]
				];
	$source_num = count($arrNotes);
	?>
	<div class='list'>
		<ol>
			<?php
			if($source_num == 0){
				?>
				<p class="">
					No files found; file maintenance.
				</p>
				<?php
			}else{
				for( $i=0; $i<$source_num; $i++ ){
					?>
					<li class="row">
						<a target="_blank" href="<?=$arrNotes[$i][1]?>">
							<h4 class="title">
								<?=$arrNotes[$i][0]?>
								<i class='bx bx-file-find t-s18'></i>
							</h4>
							<div class="bottom">
								<p class=""></p>
							</div>
						</a>
					</li>
					<?php
				}
					
			}
			?>
			
		</ol>
	</div>
	<?php
}

// ----------- FORUM -----------
function showRating($type,$id){
	$DB = new Database();
	switch($type){
		case 'thread':
			$rate = $DB->threadRateCounter($id);
			break;
		case 'comment':
			$rate = $DB->commentRateCounter($id);
			break;
	}
	if( isset($_SESSION['user']) ){
		$user_id = unserialize($_SESSION['user'])->getData()['id'];
		if( $DB->hasRated($type,$user_id,$id) )
			echo "$rate <i class='bx bxs-upvote'></i>";
		else
			echo "$rate <i class='bx bx-upvote'></i>";
	}
	else{
		echo "$rate <i class='bx bx-upvote'></i>";
	}
}
function forumList(){
	$DB = new Database();
	$result =  $DB->readTbl("threads t INNER JOIN accounts a ON a.id = t.acc_id",
								"t.id, a.id AS author_id, a.name AS author, t.date, t.title, t.description",
								"ORDER BY t.date DESC");
	$list_data =  $DB->tableToListRow($result);
	
	?>
	<div class='list'>
		<ol>
			<?php
			if(count($list_data) == 0){
				?>
				<p class="">
					No posts found; server error.
				</p>
				<?php
			}else{
				// reverse($list_data);
				for( $i=0; $i<count($list_data); $i++ ){
					$row = $list_data[$i];
					$commentCount = $DB->threadCommentNumber($row['id']);
					?>
					<li class="row">
						<a href="<?=BASE_URL?>forum/thread?id=<?=$row["id"]?>">
							<div class="pad">
								<div class="t-left">
									<h4 class="title"> <?=$row["title"]?> </h4>
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
										<p class="rating">
											<?=showRating('thread',$row["id"])?>
										</p>
									</div>

								</div>
							</div>
						</a>
					</li>
					<?php
				}
			}
			?>
		</ol>
	</div>
	<?php
}
function forumComments($id){
	$DB = new Database();
	$result =  $DB->readTbl("comments c
								INNER JOIN accounts a ON a.id = c.acc_id",
								"c.id, a.id AS author_id, a.name AS author, c.description, c.date",
								"WHERE c.thread_id = '$id'");
	
	$list_data =  $DB->tableToListRow($result);
	?>
	<div class="comments">
		<ul>
		<?php
		if(count($list_data) == 0){
			?>
			<p class="">
				No comments found.
			</p>
			<?php
		}else{
			for( $i=0; $i<count($list_data); $i++ ){
				$row = $list_data[$i];
				?>
				<li class="row grid-2">
					<div class="t-left">
						<div class="bottom">
							<h2 class="title"> <?=$row["author"]?> </h2>
							<p class="timestamp"> <?=$row["date"]?> </p>
							<?php
								if(isset($_SESSION['user'])){
									?>
									<p class="rating pointer" onclick="makeRating('comment','<?=$row['id']?>')"> 
										<?=showRating('comment',$row["id"])?>
									</p>
									<?php
								}
								else{
									?>
									<p class="rating"> 
										<?=showRating('comment',$row["id"])?>
									</p>
									<?php
								}
							?>
						</div>
						<p class="description"> <?=str_replace("\n","<br>",$row["description"])?> </p>
					</div>
					<div class="t-right">
                    <?php
                        if(isset($_SESSION['user'])){
                            $user_id = unserialize($_SESSION['user'])->getData()['id'];
                            if( $row['author_id'] == $user_id ){
                                ?>
                                <h4 class='t-s24 pad'><i class='pointer bx bx-trash' onclick="deletePost('comment','<?=$row['id']?>')"></i></h4>
                                <?php
                            }
                        }
                    ?>

					</div>
				</li>
				<?php
			}
		}
		?>
		</ul>
	</div>
	<?php
}
function simHistoryList($id){
	$DB = new Database();
	$SH =  $DB->tableToListRow($DB->readTbl("sim_history","*","WHERE acc_id = $id ORDER BY id DESC"));
	// testData($list_data->num_rows);
	?>
	<div class='list'>
		<ol>
			<?php
			if(count($SH) == 0){
				?>
				<p class="">
					No sim history found; try simulating.
				</p>
				<?php
			}else{
				for( $i=0; $i<count($SH); $i++ ){
					$row = $SH[$i];
					?>
					<li class="row">
						<a href="<?=BASE_URL?>simulator/execute?m=<?=$row['method']?>&f=<?=$row['function']?>&x=[<?=$row['x1'].','.$row['x2']?>]&tol=<?=$row['tolerance']?>">
							<h4 class=""> <?=$row['function']?> </h4>
							<div class="bottom">
                    			<p class=""> <?php
									switch($row["method"]){
										case 1: echo "Bisection Method";
											break;
										case 2: echo "Secant Method";
											break;
										case 3: echo "Newton Method";
											break;
									}
								?> </p>
								<p class=""> x = [<?=$row["x1"]?>,<?=$row["x2"]?>] </p>
								<p class=""> tolerance = <?=$row["tolerance"]?> </p>
							
							</div>
						</a>
					</li>
					<?php
				}
					
			}
			?>
			
		</ol>

	</div>
	<?php
}

// ----------- AUTO-LIST -----------
function listOptionColors(){
	?>
    <option value="Black"       >Black</option>
    <option disabled       		></option>
    <!-- <option value="LightRed"   >Light Red</option> -->
    <option value="Red"         >Red</option>
    <option value="DarkRed"     >Dark Red</option>
    <option disabled       		></option>
    <option value="LightBlue"  >Light Blue</option>
    <option value="Blue"        >Blue</option>
    <option value="DarkBlue"    >Dark Blue</option>
    <option disabled       		></option>
    <option value="LightGreen" >Light Green</option>
    <option value="Green"       >Green</option>
    <option value="DarkGreen"   >Dark Green</option>
    <?php
}

// ----------- SCRIPTS -----------
function scriptings(){
	?>
	<script src="<?=BASE_URL?>pub/lib/js/controls/sidebar.js"></script>
	<script src="<?=BASE_URL?>pub/lib/js/data/setting.js"></script>
	<?php
}
function scripts_forum(){
	?>
	<!-- <script src="<?=BASE_URL?>pub/lib/js/controls/data/forum.js"></script> -->
	<script src="<?=BASE_URL?>pub/lib/js/controls/forum/forum.js"></script>
	<script src="<?=BASE_URL?>pub/lib/js/controls/forum/thread.js"></script>
	<?php
}
function scripts_graph(){
	?>
	<script src="<?=BASE_URL?>pub/lib/js/graph/parseURL.js"></script>
	<script src="<?=BASE_URL?>pub/lib/js/graph/mathEval.js"></script>
	<script src="<?=BASE_URL?>pub/lib/js/graph/Graph.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/nerdamer@latest/nerdamer.core.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/nerdamer@latest/Algebra.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/nerdamer@latest/Calculus.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/nerdamer@latest/Solve.js"></script>

	<script src="<?=BASE_URL?>pub/lib/js/methods/Bisection.js"></script>
	<script src="<?=BASE_URL?>pub/lib/js/methods/Secant.js"></script>
	<script src="<?=BASE_URL?>pub/lib/js/methods/Newton.js"></script>
	<?php
}

