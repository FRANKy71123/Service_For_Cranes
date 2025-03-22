
// Productos de ejemplo
const catalogoProductos = [
    { codigo: "P001", nombre: "Aceite Hidráulico", precioInicial: 50, precioVenta: 60 },
    { codigo: "P002", nombre: "Filtro de Aire", precioInicial: 30, precioVenta: 40 },
    { codigo: "P003", nombre: "Repuesto XYZ", precioInicial: 100, precioVenta: 120 },
    // Puedes agregar más productos aquí
];

// Mostrar y ocultar modal
const openSearchModalBtn = document.getElementById("openSearchModal");
const searchModal = document.getElementById("searchModal");
const cerrarModalBtn = document.getElementById("cerrarModal");

openSearchModalBtn.addEventListener("click", () => {
    searchModal.style.display = "block";
    cargarCatalogo(catalogoProductos); // Cargar todos los productos
});

cerrarModalBtn.addEventListener("click", () => {
    searchModal.style.display = "none";
});

// Cargar productos en tabla
function cargarCatalogo(productos) {
    const catalogoBody = document.getElementById("catalogoBody");
    catalogoBody.innerHTML = ""; // Limpiar tabla

    productos.forEach(prod => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td>${prod.codigo}</td>
            <td>${prod.nombre}</td>
            <td>${prod.precioInicial}</td>
            <td>${prod.precioVenta}</td>
            <td>
                <input type="number" id="cantidad-${prod.codigo}" placeholder="Cant." style="width: 60px;">
                <input type="number" id="ajuste-${prod.codigo}" placeholder="Desc/Aum" style="width: 80px;">
                <button onclick="agregarDesdeCatalogo('${prod.codigo}')">Agregar</button>
            </td>
        `;
        catalogoBody.appendChild(fila);
    });
}

// Buscar producto por código o nombre
document.getElementById("buscarProductoBtn").addEventListener("click", () => {
    const valorBusqueda = document.getElementById("buscarProductoInput").value.toLowerCase();
    const resultados = catalogoProductos.filter(prod => 
        prod.codigo.toLowerCase().includes(valorBusqueda) || 
        prod.nombre.toLowerCase().includes(valorBusqueda)
    );
    cargarCatalogo(resultados);
});

// Agregar producto desde catálogo a tabla principal
function agregarDesdeCatalogo(codigoProd) {
    const producto = catalogoProductos.find(p => p.codigo === codigoProd);
    const cantidad = parseInt(document.getElementById(`cantidad-${codigoProd}`).value);
    const ajuste = parseFloat(document.getElementById(`ajuste-${codigoProd}`).value) || 0;

    if (!cantidad || cantidad <= 0) {
        alert("Ingresa una cantidad válida.");
        return;
    }

    const precioUnitario = producto.precioVenta + ajuste;
    const precioFinal = precioUnitario * cantidad;

    // Agregar a la tabla principal
    const tabla = document.getElementById("productTable");
    const fila = document.createElement("tr");
    fila.innerHTML = `
        <td>${producto.codigo}</td>
        <td>${producto.nombre}</td>
        <td>${cantidad}</td>
        <td>${precioUnitario.toFixed(2)}</td>
        <td>${precioFinal.toFixed(2)}</td>
        <td>
            <button onclick="editarFila(this)">✏️</button>
            <button onclick="eliminarFila(this)">❌</button>
        </td>
    `;
    tabla.appendChild(fila);
    actualizarTotales();

    // Cerrar modal
    searchModal.style.display = "none";
}

// Eliminar fila
function eliminarFila(btn) {
    btn.parentElement.parentElement.remove();
    actualizarTotales();
}

// Editar fila (simple, puedes expandirlo)
function editarFila(btn) {
    const fila = btn.parentElement.parentElement;
    const cantidad = prompt("Nueva cantidad:", fila.children[2].textContent);
    if (cantidad && !isNaN(cantidad)) {
        const precioUnitario = parseFloat(fila.children[3].textContent);
        fila.children[2].textContent = cantidad;
        fila.children[4].textContent = (precioUnitario * cantidad).toFixed(2);
        actualizarTotales();
    }
}

// Actualizar totales
function actualizarTotales() {
    let subtotal = 0;
    const filas = document.querySelectorAll("#productTable tr");
    filas.forEach(fila => {
        const precioFinal = parseFloat(fila.children[4].textContent);
        subtotal += precioFinal;
    });

    const igv = subtotal * 0.18;
    const total = subtotal + igv;

    document.getElementById("subtotal").textContent = subtotal.toFixed(2);
    document.getElementById("igv").textContent = igv.toFixed(2);
    document.getElementById("total").textContent = total.toFixed(2);
}
