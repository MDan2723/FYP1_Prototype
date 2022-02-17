<html>

<head>
    <title>Homepage</title>
</head>

<header>
    
    <div class='cent pad marg t_cent'>
        <h1>
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
        <form method='POST' action='/results'>

            <div>
                <select name="numMeth" class='in1 block'>
                    <option value='1'>Bisection Method</option>
                    <option value='2'>Secant Method</option>
                    <option value='3'>Newton Method</option>
                </selection>
            </div>
            
            <div class='block'>
                <input  class='in1' type='text' name='func' placeholder='function, f(x)'>
                <input  class='in1' type='number' name='start' placeholder='start, a'>
                <input  class='in1' type='number' name='end' placeholder='end, b'>
                <input  class='in1' type='number' name='tol' step="0.000001" placeholder='tolerance'>
            </div>
            
            <div class='block'>
                <input  class='in1' type='submit'>
                <input  class='in1' type='reset'>
            </div>
        </form>
    </div>
    
	<div class='cent pad marg'>
        <div class='desc'>
            FORUM <hr> looking to ask questions? start a dialogue or read the what other's have left. Rated for your education.
		</div>
        <?=forumTbl1();?>
    </div>
</body>

<?=footing()?>

</html>