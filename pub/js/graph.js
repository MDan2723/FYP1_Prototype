console.log("logging");

var	canvas = document.getElementById('graphCanvas'),
		c = canvas.getContext('2d'),

		// 'n' = number of line segments
		n = 1000,

		// define the math 'window'.
		xMin = -10,
		xMax = 10,
		yMin = -10,
		yMax = 10,

		nMag = 0,

		exmpl = [
			'sin(x)', 'cos(x)', 'tan(x)',
			'x^2', 'x^3'
		]

		math = mathjs(),
		expr = exmpl[ 1 ],
		scope = { x: 0 },
		tree = math.parse(expr, scope);

// Canvas Handling
function clearCanvas(){
	c.clearRect(0,0,canvas.width,canvas.height);
}
function drawGrid(){
	var	x, y, i,
			nX =(xMax-xMin),
			nY =(yMax-yMin);

	c.beginPath();
	c.strokeStyle = "lightGrey";
	
	// x-axis
	for(var i=0; i<=nX; i++){

		perX = i/(nX);
		

		x = perX * canvas.width;

		// console.log((i+xMin)+' :	'+x);

		if( ( i + xMin ) == '0' ){
			c.stroke();

			c.beginPath();
			c.strokeStyle = "Red";
			c.moveTo( x, 0 );
			c.lineTo( x, 400 );
			c.stroke();

			c.beginPath();
			c.strokeStyle = "lightGrey";
		}else{
			c.moveTo( x, 0 );
			c.lineTo( x, 400 );
		}

	}

	// y-axis
	for(var i=0; i<=nY; i++){
		perY = i/(nY);
		

		y = (1-perY) * canvas.height;

		// console.log((i+yMin)+' :	'+y);

		if( ( i + yMin ) == '0' ){
			c.stroke();

			c.beginPath();
			c.strokeStyle = "Red";
			c.moveTo( 0, y);
			c.lineTo( 400, y);
			c.stroke();

			c.beginPath();
			c.strokeStyle = "lightGrey";
		}else{
			c.moveTo( 0, y);
			c.lineTo( 400, y);
		}
	}

	c.stroke();
}
function drawCurve(){
	var	x, y, i,
			perX, perY,
			mathX, mathY;

	c.beginPath();
	c.strokeStyle = "Black";

	for(var i=0; i<n; i++){
		perX = i/(n-1);

		mathX = perX * (xMax-xMin) + xMin;
		mathY = evalMathExpr(mathX);
		perY = (mathY - yMin) / (yMax-yMin);

		// console.log(mathX + ":" +perX);

		x = perX * canvas.width;
		y = (1-perY) * canvas.height;

		c.lineTo( x, y );

	}

	c.stroke();
}

// Math Handling
function evalMathExpr(mathX){
	var mathY;
	scope.x = mathX;
	return tree.eval();
}

// Field Handling
function fieldFunc(){
	var input = $('#fieldFunc');

	// Set the initial text value programmatically using jQuery.
	input.val(expr);
	
	// Listen for changes using jQuery.
	input.keyup( function (e) {
		if ((e.key === 'Enter') && (e.keyCode == 13)) {
			expr = input.val();
			console.log(expr);
			tree = math.parse(expr, scope);
			refreshCanvas();
    }
	});
}

// Magnification Handling
function magnification(e){
	var mouse = document.getElementById("graphCanvas");
	
	mouse.addEventListener("wheel", function(e){
		e.preventDefault();
		
		if( e.deltaY>0 ){
			nMag--;
			magOut();
		}
		else{
			if( (xMax - xMin) >2 ){
				nMag++;
				magIn();
			
			}
		}
		// console.log('mouse('+e.clientX+':'+e.clientY+')');
	});

}
function magIn(){
	xMin++;
	xMax--;
	yMin++;
	yMax--;
	refreshCanvas();
}
function magOut(){
	xMin--;
	xMax++;
	yMin--;
	yMax++;
	refreshCanvas();
}

// Function Handling
function fieldsTriggers(){
	fieldFunc();
	magnification();
}
function refreshCanvas(){
	clearCanvas();

	drawGrid();
	drawCurve();
}

refreshCanvas();
fieldsTriggers();
