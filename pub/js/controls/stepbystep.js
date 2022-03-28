function c_log(s){ console.log(s); }

var urlParams = parseURLParams(document.URL);
// if(urlParams) console.log(urlParams); else c_log("defult param used");
let G = new Graph;

G.refreshCanvas();
G.fieldsTriggers();

switch( parseInt(urlParams.m) ){
    case 1:
        var numSim = new Bisection( parseInt(urlParams.a), parseInt(urlParams.b), parseFloat(urlParams.tol), false );
        break;
    case 2:
        var numSim = new Secant( 7, 4, 0.001 );
        break;
    case 3:
        var numSim = new Newton( 7, 0.001 );
        break;
    default:
        c_log("running default");
        var numSim = new Bisection( 4, 7, 0.001, false );
        break;
}

numSim.iteration();
numSim.fieldStep();
numSim.tableResultStep();
numSim.writeCriterias();
