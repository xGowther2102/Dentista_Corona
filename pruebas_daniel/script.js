// Datos de ejemplo (puedes reemplazarlos con tus propios datos)
const data = [
    { id: 1, nombre: "Juan Pérez", telefono: "123456789", correo: "juan@example.com", edad: 30, sexo: "M", padecimiento: "Ninguno" },
    { id: 2, nombre: "María López", telefono: "987654321", correo: "maria@example.com", edad: 25, sexo: "F", padecimiento: "Asma" },
    // Agrega más datos si es necesario
    { id: 3, nombre: "Ana García", telefono: "5551234567", correo: "ana@example.com", edad: 28, sexo: "F", padecimiento: "Ninguno" },
    { id: 4, nombre: "Pedro Martínez", telefono: "5559876543", correo: "pedro@example.com", edad: 35, sexo: "M", padecimiento: "Asma" },
    { id: 5, nombre: "Luisa Sánchez", telefono: "5558765432", correo: "luisa@example.com", edad: 40, sexo: "F", padecimiento: "Diabetes" },
    { id: 6, nombre: "Jorge Rodríguez", telefono: "5552345678", correo: "jorge@example.com", edad: 45, sexo: "M", padecimiento: "Hipertensión" },
    { id: 7, nombre: "Lucía Fernández", telefono: "5553456789", correo: "lucia@example.com", edad: 50, sexo: "F", padecimiento: "Ninguno" },
    { id: 8, nombre: "Eduardo Gómez", telefono: "5554567890", correo: "eduardo@example.com", edad: 55, sexo: "M", padecimiento: "Migraña" },
    { id: 9, nombre: "Marta Pérez", telefono: "5559876543", correo: "marta@example.com", edad: 60, sexo: "F", padecimiento: "Ninguno" },
    { id: 10, nombre: "Carlos López", telefono: "5558765432", correo: "carlos@example.com", edad: 65, sexo: "M", padecimiento: "Asma" },
    { id: 11, nombre: "Sofía Martínez", telefono: "5552345678", correo: "sofia@example.com", edad: 70, sexo: "F", padecimiento: "Diabetes" },
    { id: 12, nombre: "Mateo Rodríguez", telefono: "5553456789", correo: "mateo@example.com", edad: 75, sexo: "M", padecimiento: "Hipertensión" }
];

const tableBody = document.getElementById('dataBody');
const searchInput = document.getElementById('searchInput');
const perPageSelect = document.getElementById('perPageSelect');

// Función para mostrar los datos en la tabla con límite de registros por página
function displayDataWithLimitAndSearch(data, limit, query) {
    tableBody.innerHTML = '';
    const filteredData = filterData(data, query);
    const dataToDisplay = limit === 'all' ? filteredData : filteredData.slice(0, limit);
    dataToDisplay.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
      <td>${item.id}</td>
      <td>${item.nombre}</td>
      <td>${item.telefono}</td>
      <td>${item.correo}</td>
      <td>${item.edad}</td>
      <td>${item.sexo}</td>
      <td>${item.padecimiento}</td>
      <td><button onclick="deleteRow(${item.id})">Eliminar</button></td>
      <td><button onclick="updateRow(${item.id})">Actualizar</button></td>
    `;
        tableBody.appendChild(row);
    });
}

// Función para filtrar los datos por nombre completo
function filterData(data, query) {
    return data.filter(item => item.nombre.toLowerCase().includes(query.toLowerCase()));
}

// Manejador de evento para el cambio de cantidad de registros por página
perPageSelect.addEventListener('change', function () {
    const limit = this.value === 'all' ? 'all' : parseInt(this.value);
    const query = searchInput.value.trim();
    displayDataWithLimitAndSearch(data, limit, query);
});

// Manejador de evento para la búsqueda en tiempo real
searchInput.addEventListener('input', function () {
    const query = this.value.trim();
    const limit = perPageSelect.value === 'all' ? 'all' : parseInt(perPageSelect.value);
    displayDataWithLimitAndSearch(data, limit, query);
});

// Mostrar datos al cargar la página con un límite predeterminado de 10 registros y sin filtro inicial
displayDataWithLimitAndSearch(data, 10, '');
