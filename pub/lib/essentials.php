
<head>
    <style>
        <?php require_once 'pub/css/SS1.css';?>
        <?php require_once 'pub/css/form.css';?>
        <?php require_once 'pub/css/texts.css';?>
        <?php require_once 'pub/css/lists.css';?>
        <?php require_once 'pub/css/tables.css';?>
        <?php require_once 'pub/css/graphs.css';?>
    </style>
</head>

<?php 

require_once "config.php";
require_once "ess.debug.php";

function hd( $type, $str ){
	
	echo "<head>";

  
	echo "</head>";
}

function footing(){
	?>
	<footer>
		<div class='cent pad marg f_cent'>
			FOOTER
		</div>
	</footer>	
	<?php
}

function navHeader( $page ){
	$pages = [	['1','&#9750','../'],
				['2','EXERCISES','/exercises'],
				['3','NOTES','/notes'],
				['4','FORUM','/forum'],
				['5','SETTINGS','/settings'],
				];
	
		?>
		<div class='cent pad f_cent'>
		<nav>
			<ul>
				<?php
					for( $i=0; $i<count($pages); $i++ ){
						if( $page!=$pages[$i][0] )
							echo "<a class='' href='".$pages[$i][2]."'><li class='navList'>".$pages[$i][1]."</li></a>";
						else
							echo "<a class='' href='".$pages[$i][2]."'><li class='nlSel'>".$pages[$i][1]."</li></a>";
					}
				?>
			</ul>
		</nav>
		</div>
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

function forumTbl1(){
	?>
	<div class='f_cent'>
		<table class='tbl1'>
			<tr>
				<th>Author</th>
				<th>Title</th>
				<th>Comment</th>
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

function scripts(){
	?>
	<script src="pub/js/graph.js"></script>
	<?php
}