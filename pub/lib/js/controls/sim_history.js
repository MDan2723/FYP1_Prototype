console.log("History-ing");

var btn = document.querySelector('sim_link');
btn.addEventListener('click', function() {
    console.log("saving sim");
    var f = document.querySelector('in_func');
    var m = document.querySelector('in_meth');
    var x1 = document.querySelector('in_x1');
    var x2 = document.querySelector('in_x2');
    var tol = document.querySelector('in_tol');

    if(x2==null) x = [x1.value];
    else x = [x1.value,x2.value];
    

    var sim = {
        function: f.value,
        method: m.value,
        x: x,
        tol: tol.value
    }
    // addSimHistory(comment);
    // txt.value = '';
    setting.sim_history.push(sim);
    localStorage.setItem('setting', JSON.stringify(setting));
})