<html>

<head>
    <title>Homepage</title>
</head>

<header>
    
    <div class='cent pad marg t_cent'>
        <h1>
            <i class='bx bx-chart' ></i>
            NUMERICAL SIMULATOR
        </h1>
    </div>
</header>

<body>
    <?php navHeader(1); ?>
    
    <div class='cent pad marg'>
        <div class='desc'>
            SIMULATE <hr> make a quick numerical approximation here
        </div>
        <form id='formSimulation' class='form-sim' method='POST' action='/simulation'>

            <div>
                <select id='in_meth' name="method" class='in1 block'>
                    <option value='1'>Bisection Method</option>
                    <option value='2'>Secant Method</option>
                    <option value='3'>Newton Method</option>
                </selection>
            </div>
            
            <div class='block'>
                <input id='in_func' class='in1' type='text' name='func' placeholder='function, f(x)'>
                <input id='in_x1' class='in1' type='number' name='a' placeholder='start, a'>
                <input id='in_x2' class='in1' type='number' name='b' placeholder='end, b'>
                <input id='in_tol' class='in1' type='number' name='tol' step="0.000001" placeholder='tolerance'>
            </div>
            
            <div class='block'>
                <input class='in1' type='submit' >
                <input class='in1' type='reset'>
            </div>
        </form>
    </div>
    
	<div class='cent pad marg'>
        <div class='desc'>
            FORUM <hr> looking to ask questions? start a dialogue or read the what other's have left. Rated for your education.
		</div>
        <?=forumTbl1();?>
    </div>

    <?=sciptings()?>
    <script src="pub/lib/js/controls/home.js"></script>

</body>
<?=footing()?>

</html>