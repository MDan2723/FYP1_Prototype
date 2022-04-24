class Secant{
    constructor( G, xb, xa, tol, bw ){
        const S = this;
        S.G = G;
        S.x = [];
        S.x[0] = xb,
        S.x[1] = xa,
        S.tol = tol;
        S.boolWrite = bw;

        S.guide = [];
		S.tableItr = [];
		S.result = 0.00;

        // c_log("Secant ready");
		// c_log(S);
        if(document.getElementById("methodName")){
            document.getElementById("methodName").innerHTML = "Method: Secant";
            document.getElementById("inputCrit").innerHTML = " Criteria <br> x1: <input id='fieldX1' type='number' /><br> x2: <input id='fieldX2' type='number' />";
        }
    }
    
    
    iteration(){
        const S = this;
        let x = S.x,
            fx = [],
            e = null,
            result = null,
			root = findRangeRoot(findRootExpr(),x[1],x[0]);
            
        S.guide = [];
        S.tableItr = [];
        
		S.G.graphCenter( root, farthestDistance(root,x[1],x[0]) );
        let errorMessage = document.getElementById('error_message');
        // c_log(root);
        if(root.length==0){
			// c_log("no root detected");
			if(errorMessage) errorMessage.innerHTML = "Error; No root detected.<hr>";
		}
		else{
            if(errorMessage) errorMessage.innerHTML = "";
            if(root.length>1){
                // c_log('more than 1 root detected');
                // c_log(root);
                root = findNearestRoot(root,x[1]);
                // c_log(root);
            }

            e = Math.abs(root-x[1]);
    
            // c_log("n	Xn			f(Xn)		Xn+1		e");
            let i = 0;
            do {
                fx[i] = evalMathExpr(x[i]);
                e = Math.abs(root-x[i]);
                if(i==0){
                    // c_log(i+'	'+x[i].toFixed(5)+'    '+fx[i].toFixed(5)+'		'+'------'+'		'+e.toFixed(5)+'	'+!(e > this.tol));
                }
                else{
                    x[i+1] = S.formula(i,x,fx);
                    
                    // c_log(i+'	'+x[i].toFixed(5)+'    '+fx[i].toFixed(5)+'		'+x[i+1].toFixed(5)+'		'+e.toFixed(5)+'	'+!(e > this.tol));
                }

                result = x[i+1];
                S.saveTable(i, [ x[i], fx[i], x[i+1], e ]);
                S.saveGuides((i),[ x[i], fx[i],'l']);
                i++;
            }
            while ( e > this.tol );

            fx[i] = evalMathExpr(x[i]);
            S.saveGuides((i),[ x[i], fx[i],'l']);
            // c_log(result.toString() +' ≈ '+ Math.round(parseFloat(result.toString())));
            S.result = result;

            S.G.refreshCanvas();

            if(S.boolWrite){
                S.writeLink();
                S.listTable();
                S.writeResult();
            }
        }
    }
    
    formula(i,x,fx){
        return x[i] - ( (fx[i] * (x[i]-x[i-1]))/(fx[i]-fx[i-1]) )
    }
    
	saveGuides(i,g){
		this.guide[i] = g;
	}
    saveTable(i,arr){
		this.tableItr[i] = arr;
	}

    drawGuides(){
        const   S = this,
                G = S.G,
                ctxG = G.ctxGraph;
		let g = S.guide,
            i = 1,
            stop = g.length;

        let fS = document.getElementById("fieldStep");
        if( fS != null ){
            stop = parseInt(fS.value);
            stop++;
            fS.max = g.length;
            fS.max-=2;
        }

        if( stop>0 ){
            for( i=0; i<=stop; i++ ){
                if(i<g.length){
                    ctxG.beginPath();
                    ctxG.strokeStyle = setting.guide_lines.marker;
                    ctxG.arc( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y'), 2 , 0, 2*Math.PI );
                    ctxG.stroke();
                    ctxG.fillStyle = setting.guide_lines.marker;
                    ctxG.fillText( "X"+i, G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y') );
                }
            };

            ctxG.beginPath();
            ctxG.strokeStyle = setting.guide_lines.solid;
            for( i=1; i<stop; i++ ){
                if(i<g.length-1){
                    ctxG.moveTo( G.findCoords('math',g[i-1][0],'x'), G.findCoords('math',g[i-1][1],'y') );
                    ctxG.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y') );
                    ctxG.lineTo( G.findCoords('math',g[i+1][0],'x'), G.findCoords('math',0,'y') );
                }
            }
            ctxG.stroke();

            ctxG.setLineDash([4, 2]);
            ctxG.beginPath();
            ctxG.strokeStyle = setting.guide_lines.dashed;
            for( i=1; i<stop; i++) {
                if(i<g.length-1){
                    ctxG.moveTo( G.findCoords('math',g[i+1][0],'x'), G.findCoords('math',0,'y') );
                    ctxG.lineTo( G.findCoords('math',g[i+1][0],'x'), G.findCoords('math',g[i+1][1],'y') );
                }
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
		let link = '';
		link += '?m='+2;
		link += '&f='+expr;
		link += '&x=['+this.x[1]+','+this.x[0]+']';
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
		document.getElementById("writeCriteria").innerHTML = "[ x1 = <t class='t-bold'>"+up.x[1]+"</t>, x2 = <t class='t-bold'>"+up.x[0]+"</t> ]";
		document.getElementById("writeTolerance").innerHTML = up.tol;
    }

    // Trigger Handling
    fieldCritX1(){
		const S = this;
        let inputX1 = $('#fieldX1');
        let inputX2 = document.getElementById('fieldX2');
        
		inputX1.val(S.x[0]);
        inputX2.max = S.x[0]-1;

        inputX1.change( function (e) {
            S.x[0] = parseFloat(inputX1.val());
            inputX2.max = parseInt(inputX1.val())-1;
            
            S.iteration();
            S.G.refreshCanvas();
        });
    }
    fieldCritX2(){
        const S = this;
        let inputX2 = $('#fieldX2');
        let inputX1 = document.getElementById('fieldX1');
        
		inputX2.val(S.x[1]);
        inputX1.min = S.x[1]+1;

        inputX2.change( function (e) {
            S.x[1] = parseFloat(inputX2.val());
            inputX1.min = parseInt(inputX2.val())+1;

            S.iteration();
            S.G.refreshCanvas();
        });
    }
	fieldTolCrit(){
		let input = $('#fieldTol');
		const S = this;

		input.val(S.tol);

		input.change( function (e) {
			// c_log(this.a,input.val());
			if( input.val()!='' && parseFloat(input.val())!=0 ){
				// c_log(parseFloat(input.val())!=0);
				S.tol = parseFloat(input.val());
				S.iteration();
				refreshCanvas();

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
        this.fieldCritX2();
        this.fieldTolCrit();
    }

	// Step Handling
	fieldStep(){
		// graphCenter( root, (a-b)/2 );
		let B = this,
			input = $('#fieldStep');

		input.change( function (e) {
			if( input.val()!='' ){
				B.tableResultStep()
				// B.iteration();
				B.G.refreshCanvas();
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
		
		for(i = 0; i < row; i++) {
			
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