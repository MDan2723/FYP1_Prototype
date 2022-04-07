function c_log(s){console.log(s);}

class Graph{

	constructor(){
		console.log("Graph ready");

		const G = this;
		G.Graph = {};
		G.cnvGraph = document.getElementById('graphCanvas'),
		G.ctxGraph = G.cnvGraph.getContext('2d'),
		G.cnvPointr = document.getElementById('gPointer'),
		G.ctxPointr = G.cnvPointr.getContext('2d'),

		G.n = 1000, // 'n' = number of line segments
			
		G.ctxGraph.font = "14px Arial";
		G.ctxPointr.font = "16px Arial";
		
		G.graphData = {
			centPoint: {x:0, y:0},	// x-y coordinates
			size: 20,
			mathWindow: { // define the math 'window'.
				maxX: 0,
				minX: 0,
				maxY: 0,
				minY: 0
			}
		};
		G.pointer = {
			mathX: 0,
			mathY: 0
		}

        G.updateMathWin();
		G.ctxGraph.font = "16px Arial";
	}
	
	// graph data handler
	updateMathWin(){
		const gD = this.graphData;
		let range = gD.size/2;
		gD.mathWindow.maxX = (gD.centPoint.x + range);
		gD.mathWindow.minX = (gD.centPoint.x - range);
		gD.mathWindow.maxY = (gD.centPoint.y + range);
		gD.mathWindow.minY = (gD.centPoint.y - range);
	}	

	// Canvas Handling
	clearCanvas(cnv,ctx){
		ctx.clearRect(0,0,cnv.width,cnv.height);
	}
	drawGrid(){
		const	cnvG = this.cnvGraph,
				ctxG = this.ctxGraph,
				gD = this.graphData,
				gS = gD.size,
				gW = gD.mathWindow;
		let	x, y, perX, perY,
			nX =Math.round(( gS )*100000)/100000,
			nY =Math.round(( gS )*100000)/100000;

		ctxG.beginPath();
		ctxG.strokeStyle = setting.grid.line_1;
		
		if(  nX >2 ){ gridding(1); }
		else if(  nX ==2 || nX >0.2 ){ gridding(10); }
		else if(  nX ==0.2 || nX >0.02 ){ gridding(100); }
		else if(  nX ==0.02 || nX >0.002 ){ gridding(1000); }
		else if(  nX ==0.002 || nX >0.0002 ){ gridding(10000); }
		else if(  nX ==0.0002 || nX >0.00002 ){ gridding(100000); }
	
		function gridding(scale){
			nX*=scale;
			nY*=scale;
			var newMinX = gW.minX*scale,
				newMinY = gW.minY*scale;
	
			// x-axis
			for(var i=0; i<=nX; i++){
	
				perX = i/nX;
				x = perX * cnvG.width;
		
				// console.log((i+newMinX)+'	 :	'+x);
		
				if( Math.round( i + newMinX ) == '0' ){
					ctxG.stroke();
		
					ctxG.beginPath();
					ctxG.strokeStyle = setting.grid.line_axis;
					ctxG.moveTo( x, 0 );
					ctxG.lineTo( x, cnvG.height );
					ctxG.stroke();
		
					ctxG.beginPath();
					ctxG.strokeStyle = setting.grid.line_1;
				}
				else if( Math.ceil( (i + newMinX)%10 ) == '0' ){				
					ctxG.stroke();
		
					ctxG.beginPath();
					ctxG.strokeStyle = setting.grid.line_10;
					ctxG.moveTo( x, 0 );
					ctxG.lineTo( x, cnvG.height );
					ctxG.stroke();
		
					ctxG.beginPath();
					ctxG.strokeStyle = setting.grid.line_1;
				}
				else{
					ctxG.moveTo( x, 0 );
					ctxG.lineTo( x, cnvG.height );
				}
		
			}
		
			// y-axis
			for(var i=0; i<=nY; i++){
				perY = i/nY;
				y = (1-perY) * cnvG.height;
		
				// console.log((i+newMinY)+' :	'+y);
		
				if( Math.round( i + newMinY ) == '0' ){
					ctxG.stroke();
		
					ctxG.beginPath();
					ctxG.strokeStyle = setting.grid.line_axis;
					ctxG.moveTo( 0, y);
					ctxG.lineTo( cnvG.width, y);
					ctxG.stroke();
		
					ctxG.beginPath();
					ctxG.strokeStyle = setting.grid.line_1;
				}
				else if( Math.ceil( (i + newMinY)%10 ) == '0' ){
					ctxG.stroke();
		
					ctxG.beginPath();
					ctxG.strokeStyle = setting.grid.line_10;
					ctxG.moveTo( 0, y);
					ctxG.lineTo( cnvG.width, y);
					ctxG.stroke();
		
					ctxG.beginPath();
					ctxG.strokeStyle = setting.grid.line_1;
				}
				else{
					ctxG.moveTo( 0, y);
					ctxG.lineTo( cnvG.width, y);
				}
			}
		}
		ctxG.stroke();
	}
	drawCurve(){
		const	cnvG = this.cnvGraph,
				ctxG = this.ctxGraph,
				gD = this.graphData,
				gW = gD.mathWindow,
				n = this.n;
		var	x, y, i,
			perX, perY,
			mathX, mathY;
	
		ctxG.beginPath();
		ctxG.strokeStyle = setting.graph.curve;
	
		for(var i=0; i<n; i++){
			perX = i/(n-1);
	
			mathX = perX * (gW.maxX-gW.minX) + gW.minX;
			mathY = evalMathExpr(mathX);
			perY = (mathY - gW.minY) / (gW.maxY-gW.minY);
	
			x = perX * cnvG.width;
			y = (1-perY) * cnvG.height;
	
			ctxG.lineTo( x, y );
		}

		ctxG.stroke();
	}

