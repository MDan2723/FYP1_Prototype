let G = new Graph();

G.refreshCanvas();
G.fieldsTriggers();

if(urlParams){
    let up = urlParams;
    up.x = up.x.toString();
    up.x = up.x.replace('[','').replace(']','');
	up.x = up.x.split(',');

    switch(parseInt(up.m)){
        case 1:
            var numSim = new Bisection( G, parseInt(up.x[0]), parseInt(up.x[1]), parseFloat(urlParams.tol), true );
            break;
        case 2:
            var numSim = new Secant( G, parseInt(up.x[1]), parseInt(up.x[0]), 0.00001, true );
            break;
        case 3:
            var numSim = new Newton( G, parseInt(up.x[0]), 0.001, true );
            break;
        default:
            c_log("running default");
            var numSim = new Bisection( G, parseInt(up.x[0]), parseInt(up.x[1]), 0.001, true );
            break;
    }
}
else{
    var numSim = new Bisection( G, 4, 7, 0.001, true );
}

numSim.iteration();
numSim.fieldsTriggers();