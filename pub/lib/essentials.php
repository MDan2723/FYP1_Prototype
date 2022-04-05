
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
                <i class='bx bx-search pointer'></i><input type="text" placeholder="Search..." value="">
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
		<div class='cent pad marg f_cent'>
			<p class="">MMU Cyberjaya | Faculty of Computer & Informatics | Muhammad Danial</p>
		</div>
	</footer>	
	<?php
}

// ----------- NOTES & EXERCISE -----------
function exercisesTable(){
	$source_num = 3;
	?>
	<div class='forum'>
		<ol>
			<?php
			if($source_num == 0){
				?>
				<p class="">
					No sim history found; try simulating.
				</p>
				<?php
			}else{
				for( $i=1; $i<=$source_num; $i++ ){
					?>
					<li class="row">
					<a href="<?=BASE_URL?>exercises?id=<?=$i?>">
							<h4 class="title">
								Exercise_<?=$i?>
							</h4>
							<div class="bottom">
								<p class="timestamp">
									Date_<?=$i?>
								</p>
								<p class="difficulty">
									Difficulty_<?=$i?>
								</p>
								<p class="rating">
									Rating_<?=$i?>
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
function notesTable(){
	$source_num = 3;
	?>
	<div class='forum'>
		<ol>
			<?php
			if($source_num == 0){
				?>
				<p class="">
					No sim history found; try simulating.
				</p>
				<?php
			}else{
				for( $i=1; $i<=$source_num; $i++ ){
					?>
					<li class="row">
					<a href="<?=BASE_URL?>notes?id=<?=$i?>">
							<h4 class="title">
								Note_<?=$i?>
							</h4>
							<div class="bottom">
								<p class="timestamp">
									Date_<?=$i?>
								</p>
								<p class="difficulty">
									Difficulty_<?=$i?>
								</p>
								<p class="rating">
									Rating_<?=$i?>
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
	<!-- <div class='f_cent'>
		<table class='tbl1'>
			<tr>
				<th>Author</th>
				<th>Title</th>
				<th>Description</th>
				<th>Date</th>
			</tr>
			<?php
			for( $i=0; $i<3; $i++ ){
				?>
				<tr>
					<td>author_<?=$i+123?></td>
					<td>title_<?=$i+123?></td>
					<td>description_<?=$i+123?></td>
					<td>15/11/2021 11:50</td>
				</tr>
				<?php
			}
			
			?>
		</table>

	</div> -->
	<?php
}

// ----------- FORUM -----------
function forumList(){
	$DB = new Database();
	$result =  $DB->readTbl("forum","*","");
	$list_data =  $DB->tableToListRow($result);
	// testData($list_data);
	?>
	<div class='forum'>
		<ol>
			<?php
			if(count($list_data) == 0){
				?>
				<p class="">
					No posts found; server error.
				</p>
				<?php
			}else{
				for( $i=0; $i<count($list_data); $i++ ){
					?>
					<li class="row">
						<a href="<?=BASE_URL?>forum/thread?id=<?=$list_data[$i]["id"]?>">
							<h4 class="title">
								<?=$list_data[$i]["title"]?>
							</h4>
							<div class="bottom">
								<p class="timestamp">
									<?=$list_data[$i]["date"]?>
								</p>
								<p class="comment-count">
									<!-- <?=$list_data[$i]["title"]?> -->
								</p>
								<p class="rating">
									<?=$list_data[$i]["rating"]?>
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
function simHistoryList(){
	$DB = new Database();
	$list_data =  $DB->readTbl("sim_history","*","");
	// testData($list_data->num_rows);
	?>
	<div class='forum'>
		<ol>
			<?php
			if($list_data->num_rows == 0){
				?>
				<p class="">
					No sim history found; try simulating.
				</p>
				<?php
			}else{
				for( $i=0; $i<$list_data->num_rows; $i++ ){
					?>
					<li class="row">
						<a href="<?=BASE_URL?>simulator/">
							<p></p>
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

// ----------- SCRIPTS -----------
function scriptings(){
	?>
	<script src="<?=BASE_URL?>pub/lib/js/sidebar.js"></script>
	<?php
}
function scripts_forum(){
	?>
	<!-- <script src="<?=BASE_URL?>pub/lib/js/controls/data.js"></script>
	<script src="<?=BASE_URL?>pub/lib/js/controls/forum.js"></script>
	<script src="<?=BASE_URL?>pub/lib/js/controls/thread.js"></script> -->
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