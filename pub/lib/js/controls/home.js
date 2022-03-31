const formSim = document.getElementById('formSimulation');

console.log(formSim);

// formSim[0].addEventListener("change",function(e){ showLink(); });
// formSim[1].addEventListener("change",function(e){ showLink(); });
// formSim[2].addEventListener("change",function(e){ showLink(); });
// formSim[3].addEventListener("change",function(e){ showLink(); });
// formSim[4].addEventListener("change",function(e){ showLink(); });


function showLink(){ reWriteLink(); console.log(formSim.action); }

function reWriteLink(){
    formSim.action = "simulation?";
    formSim.action += "m="+formSim[0].value;
    formSim.action += "&f="+formSim[1].value;
    formSim.action += "&x=["+formSim[2].value+ ","+formSim[3].value+"]";
    formSim.action += "&tol="+formSim[4].value;
}