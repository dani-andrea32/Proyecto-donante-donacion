// --- Constructores de objeto (POO) --- //
// Constructor para crear objetos de tipo proyecto //
function Proyecto(nombre, descripcion, estado) {
  this.nombre = nombre;
  this.descripcion = descripcion;
  this.estado = estado;


  // Método que devuelve el resumen del proyecto //
  this.obtenerResumen = function () {
      return  `${this.nombre}: ${this.descripcion} (Estado: ${this.estado})`;
  };
}



// Constructor para crear objetos de tipo evento //
function Evento(nombre, fecha, tipo) {
  this.nombre = nombre;
  this.fecha = fecha;
  this.tipo = tipo;



  // Método que devuelve los detalles del evento //
  this.obtenerDetalle = function () {
      return  `${this.nombre} - ${this.fecha} (${this.tipo})`;
  };
}



// Constructor para crear objetos de tipo donación //
function Donacion(monto) {
  this.monto = monto;
  this.fecha = new Date().toLocaleDateString();



  // Método que confirma la donación //
  this.confirmar = function () {
      return `Donación de $${this.monto.toFixed(2)} realizada el ${this.fecha}`;
  };
}



// ---Simulación de base de datos --- //
const proyectos = [
  {
      nombre: "Agua para Chile ",
      descripcion: "Instalación de agua potable en zonas extremas",
      estado: "Activo"
  },
  {
      nombre: "Reciclaje en la escuela",
      descripcion: "Implementar reciclaje en las escuelas para una mayor conciencia ambiental",
      estado: "Incompleto"
  }
];



// Lista de eventos disponibles //
const eventos = [
  { nombre: "Carrera día actividad fisica", fecha: "2025-08-20", tipo: "Deportivo" },
  { nombre: "Concierto Educativo", fecha: "2025-09-14", tipo: "Educativo" },
  { nombre: "Taller solidario de teatro", fecha: "2025-10-12", tipo: "Cultural" }
];



// Variable donde se acumula el total de donaciones //
let totalDonado = 0;



//---Mostar proyectos en pantalla---//
function mostrarProyectos() {
  const contenedor =document.getElementById("projects-container");
  contenedor.innerHTML = ""; // Limpiar contenido anterior
   // Recorrer todos los proyectos y mostrarlos //
  proyectos.forEach(proyecto => {
   const div = document.createElement("div");
   div.innerHTML = `
       <strong>${proyecto.nombre}</strong><br>
       ${proyecto.descripcion}<br>
       Estado: <em>${proyecto.estado}</em><hr>
       <button onclick="mostrarDetalleProyecto('${proyecto.nombre}')">Ver más</button>
       <hr>
   `;
  contenedor.appendChild(div); // Agregar al contenedor //
});
}



// --- Buscar eventos por texto ingresado --- //
function search() {
const termino = document.getElementById("events").value.toLowerCase();
 // Filtrar eventos que incluyen el termino en su nombre //
const resultados = eventos.filter(evento =>
  evento.nombre.toLowerCase().includes(termino)
);



const contenedor = document.getElementById("results-container");
contenedor.innerHTML = "<h3>Resultados:</h3>"; // Título de sección //



// Mostrar mensaje si no hay coincidencias //
if (resultados.length === 0) {
  contenedor.innerHTML += "<p>No se encontraron eventos.</p>";
} else {
  // Mostrar eventos encontrados //
  resultados.forEach(evento => {
    const div = document.createElement("div");
    div.innerHTML = `
    ${evento.nombre} - ${evento.fecha} (${evento.tipo})<br>
    <button onclick="mostrarDetalleEvento('${evento.nombre}')">Ver más</button>
    <hr>
    `;
    contenedor.appendChild(div);
  });
}
}



// Funciones de detalle //
function mostrarDetalleProyecto(nombre) {
  const proyecto = proyectos.find(p => p.nombre === nombre);
  if (proyecto) {
      alert(`Detalle del Proyecto:\n\nNombre: ${proyecto.nombre}\nDescripcion: ${proyecto.descripcion}\nEstado: ${proyecto.estado}`);
  }
}



function mostrarDetalleEvento(nombre) {
  const evento = eventos.find(e => e.nombre === nombre);
  if (evento) {
      alert(`Detalle del Evento:\n\nNombre: ${evento.nombre}\nFecha: ${evento.fecha}\nTipo: ${evento.tipo}`);
  }
}



// --- Donación y actualización en tiempo real --- //
function donate() {
const monto = parseFloat(document.getElementById("donation-amount").value); // Obtener monto ingresado //
const estado = document.getElementById("donation-status"); // Elemento donde se muestra el estado //



// Validar monto ingresado //
if (isNaN(monto) || monto <= 0) {
  estado.textContent = "Por favor, ingresa un monto válido.";
  return;
}



// Sumar al total donado y mostrar agradecimiento //
totalDonado += monto;
estado.textContent = `¡Gracias por donar $${monto.toFixed(2)}! Total recaudado: $${totalDonado.toFixed(2)}`;



// Activar notificación si se alcanza la meta pactada //
if (totalDonado >= 10000 && !notificaciones.includes("!Meta de $10.000 en donaciones alcanzada")) {
  agregarNotificacion("¡Meta de $10.000 en donaciones alcanzada!");
}



// Notificación por campaña activa //
if (totalDonado >= 5000 && totalDonado < 10000 && !notificaciones.includes("Vamos en la mitad de la meta de la campaña: ¡Lo podemos lograr!")) {
  agregarNotificacion("Vamos en la mitad de la meta de la campaña: ¡Lo podemos lograr!");
}
}



// --- Mostrar notificaciones importantes --- //
// Lista de notificaciones actuales //
const notificaciones = [
"Campaña 'Reciclaje en la escuela' incompleto.",
"Campaña 'Ayuda bomberos Fundo el Carmen' incompleto.",
"Nuevo evento: Concierto Educativo - 14 de septiembre.",
];



// Función para mostrar todas las notificaciones en la interfaz //
function mostrarNotificaciones() {
const lista = document.getElementById("notifications-list");
lista.innerHTML = ""; // Limpiar la lista anterior //



// Agregar cada notificación como un ítem de lista //
notificaciones.forEach(mensaje => {
  const li = document.createElement("li");
  li.textContent = mensaje;
  lista.appendChild(li);
});
}



// Función para agregar una nueva notificación y poder mostrarla al instante //
function agregarNotificacion(mensaje) {
if (!notificaciones.includes(mensaje)) {
  notificaciones.unshift(mensaje); // Añadir al principio del arreglo //
  mostrarNotificaciones();         // Actualizar la lista en la pantalla //
}
}



// --- Inicializar funciones al cargar la página --- //
document.addEventListener("DOMContentLoaded", () => {
mostrarProyectos();      // Mostrar lista de proyectos //
mostrarNotificaciones(); // Mostrar lista de notificaciones //
});
