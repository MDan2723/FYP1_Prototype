<?=heads("Settings")?>

<header>
    <div class='cent pad marg t_cent'>
        <h1>
            SETTINGS
        </h1>
    </div>
    <?php navHeader(5); ?>
</header>

<body class="main-body">

    <div class='cent pad marg'>
        <div class='desc'>
            GRAPH <hr> make changes to the output of Graph
        </div>

        <table class='setTbl f_cent'>
            <tr>
                <td>Graph Color</td>
                <td colspan='2'>
                    <select>
                        <option>RED</option>
                        <option>GREEN</option>
                        <option>BLUE</option>
                    </select>
                </td>
            <tr>
            <tr>
                <td>Grid Color</td>
                <td colspan='2'>
                    <select>
                        <option>RED</option>
                        <option>GREEN</option>
                        <option selected>BLUE</option>
                    </select>
                </td>
            <tr>
            <tr>
                <td>Grid Number</td>
                <td colspan='2'>
                    <select>
                        <option>Disable</option>
                        <option selected>Integer</option>
                        <option>Even</option>
                        <option>Odd</option>
                    </select>
                </td>
            <tr>
        </table>

    </div>
    
    <div class='cent pad marg'>
        <div class='desc'>
            GUIDES<hr> make changes to the output of Graph
        </div>
        
        <table class='setTbl f_cent'>
            <tr>
                <td>Line Color</td>
                <td colspan='2'>
                    <select>
                        <option selected>BLACK</option>
                        <option>RED</option>
                        <option>GREEN</option>
                        <option>BLUE</option>
                    </select>
                </td>
            <tr>
            <tr>
                <td>Indicator Color</td>
                <td colspan='2'>
                    <select>
                        <option selected>BLACK</option>
                        <option>RED</option>
                        <option>GREEN</option>
                        <option>BLUE</option>
                    </select>
                </td>
            <tr>
            <tr>
                <td>Steps</td>
                <td colspan='2'>
                    <select>
                        <option>Disable</option>
                        <option selected>Show All</option>
                        <option>First 3</option>
                    </select>
                </td>
            <tr>
            <tr>
                <td>Grid Density / Zoom</td>
                <td colspan='2'>
                    <input type='number' value='10' step='10' min='5'>
                </td>
            <tr>
        </table>

    </div>

	<?=scriptings();?>
    
</body>
<?=footers()?>