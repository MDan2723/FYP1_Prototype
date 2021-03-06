// console.log("data settings");

var default_setting =
{
    graph: {
        curve: "Black"
    },
    grid: {
        line_1: "LightBlue",
        line_10: "Blue",
        line_axis: "Red",
        grid_number: "Moderate"
    },
    pointer: {
        shape: "circle",
        size: 3,
        color: "Red",
        coords: {
            color: "Blue",
            size: 14
                }
    },
    guide_lines: {
        solid:  "Green",
        dashed: "Green",
        marker: "DarkGreen"
    },
    table_iteration: {
        decimal_places:  12
    }
};

let setting = default_setting;
if (localStorage && localStorage.getItem('setting')) {
    setting = JSON.parse(localStorage.getItem('setting'));
} else {
    setting = default_setting;
    localStorage.setItem('setting', JSON.stringify(default_setting));
}