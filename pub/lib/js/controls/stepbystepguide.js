var urlParams = parseURLParams(document.URL);
let G = new Graph;
let table_decimal_places = setting.table_iteration.decimal_places;
let dp = Math.pow(10,setting.table_iteration.decimal_places);

function cleanMathRound(itm){
    return (Math.round( itm*dp ))/dp;
}

G.refreshCanvas();
G.fieldsTriggers();

if(urlParams){
    let up = urlParams;
    up.x = up.x.toString();
    up.x = up.x.replace('[','').replace(']','');
	up.x = up.x.split(',');

    switch(parseInt(up.m)){
        case 1:
            var numSim = new Bisection( G, parseInt(up.x[0]), parseInt(up.x[1]), parseFloat(urlParams.tol), false );
            break;
        case 2:
            var numSim = new Secant( G, parseInt(up.x[1]), parseInt(up.x[0]), 0.00001, false );
            break;
        case 3:
            var numSim = new Newton( G, parseInt(up.x[0]), 0.001, false );
            break;
        default:
            c_log("running default");
            var numSim = new Bisection( G, parseInt(up.x[0]), parseInt(up.x[1]), 0.001, false );
            break;
    }
}
else{
    var numSim = new Bisection( G, 4, 7, 0.001, false );
}

numSim.iteration();
numSim.fieldStep();
numSim.tableResultStep();
numSim.writeCriterias();
