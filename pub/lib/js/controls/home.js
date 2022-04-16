class Home{
    constructor(){
        const H = this;
        H.formSim = document.getElementById('formSimulation');
        H.criteria = document.getElementById("criteria");
        H.method = document.getElementById("sim_method");
        H.simlink = document.getElementById("simlink");
        // H.sim_input = document.getElementById("sim_input");
        // console.log(H.sim_input);

        H.criterias = ["<input id='sim_x1' class='in1 criteria' type='number' name='x' placeholder='start, a'><input id='sim_x2' class='in1 criteria' type='number' name='x' placeholder='end, b'>",
                        "<input id='sim_x2' class='in1 criteria' type='number' name='x' placeholder='start, x1'><input id='sim_x1' class='in1 criteria' type='number' name='x' placeholder='follow, x2'>",
                        "<input id='sim_x1' class='in1 criteria' type='number' name='x' placeholder='start, x1'>" ];
        H.criteria.innerHTML = H.criterias[0];
    }

    inputTrigger(){
        const H = this;
        if( H.formSim ){
            H.formSim.addEventListener("change",function(e){
                H.updateLink();
                // console.log(H.simlink.href);
            });

        }
    }

    updateLink(){
        const H = this;
        let x2;
        H.simlink.href = "/simulator/execute?";
        H.simlink.href += "m="+document.getElementById("sim_method").value;
        H.simlink.href += "&f="+document.getElementById("sim_func").value;
        if( x2 = document.getElementById("sim_x2") ){
            H.simlink.href += "&x=["+document.getElementById("sim_x1").value+ ","+ (x2.value) +"]";
        }else{
            H.simlink.href += "&x=["+document.getElementById("sim_x1").value+"]";
        }
        H.simlink.href += "&tol="+document.getElementById("sim_tol").value;
    }

    changeCriteria(){
        const H = this;
        H.method.addEventListener("change",function(e){
            switch( H.method.value ){
                case '1': H.criteria.innerHTML = H.criterias[0];
                    break;
                case '2': H.criteria.innerHTML = H.criterias[1];
                    break;
                case '3': H.criteria.innerHTML = H.criterias[2];
                    break;
                default:
                    break;
            }
        });
        // H.addEventListener("change",function(e){ showLink(); });

    }
}

let H = new Home;
H.changeCriteria();
H.inputTrigger();