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
		// c_log(this);

		if(document.getElementById("methodName")){
			document.getElementById("methodName").innerHTML = "Method: Bisection";
			document.getElementById("inputCrit").innerHTML = " Criteria <br> a: <input id='fieldA' type='number' /><br> b: <input id='fieldB' type='number' />";
		}

	}

	iteration(){
		// c_log(">> ITERATING... [ "+this.a+", "+this.b+" ]");

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
		let errorMessage = document.getElementById('error_message');
		
		if(root.length==0){
			// c_log("no root detected");
			errorMessage.innerHTML = "Error; No root detected.<hr>";
		}
		else{
			if(root.length>1){
				// c_log('more than 1 root detected');
				// c_log(root);
				
				// root = findNearestRoot(root,a);
				errorMessage.innerHTML = "Error; More than one root detected.<hr>";
			}else{
				// c_log(farthestDistance(root,a,b));
				if(errorMessage)
				errorMessage.innerHTML = "";
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
		
				// c_log('n = '+i+', '+result.toString()+' ≈ '+Math.round(parseFloat(result.toString())));
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
		const	G = this.G,
				ctxG = G.ctxGraph;
		let i = 1,
			g = this.guide,
			stop = g.length;

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
				ctxG.beginPath();
				ctxG.strokeStyle = setting.guide_lines.marker;
				ctxG.arc( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y'), 2 , 0, 2*Math.PI );
				ctxG.stroke();
				// ctxG.fillText( g[i][2], G.findCoords('math',g[i][0],'x')+2, G.findCoords('math',g[i][1],'y')+14 );			
				ctxG.fillStyle = setting.guide_lines.marker;
				ctxG.fillText( "x"+(i+1), G.findCoords('math',g[i][0],'x')+2, G.findCoords('math',g[i][1],'y')+12 );
			}

			ctxG.beginPath();
			ctxG.strokeStyle = setting.guide_lines.solid;
			for(i=2; i<stop; i++) {
				ctxG.moveTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i-1][1],'y') );
				ctxG.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y') );
			}
			ctxG.stroke();

			ctxG.setLineDash([4, 2]);
			ctxG.beginPath();
			ctxG.strokeStyle = setting.guide_lines.dashed;
			for(i=3; i<stop; i++) {
				ctxG.moveTo( G.findCoords('math',g[i-1][0],'x'), G.findCoords('math',g[i-1][1],'y') );
				ctxG.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i-1][1],'y') );
			}
			ctxG.stroke();
			ctxG.setLineDash([0, 0]);
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
		let str =	"";
			str +=	"<thead>";
			str +=	"<tr>";
			str +=	"	<th>steps, n</th>";
			str +=	"	<th>a</th>";
			str +=	"	<th>b</th> ";
			str +=	"	<th>midpoint, x</th>";
			str +=	"	<th>f(x)</th> ";
			str +=	"	<th>error, e</th> ";
			str +=	"</tr>";
			str +=	"</thead>";
		let row = this.tableItr.length;
		let j;

			str += "<tbody>";
		for(let i = 1; i < row; i++) {
			j=1;
			str += "<tr>";

			str += "	<td class='td-cent'>"+ (i) +"</td>";
			this.tableItr[i].forEach(itm=>{
			str += "	<td> "+cleanMathRound(itm)+ "</td>";
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

		urlParams = parseURLParams(document.URL);
		let up = urlParams;
			up.x = up.x.toString();
			up.x = up.x.replace('[','').replace(']','');
			up.x = up.x.split(',');
		c_log(up);
		var method; 
		switch( parseInt(up.m) ){
			case 1: method = "Bisection"; 
				break;
			case 2: method = "Secant"; 
				break;
			case 3: method = "Newton"; 
				break;
		}
		document.getElementById("writeMethod").innerHTML = method+' Method';
		document.getElementById("writeFunc").innerHTML = up.f;
		document.getElementById("writeCriteria").innerHTML = "[ a = <t class='t-bold'>"+up.x[0]+"</t>, b = <t class='t-bold'>"+up.x[1]+"</t> ]";
		document.getElementById("writeTolerance").innerHTML = up.tol;
	}

	// Trigger Handling
	fieldStartCrit(){
		const B = this;
		var inputA = $('#fieldA');
		var inputB = document.getElementById('fieldB');
		
		inputB.min = B.a+1;
		inputA.val(B.a);

		inputA.change( function (e) {
			// c_log(this.a,input.val());
			if( inputA.val()!='' ){
				B.a = parseFloat(inputA.val());
				B.iteration();
				B.G.refreshCanvas();
				inputB.min = parseInt(inputA.val())+1;

			}else{
				// c_log("missing a");
			}
		});
	}
	fieldEndCrit(){
		const B = this;
		var inputB = $('#fieldB');
		var inputA = document.getElementById('fieldA');
		
		inputA.max = B.b-1;
		inputB.val(B.b);

		inputB.change( function (e) {
			// c_log(this.a,input.val());
			if( inputB.val()!='' ){
				B.b = parseFloat(inputB.val());
				B.iteration();
				B.G.refreshCanvas();
				inputA.max = parseInt(inputB.val())-1;
			}else{
				// c_log("missing b");
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
				// c_log("missing tolerance");
			}else if( parseFloat(input.val())==0 ){
				// c_log("unacceptable tolerance: "+input.val());
			}else {
				// c_log("problematic input: "+input.val());
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
				B.iteration();
				B.G.refreshCanvas();
			}else{
				// c_log("missing step");
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
			str += "<td class='t-cent'>"+ (i) +"</td>";
			this.tableItr[i].forEach(itm=>{
				str += "<td> "+cleanMathRound(itm)+ "</td>";
			});
			str += "</tr>";
		}
		if(i == row && i<this.tableItr.length){
			str += "<tr>";
			str += "<td class='t-cent'>"+ (i) +"</td>";
			str += "<td> "+cleanMathRound(this.tableItr[i][0])+ "</td>";
			str += "<td> "+cleanMathRound(this.tableItr[i][1])+ "</td>";
			str += "</tr>";
		}

		document.getElementById("tableIter").innerHTML = str;

		row--;
		if(row==0) stepResult = 0;
		else if(row>0) stepResult = this.tableItr[row][2];
		document.getElementById("result").innerHTML = "x = "+(stepResult)+' ≈ '+Math.round(stepResult);
	}
}