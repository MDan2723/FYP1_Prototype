<?=heads("Numerical Simulator")?>

<header>
    
    <!-- <div class='cent pad marg t-cent'>
        <h1>
            <i class='bx bx-chart' ></i>
            NUMERICAL SIMULATOR
        </h1>
    </div> -->
    <?php navHeader(1); ?>
</header>

<body class="main-body">
    
    <div class='cent marg header-image t-v-cent t-cent'>
        <h1 class="t-white t-shadow t-s42">
            <i class='bx bx-chart' ></i>
            NUMERICAL SIMULATOR
        </h1>
    </div>

    <div class='cent pad marg'>
        <div class='desc'>
            <h3>SIMULATE</h3> 
            <hr> make a quick numerical approximation here
        </div>
        <div id='formSimulation' class='form-sim'>
            <input id='sim_func' class='in1' type='text' name='func' placeholder='function, f(x)'>
            <!-- <div class="tooltip note block-inline"></div> -->
            <div class="tooltip note"><i class='bx bx-question-mark'></i>
                <span class="tooltiptext note">
                    make sure the function is valid: 
                    <br>e.g. sin(x), sqrt(x), ((x+3)/4)^2-4
                    <br>- if the function does not have any root, an error message will appear.
                    <br>- .
                </span>
            </div>

            <div class=''>
                <select id='sim_method' name="method" class='in1'>
                    <option value='1'>Bisection Method</option>
                    <option value='2'>Secant Method</option>
                    <option value='3'>Newton Method</option>
                </select>
                <div class="tooltip note"><i class='bx bx-question-mark'></i>
                    <span class="tooltiptext note">
                        Choose a method and the criteria will change.
                        <br>- Fill the criteria with the 'x' range/start for the method to work with. 
                    </span>
                </div>
                
                <div id="criteria"></div>
                <input id='sim_tol' class='in1' type='number' name='tol' min='0.000000000001' max='0.1' step="0.000000000001" placeholder='tolerance'>
                <div class="tooltip note"><i class='bx bx-question-mark'></i>
                    <span class="tooltiptext note">
                        tolerances are usually in decimal.
                        <br> 0.1 - 0.000001
                    </span>
                </div>
            </div>
            <br>
            <div class=''>
                <a id="simlink" href="<?=BASE_URL?>simulator/execute"><button class='in1' type='submit'>Execute</button></a>
                <!-- <input class='in1' type='reset'> -->
            </div>
        </div>
    </div>
    
	<div class='cent pad marg'>
        <div class='desc'>
            <h3>FORUM</h3>
            <p>looking to ask questions? start a thread or read the what other's have left. Rated for your education.</p>
            <hr> 
            <?=forumList();?>
		</div>
    </div>

    <?=scriptings()?>
    <script src="<?=BASE_URL?>pub/lib/js/controls/home.js"></script>
</body>
<?=footers()?>