class Bisection{
	constructor(G,a,b,tol,bw){
		this.G = G;
		this.a = a;
		this.b = b;
		this.tol = tol;
		this.boolWrite = bw;

		this.guide = [];
		this.tabl = [];
		this.result = 0.00;

		// c_log("Bisection ready");
		c_log(this);

		document.getElementById("methodName").innerHTML = "Method: Bisection";
		document.getElementById("inputCrit").innerHTML = " Criteria <br> a: <input id='fieldA' type='number' /><br> b: <input id='fieldB' type='number' />";
	}

	iteration(){
		c_log(">> ITERATING... [ "+this.a+", "+this.b+" ]");

		var a = this.a,
			b = this.b,
			tol = this.tol,
			x = 0,
			fx = null,
			e = null,
			result = 0.00,
			root = findRangeRoot(findRootExpr(),a,b),
			iAB = {a:1,b:1};

		this.guide = [];
		this.tableItr = [];

		
		if(root.length==0){
			c_log("no root detected");
		}
		else{
			if(root.length>1){
				c_log('more than 1 root detected');
				c_log(root);
				
				// root = findNearestRoot(root,a);
			}else{
				c_log(farthestDistance(root,a,b));
				this.G.graphCenter( root, farthestDistance(root,a,b) );
				
				// c_log('available root = '+root);
		
				this.saveGuides(0,[ a, 0,'a1']);
				this.saveGuides(1,[ b, 0,'b1']);
				
				// c_log("n	a			b			x			f(x)	e");
				let i = 0;
				do {
					i++;
					x = this.formula(a,b);
					// c_log([a,b]);
					fx = evalMathExpr(x);
					e = Math.abs(root-x);

					// c_log(i+'	'+a.toFixed(5)+'		'+b.toFixed(5)+'		'+x.toFixed(5)+'		'+fx.toFixed(3)+'	'+e.toFixed(5)+'	'+!(e > this.tol));
					this.saveTable(i, [ a, b, x, fx, e, ]);
		
					if(fx<0){
						iAB.a++;
						a = x;
						this.saveGuides((i+1),[ x, fx, "a"+iAB.a ]);
					}
					else{
						iAB.b++;
						b = x;
						this.saveGuides((i+1),[ x, fx, "b"+iAB.b ]);
					} 
		
					
				} while ( e > tol && i<50);
				result = x;
		
				c_log('n = '+i+', '+result.toString()+' ≈ '+Math.round(parseFloat(result.toString())));
				this.result = result;
				// c_log(this.tableItr);
				// c_log(this.guide);
		
				this.G.refreshCanvas();
			}
			
			if(this.boolWrite){
				this.writeLink();
				this.listTable();
				this.writeResult();
			}
		}
	}

	formula(a,b){ return (a+b)/2; }
	
	saveGuides(i,g){
		this.guide[i] = g;
	}
	saveTable(i,arr){
		this.tableItr[i] = arr;
	}

	drawGuides(){
		let i = 1;
		let g = this.guide;
		let stop = g.length;
		const	G = this.G,
				ctx = G.ctxGraph;

		let fS = document.getElementById("fieldStep");
		if( fS != null ){
			stop = parseInt(fS.value);
			stop+=2;
			// c_log(stop);
			fS.max = g.length;
			fS.max-=2;
		}

		if( stop>0 ){
			// Set all points
			for(i=0; i<stop; i++){
				ctx.beginPath();
				ctx.arc( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y'), 2 , 0, 2*Math.PI );
				ctx.stroke();
				// ctx.fillText( g[i][2], G.findCoords('math',g[i][0],'x')+2, G.findCoords('math',g[i][1],'y')+14 );
				ctx.fillText( "x"+(i+1), G.findCoords('math',g[i][0],'x')+2, G.findCoords('math',g[i][1],'y')+12 );
			}

			ctx.beginPath();
			for(i=2; i<stop; i++) {
				ctx.moveTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i-1][1],'y') );
				ctx.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y') );
			}
			ctx.stroke();

