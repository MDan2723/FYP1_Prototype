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
    <div class="g-cent">
        <div class='item d-small pad marg'>
            <div class='desc f-cent'>
                <h3>GRAPH SETTING</h3> 
            </div>
            <table class='setTbl f-cent marg'>
                <tr>
                    <td>Line Curve Color</td>
                    <td colspan='2'>
                        <select class="sel-1" id="graph_lineCurve">
                            <?=listOptionColors()?>
                        </select>
                    </td>
                <tr>
            </table>
        </div>
        <div class='item d-small pad marg'>
            <div class='desc f-cent'>
                <h3>GRID SETTINGS</h3> 
            </div>
            <table class='setTbl f-cent marg'>
                <tr>
                    <td>Line 1's</td>
                    <td colspan='2'>
                        <select class="sel-1" id="grid_line1">
                            <?=listOptionColors()?>
                        </select>
                    </td>
                    <td id="color-indicator"></td>
                <tr>
                <tr>
                    <td>Line 10's</td>
                    <td colspan='2'>
                        <select class="sel-1" id="grid_line10">
                            <?=listOptionColors()?>
                        </select>
                    </td>
                <tr>
                <tr>
                    <td>Line Axis</td>
                    <td colspan='2'>
                        <select class="sel-1" id="grid_lineAxis">
                            <?=listOptionColors()?>
                        </select>
                    </td>
                <tr>
                <tr>
                    <td>Grid Numbering</td>
                    <td colspan='2'>
                        <select class="sel-1" id="grid_num">
                            <option>Disable</option>
                            <option>Integer</option>
                            <option>Even</option>
                            <option>Odd</option>
                        </select>
                    </td>
                <tr>
            </table>

        </div>
        
        <div class='item d-small pad marg'>
            <div class='desc f-cent'>
                <h3>POINTER SETTINGS</h3>
            </div>
            <table class='setTbl f-cent marg'>
                <tr>
                    <td>Pointer Shape</td>
                    <td colspan='2'>
                        <select class="sel-1" id="point_shape">
                            <option value="circle">◯</option>
                            <option value="axe">⨉</option>
                            <option value="arrow">ↆ</option>
                            <option value="triangle">▲</option>
                            <option value="square">▢</option>
                        </select>
                    </td>
                <tr>
                <tr>
                    <td>Pointer Size</td>
                    <td colspan='2'>
                        <select class="sel-1" id="point_size">
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                <tr>
                <tr>
                    <td>Pointer Color</td>
                    <td colspan='2'>
                        <select class="sel-1" id="point_color">
                            <?=listOptionColors()?>
                        </select>
                    </td>
                <tr>
                <tr>
                    <td>Coordinates Color</td>
                    <td colspan='2'>
                        <select class="sel-1" id="point_coords">
                            <?=listOptionColors()?>
                        </select>
                    </td>
                <tr>
            </table>

        </div>
        <div class='item d-small pad marg'>
            <div class='desc f-cent'>
                <h3>GUIDING LINES SETTINGS</h3>
            </div>
            <table class='setTbl f-cent marg'>
                <tr>
                    <td>Solid Line Color</td>
                    <td colspan='2'>
                        <select class="sel-1" id="guide_solidLine">
                            <?=listOptionColors()?>
                        </select>
                    </td>
                <tr>
                <tr>
                    <td>Dashed Line Color</td>
                    <td colspan='2'>
                        <select class="sel-1" id="guide_dashedLine">
                            <?=listOptionColors()?>
                        </select>
                    </td>
                <tr>
                <tr>
                    <td>Marker Color</td>
                    <td colspan='2'>
                        <select class="sel-1" id="guide_marker">
                            <?=listOptionColors()?>
                        </select>
                    </td>
                <tr>
            </table>

        </div>
        <div class='item d-small pad marg'>
            <div class='desc f-cent'>
                <h3>ITERATION TABLE SETTINGS</h3>
            </div>
            <table class='setTbl f-cent marg'>
                <tr>
                    <td>Decimal Places</td>
                    <td colspan='2'>
                        <select class="sel-1" id="iter_decimalPlace">
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="12">12</option>
                        </select>
                    </td>
                <tr>
            </table>

        </div>
    </div>

	<?=scriptings();?>
    <script src="<?=BASE_URL?>pub/lib/js/controls/setting.js"></script>
    
</body>
<?=footers()?>