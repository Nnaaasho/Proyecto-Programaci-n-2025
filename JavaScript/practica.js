var nombre = "Ana";
let edad = 25;
const PI = 3.1416;
/*
let radio = prompt("Cuanto mide el radio");
let radioEnNumero = parseInt (radio);

function calcularCirculo(radio){
    let resultado = (radio ** 2) / Math.PI;
    return resultado;
}
console.log(calcularCirculo(10));
*/
function calcularRectangulo(){
    let base = prompt("Ingrese la base del rectangulo");
    let alto = prompt("Ingrese el alto del rectangulo");

    baseEnNumero = parseInt(base);
    altoEnNumero = parseInt(alto);
 
    const altura = baseEnNumero * altoEnNumero;
    const perimetro = baseEnNumero + baseEnNumero + altoEnNumero + altoEnNumero;
    return altura, perimetro;

}
console.log(calcularRectangulo());