			ctx.setLineDash([4, 2]);
			ctx.beginPath();
			for(i=3; i<stop; i++) {
				ctx.moveTo( G.findCoords('math',g[i-1][0],'x'), G.findCoords('math',g[i-1][1],'y') );
				ctx.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i-1][1],'y') );
			}
			ctx.stroke();
			ctx.setLineDash([0, 0]);
		}
		else{
			// c_log("no guides recorded");
		}
	}

	// Writings
	writeLink(){
		var link = '';
		link += '?m='+1;
		link += '&f='+expr;
		link += '&x=['+this.a+','+this.b+']';
		link += '&tol='+this.tol;
		// c_log(link);
		document.getElementById('viewLink').innerHTML = "<a class='' href='/simulator/stepbystepguide"+link+"'>View Step-by-Step</a>";
	}
	listTable(){
		let str = '<thead><tr> <th>steps, n</th> <th>a</th> <th>b</th> <th>midpoint, x</th> <th>f(x)</th> <th>error, e</th> </tr></thead>';
		let row = this.tableItr.length;
		
		str += "<tbody>";
		for(let i = 1; i < row; i++) {
			
			str += "<tr>";
			str += "<td class='td-cent'>"+ (i) +"</td>";
			this.tableItr[i].forEach(itm=>{
				str += "<td > "+itm+ "</td>";
			});
			str += "</tr>";
		}
		str += "</tbody>";

		document.getElementById("tableIter").innerHTML = str;
	}
	writeResult(){
		document.getElementById("result").innerHTML = "x = "+(this.result)+' ≈ '+Math.round(this.result);
	}
	writeCriterias(){
		// c_log(urlParams);
		// document.getElementById("").innerHTML = ;
		document.getElementById("fieldFunc").innerHTML = urlParams.f;
		document.getElementById("inputCrit").innerHTML = "[ a = <t class='txt_bold'>"+urlParams.a+"</t>, b = <t class='txt_bold'>"+urlParams.b+"</t> ]";
		document.getElementById("fieldTol").innerHTML = urlParams.tol;
	}

	// Trigger Handling
	fieldStartCrit(){
		var input = $('#fieldA');
		const B = this;

		input.val(B.a);

		input.change( function (e) {
			// c_log(this.a,input.val());
			if( input.val()!='' ){
				B.a = parseFloat(input.val());
				B.iteration();
				B.G.refreshCanvas();

			}else{
				c_log("missing a");
			}
		});
	}
	fieldEndCrit(){
		var input = $('#fieldB');
		const B = this;

		input.val(B.b);

		input.change( function (e) {
			// c_log(this.a,input.val());
			if( input.val()!='' ){
				B.b = parseFloat(input.val());
				B.iteration();
				B.G.refreshCanvas();

			}else{
				c_log("missing b");
			}
		});
	}
	fieldTolCrit(){
		var input = $('#fieldTol');
		const B = this;

		input.val(B.tol);

		input.change( function (e) {
			// c_log(this.a,input.val());
			if( input.val()!='' && parseFloat(input.val())!=0 ){
				// c_log(parseFloat(input.val())!=0);
				B.tol = parseFloat(input.val());
				B.iteration();
				B.G.refreshCanvas();

			}else if( input.val()=='' ){
				c_log("missing tolerance");
			}else if( parseFloat(input.val())==0 ){
				c_log("unacceptable tolerance: "+input.val());
			}else {
				c_log("problematic input: "+input.val());
			}
		});
	}

	// Function Handling
	fieldsTriggers(){
		this.fieldStartCrit();
		this.fieldEndCrit();
		this.fieldTolCrit();
	}

	// Step Handling
	fieldStep(){
		let B = this,
			input = $('#fieldStep');
		// B.G.graphCenter( root, (a-b)/2 );

		input.change( function (e) {
			if( input.val()!='' ){
				B.tableResultStep()
				B.G.refreshCanvas();
			}else{
				c_log("missing step");
			}
		});

	}
	tableResultStep(){
		let str = '<tr> <th>steps, n</th> <th>a</th> <th>b</th> <th>midpoint, x</th> <th>f(x)</th> <th>error, e</th> </tr>';
		let row = this.tableItr.length;
		let i = 0;
		let stepResult = 0;

		let fS = document.getElementById("fieldStep");
		if( fS != null ){
			row = fS.value;
			row++;
		} 
		
		for(i = 1; i < row; i++) {
			
			str += "<tr>";
			str += "<td>"+ (i) +"</td>";
			this.tableItr[i].forEach(itm=>{
				str += "<td> "+itm+ "</td>";
			});
			str += "</tr>";
		}
		if(i == row && i<this.tableItr.length){
			str += "<tr>";
			str += "<td>"+ (i) +"</td>";
			str += "<td> "+this.tableItr[i][0]+ "</td>";
			str += "<td> "+this.tableItr[i][1]+ "</td>";
			str += "</tr>";
		}

		document.getElementById("tableIter").innerHTML = str;

		row--;
		if(row==0) stepResult = 0;
		else if(row>0) stepResult = this.tableItr[row][2];
		document.getElementById("result").innerHTML = "x = "+(stepResult)+' ≈ '+Math.round(stepResult);
	}
}