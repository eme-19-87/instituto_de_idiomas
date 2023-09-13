const inputTel=document.querySelector("#telefono");
const maskNumber="####-######";
let current="";
let telNumber=[];


//keydown es el evento de presionar una tecla
inputTel.addEventListener("keydown",(e)=>{
	alert("Entra");
	e.preventDefault();
	//e.key es la tecla presionada
	handleInput(maskNumber,e.key,telNumber);
	//Cuando se termine de ejecutar handleInput, tendré en cardNumber los números y los separadores
	//uno lo que se encuentra en cardNumber en un solo string y lo coloco en el input
	inputTel.value=telNumber.join("");
});

/*NOTA: Debe colocarse el mismo addEventListener a todos los input para que funcionen de la misma manera.
Falta agregar un control a la fecha.*/
function handleInput(mask,key_pressed,arr){
	alert("Anda");
	//los caracteres válidos
	let numbers=['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
	//esto controla que se borren números en el input
	if (key_pressed=='Backspace' && arr.length>0){
		arr.pop();
		return;
	};
	
	//controla que la tecla presionada sea de un caracter válido y que los caracteres ingresados no superen
	//a los caracteres de la máscara
	if (numbers.includes(key_pressed) && arr.length+1<=mask.length){
		//si en la máscara se detecta el caracter sepearador
		if(mask[arr.length]=="-" || mask[arr.length]=="/"){
			//agrego dos elementos: primero el caracter separador y luego la tecla pulsada
			arr.push(mask[arr.length],key_pressed);
		}else{
			//si lo que detecto fue el #, solo coloco el número
			arr.push(key_pressed);
		}
	}
}