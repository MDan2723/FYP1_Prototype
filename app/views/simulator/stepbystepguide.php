<?=heads("Graphing Calculator")?>
<head>
	<meta charset=utf-8 />
	<script src="http://cdnjs.cloudflare.com/ajax/libs/mathjs/0.15.0/math.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="https://unpkg.com/mathjs@10.1.1/lib/browser/math.js"></script>
	
</head>

<header>
	<div class='cent pad marg t-cent'>
		<h1>
			STEP-BY-STEP
		</h1>
	</div>
	<?php navHeader(6); ?>
</header>

<body class="main-body">
	<div class='cent pad marg'>
		<div class='pad marg t-cent'>
			<h3><t id="writeMethod"></t></h3>
			f = <t id="writeFunc" class="t-bold"></t>, 
			<t id="writeCriteria"></t>,
			t = <t id="writeTolerance" class="t-bold"></t>
		</div>

		<div class='pad marg g-cent'>
			<div id="graph" style="position: relative;">
				<canvas id="graphCanvas" width="500" height="500" style="position: absolute; z-index: 0;"></canvas>
				<canvas id="gPointer" width="500" height="500" style="position: absolute; z-index: 1;"></canvas>
			</div>
			<div id="graphForm">
				<h3 class="t-cent">Step-by-step</h3>
				<div class="pad marg">
					Steps, n: <input id="fieldStep" type='number' min='0' max='10' step='1' value='0'/>
				</div>
				<hr>
			</div>
		</div>
		<hr>
		<div class='pad marg'>
			<h3 class='t-cent'>Iteration Table</h3>
			<div class='g-cent'>
				<table id="tableIter" class="tbl1"></table>
			</div>
		</div>
		
		<hr>
		<div class='pad marg'>
			Final Result: 
			<br/><h3 id="result">x = 0.000<h3>
		</div>
	</div>

	<?=scriptings();?>
	<?php scripts_graph(); ?>
	<script src="<?=BASE_URL?>pub/lib/js/controls/stepbystepguide.js"></script>

</body>
	