class Newton{
    constructor( G, x, tol, bw ){
        const N = this;

        N.G = G;
        N.x = [];
        N.x[0] = x,
        N.tol = tol;
        N.boolWrite = bw;

        N.guide = [];
        N.tableItr = [];
		N.result = 0.00;

        // c_log(N);
        if(document.getElementById("methodName")){
            document.getElementById("methodName").innerHTML = "Method: Newton";
            document.getElementById("inputCrit").innerHTML = " Criteria <br> x1: <input id='fieldX1' type='number' />";
        }
    }

    iteration(){
        const N = this;
        N.guide = [];
        N.tableItr = [];
        
        let root = findRootExpr(),
            errorMessage = document.getElementById('error_message');
        // c_log(root);
        if(root.length == 0){
			if(errorMessage) errorMessage.innerHTML = "Error; No root detected.<hr>";
        }
        else if(root.length>=1){
            if(errorMessage) errorMessage.innerHTML = "";
			// c_log('more than 1 root detected');
			// c_log(root);
			root = findNearestRoot(root,this.x[0]);
            
            if(root.constructor.name!="Number"){
                if(errorMessage) errorMessage.innerHTML = "Error; No root detected.<hr>";
            }
            else{
                N.G.graphCenter( root, math.abs(root-this.x[0]) );
                // c_log( expr );
                let expr2 = math.derivative(expr,'x').toString();
                // c_log( expr2 );
                let x = this.x,
                    fx = [],
                    ffx = [],
                    result = null,
                    e = null;
        
                // c_log("n	Xn			f(Xn)		f'(Xn)		Xn+1		e");
                let i = 0;
                
                do {
                    fx[i] = evalMathExpr(x[i]);
                    ffx[i] = math.evaluate(expr2,{x:x[i]});
                    
                    e = Math.abs(root-x[i]);
                    x[i+1] = this.formula(i,x,fx,ffx);
                    // c_log(i+'	'+x[i].toFixed(5)+'     '+fx[i].toFixed(5)+'		'+ffx[i].toFixed(5)+'		'+x[i+1].toFixed(5)+'		'+e.toFixed(5)+'	'+!(e > this.tol));
                    
                    result = x[i+1];
                    N.saveTable(i, [ x[i], fx[i], ffx[i], x[i+1], e ]);
                    N.saveGuides((i),[ x[i], fx[i], 'l']);
                    i++;
                    if(ffx[i]==0) break;
                }
                while ( e > this.tol && i<25);
        
                N.result = result;
                // c_log(result.toString() +' ≈ '+ Math.round(parseFloat(result.toString())));
                
            }
		}
        N.G.refreshCanvas();

        if(N.boolWrite){
            N.writeLink();
            N.listTable();
            N.writeResult();
        }
    }
    
    formula(i,x,fx,ffx){
        return x[i] - ( fx[i]/ffx[i] );
    }
    
	saveGuides(i,g){
		this.guide[i] = g;
	}
    saveTable(i,arr){
		this.tableItr[i] = arr;
	}

    drawGuides(){
        const   N = this,
                G = N.G,
                ctxG = G.ctxGraph;
		let g = N.guide,
            i = 1,
            stop = g.length;

        let fS = document.getElementById("fieldStep");
        if( fS != null ){
            stop = parseInt(fS.value);
            stop++;
            fS.max = g.length;
            fS.max--;
        }

        if( stop>0 ){
            for( i=0; i<stop; i++ ){
                ctxG.beginPath();
                ctxG.strokeStyle = setting.guide_lines.marker;
                ctxG.arc( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y'), 2 , 0, 2*Math.PI );
                ctxG.stroke();
                ctxG.fillStyle = setting.guide_lines.marker;
                ctxG.fillText( "X"+i, G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y') );
            }
    
            ctxG.beginPath();
            ctxG.strokeStyle = setting.guide_lines.solid;
            for( i=1; i<g.length; i++ ){
                ctxG.moveTo( G.findCoords('math',g[i-1][0],'x'), G.findCoords('math',g[i-1][1],'y') );
                ctxG.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',0,'y') );
            }
            ctxG.stroke();
    
            ctxG.setLineDash([4, 2]);
            ctxG.beginPath();
            ctxG.strokeStyle = setting.guide_lines.dashed;
            // ctxG.strokeStyle = 2;
            for( i=1; i<g.length; i++) {
                ctxG.moveTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',0,'y') );
                ctxG.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y') );
            }
            ctxG.stroke();
            ctxG.setLineDash([0, 0]);

        }
	}

    // Writings
	writeLink(){
		let link = '';
		link += '?m='+3;
		link += '&f='+expr;
		link += '&x=['+this.x[0]+']';
		link += '&tol='+this.tol;
		// c_log(link);
		document.getElementById('viewLink').innerHTML = "<a class='' href='/simulator/stepbystepguide"+link+"'>View Step-by-Step</a>";
	}
	listTable(){
        let str =	"";
            str +=	"<thead>";
            str +=	"<tr>";
            str +=	"	<th>steps, n</th>";
            str +=	"	<th>Xn</th>";
            str +=	"	<th>f(Xn)</th> ";
            str +=	"	<th>f'(Xn)</th> ";
            str +=	"	<th>Xn+1</th>";
            str +=	"	<th>error, e</th> ";
            str +=	"</tr>";
            str +=	"</thead>";
    
            let j;
            str += "<tbody>";
		for(let i = 0; i < this.tableItr.length; i++) {
			j=1;
			str += "<tr>";
			str += "    <td>"+ (i) +"</td>";
			this.tableItr[i].forEach(itm=>{;
			str += "	<td> "+cleanMathRound(itm)+ "</td>";
			});
			str += "</tr>";
		}
            str += "<tbody>";

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
		document.getElementById("writeCriteria").innerHTML = "[ x1 = <t class='t-bold'>"+up.x[0]+"</t> ]";
		document.getElementById("writeTolerance").innerHTML = up.tol;
    }

    // Trigger Handling
    fieldCritX1(){
        let input = $('#fieldX1');
		const N = this;

		input.val(N.x[0]);
        input.change( function (e) {
            N.x[0] = parseFloat(input.val());
            N.iteration();
            N.G.refreshCanvas();
        });
    }
	fieldTolCrit(){
		let input = $('#fieldTol');
		const N = this;

		input.val(N.tol);

		input.change( function (e) {
			// c_log(this.a,input.val());
			if( input.val()!='' && parseFloat(input.val())!=0 ){
				// c_log(parseFloat(input.val())!=0);
				N.tol = parseFloat(input.val());
				N.iteration();
				N.G.refreshCanvas();

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
        this.fieldCritX1();
        this.fieldTolCrit();
    }
    

	fieldStep(){
		let N = this,
			input = $('#fieldStep');
		// N.G.graphCenter( root, (a-b)/2 );

		input.change( function (e) {
			if( input.val()!='' ){
				N.tableResultStep()
				// N.iteration();
				N.G.refreshCanvas();
			}else{
				// c_log("missing step");
			}
		});

	}
	tableResultStep(){
		let str =	"";
            str +=	"<thead>";
            str +=	"<tr>";
            str +=	"	<th>steps, n</th>";
            str +=	"	<th>Xn</th>";
            str +=	"	<th>f(Xn)</th> ";
            str +=	"	<th>f'(Xn)</th> ";
            str +=	"	<th>Xn+1</th>";
            str +=	"	<th>error, e</th> ";
            str +=	"</tr>";
            str +=	"</thead>";
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