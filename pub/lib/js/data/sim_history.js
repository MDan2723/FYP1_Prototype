var default_history = [
    {
        function: "((x+3)/4)^2-4",
        method: 1,
        x: [4,7],
        tol: 0.0001
    }
]

var sim_history = default_history;
// console.log(setting);
if (localStorage && localStorage.getItem('sim_history')) {
    sim_history = JSON.parse(localStorage.getItem('sim_history'));
} else {
    sim_history = default_history;
    localStorage.setItem('sim_history', JSON.stringify(default_history));
}