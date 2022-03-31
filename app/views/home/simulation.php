
<html>
  	<head>
		<meta charset=utf-8 />
		<title>Graphing Calculator</title>
			
		<script src="http://cdnjs.cloudflare.com/ajax/libs/mathjs/0.15.0/math.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="https://unpkg.com/mathjs@10.1.1/lib/browser/math.js"></script>
			
  	</head>
	<header>
		<div class='cent pad marg t_cent'>
			<h1>
				RESULT PAGE
			</h1>
		</div>
    	<?php navHeader(6); ?>

	</header>
	
	<body>
	
		<div class='cent pad marg'>
			<div class=''>
			
				
				<h3 class='t_cent'>Graph plot/Guides</h3>
				<div class='pad marg g_cent'>
					<div id="graph" style="position: relative;">
						<canvas id="graphCanvas" width="500" height="500" style="position: absolute; z-index: 0;"></canvas>
						<canvas id="gPointer" width="500" height="500" style="position: absolute; z-index: 1;"></canvas>
					</div>
					<div id="graphForm">
						<div class="t_cent">
							<h3 id="methodName"></h3>
						</div>
						<div id="inputFunc" class="pad marg">
							Function / Formula
							<br>
							<input id="fieldFunc" type='text' />
						</div>
						<hr>
						<div id="inputCrit" class="pad marg">
						</div>
						<hr>
						<div class="pad marg">
							Tolerance
							<br>
							<input id="fieldTol" type='number' min='0.000001' step='0.000001' />
						</div>
						<hr>
						<div class="pad marg" id="viewLink"></div>
					</div>
				</div>
				<hr>
				<div class='pad marg'>
					<h3 class='t_cent'>Iteration Table</h3>
					<div class='g_cent'>
						<table id="tableIter" class="tbl1">
							
						</table>
					</div>
				</div>
			</div>
			
			<hr>
			<div class='pad marg'>
				Final Result: 
				<br/><h3 id="result">x = 0.000<h3>
			</div>
	
		</div>
		<?php scripts_graph();?>
		<script src="pub/lib/js/controls/simulation.js"></script>
	</body>
	
</html>