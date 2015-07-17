cont=0;
function soloNumeros(e){
	var nav4 = window.Event ? true : false;
    var key = nav4 ? e.which : e.keyCode; 
    return (key <= 13 || key==46 ||  (key >= 38 && key <= 57)); 
}


function nuevo_reg()
{
	//fila es el ultimo nodo
	fila=document.getElementById('fila_'+cont);
	cont=document.getElementById("CONT").value;
	crea_fila(fila,cont);
}

function crea_fila(fila,cont)
	{
	cont++;
	nueva_fila=document.getElementById('fila_'+(cont-1)).cloneNode(false);
	nueva_fila.id="fila_"+cont;

	nueva_col=document.createElement("td");
	nueva_col.setAttribute("valign","top");
	nuevo_camp=document.getElementById("K_"+(cont-1)).cloneNode(true);
	nuevo_camp.name="K_"+cont;
	nuevo_camp.id="K_"+cont;
	nuevo_camp.value="";
	nueva_col.appendChild(nuevo_camp);
	nueva_fila.appendChild(nueva_col);

	nueva_col=document.createElement("td");
	nueva_col.setAttribute("valign","top");
	nuevo_camp=document.getElementById("D_"+(cont-1)).cloneNode(true);
	nuevo_camp.name="D_"+cont;
	nuevo_camp.id="D_"+cont;
	nuevo_camp.value="";
	nuevo_camp.disabled=false;
	nueva_col.appendChild(nuevo_camp);
	nueva_fila.appendChild(nueva_col);

	nueva_col=document.createElement("td");
	nueva_col.setAttribute("valign","top");
	nuevo_camp=document.getElementById("H_"+(cont-1)).cloneNode(true);
	nuevo_camp.name="H_"+cont;
	nuevo_camp.id="H_"+cont;
	nuevo_camp.value="";
	nuevo_camp.disabled=false;
	nueva_col.appendChild(nuevo_camp);
	nueva_fila.appendChild(nueva_col);

	nueva_col=document.createElement("td");
	nueva_col.setAttribute("valign","top");
	nuevo_camp=document.getElementById("a_"+(cont-1)).cloneNode(true);
	nuevo_camp.name="a_"+cont;
	nuevo_camp.id="a_"+cont;
	nuevo_camp.value="";
	nueva_col.appendChild(nuevo_camp);
	nueva_fila.appendChild(nueva_col);

	nueva_col=document.createElement("td");
	nueva_col.setAttribute("valign","top");

	nueva_fila.appendChild(nueva_col);

	fila.parentNode.appendChild(nueva_fila,fila.nextSibling);

	document.getElementById("CONT").value=cont;
	
	}

function format(input)
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
}