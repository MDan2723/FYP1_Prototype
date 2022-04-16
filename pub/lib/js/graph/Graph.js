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
			newSize = cleanRound(gS,5);

		ctxG.beginPath();
		ctxG.strokeStyle = setting.grid.line_1;
		
		if(  newSize >2 ){ gridding(1); }
		else if(  newSize ==2 || newSize >0.2 ){ gridding(10); }
		else if(  newSize ==0.2 || newSize >0.02 ){ gridding(100); }
		else if(  newSize ==0.02 || newSize >0.002 ){ gridding(1000); }
		else if(  newSize ==0.002 || newSize >0.0002 ){ gridding(10000); }
		else if(  newSize ==0.0002 || newSize >0.00002 ){ gridding(100000); }
	
		function gridding(scale){
			newSize*=scale;
			let newMinX = Math.round(gW.minX*scale),
				newMinY = Math.round(gW.minY*scale);
			
			for(let j=0;j<3;j++){
				
				// x-axis
				for(let i=0; i<=newSize; i++){
		
					perX = i/newSize;
					x = perX * cnvG.width;
			
					// console.log((i+newMinX)+'	 :	'+x);
					switch(j){
						case 0:
							if( Math.ceil( (i + newMinX)%10 ) != '0' && Math.round( i + newMinX ) != '0' ){
								ctxG.moveTo( x, 0 );
								ctxG.lineTo( x, cnvG.height );
							}
							break;
						case 1:
							if( Math.ceil( (i + newMinX)%10 ) == '0' && Math.round( i + newMinX ) != '0' ){				
								ctxG.stroke();
					
								ctxG.beginPath();
								ctxG.strokeStyle = setting.grid.line_10;
								ctxG.moveTo( x, 0 );
								ctxG.lineTo( x, cnvG.height );
								ctxG.stroke();
					
								ctxG.beginPath();
								ctxG.strokeStyle = setting.grid.line_1;
							}
							break;
						case 2:
							if( Math.round( i + newMinX ) == '0' ){
								ctxG.stroke();
					
								// drawing y-axis
								ctxG.beginPath();
								ctxG.strokeStyle = setting.grid.line_axis;
								ctxG.moveTo( x, 0 );
								ctxG.lineTo( x, cnvG.height );
								ctxG.stroke();
		
								// numbering y-axis
								numbering('y');
		
								// reset
								ctxG.beginPath();
								ctxG.strokeStyle = setting.grid.line_1;
							}
							break;
					}
					
			
				}
			
				// y-axis
				for(let i=0; i<=newSize; i++){
					perY = i/newSize;
					y = (1-perY) * cnvG.height;
			
					// console.log((i+newMinY)+' :	'+y);
			
					switch(j){
						case 0:
							if( Math.ceil( (i + newMinY)%10 ) != '0' && Math.round( i + newMinY ) != '0' ){
								ctxG.moveTo( 0, y);
								ctxG.lineTo( cnvG.width, y);
							}
							break;
						case 1:
							if( Math.ceil( (i + newMinY)%10 ) == '0' && Math.round( i + newMinY ) != '0' ){
								ctxG.stroke();
					
								ctxG.beginPath();
								ctxG.strokeStyle = setting.grid.line_10;
								ctxG.moveTo( 0, y);
								ctxG.lineTo( cnvG.width, y);
								ctxG.stroke();
					
								ctxG.beginPath();
								ctxG.strokeStyle = setting.grid.line_1;
							}
							break;
						case 2:
							if( Math.round( i + newMinY ) == '0' ){
								ctxG.stroke();
					
								ctxG.beginPath();
								ctxG.strokeStyle = setting.grid.line_axis;
								ctxG.moveTo( 0, y);
								ctxG.lineTo( cnvG.width, y);
								ctxG.stroke();
		
								// numbering x-axis
								numbering('x');
								
								ctxG.beginPath();
								ctxG.strokeStyle = setting.grid.line_1;
							}
							break;
					}
				}
			}
			
			function numbering(xy){
				let noteX, noteY;
				switch(xy){
					case 'x':	// numbering for X-axis
						for(let j=0; j<=newSize; j++){
							perX = j/newSize;
							x = perX * cnvG.width;
							noteX = Math.round(j+newMinX)/scale;
							switch(setting.grid.grid_number){
								case "Disable":
									break;
								case "Moderate":
									if( gD.size>10 ){
										if( (noteX)%5==0 ) writeX(j);
									}else{
										if( (noteX)%1==0 && scale==1 ) writeX(j);
										else if( (noteX*scale)%5==0 ) writeX(j);
									}
									break;
								case "Integer":
									if( noteX%1==0 ){ writeX(j);}
									break;
								case "Odd":
									if( noteX%2!=0 ){ writeX(j); }
									break;
								case "Even":
									if( noteX%2==0 ){ writeX(j); }
									break;
								default: writeX(j);
									break;
							}
						}
						function writeX(j){
							ctxG.fillStyle = setting.grid.line_axis;
							ctxG.font = "12px Arial";
							ctxG.fillText( (j+newMinX)/scale, x+2, y+12 );
						}

						break;

					case 'y':	// numbering for Y-axis
						for(let j=0; j<=newSize; j++){
							perY = j/newSize;
							y = (1-perY) * cnvG.height;
							noteY = (j+newMinY)/scale;
							switch(setting.grid.grid_number){
								case "Disable":
									break;
								case "Moderate":
									if( gD.size>10 ){
										if( (noteY)%5==0 ) writeY(j);
									}else{
										if( (noteY)%1==0 && scale==1 ) writeY(j);
										else if( (noteY*scale)%5==0 ) writeY(j);
									}
									break;
								case "Integer":
									if( noteY%1==0 ){ writeY(j); }
									break;
								case "Odd":
									if( noteY%2!=0 ){ writeY(j); }
									break;
								case "Even":
									if( noteY%2==0 ){ writeY(j); }
									break;
								default:
									writeY(j);
									break;
							}
						}
						function writeY(j){
							ctxG.fillStyle = setting.grid.line_axis;
							ctxG.font = "12px Arial";
							ctxG.fillText( (j+newMinY)/scale, x+2, y+12 );
						}
						break;
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
		let	x, y, i,
			perX, perY,
			mathX, mathY;
	
		ctxG.beginPath();
		ctxG.strokeStyle = setting.graph.curve;
	
		for(let i=0; i<n; i++){
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
		let G = this,
			pCnv = G.cnvPointr;

		pCnv.addEventListener("wheel", function(e){
			let	gS = G.graphData.size;

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
		const	gD = this.graphData,
				gS = gD.size;

		gD.size += m*2;
		gD.size = cleanRound(gD.size,7);
		
		// if(gS>20){ updateCentPoint(0); }
		if(m>0){
			if(gS>1){ updateCentPoint(0); }
			else if(gS==1 || gS>0.1){ updateCentPoint(1); }
			else if(gS==0.1 || gS>0.01){ updateCentPoint(2); }
			else if(gS==0.01 || gS>0.001){ updateCentPoint(3); }
			else if(gS==0.001 || gS>0.0001){ updateCentPoint(4); }
			else if(gS==0.0001 || gS>0.00001){ updateCentPoint(5); }
		}

		function updateCentPoint(dp){
			gD.centPoint.x = cleanRound(gD.centPoint.x,dp);
			gD.centPoint.y = cleanRound(gD.centPoint.y,dp);
		}
		this.updateMathWin();
		this.refreshCanvas();
		// c_log(gD.size+": "+gD.centPoint.x+","+gD.centPoint.y);
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
		
		const	gD = this.graphData,
				gL = gD.centPoint,
				gS = gD.size;
		let ms;

		if(gS>20){ ms = 5; }
		else if(gS>2){ ms = 1; }
		else if(gS>0.2){ ms = 0.1;	}
		else if(gS>0.02){ ms = 0.01;	}
		else if(gS>0.002){ ms = 0.001;	}
		else if(gS>0.0002){ ms = 0.0001;	}
		else if(gS>0.00002){ ms = 0.00001;	}
		else{ ms = 1; }

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
			let rect = cnvP.getBoundingClientRect(),
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
			ctxP.font = (parseInt(setting.pointer.size)*4)+"px Arial";
			switch(setting.pointer.shape){
				case "circle":
					ctxP.arc( coorX, coorY, setting.pointer.size, 0, 2*Math.PI );
					break;
				case "axe":
					let pointSize = parseInt(setting.pointer.size);
					// ctxP.fillText( "⨉", coorX-6, coorY+5 );
					ctxP.moveTo(coorX - pointSize, coorY - pointSize); ctxP.lineTo(coorX + pointSize, coorY + pointSize);
					ctxP.moveTo(coorX + pointSize, coorY - pointSize); ctxP.lineTo(coorX - pointSize, coorY + pointSize);
					break;
				// case "square":
				// 	ctxP.fillText( "▢", coorX-6, coorY+5 );
				// 	break;
				default:
					ctxP.arc( coorX, coorY, setting.pointer.size, 0, 2*Math.PI );
					break;
			}


			ctxP.stroke();
			ctxP.fillStyle = setting.pointer.coords.color;
			ctxP.font = setting.pointer.coords.size+"px Arial";
			ctxP.fillText( "( "+point.mathX.toFixed(setting.table_iteration.decimal_places)+", "+point.mathY.toFixed(setting.table_iteration.decimal_places)+" )", 10, 16+(setting.pointer.coords.size/4) );
		}
	}

	// Finder
	findCoords(from,valXY,attXY){
		const	cnvG = this.cnvGraph,
				gW = this.graphData.mathWindow,
				point = this.pointer;
		let perX, perY, mathX, mathY;
		
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
