console.log("Settings JS");

// ----------- Updating LOCAL SETTING -----------

let selections = [];
selections[0]   = document.querySelector('#graph_lineCurve');
selections[1]   = document.querySelector('#grid_line1');
selections[2]   = document.querySelector('#grid_line10');
selections[3]   = document.querySelector('#grid_lineAxis');
selections[4]   = document.querySelector('#grid_num');
selections[5]   = document.querySelector('#point_shape');
selections[6]   = document.querySelector('#point_size');
selections[7]   = document.querySelector('#point_color');
selections[8]   = document.querySelector('#point_coords');
selections[9]   = document.querySelector('#guide_solidLine');
selections[10]   = document.querySelector('#guide_dashedLine');
selections[11]  = document.querySelector('#guide_marker');
selections[12]  = document.querySelector('#iter_decimalPlace');

function selectionEvents(){
    selections[0].addEventListener('change', function() {
        setting.graph.curve = selections[0].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[1].addEventListener('change', function() {
        setting.grid.line_1 = selections[1].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[2].addEventListener('change', function() {
        setting.grid.line_10 = selections[2].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[3].addEventListener('change', function() {
        setting.grid.line_axis = selections[3].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[4].addEventListener('change', function() {
        setting.grid.grid_number = selections[4].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[5].addEventListener('change', function() {
        setting.pointer.shape = selections[5].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[6].addEventListener('change', function() {
        setting.pointer.size = selections[6].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[7].addEventListener('change', function() {
        setting.pointer.color = selections[7].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[8].addEventListener('change', function() {
        setting.pointer.coords = selections[8].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[9].addEventListener('change', function() {
        setting.guide_lines.solid = selections[9].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[10].addEventListener('change', function() {
        setting.guide_lines.dashed = selections[10].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[11].addEventListener('change', function() {
        setting.guide_lines.marker = selections[11].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });
    selections[12].addEventListener('change', function() {
        setting.table_iteration.decimal_places = selections[12].value;
        localStorage.setItem('setting', JSON.stringify(setting));
    });

}

function updateSelector(){
    selections[0].value = setting.graph.curve;
    selections[1].value = setting.grid.line_1;
    selections[2].value = setting.grid.line_10;
    selections[3].value = setting.grid.line_axis;
    selections[4].value = setting.grid.grid_number;
    selections[5].value = setting.pointer.shape;
    selections[6].value = setting.pointer.size;
    selections[7].value = setting.pointer.color;
    selections[8].value = setting.pointer.coords;
    selections[9].value = setting.guide_lines.solid;
    selections[10].value = setting.guide_lines.dashed;
    selections[11].value = setting.guide_lines.marker;
    selections[12].value = setting.table_iteration.decimal_places;
}

updateSelector();
selectionEvents();
