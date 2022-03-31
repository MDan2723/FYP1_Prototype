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
				STEP-BY-STEP
			</h1>
		</div>
		<div class='cent pad g_cent'>
			<nav>
				<ul>
					
				</ul>
			</nav>
		</div>
	</header>
	
	<body>
		<div class='cent pad marg'>
			<div class='pad marg t_cent'>
				<h3><t id="methodName"></t></h3>
				f = <t id="fieldFunc" class="txt_bold"></t>, 
				<t id="inputCrit"></t>,
				t = <t id="fieldTol" class="txt_bold"></t>
			</div>

			<div class='pad marg g_cent'>
				<div id="graph" style="position: relative;">
					<canvas id="graphCanvas" width="500" height="500" style="position: absolute; z-index: 0;"></canvas>
					<canvas id="gPointer" width="500" height="500" style="position: absolute; z-index: 1;"></canvas>
				</div>
				<div id="graphForm">
					<h3 class="t_cent">Step-by-step</h3>
					<div class="pad marg">
						Steps, n: <input id="fieldStep" type='number' min='0' max='10' step='1' value='0'/>
					</div>
					<hr>
				</div>
			</div>
			<hr>
			<div class='pad marg'>
				<h3 class='t_cent'>Iteration Table</h3>
				<div class='g_cent'>
					<table id="tableIter">
						
					</table>
				</div>
			</div>
			
			<hr>
			<div class='pad marg'>
				Final Result: 
				<br/><h3 id="result">x = 0.000<h3>
			</div>
		</div>
	</body>
	<?php scripts_graph(); ?>
		<script src="pub/lib/js/controls/stepbystepguide.js"></script>
	
	
</html>