	// Graph Handling
	graphCenter(x,d){
		const	gD = this.graphData,
				gL = gD.centPoint,
				gS = gD.size;

		gL.x = parseInt(x);
		gL.y = 0;
		gD.size = Math.round(d)*2+2;
		// c_log(gD);
		
		this.updateMathWin();
	}

	// Field Handling
	fieldFunc(){
		const G = this;
		let input = $('#fieldFunc');
		input.val(expr); // Set the initial text value programmatically using jQuery.
			
		// Listen for changes using jQuery.
		input.keyup( function (e) {
			if( input.val() != '' ){
				if ((e.key === 'Enter') && (e.keyCode == 13) && (input.val() != '')) {
					expr = input.val();

					tree = mathGraph.parse(expr, scope);
					if( tree.name != 'ParseError' ){
						numSim.iteration();
						G.refreshCanvas();
					}
					else{
						console.log("error detected in function provided");
						G.clearCanvas(this.cnvGraph,this.ctxGraph);
					}
				}
			}
			else{
				console.log("no input function detected");
			}
		});
	}

	// Magnification Handling
	magnification(e){
		var G = this,
			pCnv = G.cnvPointr;

		pCnv.addEventListener("wheel", function(e){
			var	gS = G.graphData.size;

			e.preventDefault();
			if( e.deltaY>0 ){ // zooming out
				if(gS>=2){
					zoom(1);
				} else if(gS>=0.2){
					zoom(0.1);
				} else if(gS>=0.02){
					zoom(0.01);
				} else if(gS>=0.002){
					zoom(0.001);
				} else if(gS>=0.0002){
					zoom(0.0001);
				}
			}
			else{ // zooming in
				if( gS>2 ){
					zoom(-1);
				} else if( gS>0.2 ){
					zoom(-0.1);
				} else if( gS>0.02 ){
					zoom(-0.01);
				} else if( gS>0.002 ){
					zoom(-0.001);
				} else if( gS>0.0002 ){
					zoom(-0.0001);
				}
			}
			function zoom(ms){ G.magnify(ms); }
		});

	}
	magnify(m){
		const gD = this.graphData;

		gD.size += m*2;
		gD.size = (Math.round(gD.size*100000))/100000;
		
		this.updateMathWin();
		this.refreshCanvas();
	}
	
