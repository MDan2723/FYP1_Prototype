<?=heads("Numerical Simulator")?>

<header>
    
    <div class='cent pad marg t_cent'>
        <h1>
            <i class='bx bx-chart' ></i>
            NUMERICAL SIMULATOR
        </h1>
    </div>
</header>

<body class="main-body">
    <?php navHeader(1); ?>
    
    <div class='cent pad marg'>
        <div class='desc'>
            <h3>SIMULATE</h3> 
            <hr> make a quick numerical approximation here
        </div>
        <div id='formSimulation' class='form-sim'>

            <div>
                <select id='sim_method' name="method" class='in1 block'>
                    <option value='1'>Bisection Method</option>
                    <option value='2'>Secant Method</option>
                    <option value='3'>Newton Method</option>
                </selection>
            </div>
            
            <div class='block'>
                <input id='sim_func' class='in1' type='text' name='func' placeholder='function, f(x)'>
                <div id="criteria"></div>
                <input id='sim_tol' class='in1' type='number' name='tol' step="0.000001" placeholder='tolerance'>
            </div>
            
            <div class='block'>
                <a id="simlink" href="/simulator"><button class='in1' type='submit'>Submit</button><a>
                <!-- <input class='in1' type='reset'> -->
            </div>
        </div>
    </div>
    
	<div class='cent pad marg'>
        <div class='desc'>
            <h3>FORUM</h3>
            <p>looking to ask questions? start a dialogue or read the what other's have left. Rated for your education.</p>
            <hr> 
            <?=forumList();?>
		</div>
    </div>

    <?=scriptings()?>
    <script src="pub/lib/js/controls/home.js"></script>
</body>
<?=footers()?>