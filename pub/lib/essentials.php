
<?php 

require_once "config.php";
require_once "ess.debug.php";


function heads( $title ){
	?>

	<head>
		<style>
			<?php require_once 'pub/lib/css/SS2.css';?>
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
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul>
            <li>
                <i class='bx bx-search'></i><input type="text" placeholder="Search..." value="">
                <span class="tooltip">Search</span>
            </li>
			<li><a href="/simulator/simhistory">
				<i class='bx bx-history'></i><span class="links-name">Sim History</span>
				</a><span class="tooltip">Sim History</span>
			</li>
            <li><a href="/notes">
                <i class='bx bx-notepad'></i><span class="links-name">Notes</span>
                </a><span class="tooltip">Notes</span>
            </li>
			<li><a href="/exercises">
				<i class='bx bx-file-blank'></i><span class="links-name">Exercises</span>
                </a><span class="tooltip">Exercises</span>
            </li>
            <li><a href="/forum">
                <i class='bx bxs-conversation'></i><span class="links-name">Forum</span>
                </a><span class="tooltip">Forum</span>
            </li>
            <li><a href="/settings">
                <i class='bx bx-cog' ></i><span class="links-name">Setting</span>
                </a><span class="tooltip">Setting</span>
            </li>
        </ul>
        <div class="profile-content">
            <div class="profile">
                <div class="profile-details">
					<?php
					$user = unserialize($_SESSION['user']);
					// testDataHere($user->getData());
					if (session_status() === PHP_SESSION_NONE){
						session_start();
						?>
						<!-- <profile image here> -->
						<a href="/account">
							<i class="bx bx-user"></i>
						</a>
						<div class="name-job">
							<div class="name">Muhammad Danial</div>
							<div class="job">MMU Undergraduate</div>
						</div>
						<?php
					} 
					else{
						?>
						<a href="/account">
							<i class="bx bx-user"></i>
						</a>
						<div class="name-job">
							<div class="name"><?=$user->getdata()["name"] ?></div>
							<div class="job"><?=$user->getdata()["email"] ?></div>
						</div>
						<?php
					}

					?>
                </div>
				
				<?php
					
				if (session_status() === PHP_SESSION_NONE){
					session_start();
					if( !isset($_SESSION["user"]) ){
						?>
						<a href="/login"><i class="bx bx-log-in" id="loggings"></i></a>
						<span class="tooltip">Login/Singup</span>
						<?php
					}
				} 
				else{
					if( !isset($_SESSION["user"]) ){
						?>
						<a href="/login"><i class="bx bx-log-in" id="loggings"></i></a>
						<span class="tooltip">Login/Singup</span>
						<?php
					}
					else{
						?>
						<a href="/logout"><i class="bx bx-log-out" id="loggings"></i></a>
						<span class="tooltip">Logout</span>
						<?php
					}
				}
				?>
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

function exercisesTbl1(){
	?>
	<div class='f_cent'>
		<table class='tbl1'>
			<tr>
				<th>Author</th>
				<th>Title</th>
				<th>Description</th>
				<th>Date</th>
				<th>Rating</th>
			</tr>

			<?php
			for( $i=0; $i<3; $i++ ){
				?>
				<tr>
					<td>author_<?=$i+123?></td>
					<td>title_<?=$i+123?></td>
					<td>comment_<?=$i+123?></td>
					<td>15/11/2021 11:50</td>
					<td>45%</td>
				</tr>
				<?php
			}
			
			?>
		</table>

	</div>
	<?php
}


function notesTbl1(){
	?>
	<div class='f_cent'>
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

	</div>
	<?php
}

function forumList(){
	$DB = new Database();
	$list_data =  $DB->readTbl("forum","*","");
	// testData($list_data->num_rows);
	?>
	<div class='forum'>
		<ol>
			<?php
			if($list_data->num_rows == 0){
				?>
				<p class="">
					No posts found; server error.
				</p>
				<?php
			}else{
				for( $i=0; $i<$list_data->num_rows; $i++ ){
					?>
					<li class="row">
						<a href="/thread?id=">
							<h4 class="title">
								Start
								<!-- <?="title"?> -->
							</h4>
							<div class="bottom">
								<p class="timestamp">
									4/3/2022 12:00
									<!-- <?="timestamp"?> -->
								</p>
								<p class="comment-count">
									0 comments
									<!-- <?="comment number"?> -->
								</p>
								<p class="rating">
									0 Ratings
									<!-- <?="comment number"?> -->
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

function plotGraph(){
	?>
	<div class='pad'>
		<div class="graph f_cent">
		<div id="graph">
    		<canvas width="400" height="400" id="graphCanvas"></canvas>
		</div>
		<div>	
	        <?=formModify()?>
		</div>

		</div>
	</div>	
	<?php
}

function tblIterate($meth){
	
	echo "<table class='tbl1'>";
	switch($meth){
		case 1: iterBisect();
			break;
		case 2: iterSecant();
		break;
		case 3: iterNewton();
		break;
	}
	echo '</table>';
}
function iterList($col){
	for( $i=0; $i<5; $i++ ){
		?>
		<tr>
			<?php
			for( $j=0; $j<$col; $j++ )
				echo "<td>000000</td>";
			?>
		</tr>
		<?php	
	}
}
function iterBisect(){
	?>
		<tr>
			<th>Steps, n</th>
			<th>a</th>
			<th>b</th>
			<th>Midpoint, x</th>
			<th>f(x)</th>
			<th>error, e</th>
		</tr>
	<?php
	iterList(6);
}

function iterSecant(){
	?>
		<tr>
			<th>Steps, n</th>
			<th>xn</th>
			<th>f(xn)</th>
			<th>f'(xn)</th>
			<th>xn+1</th>
			<th>error, e</th>
		</tr>
	<?php
}

function iterNewton(){
	?>
		<tr>
			<th>Steps, n</th>
			<th>xn</th>
			<th>f(xn)</th>
			<th>f'(xn)</th>
			<th>xn+1</th>
			<th>error, e</th>
		</tr>
	<?php
}

function formModify0(){
	?>
	<form method='POST' action='/results'>
		<div>
			<select name="numMeth" class='in1 block'>
				<?php
					$methods = [ Bisection, Secant, Newton ];
					for($i=0; $i<3; $i++){
						if( ($i+1)!=$_POST['numMeth'] )
							echo "<option value='".($i+1)."'>".$methods[$i]." Method</option>";
						else
							echo "<option value='".($i+1)."' selected>".$methods[$i]." Method</option>";
					}
				?>
			</selection>
		</div>

		<div class='block'>
			<input class='in1' type='text' name='func' placeholder='f(x) = <?=$_POST['func']?>'>
			<input class='in1' type='number' name='start' placeholder='a = <?=$_POST['start']?>'>
			<input class='in1' type='number' name='end' placeholder='b = <?=$_POST['end']?>'>
			<input class='in1' type='number' name='tol' step="0.000001" placeholder='tolerance = <?=$_POST['tol']?>'>
		</div>

		<div class='block'>
			<button class='in1' type='submit'>MODIFY</button>
			<input class='in1' type='reset'>
		</div>
	</form>
	<?php
}

function formModify(){
	?>
	<div>
		<div>
			<select name="numMeth" class='in1 block'>
				<?php
					$methods = [ Bisection, Secant, Newton ];
					for($i=0; $i<3; $i++){
						if( ($i+1)!=$_POST['numMeth'] )
							echo "<option value='".($i+1)."'>".$methods[$i]." Method</option>";
						else
							echo "<option value='".($i+1)."' selected>".$methods[$i]." Method</option>";
					}
				?>
			</selection>
		</div>

		<div class='block'>
			<input class='in1' id="fieldFunc" type='text' name='func' placeholder='f(x) = <?=$_POST['func']?>'>
			<input class='in1' type='number' name='start' placeholder='a = <?=$_POST['start']?>'>
			<input class='in1' type='number' name='end' placeholder='b = <?=$_POST['end']?>'>
			<input class='in1' type='number' name='tol' step="0.000001" placeholder='tolerance = <?=$_POST['tol']?>'>
		</div>
	</div>
	<?php
}
function scriptings(){
	?>
	<script src="<?=BASE_URL?>pub/lib/js/sidebar.js"></script>
	<?php
}
function scripts_forum(){
	?>
	<script src="<?=BASE_URL?>pub/lib/js/controls/data.js"></script>
	<script src="<?=BASE_URL?>pub/lib/js/controls/forum.js"></script>
	<script src="<?=BASE_URL?>pub/lib/js/controls/thread.js"></script>
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