<html>

<head>
    <title>Result</title>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/mathjs/0.15.0/math.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
</head>

<header>
    <div class='cent pad marg t_cent'>
        <h1>
            RESULT PAGE
        </h1>
    </div>
</header>

<body>
    <?php navHeader(6); ?>

    <!-- <div class='cent pad marg'>
        <div class='desc'>
        </div>
        <?=formModify()?>
    </div> -->

    <div class='cent pad marg'>
        <!-- <?=testData($_POST)?> -->
        <div class=''>
        
            
            <div class='pad marg'>
                <h3 class='t_cent'>Graph plot/Guides</h3>
                <?=plotGraph()?> 
            </div>
            <div class='pad marg'>
                <h3 class='t_cent'>Iteration Table</h3>
                <div class='f_cent'>
                    <?=tblIterate($_POST['numMeth'])?>
                </div>
            </div>
        </div>
        
        <hr>
        <div class='pad marg'>
            Final Result: 
            <br/><h3>x = 0.000<h3>
        </div>

    </div>
    <?=scripts()?>
</body>

<?=footing()?>

</html>