<head>
    <style>
    <?php
        include "pub/lib/StyleSheets/SS1.css";
    ?>
    </style>
</head>
<body>
    <div class="container">

        <div class="item">
            Input Here:
            <br/>
            <form method="POST" action="">
                <input class="in_eq" type="text" name="" placeholder="f(x)"/>
                <br/>
                <input class="in_eq" type="text" name="" placeholder="f'(x)"/>
                <br/>
                <input class="in_eq" type="text" name="" placeholder="a"/>
                <br/>
                <input class="in_eq" type="text" name="" placeholder="b"/>
            </form>
        </div>
        
        <div class="item">
            Output Here
            
        </div>
        
        <div class="item">
            Selection and Modify Output here:
            <br/>
            <form method="POST" action="">
                <select name="type">
                    <option value="0">Display All</option>
                    <optgroup label="Non-Linear Equation">
                        <option value="1">Bisection</option>
                        <option value="2">Secant</option>
                        <option value="3">Newton</option>
                    </optgroup>
                    <optgroup label="Differential Equation">
                        <option value="4" disabled>_</option>
                        <option value="5" disabled>_</option>
                        <option value="6" disabled>_</option>
                    </optgroup>
                </select>
            </form>
                                
        </div>

    </div>
    
</body>
<footer>

</footer>