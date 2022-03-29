class MathEval{
	constructor(){}
	
}

var urlParams = parseURLParams(document.URL);

var exmpl = [
			'sin(x)', 'cos(x)', 'tan(x)',
			'x^2', 'x^3', '((x-4)^3)/4', '((x+3)/4)^2-4'
		],
		mathGraph = mathjs(),
		expr = "";

(urlParams)? expr = urlParams.f[0]: expr = exmpl[ 6 ]; // take from URL

var scope = { x: 0 },
	tree = mathGraph.parse(expr, scope);
	
// Math Handling
function evalMathExpr(mathX){
	scope.x = mathX;
	return tree.eval();
}

function findRootExpr(tempExpr){
	let expression;
	if( tempExpr!=null ){
		expression = tempExpr;
	}
	else{
		if ( expr!='' ){
			expression = expr;
			return rootFinder(expression);
		}
	}
	// console.log(r);
	// return parseInt((x.toString().split(',',1)).toString().split('[')[1]);
}
function rootFinder(expression){
	var x = nerdamer.solve('0='+expression, 'x'),
	s = x.toString(),
	s = s.replace('[','').replace(']',''),
	s = s.split(','),
	r = [],
	i = 0;

	s.forEach(el=>{
		r[i] = math.evaluate(el);
		i++;
	})

	r.sort(function(a, b){return b - a});
	r.reverse();
	return r;
}

function findRangeRoot(r,x1,x2){
	var newR = [], i=0;
	r.forEach(el=>{
		if( el>x1 && el<x2 ){
			console.log( x1+' -->', el, '<-- '+x2 );
			newR[i] = el;
			i++;
		}
		else if(el==x1 || el==x2 ){
			// ( el==x1 )? c_log( x1+' = '+ el):c_log( x2+' = '+ el);
			console.log( 'root -->', el);
			newR[i] = el;
			i++;
		}
	})
	return newR;
}

function findNearestRoot(r,x){
	return r.reduce((a, b) => {
		return Math.abs(b - x) < Math.abs(a - x) ? b : a;
	});
}

function findM(x){
	math.evaluate(math.derivative(expr,'x').toString(),);
}

function farthestDistance(root,x1,x2){
	// c_log( Math.abs(root-x1)+","+Math.abs(root-x2) );
	if ( Math.abs(root-x1) > Math.abs(root-x2))
		return Math.abs(root-x1);
	else
		return Math.abs(root-x2);
}