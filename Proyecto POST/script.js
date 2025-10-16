// Agrega un listener al formulario con id "formRegistro" para el evento submit
document.getElementById("formRegistro").addEventListener("submit", async (e) => {
  // Previene el comportamiento por defecto del formulario (recargar la página)
  e.preventDefault();

  // Obtiene y limpia el valor del campo nombre
  const nombre = document.getElementById("nombre").value.trim();
  // Obtiene y limpia el valor del campo email
  const email = document.getElementById("email").value.trim();
  // Obtiene y limpia el valor del campo password
  const tipo = document.getElementById("tipo").value.trim();
  const telefono = document.getElementById("telefono").value.trim();
  const razon = document.getElementById("razon").value.trim();
  
  // Obtiene el elemento donde se mostrarán los mensajes
  const mensaje = document.getElementById("mensaje");

  // Verifica si algún campo está vacío
  if (!nombre || !email || !tipo || !telefono || !razon) {
    // Muestra mensaje de error si hay campos vacíos
    mensaje.textContent = "⚠️ Todos los campos son obligatorios.";
    mensaje.style.color = "red";
    return;
  }

  // Valida que el email tenga un formato básico correcto
  if (!email.includes("@") || !email.includes(".")) {
    // Muestra mensaje de error si el email no es válido
    mensaje.textContent = "⚠️ Ingresa un correo válido.";
    mensaje.style.color = "red";
    return;
  }

  try {
    // Envía los datos al servidor usando fetch con método POST y formato JSON
    const respuesta = await fetch("api/Registrar.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ nombre, email, tipo, telefono, razon })
    });

    // Espera la respuesta del servidor en formato JSON
    const data = await respuesta.json();

    // Si el registro fue exitoso, muestra mensaje de éxito
    if (data.estado === "ok") {
      mensaje.textContent = "✅ " + data.mensaje;
      mensaje.style.color = "green";
    } else {
      // Si hubo un error, muestra mensaje de advertencia
      mensaje.textContent = "⚠️ " + data.mensaje;
      mensaje.style.color = "red";
    }

  } catch (error) {
    // Si ocurre un error en la conexión, muestra mensaje de error
    mensaje.textContent = "❌ Error de conexión con el servidor.";
    mensaje.style.color = "red";
  }
});