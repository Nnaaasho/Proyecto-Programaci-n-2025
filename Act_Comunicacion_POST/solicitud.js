document.getElementById("formulario").addEventListener("submit", async(e) => {
    e.preventDefault();

    const nombre = document.getElementById("nombre").value.trim();
    const razon = document.getElementById("razon").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const tipo = document.getElementById("tipo").value.trim();
    
if (!nombre || !correo || !razon || !telefono || !tipo){
    mensaje.textConent = "Todos los campos son obligatorios";
    mensaje.style.color = "red";
    return;
}
if (!correo.includes("@") || !correo.includes(".")){
    mensaje.textConent = "Ingrese un correo valido";
    mensaje.style.color = "red";
    return;
}
try{
    const respuesta = await fetch ("Act_Comunicacion_POST/api.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({nombre, razon, correo, telefono, tipo})
    });

const data = await respuesta.json();
if (data.estado === "ok"){
    mensaje.textConent = "Funciona" + data.mensaje;
    mensaje.style.color = "green";

}else{
mensaje.textConent = "Algo salio mal" + data.mensaje;
mensaje.style.color = "red";
}

} catch (error){
    mensaje.textConent = "error de conexion con el servidor";
    mensaje.style.color = "red";

}
});