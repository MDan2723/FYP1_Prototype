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

        c_log(N);
		document.getElementById("methodName").innerHTML = "Method: Newton";
		document.getElementById("inputCrit").innerHTML = " Criteria <br> x1: <input id='fieldX1' type='number' />";
    }

    iteration(){
        const N = this;
        N.guide = [];
        N.tableItr = [];
        
        var root = findRootExpr();
        if(root.length>1){
			c_log('more than 1 root detected');
			// c_log(root);
			
			root = findNearestRoot(root,this.x[0]);
		}
        c_log(root);
        N.G.graphCenter( root, math.abs(root-this.x[0]) );

        // c_log( expr );
        var expr2 = math.derivative(expr,'x').toString();
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
        c_log(result.toString() +' ≈ '+ Math.round(parseFloat(result.toString())));
        
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
                gCtx = G.ctxGraph;
		var g = N.guide,
            i = 1;
		g.forEach(el => {
			gCtx.beginPath();
			gCtx.arc( G.findCoords('math',el[0],'x'), G.findCoords('math',el[1],'y'), 2 , 0, 2*Math.PI );
			gCtx.stroke();
            gCtx.fillText( "X"+i, G.findCoords('math',el[0],'x'), G.findCoords('math',el[1],'y') );
            i++;
		});

        gCtx.beginPath();
        for( var i=1; i<g.length; i++ ){
			gCtx.moveTo( G.findCoords('math',g[i-1][0],'x'), G.findCoords('math',g[i-1][1],'y') );
			gCtx.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',0,'y') );
        }
		gCtx.stroke();

        gCtx.setLineDash([4, 2]);
        gCtx.beginPath();
        for(var i=1; i<g.length; i++) {
            gCtx.moveTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',0,'y') );
            gCtx.lineTo( G.findCoords('math',g[i][0],'x'), G.findCoords('math',g[i][1],'y') );
        }
        gCtx.stroke();
        gCtx.setLineDash([0, 0]);
	}

    // Writings
	writeLink(){
		var link = '';
		link += '?m='+3;
		link += '&f='+expr;
		link += '&x=['+this.x[0]+']';
		link += '&tol='+this.tol;
		// c_log(link);
		document.getElementById('viewLink').innerHTML = "<a class='' href='../stepbystepguide/index.html"+link+"'>View Step-by-Step</a>";
	}
	listTable(){
		var str = "<tr> <th>steps, n</th> <th>Xn</th> <th>f(Xn)</th> <th>f'(Xn)</th> <th>Xn+1</th> <th>error, e</th> </tr>";

		for(var i = 0; i < this.tableItr.length; i++) {
			
			str += "<tr>";
			str += "<td>"+ (i) +"</td>";
			this.tableItr[i].forEach(itm=>{
				str += "<td> "+itm+ "</td>";
			});
			str += "</tr>";
		}

		document.getElementById("tableIter").innerHTML = str;
	}
	writeResult(){
		document.getElementById("result").innerHTML = "x = "+(this.result)+' ≈ '+Math.round(this.result);
	}

    // Trigger Handling
    fieldCritX1(){
        var input = $('#fieldX1');
		const N = this;

		input.val(N.x[0]);
        input.change( function (e) {
            N.x[0] = parseFloat(input.val());
            N.iteration();
            N.G.refreshCanvas();
        });
    }
	fieldTolCrit(){
		var input = $('#fieldTol');
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
        this.fieldTolCrit();
    }
    

}