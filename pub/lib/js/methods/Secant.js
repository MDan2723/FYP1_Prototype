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
		c_log(S);

		document.getElementById("methodName").innerHTML = "Method: Secant";
		document.getElementById("inputCrit").innerHTML = " Criteria <br> x1: <input id='fieldX1' type='number' /><br> x2: <input id='fieldX2' type='number' />";
    }
    
    
    iteration(){
        const S = this;
        var x = S.x,
            fx = [],
            e = null,
            result = null,
			root = findRangeRoot(findRootExpr(),x[1],x[0]);
            
        S.guide = [];
        S.tableItr = [];
        
		S.G.graphCenter( root, farthestDistance(root,x[1],x[0]) );
        // c_log(root);
        if(root.length==0){
			c_log("no root detected");
		}
		else{
            if(root.length>1){
                c_log('more than 1 root detected');
                c_log(root);
                root = findNearestRoot(root,x[1]);
                c_log(root);
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
            c_log(result.toString() +' ≈ '+ Math.round(parseFloat(result.toString())));
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
                G = S.G;
		let g = S.guide,
            i = 1,
            stop = g.length,
            ctxG = G.ctxGraph;

        let fS = document.getElementById("fieldStep");
        if( fS != null ){
            stop = parseInt(fS.value);
            // stop+=2;
            // c_log(stop);
            fS.max = g.length;
            fS.max--;
        }

		if( stop>0 ){
            for( i=0; i<stop; i++ ){
                ctxG.beginPath();
                ctxG.arc( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y'), 2 , 0, 2*Math.PI );
                ctxG.stroke();
                ctxG.fillText( "X"+i, G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y') );
            };

            ctxG.beginPath();
            for( i=1; i<stop; i++ ){
                ctxG.moveTo( G.findCoords('math',g[i-1][0],'x'), G.findCoords('math',g[i-1][1],'y') );
                ctxG.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y') );
            }
            ctxG.stroke();

            ctxG.setLineDash([4, 2]);
            ctxG.beginPath();
            for( i=2; i<stop; i++) {
                ctxG.moveTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',0,'y') );
                ctxG.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y') );
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
		link += '?m='+2;
		link += '&f='+expr;
		link += '&a='+this.a;
		link += '&b='+this.b;
		link += '&tol='+this.tol;
		// c_log(link);
		document.getElementById('viewLink').innerHTML = "<a class='' href='../stepbystepguide/index.html"+link+"'>View Step-by-Step</a>";
	}
	listTable(){
		var str = '<thead><tr> <th>steps, n</th> <th>Xn</th> <th>f(Xn)</th> <th>Xn+1</th> <th>error, e</th> </tr></thead>';

        str += "<tbody>";
		for(var i = 0; i < this.tableItr.length; i++) {
            
			str += "<tr>";
			str += "<td>"+ (i) +"</td>";
			this.tableItr[i].forEach(itm=>{
                str += "<td> "+itm+ "</td>";
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
		document.getElementById("inputCrit").innerHTML = "[ x1 = <t class='txt_bold'>"+urlParams.a+"</t>, x2 = <t class='txt_bold'>"+urlParams.b+"</t> ]";
		document.getElementById("fieldTol").innerHTML = urlParams.tol;
	}

    // Trigger Handling
    fieldCritX1(){
        var input = $('#fieldX1');
		const S = this;

		input.val(S.x[0]);
        input.change( function (e) {
            S.x[0] = parseFloat(input.val());
            
            S.iteration();
            S.G.refreshCanvas();
        });
    }
    fieldCritX2(){
        var input = $('#fieldX2');
		const S = this;

		input.val(S.x[1]);
        input.change( function (e) {
            S.x[1] = parseFloat(input.val());

            S.iteration();
            S.G.refreshCanvas();
        });
    }
	fieldTolCrit(){
		var input = $('#fieldTol');
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
				refreshCanvas();
			}else{
				c_log("missing step");
			}
		});

	}
	tableResultStep(){
		let str = '<tr> <th>steps, n</th> <th>x[n]</th> <th>f(x)</th> <th>x[n+1]</th> <th>error, e</th> </tr>';
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