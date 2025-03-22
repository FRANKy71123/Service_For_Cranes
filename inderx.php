<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/catalogo.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<body>
    <!-- Encabezado con logo alineado a la derecha -->
    <div class="header">
        <h1>SERVICES FOR CRANES OF PERU SAC</h1>
        <img src="https://i.postimg.cc/x8G4McbX/2.png" alt="Logo de la empresa" class="logo">
    </div>

    <!-- RUC centrado -->
    <p class="ruc">RUC: 20603411481</p>
<!-- PROFORMA -->
<div class="proforma-wrapper">
    <div class="proforma-box" id="proformaTexto">
      PROFORMA N° <span id="numeroProforma">00000</span>
    </div>
    <div class="proforma-edit">
      <input type="number" id="inputProforma" placeholder="N°" />
      <button onclick="actualizarProforma()" title="Actualizar">
        🔄
      </button>
    </div>
  </div>
  <!-- BUSCADOR COMPACTO DE CLIENTE -->
<div class="buscador-cliente-centro">
    <button id="btnMostrarOpciones" title="Buscar Cliente">
        🔍 Buscar Cliente
    </button>

    <div id="opcionesBusqueda" class="opciones-busqueda-oculto">
        <button class="opcion-btn" data-tipo="camion">🚛 Placa Camión</button>
        <button class="opcion-btn" data-tipo="grua">🏗️ Placa Grúa</button>
        <button class="opcion-btn" data-tipo="ruc">🧾 RUC Cliente</button>
    </div>

    <div id="campoBusqueda" class="campo-busqueda-oculto">
        <label id="labelBusqueda"></label>
        <input type="text" id="inputBusqueda" placeholder="" />
        <button id="btnBuscarClienteFinal">Buscar 🔎</button>
    </div>
</div>
<!-- MODAL DE BÚSQUEDA DE PRODUCTOS -->
<div id="searchModal" class="modal-oculto">
    <div class="modal-contenido">
        <span class="cerrar-modal" id="cerrarModal">&times;</span>
        <h2>Buscar Producto</h2>
        
        <input type="text" id="buscarProductoInput" placeholder="Buscar por código o nombre...">
        <button id="buscarProductoBtn">Buscar 🔍</button>

        <table id="tablaCatalogo">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Precio Inicial</th>
                    <th>Precio Venta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="catalogoBody">
                <!-- Aquí se cargan los productos -->
            </tbody>
        </table>
    </div>
</div>

   <!-- datos cliente --> 
<textarea id="clienteNombre" placeholder="Electronorte S.A."></textarea>
<textarea id="clienteRUC" placeholder="20103117560"></textarea>
<textarea id="clienteDireccion" placeholder="Cal. San Martín N°250- Chiclayo"></textarea>
<textarea id="clienteServicio" placeholder="reparación general de camión"></textarea>
<textarea id="clienteLugar" placeholder="PR. Chacupe N° UC10264"></textarea>
<textarea id="clienteCamion" placeholder="Hyundai HD72"></textarea>
<textarea id="clientePlaca" placeholder="B6M-880"></textarea>
<textarea id="clienteKilometraje" placeholder="sin registro por tarjeta averiada"></textarea>
<textarea id="clienteHorometro" placeholder="sin registro por tarjeta averiada"></textarea>
<textarea id="clienteMaquinaria" placeholder="Grúa de brazo articulada - SKYRITZ"></textarea>
<textarea id="clienteModelo" placeholder="SKYRITZ-137L7DI"></textarea>
<textarea id="clienteSerie" placeholder="07,000"></textarea>
<textarea id="clienteAnio" placeholder="2007"></textarea>
<textarea id="clienteFecha" placeholder="09/07/2022"></textarea>




    <h2>Lista de Productos</h2>
    
    <form id="productForm">
        <input type="text" id="productName" placeholder="Nombre del producto" required>
        <input type="number" id="productQuantity" placeholder="Cantidad" required>
        <input type="number" id="productPrice" placeholder="Precio Unitario" step="0.01" required>
        
        <button type="submit">🛒</button>
        <button type="button" id="openSearchModal" class="search-button">🔎</button>
    </form>    

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Precio Final</th>
                <th>Acciones</th> <!-- Nueva columna para botones -->
            </tr>
        </thead>
        <tbody id="productTable">
            <!-- Los productos se agregan aquí dinámicamente -->
        </tbody>
    </table>
    

    <div class="total-container">
        <p class="total-label">Subtotal: <span id="subtotal">0</span></p>
        <p class="total-label">IGV (18%): <span id="igv">0</span></p>
        <p class="total-label">Total: <span id="total">0</span></p>
    </div>

    <button id="exportPdf">Exportar a PDF</button>
    <div class="image-before-footer">
    <img src="https://i.postimg.cc/pdXqKmDp/Dise-o-sin-t-tulo-3.png" alt="Services Image">
</div>

    <!-- Pie de página -->
    <div class="footer">
        <img src="https://i.postimg.cc/63kcKCjf/PUIE-DE-PAGINA.png" alt="Pie de página">
        <p>OF. PRINCIPAL: PSJ. LAS ALMENDRAS MZ D LT 15 – YARINACOCHA / UCAYALI / CORONEL PORTILLO.</p>
        <p>SUC. SERVICIO 01: PR CHACUPE N° UC1024 – CHOSICA DEL NORTE / LA VICTORIA / CHICLAYO / LAMBAYEQUE.</p>
        <p>SUC. SERVICIO 02: MZ B LT 15 AA.HH NUEVO PACHACUTEC SCT1 / VENTANILLA / CALLAO / LIMA.</p>
        <p>CELULAR: 949-156-523</p>
        <p>EMAIL: <a href="mailto:SEFCROP__SAC@HOTMAIL.COM">SEFCROP__SAC@HOTMAIL.COM</a> / 
        <a href="mailto:servicesforcranes.logistica@gmail.com">servicesforcranes.logistica@gmail.com</a></p>
    </div>

    <script defer src="js/animations.js"></script>
    <script defer src="js/script.js"></script>
    <script defer src="js/catalogo.js"></script>
</body>
</html>