	// Move Handling
	mouseInTrigger(){
		const	G = this,
				pCnv = G.cnvPointr;

		pCnv.onmouseenter = function(e){
			// c_log("in");
			document.onkeydown = graphMove;
			pointMouse();
		};
		pCnv.onmouseleave = function(e){
			// c_log("out");
			document.onkeydown = null;
			refreshC();
		};

		function graphMove(e){ G.moveGraph(e); }
		function pointMouse(){ G.mousePointer(); }
		function refreshC(){ G.refreshCanvas(); }
	}
	moveGraph(event) {
		event.preventDefault();
		
		const	gL = this.graphData.centPoint;
		let ms = 1;

		// if(mag>2){ ms = 1; }
		// else if(mag>0.2){ ms = 0.1; }
		// else if(mag>0.02){ ms = 0.01;	}
		// else{ ms = 1; }

		switch (event.keyCode) {
			case 37:	// left
				gL.x -= ms;
				break;
			case 38:	// up
				gL.y += ms;
				break;
			case 39:	// right
				gL.x += ms;
				break;
			case 40:	// down
				gL.y -= ms;
				break;
		}

		this.updateMathWin();
		this.refreshCanvas();
	}

	mousePointer(){
		const	G = this,
				cnvP = G.cnvPointr,
				ctxP = G.ctxPointr,
				point = G.pointer;

		cnvP.onmousemove = function (e){
			var rect = cnvP.getBoundingClientRect(),
				// coords = {
				// 	x: e.clientX - rect.left,
				// 	y: e.clientY - rect.top
				// };
				coorX = e.clientX - rect.left,
				coorY = G.findCoords('coor',coorX,'y');
				
			G.clearCanvas(cnvP,ctxP);

			ctxP.beginPath();
			ctxP.strokeStyle = setting.pointer.color
			ctxP.fillStyle = setting.pointer.color
			switch(setting.pointer.shape){
				case "circle":
					ctxP.arc( coorX, coorY, setting.pointer.size, 0, 2*Math.PI );
					break;
				case "axe":
					ctxP.fillText( "⨉", coorX-6, coorY+5 );
					break;
				case "arrow":
					ctxP.fillText( "ↆ", coorX-6, coorY );
					break;
				case "triangle":
					ctxP.fillText( "▲", coorX-8, coorY+9 );
					break;
				case "square":
					ctxP.fillText( "▢", coorX-6, coorY+5 );
					break;
				default:
					ctxP.arc( coorX, coorY, setting.pointer.size, 0, 2*Math.PI );
					break;
			}


			ctxP.stroke();
			ctxP.fillStyle = setting.pointer.coords;
			ctxP.fillText( "( "+point.mathX.toFixed(4)+", "+point.mathY.toFixed(4)+" )", 10, 20 );
		}
	}

	// Finder
	findCoords(from,valXY,attXY){
		const	cnvG = this.cnvGraph,
				gW = this.graphData.mathWindow,
				point = this.pointer;
		var perX, perY, mathX, mathY;
		
		switch(from){
			case 'coor':
				if(attXY=='x'){
					
					perY = 1-(valXY/cnvG.height);
					mathY = perY * (gW.maxY-gW.minY) + gW.minY;
					
					// mathX = solveMathExpr(mathY) // solve for y to get x
					perX = (mathX - gW.minX) / (gW.maxX-gW.minX);

					return perX * cnvG.width;
				}
				else if(attXY=='y'){
					perX = valXY/cnvG.width;
					// c_log(perX);
				
					mathX = perX * (gW.maxX-gW.minX) + gW.minX;
					mathY = evalMathExpr(mathX);
					perY = (mathY - gW.minY) / (gW.maxY-gW.minY);
					
					point.mathX = mathX;
					point.mathY = mathY;
					return (1-perY) * cnvG.height;
				}
				break;
			case 'math':
				if(attXY=='x'){
					perX = (valXY - gW.minX)/(gW.maxX-gW.minX) ;
					return perX * cnvG.width;
				}
				else if(attXY=='y'){
					perY = (valXY - gW.minY) / (gW.maxY-gW.minY);
					return (1-perY) * cnvG.height;
				}
				break;
			default:
				break;
		}
	}

	// Function Handling
	fieldsTriggers(){
		this.fieldFunc();
		this.magnification();
		this.mouseInTrigger();
	}

	refreshCanvas(){
		const G = this;
		G.clearCanvas(G.cnvGraph, G.ctxGraph);
		G.clearCanvas(G.cnvPointr, G.ctxPointr);
	
		G.drawGrid();
		G.drawCurve();
		// c_log(G.graphData.size);
	
		if(typeof numSim != "undefined") numSim.drawGuides();
	}
}
