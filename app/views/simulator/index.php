<?=heads("Graphing Calculator")?>
<head>
	<meta charset=utf-8 />
	<script src="http://cdnjs.cloudflare.com/ajax/libs/mathjs/0.15.0/math.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="https://unpkg.com/mathjs@10.1.1/lib/browser/math.js"></script>
		
</head>

<header>
	<div class='cent pad marg t_cent'>
		<h1>
			Simulator
		</h1>
	</div>
	<?php navHeader(6); ?>
</header>

<body class="main-body">

	<div class='cent pad marg'>
		<div class=''>
		
			
			<h3 class='t_cent'>Graph plot/Guides</h3>
			<div class='pad marg g-cent'>
				<div id="graph" style="position: relative;">
					<canvas id="graphCanvas" width="500" height="500" style="position: absolute; z-index: 0;"></canvas>
					<canvas id="gPointer" width="500" height="500" style="position: absolute; z-index: 1;"></canvas>
				</div>
				<div id="graphForm" class="t_cent">
					<div id='formSimulation' class='form-sim'>

						<div>
							<input id='sim_func' class='in1' type='text' name='func' placeholder='function, f(x)'>
						</div>

						<div class=''>
							<select id='sim_method' name="method" class='in1'>
								<option value='1'>Bisection Method</option>
								<option value='2'>Secant Method</option>
								<option value='3'>Newton Method</option>
							</select>
							<div id="criteria"></div>
							<input id='sim_tol' class='in1' type='number' name='tol' step="0.000001" placeholder='tolerance'>
						</div>

						<div class=''>
							<a id="simlink" href="<?=BASE_URL?>simulator/execute"><button class='in1'>Simulate</button><a>
						</div>
					</div>
                
				</div>
			</div>
			<hr>
		</div>

	</div>

	<?php scriptings();?>
	<?php scripts_graph();?>
	<script src="<?=BASE_URL?>pub/lib/js/controls/simulation.js"></script>
    <script src="<?=BASE_URL?>pub/lib/js/controls/home.js"></script>
	
</body>
<?=footers()?>